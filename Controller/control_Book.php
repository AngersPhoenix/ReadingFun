<?php
error_reporting ( E_ALL );
ini_set ( 'display_errors', 1 );

if (php_sapi_name () == "cli") {
	require_once '../bootstrap.php';
	require_once '../vendor/autoload.php';
	require_once '../Persistance/BookDaoImp.php';
	require_once '../../vendor/autoload.php';
	require_once '../Model/Book.php';
	require_once '../Model/Author.php';
	require_once '../Model/Category.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/bootstrap.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Persistance/BookDaoImp.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Model/Book.php';
	require_once $root . '/phoenix/Project/Model/Author.php';
	require_once $root . '/phoenix/Project/Model/Category.php';
}


if(isset($_POST ['action'])){

	if (strcmp ( $_POST ['action'], 'logout' ) == 0) {
		try {
			session_start ();
// 			$_SESSION = array ();
			session_destroy ();
			echo json_encode ( array (
					'flag' => 'yes'
			) );
		} catch ( Exception $ex ) {
			echo json_encode ( array (
					'flag' => "control_registration(page): " . $ex->getTrace ()
			) );
		}
	}














}





?>