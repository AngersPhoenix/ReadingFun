<?php
error_reporting ( E_ALL );
ini_set ( 'display_errors', 1 );

if (php_sapi_name () == "cli") {
	require_once '../bootstrap.php';
	require_once '../vendor/autoload.php';
	require_once '../Persistance/ClientDaoImp.php';
	require_once '../../vendor/autoload.php';
	require_once '../Model/Client.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/bootstrap.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Persistance/ClientDaoImp.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
	require_once $root . '/phoenix/Project/Model/Client.php';
}
session_start ();

if (isset ( $_POST ['action'] )) {
	
	$cl = $_SESSION ['client'];
	$cdi = new ClientDaoImp ( $entityManager );
	$client = $cdi->getClientById ( $cl->getId () );
	
	if (strcmp ( md5 ( trim ( $_POST ['clientOld'] ) ), $client->getPassword () ) == 0) {
		
		$client->setName ( trim ( $_POST ['clientName'] ) );
		$client->setAge ( intval ( trim ( $_POST ['clientAge'] ) ) );
		$client->setEmail ( trim ( $_POST ['clientEmail'] ) );
		$client->setPassword ( md5 ( trim ( $_POST ['clientNew'] ) ) );
		
		$entityManager->flush ();
		echo json_encode ( array (
				'flag' => true,'name'=>$client->getName(),'age'=>$client->getAge(),'email'=>$client->getEmail() 
		) );
	} else
		echo json_encode ( array (
				"flag" => false,
				'cause' => 'old error' 
		) );
} else
	echo json_encode ( array (
			"flag" => false,
			'cause' => 'action was not set' 
	) );

?>