<?php

if (php_sapi_name () == "cli") {
	require_once '../../Controller/Resume.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/Controller/Resume.php';
}

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = false;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/Model"), $isDevMode);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
		'driver' => 'pdo_mysql',
		'dbname' => 'dev_database',
		'user' => 'root',
		'password' => '1991',
		'host' => 'localhost',
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
$GLOBALS['entityManager'] = $entityManager;
$gen = new Resume();
$GLOBALS['resume'] = $gen;
?>
