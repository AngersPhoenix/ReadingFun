<?php
// namespace Project\Persistance;
if (php_sapi_name () == "cli") {
	require_once 'Dao.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/Persistance/Dao.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
}


interface BookDao{
	public function getBookById($id);
	public function saveBook($book);
	public function getAllBooks();
	public function removeBook($book);
}





?>