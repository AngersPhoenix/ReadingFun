<?php
// namespace Project\Persistance;
if (php_sapi_name () == "cli") {
	require_once 'bootstrap.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/bootstrap.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
}

class Dao {
	
	/**
	 *
	 * @var Doctrine\ORM\EntityManager
	 *
	 */
	protected $entityManager;
	public function __construct($entityManager) {
		$this->entityManager = $entityManager;
	}
}

?>