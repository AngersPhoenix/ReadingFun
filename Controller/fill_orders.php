<?php
error_reporting ( E_ALL );
ini_set ( 'display_errors', 1 );

if (php_sapi_name () == "cli") {
	require_once '../bootstrap.php';
	require_once '../vendor/autoload.php';
	require_once '../Persistance/OrderDaoImp.php';
	require_once '../Persistance/OrderBookDaoImp.php';
	require_once '../Model/Client.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/bootstrap.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Persistance/OrderDaoImp.php';
	require_once $root . '/phoenix/Project/Persistance/OrderBookDaoImp.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Model/Client.php';
	
	$odi = new OrderDaoImp ( $entityManager );
	$cdi = new ClientDaoImp ( $entityManager );
	$obi = new OrderBookDaoImp($entityManager);
	
	if (isset ( $_POST ['action'] )) {
		$see = array();
		$seeall = array();
		$ffinale = array();
		$tmp = array();
		$tmpp = array();
		if (strcmp ( trim ( $_POST ['action'] ), 'edit' ) == 0) {
			
			$orderId = intval(trim($_POST['id']));
			$orderDate = new DateTime(trim($_POST['data']['orders']['Order Date']));
			$orderValid = trim($_POST['data']['orders']['Valid']);
			$clientId = intval(trim($_POST['data']['orders']['Client Id']));
			$orderBookId = trim($_POST['data']['orders']['Order Book Id']);
			
			$order = $odi->getOrderById($orderId);
			$client = $cdi->getClientById($clientId);
			
			if($order !== null){
				$order->setOrderDate($orderDate);
				if( strcmp(strtolower($orderValid),'true') === 0 )
					$order->setValid(true);
				else 		
					$order->setValid(false);
				if($client !== null)
					$order->setClient($client);
				
				$entityManager->flush();
				
				$array['DT_RowId'] = $orderId;
				$see['Order Date'] = $orderDate->format("d-m-Y");
				if($order->getValid())	$see['Valid']= 'true';
				else $see['Valid']= 'false';
				$see['Client Id'] = "".$client->getId()."";				
				$see['Order Book Id'] = "".$orderBookId."";
				$see['Client Name'] = $client->getName();
				$array['orders'] = $see;
				
				$seeall['id'] = "".$orderBookId."";
				
				$tmp['id'] = "".$clientId."";	
				
				$array['Order Book Ids'] = $seeall;
				$array['Client Ids'] = $tmp;
				
				echo json_encode(array('row'=>$array));
				
			}
			
			
			
		}else if (strcmp ( trim ( $_POST ['action'] ), 'create' ) == 0) {
			
			$orderDate = new DateTime(trim($_POST['data']['orders']['Order Date']));
			$orderValid = trim($_POST['data']['orders']['Valid']);
			$clientId = intval(trim($_POST['data']['orders']['Client Id']));
			$orderBookId = $_POST['data']['orders']['Order Book Id'];
			$client = $cdi->getClientById($clientId);
			
			$order = new Order("");
			$order->setOrderDate($orderDate);
			if( strcmp(strtolower($orderValid),'true') === 0 )
					$order->setValid(true);
				else 		
					$order->setValid(false);
			$order->setClient($client);
			if(strcmp(strtolower($orderBookId),'none') !== 0)
			{
				$ordb = $obi->getOrderBooksById(intval($orderBookId));
				$order->addOrderBook($ordb);
			}			
			$entityManager->flush();
			
			$array['DT_RowId'] = $order->getId();
			$see['Order Date'] = $order->getDate()->format("d-m-Y");
			if($order->getValid())	$see['Valid']= 'true';
			else $see['Valid']= 'false';
			$see['Client Id'] = "".$client->getId()."";
			$see['Order Book Id'] = "".$orderBookId."";
			$see['Client Name'] = $client->getName();
			$array['orders'] = $see;
			
			$seeall['id'] = "".$orderBookId."";
			
			$tmp['id'] = "".$clientId."";
			
			$array['Order Book Ids'] = $seeall;
			$array['Client Ids'] = $tmp;
			
			echo json_encode(array('row'=>$array));
			
			
			
			
			
		} if (strcmp ( trim ( $_POST ['action'] ), 'remove' ) == 0) {
		
			$ids = $_POST['id'];
			$order = $odi->getOrderById($ids[0]);

			if($order!==null)$odi->removeOrder($order);
			
			$see = array();
			$seeall = array();
			$ffinale = array();
			
			$innerclients = array();
			$tmp = array();
			$tmpp = array();
			
			$cpt = 0;
			foreach ( $odi->getAllOrders() as $order ) {
				if (count ( $order->getOrderBook () ) === 0) {
			
					$array ['DT_RowId'] = "" . $order->getId () . "";
					json_encode ( $array );
			
					$inter ["Order Date"] = $order->getDate ()->format ( 'd/m/Y' );
			
					if($order->getValid ())$inter ["Valid"] = "true";
					else $inter ["Valid"] = "false";
						
					$inter ["Client Id"] = "".$order->getClient ()->getId()."";
					$inter ["Client Name"] = $order->getClient ()->getName ();
					$inter ["Order Book Id"] = "none";
					$array ['orders'] = $inter;
					json_encode ( $array );
			
					$demi ["id"] = "none";
					$array ["Order Book Ids"] = $demi;
					json_encode ( $array );
			
					$innerclients['id'] = "".$order->getClient()->getId()."";
					$array['Client Ids'] = $innerclients;
					json_encode($array);
			
					$see['value'] = "none";
					$see['label'] = "none";
					$seeall[] = $see;
			
					$tmp['value'] = "".$order->getClient()->getId()."";
					$tmp['label']="".$order->getClient()->getId()."";
					$tmpp[] = $tmp;
			
				} else {
					foreach ( $order->getOrderBook () as $orderbook ) {
						$array ["DT_RowId"] = "" . $order->getId () . "";
						json_encode ( $array );
							
						$inter ["Order Date"] = $order->getDate ()->format ( 'd/m/Y' );
							
						if($order->getValid ())$inter ["Valid"] = "true";
						else $inter ["Valid"] = "false";
							
						$inter ["Client Id"] = "".$order->getClient ()->getId ()."";
						$inter ["Client Name"] = $order->getClient ()->getName ();
						$inter ["Order Book Ids"] = "" . $orderbook->getId() . "";
						$array ['orders'] = $inter;
						json_encode ( $array );
							
						$demi ["id"] = "" . $orderbook->getId () . "";
						$array ["Order Book Ids"] = $demi;
						json_encode ( $array );
							
						$innerclients['id'] = "".$order->getClient()->getId()."";
						$array['Client Ids'] = $innerclients;
						json_encode($array);
							
						$see['value'] = "".$orderbook->getId ()."";
						$see['label'] = "" . $orderbook->getId () . "";
						$seeall[] = $see;
							
						$tmp['value'] = "".$order->getClient()->getId()."";
						$tmp['label']="".$order->getClient()->getId()."";
						$tmpp[] = $tmp;
							
					}
				}
				$cpt ++;
				$final [] = $array;
			}
			
			$ffinal['orders.Order Book Id'] = $seeall;
			$ffinal['orders.Client Id'] = $tmpp;
			echo json_encode ( array (
					'data' => $final,'options'=>$ffinal
			) );
			
		
		
		
		}
	} else {
				$see = array();
				$seeall = array();
				$ffinale = array();
				
				$innerclients = array();
				$tmp = array();
				$tmpp = array();
		
				$cpt = 0;
				foreach ( $odi->getAllOrders() as $order ) {
					if (count ( $order->getOrderBook () ) === 0) {
		
						$array ['DT_RowId'] = "" . $order->getId () . "";
						json_encode ( $array );
		
						$inter ["Order Date"] = $order->getDate ()->format ( 'd/m/Y' );
		
						if($order->getValid ())$inter ["Valid"] = "true";
						else $inter ["Valid"] = "false";
			
						$inter ["Client Id"] = "".$order->getClient ()->getId()."";
						$inter ["Client Name"] = $order->getClient ()->getName ();
						$inter ["Order Book Id"] = "none";
						$array ['orders'] = $inter;
						json_encode ( $array );
		
						$demi ["id"] = "none";
						$array ["Order Book Ids"] = $demi;
						json_encode ( $array );
		
						$innerclients['id'] = "".$order->getClient()->getId()."";
						$array['Client Ids'] = $innerclients;
						json_encode($array);
						
						$see['value'] = "none";
						$see['label'] = "none";
						$seeall[] = $see;
						
						$tmp['value'] = "".$order->getClient()->getId()."";
						$tmp['label']="".$order->getClient()->getId()."";
						$tmpp[] = $tmp;
		
					} else {
						foreach ( $order->getOrderBook () as $orderbook ) {
							$array ["DT_RowId"] = "" . $order->getId () . "";
							json_encode ( $array );
			
							$inter ["Order Date"] = $order->getDate ()->format ( 'd/m/Y' );
			
							if($order->getValid ())$inter ["Valid"] = "true";
							else $inter ["Valid"] = "false";
			
							$inter ["Client Id"] = "".$order->getClient ()->getId ()."";
							$inter ["Client Name"] = $order->getClient ()->getName ();
							$inter ["Order Book Ids"] = "" . $orderbook->getId() . "";
							$array ['orders'] = $inter;
							json_encode ( $array );
			
							$demi ["id"] = "" . $orderbook->getId () . "";
							$array ["Order Book Ids"] = $demi;
							json_encode ( $array );
							
							$innerclients['id'] = "".$order->getClient()->getId()."";
							$array['Client Ids'] = $innerclients;
							json_encode($array);
			
							$see['value'] = "".$orderbook->getId ()."";
							$see['label'] = "" . $orderbook->getId () . "";
							$seeall[] = $see;
							
							$tmp['value'] = "".$order->getClient()->getId()."";
							$tmp['label']="".$order->getClient()->getId()."";
							$tmpp[] = $tmp;
							
						}
					}
					$cpt ++;
					$final [] = $array;
				}
		
					$ffinal['orders.Order Book Id'] = $seeall;
					$ffinal['orders.Client Id'] = $tmpp;
				echo json_encode ( array (
						'data' => $final,'options'=>$ffinal
				) );
		
		
	}
}
