<?php
// use Project\Persistance as db;
require_once 'Chunks/general.php';
require_once "bootstrap.php";
// // require_once 'Controller/Resume.php';


spl_autoload_register('persistanceLoader');
spl_autoload_register('modelLoader');

// if (php_sapi_name () == "cli") {
// 	require_once "bootstrap.php";
// 	require_once 'Model/Client.php';
// 	require_once 'Model/Order.php';
// 	require_once 'Model/Book.php';
// 	require_once 'Model/orderbook.php';
// 	require_once 'Model/Author.php';
// 	require_once 'Model/Category.php';
// 	require_once 'Persistance/BookDaoImp.php';
// 	require_once 'Persistance/ClientDaoImp.php';
// 	require_once 'Persistance/OrderDaoImp.php';
// 	require_once 'vendor/autoload.php';
// } else {
// 	$root = $_SERVER ['DOCUMENT_ROOT'];
// 	require_once $root . '/phoenix/Project/bootstrap.php';
// 	require_once $root . '/phoenix/Project/Model/Client.php';
// 	require_once $root . '/phoenix/Project/Model/Order.php';
// 	require_once $root . '/phoenix/Project/Model/Book.php';
// 	require_once $root . '/phoenix/Project/Model/orderbook.php';
// 	require_once $root . '/phoenix/Project/Model/Author.php';
// 	require_once $root . '/phoenix/Project/Model/Category.php';
// 	require_once $root . '/phoenix/Project/Persistance/BookDaoImp.php';
// 	require_once $root . '/phoenix/Project/Persistance/ClientDaoImp.php';
// 	require_once $root . '/phoenix/Project/Persistance/OrderDaoImp.php';
// 	require_once $root . '/phoenix/Project/vendor/autoload.php';

// 	// require_once 'vendor/autoload.php';
// }


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Doctrine\Common\Collections;





// $bdi = new BookDaoImp($entityManager);
// $books = $bdi->getAllBooks();
// echo $books[0]->toJson()."\n";
// // $iterator = new ArrayIterator($books);
// // $iterator->uasort(function($a,$b){
// // 	return ($a->getPrice() > $b->getPrice()) ? 1:-1;	
// // });
// // $books = new ArrayCollection(iterator_to_array($iterator));

// // foreach ($books as $book)
// // 	echo $book->getTitle()." ".$book->getPrice()."\n";

// // echo "\n".$books->get(0)->getTitle()."\n";

// $collections = new ArrayCollection($books);
// $criteria = Criteria::create()
// ->orderBy(array("price" => Criteria::ASC));
// $newbooks = $collections->matching($criteria);

// // foreach ($books as $book)
// // 	echo $book->getTitle()." ".$book->getPrice()."\n";

// for($i=0;$i<6;$i++)
// 	echo $newbooks[$i]->getTitle()." ".$newbooks[$i]->getPrice()."\n";
// // echo "\n".$books->get(0)->getTitle()."\n";


// $cdi = new ClientDaoImp($entityManager);
// $client =  $cdi->getClientById(3);

// echo "Password  ".$client->getPassword();

// echo md5('1991');



// $tab = [12.3,353.3,15];
// echo "\n".join($tab,',')."\n";
// if (($client->getOrders()[2]->getOrderBook()[2]) === null) echo "indeed !";
// echo "hao : ".count($client->getOrders()[2]->getOrderBook());

// $array = array();
// $final = array();
// $clients = $cdi->getAllClients();

// foreach($clients as $client)
// 	foreach ($client->getOrders() as $order)
// 		if(count($order->getOrderBook()) == 0){
// 			$array["Order Id"] = $order->getId();
// 			$array["Order Date"] = $order->getDate()->format('d/m/Y H:i:s');
// 			$array["Valid"] = $order->getValid();
// 			$array["Client Id"] = $order->getClient()->getId();
// 			$array["Client Name"] = $order->getClient()->getName();
// 			$array["Order Book Id"] = "none";
// 			$final [] = $array;
// 	}else{
// 			foreach($order->getOrderBook() as $orderbook){
// 				$array["Order Id"] = $order->getId();
// 				$array["Order Date"] = $order->getDate()->format('d/m/Y H:i:s');
// 				$array["Valid"] = $order->getValid();
// 				$array["Client Id"] = $order->getClient()->getId();
// 				$array["Client Name"] = $order->getClient()->getName();
// 				$array["Order Book Id"] = $orderbook->getId();
// 				$final [] = $array;
// 		}
// 	}

