<?php

if (php_sapi_name () == "cli") {
	require_once 'OrderBookDao.php';
	require_once 'Dao.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/Persistance/OrderBookDao.php';
	require_once $root . '/phoenix/Project/Persistance/Dao.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
}

class OrderBookDaoImp extends Dao implements OrderBookDao{
	
	public function __construct($entityManager){
		parent::__construct($entityManager);
	}
	
	public function getOrderBooksByClient($client){
		try{
		if($client instanceof Client){
			$qb = $this->entityManager->createQueryBuilder();
			$qb->select('u')
			   ->from('orderbook', 'u')
			   ->where('u.');
		}
		}catch(Exception $ex){
			echo $ex->getMessage();
		}
	}
	
	public function getAllOrderBooks(){
		try {
			$query = $this->entityManager->createQuery ( 'SELECT ob FROM orderbook ob' );
			return $query->getResult ();
		} catch ( Exception $ex ) {
			echo "OrderBookDaoImp-getAllOrderBooks(): " . $ex->getMessage ();
		}		
	}
	
	public function getOrderBooksByClientId($id){}

	public function getOrderBooksById($id){
		try {
			return $this->entityManager->find ( "orderbook", $id );
		} catch ( Exception $ex ) {
			echo "ClientDaoImp-getClientById(): Error --> ".$ex->getMessage();
		}
	}
	
	
}












?>