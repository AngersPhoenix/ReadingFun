<?php
error_reporting ( E_ALL );
ini_set ( 'display_errors', 1 );

if (php_sapi_name () == "cli") {
	require_once '../bootstrap.php';
	require_once '../vendor/autoload.php';
	require_once '../Persistance/BookDaoImp.php';
	require_once '../Persistance/ClientDaoImp.php';
	require_once '../../vendor/autoload.php';
	require_once '../Model/Book.php';
	require_once '../Model/Client.php';
	require_once '../Model/Author.php';
	require_once '../Model/Order.php';
	require_once '../Model/orderbook.php';
	require_once '../Model/Category.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/bootstrap.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Persistance/BookDaoImp.php';
	require_once $root . '/phoenix/Project/Persistance/ClientDaoImp.php';
	require_once $root . '/phoenix/Project/Persistance/OrderDaoImp.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Model/Book.php';
	require_once $root . '/phoenix/Project/Model/Order.php';
	require_once $root . '/phoenix/Project/Model/Client.php';
	require_once $root . '/phoenix/Project/Model/Author.php';
	require_once $root . '/phoenix/Project/Model/orderbook.php';
	require_once $root . '/phoenix/Project/Model/Category.php';
}
session_start();

if (isset ( $_POST ['action'] )) {
	
	if (strcmp ( $_POST ['action'], 'order' ) == 0 && isset ( $_POST ['bookId'] ) && isset($_POST['quantity'])) {
		$bdi = new BookDaoImp ( $entityManager );
		$book = $bdi->getBookById ( intval ( $_POST ['bookId'] ) );
		if ($book != null) {
			
			if (isset ( $_SESSION ['client'] )) {
				
				$client = $_SESSION['client'];
				
				$cdi = new ClientDaoImp ( $entityManager );
				$order = new Order ( '' );
				$ob = new orderbook ();

				$ob->setBook ( $book );
				$ob->setQuantity (intval($_POST['quantity']));
				$ob->setOrder ($order);
				$order->addOrderBook ( $ob );
				//i know it's not the best choice but the unitofWork recognize it as a different entity !
				$order->setClient ( $cdi->getClientById($client->getId()) );
				$client->addOrder ( $order );
			
				$entityManager->persist($order);
				$entityManager->flush();
				
				$_SESSION['client']=$client;
				
				$cpt=0;
				foreach($client->getOrders() as $order)
					if(!$order->getValid())
						$cpt++;
				
				echo json_encode(array('flag'=>'ok','count'=>$client->getId(),'total'=>$cpt));
			}else
				echo json_encode ( array('flag','error:Client not found' ));
		} else
			echo json_encode ( array('flag','error:Book Null') );
	} else if(strcmp($_POST['action'],'validation') == 0 && isset($_POST['value']) && isset($_POST['id'])){
		
		try{
		
			$cl = $_SESSION['client'];
			$cdi = new ClientDaoImp($entityManager);
			$client = $cdi->getClientById($cl->getId());
			$order = new OrderDaoImp($entityManager);
			$orders = $order->getOrdersByClient($client);

			foreach($orders as $order)
				foreach($order->getOrderBook() as $orderbook)
					if($orderbook->getId() == intval($_POST['id'])){
						if($orderbook->getQuantity()!=intval($_POST['value'])){
						$orderbook->setQuantity(intval($_POST['value']));
						$entityManager->flush();
						break;
						}else break;
					}
			echo json_encode ( array('flag','true') );
		}catch(Exception $ex){
// 			$ex->getMessage();
			echo json_encode (array('flag','false'));
		}
		
	}else if (strcmp($_POST['action'],'login')==0 && isset($_POST['email']) && isset($_POST['password'])){
		
		$email = trim ( $_POST ['email'] );
		$password = trim ( $_POST ['password'] );
		
		$cdi = new ClientDaoImp($entityManager);
		$client = $cdi->getClientByEmail($email);
		
		if ($client == null)
			echo json_encode ( array (
					'flag' => 'EMAIL_NULL' 
			) );
		else {
			if (strcmp ( $client->getPassword (), md5 ( $password ) ) == 0) {
				
				$cl = $_SESSION['client'];
				$cdi = new ClientDaoImp($entityManager);
				$client = $cdi->getClientById($cl->getId());
				
				if($client!=null)
					foreach($client->getOrders() as $order)
							if(!$order->getValid())$order->setValid(true);							
				
				$entityManager->flush();
					
				echo json_encode ( array (
						'flag' => 'PASSWD_OK',
				) );
			} else
				echo json_encode ( array (
						'flag' => 'PASSWD_NULL' 
				) );
		}
		
	}else
		echo json_encode ( array('flag','error: Action not found') );
}

?>




