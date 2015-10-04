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



$cdi = new ClientDaoImp($entityManager);
if(isset($_POST['action'])){
	if( strcmp(trim($_POST['action']),'edit') == 0 )
	{
		$client = $cdi->getClientById(trim($_POST['id']));	
		if($client !== null){
			$array = array();

			$client->setName(trim($_POST['data']['Client Name']));
			$client->setAge(trim($_POST['data']['Client Age']));
			$client->setEmail(trim($_POST['data']['Client Email']));
			$client->setPassword(md5(trim($_POST['data']['Client Password'])));
			if(strcmp(trim($_POST['data']['Client Level']),'User') == 0) $client->setLevel(0);
			else $client->setLevel(1);
			
			$entityManager->flush();
			
			$array['DT_RowId'] = "".$client->getId()."";
			$array['Client Name'] = $client->getName();
			$array['Client Age'] = $client->getAge();
			$array['Client Email']  = $client->getEmail();
			$array['Client Password'] = $client->getPassword();
			if($client->getLevel() === 0 ) $array['Client Level'] = 'User';
			else $array['Client Level'] = 'Admin';
			
			echo json_encode(array('row'=>$array));
		}
	}else if( strcmp(trim($_POST['action']),'create') == 0 ){
		
		$client = new Client(trim($_POST['data']['Client Name']), trim($_POST['data']['Client Age']), trim($_POST['data']['Client Email']), trim($_POST['data']['Client Password']));
		$cdi->saveClient($client);
		
		$array['DT_RowId'] = "".$client->getId()."";
		$array['Client Name'] = $client->getName();
		$array['Client Age'] = $client->getAge();
		$array['Client Email']  = $client->getEmail();
		$array['Client Password'] = $client->getPassword();
		if($client->getLevel() === 0 ) $array['Client Level'] = 'User';
		else $array['Client Level'] = 'Admin';
			
		echo json_encode(array('row'=>$array));
		
	}else if( strcmp(trim($_POST['action']),'remove') == 0 ){
		$ids = $_POST['id'];
		$client = $cdi->getClientById($ids[0]);
		if($client!=null)$cdi->removeClient($client);
		$array  = array();
		$final  = array();
		foreach ($cdi->getAllClients() as $client)
			if($client->getLevel()===0){
			$array['DT_RowId'] = $client->getId();
			$array['Client Name'] = $client->getName();
			$array['Client Age'] = "".$client->getAge()."";
			$array['Client Email'] = $client->getEmail();
			$array['Client Password'] = $client->getPassword();
			$array['Client Level'] = 'User';
			$final[] = $array;
		}
		echo json_encode(array('data'=>$final));
	}
	
	
	}else{
	
	$array  = array();
	$final  = array();
	
		foreach ($cdi->getAllClients() as $client)
			if($client->getLevel()===0){
					$array['DT_RowId'] = $client->getId();
					$array['Client Name'] = $client->getName();
					$array['Client Age'] = "".$client->getAge()."";
					$array['Client Email'] = $client->getEmail();
					$array['Client Password'] = $client->getPassword();
					$array['Client Level'] = 'User';
					$final[] = $array;
					}
	
		echo json_encode(array('data'=>$final));
	
	}



?>