<?php

if (php_sapi_name () == "cli") {
	require_once 'Dao.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/Persistance/Dao.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
}

interface OrderBookDao{
	
	public function getOrderBooksByClient($client);
	public function getOrderBooksById($id);
	public function getOrderBooksByClientId($id);
	public function getAllOrderBooks();
}



?>