// print_r($final);

// $odi = new OrderDaoImp($entityManager);

// $orders = $odi->getAllOrders();


// $cdi = new ClientDaoImp($entityManager);

// $array  = array();
// $final  = array();

// foreach ($cdi->getAllClients() as $client)
// 	if($client->getLevel()===0){
// 	$array['Client Name'] = $client->getName();
// 	$array['Client Age'] = "".$client->getAge()."";
// 	$array['Client Email'] = $client->getEmail();
// 	$array['Client Password'] = $client->getPassword();
// 	$array['Client Level'] = 'User';
// 	$final[] = $array;
// }

// echo json_encode(array('data'=>$final));

$odi = new OrderDaoImp($entityManager);


$array = array ();
$inter = array();
$demi = array ();
$final = array ();
$cpt = 0;

// echo count($odi->getAllOrders());
// $orders = $odi->getAllOrders();
// foreach($orders as $k)
// 	echo "--> ".$k->getId()."\n";


// 		$see = array();
// 				$seeall = array();
// 				$ffinale = array();
				
// 				$innerclients = array();
// 				$clients = array();
// 				$tmp = array();
// 				$tmpp = array();
		
// 				$cpt = 0;
// 				foreach ( $odi->getAllOrders() as $order ) {
// 					if (count ( $order->getOrderBook () ) === 0) {
		
// 						$array ['DT_RowId'] = "" . $order->getId () . "";
// 						json_encode ( $array );
		
// 						$inter ["Order Date"] = $order->getDate ()->format ( 'd/m/Y' );
		
// 						if($order->getValid ())$inter ["Valid"] = "true";
// 						else $inter ["Valid"] = "false";
			
// 						$inter ["Client Id"] = "".$cpt."";
// 						$inter ["Client Name"] = $order->getClient ()->getName ();
// 						$inter ["Order Book Id"] = "" . $cpt . "";
// 						$array ['orders'] = $inter;
// 						json_encode ( $array );
		
// 						$demi ["id"] = "none";
// 						$array ["Order Book Ids"] = $demi;
// 						json_encode ( $array );
		
// 						$innerclients['id'] = "".$order->getClient()->getId()."";
// 						$array['Client Ids'] = $innerclients;
// 						json_encode($array);
						
// 						$see['value'] = "".$cpt."";
// 						$see['label'] = "none";
// 						$seeall[] = $see;
						
// 						$tmp['value'] = "".$cpt."";
// 						$tmp['label']="".$order->getClient()->getId()."";
// 						$tmpp[] = $tmp;
		
// 					} else {
// 						foreach ( $order->getOrderBook () as $orderbook ) {
// 							$array ["DT_RowId"] = "" . $order->getId () . "";
// 							json_encode ( $array );
			
// 							$inter ["Order Date"] = $order->getDate ()->format ( 'd/m/Y' );
			
// 							if($order->getValid ())$inter ["Valid"] = "true";
// 							else $inter ["Valid"] = "false";
			
// 							$inter ["Client Id"] = $order->getClient ()->getId ();
// 							$inter ["Client Name"] = $order->getClient ()->getName ();
// 							$inter ["Order Book Ids"] = "" . $cpt . "";
// 							$array ['orders'] = $inter;
// 							json_encode ( $array );
			
// 							$demi ["id"] = "" . $orderbook->getId () . "";
// 							$array ["Order Book Ids"] = $demi;
// 							json_encode ( $array );
			
// 							$see['value'] = "".$cpt."";
// 							$see['label'] = "" . $orderbook->getId () . "";
// 							$seeall[] = $see;
			
// 						}
// 					}
// 					$cpt ++;
// 					$final [] = $array;
// 				}
		
// 					$ffinal['orders.Order Book Id'] = $seeall;
// 					$ffinal['orders.Client Id'] = $tmpp;
// 				echo json_encode ( array (
// 						'data' => $final,'options'=>$ffinal
// 				) );


$order = $odi->getOrderById(4);

$order->removeOrderBook($orderbook);






?>