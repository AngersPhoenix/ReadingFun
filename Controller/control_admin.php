<?php
error_reporting ( E_ALL );
ini_set ( 'display_errors', 1 );

if (php_sapi_name () == "cli") {
	require_once '../bootstrap.php';
	require_once '../vendor/autoload.php';
	require_once '../Persistance/BookDaoImp.php';
	require_once '../Persistance/ClientDaoImp.php';
	require_once '../Persistance/OrderBookDaoImp.php';
	require_once '../Persistance/OrderDaoImp.php';
	require_once '../../vendor/autoload.php';
	require_once '../Model/Client.php';
	require_once '../Model/Book.php';
	require_once '../Model/Author.php';
	require_once '../Model/Category.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/bootstrap.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Persistance/ClientDaoImp.php';
	require_once $root . '/phoenix/Project/Persistance/OrderBookDaoImp.php';
	require_once $root . '/phoenix/Project/Persistance/OrderDaoImp.php';
	require_once $root . '/phoenix/Project/Persistance/BookDaoImp.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Model/Client.php';
	require_once $root . '/phoenix/Project/Model/Book.php';
	require_once $root . '/phoenix/Project/Model/Author.php';
	require_once $root . '/phoenix/Project/Model/Category.php';
}
session_start ();

if (isset ( $_POST ['action'] )) {
	
	$cl = $_SESSION ['client'];
	$cdi = new ClientDaoImp ( $entityManager );
	$clients = $cdi->getAllClients ();
	
	if (strcmp ( trim ( $_POST ['action'] ), 'chart' ) == 0) {
		$cdi = new BookDaoImp ( $entityManager );
		$books = $cdi->getAllBooks ();
		$array = array ();
		$titles = array ();
		foreach ( $books as $book ) {
			$array [] = $book->getPrice ();
			$titles [] = $book->getTitle ();
		}
		echo json_encode ( array (
				'flag' => true,
				'data' => $array,
				'titles' => $titles 
		) );
	} else if (strcmp ( trim ( $_POST ['action'] ), 'dataOrders' ) == 0) {
		
		$array = array ();
		$final = array ();
		
		foreach ( $clients as $client )
			foreach ( $client->getOrders () as $order )
				if (count ( $order->getOrderBook () ) == 0) {
					$array ["Order Id"] = $order->getId ();
					$array ["Order Date"] = $order->getDate ()->format ( 'd/m/Y' );
					$array ["Valid"] = $order->getValid ();
					$array ["Client Id"] = $order->getClient ()->getId ();
					$array ["Client Name"] = $order->getClient ()->getName ();
					$array ["Order Book Id"] = "none";
					$final [] = $array;
				} else {
					foreach ( $order->getOrderBook () as $orderbook ) {
						$array ["Order Id"] = $order->getId ();
						$array ["Order Date"] = $order->getDate ()->format ( 'd/m/Y' );
						$array ["Valid"] = $order->getValid ();
						$array ["Client Id"] = $order->getClient ()->getId ();
						$array ["Client Name"] = $order->getClient ()->getName ();
						$array ["Order Book Id"] = $orderbook->getId ();
						$final [] = $array;
					}
				}
		
		echo json_encode ( array (
				'flag' => true,
				'data' => $final 
		) );
	} else if (strcmp ( trim ( $_POST ['action'] ), 'ids' ) == 0) {
		
		$obdi = new OrderBookDaoImp($entityManager);
		$array = array ();
		foreach ( $obdi->getAllOrderBooks() as $orderbook )
			$array [] = $orderbook->getId();
		echo json_encode ( array (
				'flag' => true,
				'data' => $array 
		) );
	} else if (strcmp ( trim ( $_POST ['action'] ), 'updateOrder' ) == 0) {
		$odi = new OrderDaoImp ( $entityManager );
		$order = $odi->getOrderById ( intval ( trim ( $_POST ['id'] ) ) );
		if ($order != null) {

			$order->setOrderDate ( new DateTime ( trim ( $_POST ['date'] ) ) );
			if (strcmp (trim ( $_POST ['valid']), 'true' ) == 0 )
				$order->setValid ( true );
			else
				$order->setValid ( false );
			
			$entityManager->flush();
			echo json_encode ( array (
					'flag' => true 
			) );
		} else
			echo json_encode ( array (
					'flag' => false 
			) );
	} else if (strcmp(trim($_POST['action']),'dataClients') == 0){
		
		$array = array ();
		$final = array ();
		
		$cdi = new ClientDaoImp($entityManager);
		foreach($cdi->getAllClients() as $client){
			
			if($client->getLevel()===0){
			$array['Client Level'] = 'User';
// 			$array['Client Id'] = $client->getId();
			$array['Client Name'] = $client->getName();
			$array['Client Age'] = $client->getAge();
			$array['Client Email'] = $client->getEmail();
			$array['Client Password'] = $client->getPassword();
			$final[] = $array;
			}
		}
			
		echo json_encode(array('flag'=>true,'data'=>$final));
		
	}else if(strcmp ( trim ( $_POST ['action'] ), 'updateClient' ) == 0){
		
		$c = $cdi->getClientById(intval(trim($_POST['id'])));
		$c->setName(trim($_POST['name']));
		$c->setAge(trim($_POST['age']));
		$c->setEmail(trim($_POST['email']));
		if(strcmp(strtolower(trim($_POST['level'])),strtolower('User')) == 0)
			$c->setLevel(0);
		else
			$c->setLevel(1);
		
		if(strlen(trim($_POST['password'])) !== 0)
			$c->setPassword(md5(trim($_POST['password'])));
		
		//the unitofWork will automatically detect the changes & it will be saved eventually
		$entityManager->flush();
		
		echo json_encode(array('flag'=>true));
				
	}else if(strcmp ( trim ( $_POST ['action'] ), 'dataBook' ) == 0){
	$array = array ();
	$final = array ();
	
	$bdi = new BookDaoImp($entityManager);
	
	foreach($bdi->getAllBooks() as $book){
		$array['Book Id'] = $book->getId();
		$array['Book Title'] = $book->getTitle();
		$array['Production Year'] = $book->getYear()->format('d-m-Y');
		$array['Image Path'] = $book->getImg();
		$array['About'] = $book->getRecap();
		$array['Book Price'] = $book->getPrice();
		$final[] = $array;		
	}
	
	echo json_encode(array('flag'=>true,'data'=>$final));
	
	
	
	} else if(strcmp(trim($_POST['action']),'updateBook') == 0){
		
		$bdi = new BookDaoImp($entityManager);
		$book = $bdi->getBookById(intval(trim($_POST['id'])));
		
		$book->setTitle(trim($_POST['title']));
		$book->setPrice(floatval(trim($_POST['price'])));
		$book->setRecap(trim($_POST['about']));
		$book->setYear(new DateTime(trim($_POST['date'])));
		
		$entityManager->flush();
			
		echo json_encode(array('flag'=>true));	
		
	}else
		echo json_encode ( array (
				'flag' => false,
				'cause' => 'not specified' 
		) );
}else
	echo json_encode ( array (
			'flag' => false,
			'cause' => 'not set' 
	) );

?>




