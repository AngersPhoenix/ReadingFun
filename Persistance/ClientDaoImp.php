<?php

// namespace Project\Persistance;

if (php_sapi_name () == "cli") {
	require_once 'ClientDao.php';
	require_once 'Dao.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/Persistance/ClientDao.php';
	require_once $root . '/phoenix/Project/Persistance/Dao.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
}

class ClientDaoImp extends DAO implements ClientDao {
	
	/**
	 *
	 * @param Doctrine\ORM\EntityManager $entityManager        	
	 */
	public function __construct($entityManager) {
		parent::__construct ( $entityManager );
	}
	
	/**
	 * get the client from the database using it's id
	 *
	 * @param $id the id of the client
	 * @return Client
	 */
	public function getClientById($id) {
		try {
			return $this->entityManager->find ( "Client", $id );
		} catch ( Exception $ex ) {
			echo "ClientDaoImp-getClientById(): Error --> ".$ex->getMessage();
		}
	}
	
	/**
	 * get the client from the database using it's id
	 *
	 * @param $id the
	 *        	id of the client
	 * @return Client
	 */
	public function getClientByEmail($email) {
		try {
			if (is_string ( $email )) {
				$query = $this->entityManager->createQuery ( 'SELECT c FROM Client c WHERE c.email=\'' . $email . '\'' );
				$array = $query->getResult ();
				return $array [0];
			}
		} catch ( Exception $ex ) {
			"ClientDaoImp-getClientByEmail(): Error " . $ex->getTrace ();
		}
	}
	
	/**
	 * saves another client to the database
	 *
	 * @param Client $client        	
	 * @return void
	 */
	public function saveClient($client) {
		try {
			if ($client != null) {
				$this->entityManager->beginTransaction ();
				$this->entityManager->persist ( $client );
				$this->entityManager->flush ();
				$this->entityManager->commit ();
			}
		} catch ( Exception $ex ) {
			$this->entityManager->rollback ();
			"ClientDaoImp-save(): " . $ex->getMessage ();
		}
	}
	
	/**
	 * update the client using the client values
	 *
	 * @param Client $client        	
	 * @return void
	 */
	public function updateClient($client) {
		try {
			
			$tmp = $this->getClientById ( $client->getId () );
			clientDaoImp::updateState ( $tmp, $client );
			$this->entityManager->persist ( $tmp );
			// $this->entityManager->flush();
		} catch ( Exception $ex ) {
			"ClientDaoImp-update(): " . $ex->getTrace ();
		}
	}
	
	/**
	 * get all the clients in the database or null if none was found 
	 *
	 * @param
	 *        	none
	 * @return ArrayCollection
	 */
	public function getAllClients() {
		try {
			$query = $this->entityManager->createQuery ( 'SELECT c FROM Client c' );
			return $query->getResult ();
		} catch ( Exception $ex ) {
			echo "ClientDaoImp-getAllClients(): " . $ex->getTrace ();
		}
	}
	
	/**
	 * static function that change the first argument identical to the second
	 *
	 * @param Client $client        	
	 * @return void
	 */
	private static function updateState(Client $client1, Client $client2) {
		// $flag = false;
		foreach ( $client1->getProprities () as $key => $value ) {
			if ($value != $client2->getProprities ()[$key]) {
				$value = $client2->getProprities ()[$key];
			}
		}
		// return flag;
		// $client1->setName ( $client2->getName () );
		// $client1->setAge ( $client2->getAge () );
		// $client1->setEmail ( $client2->getEmail () );
		// $client1->setLevel ( $client2->getLevel () );
		// $client1->setPassword ( $client2->getPassword () );
	}
	
	public function removeClient($client){
		try{
			$this->entityManager->beginTransaction();
			$this->entityManager->remove($client);
			$this->entityManager->flush();
			$this->entityManager->commit();
		}catch(Exception $ex){
			$this->entityManager->rollback();
			echo 'ClientDaoImp-removeClients() '.$ex->getMessage();
		}
	}
	
	
	
}

?>