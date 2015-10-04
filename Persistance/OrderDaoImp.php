<?php
// namespace Project\Persistance;
if (php_sapi_name () == "cli") {
	require_once 'OrderDao.php';
	require_once 'Dao.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/Persistance/OrderDao.php';
	require_once $root . '/phoenix/Project/Persistance/Dao.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
}
class OrderDaoImp extends Dao implements OrderDao {
	
	/**
	 *
	 * @param Doctrine\ORM\EntityManager $entityManager        	
	 */
	public function __construct($entityManager) {
		parent::__construct ( $entityManager );
	}
	
	/**
	 * this function helps locate the wanted order from the data base by it's id or else null is generated
	 *
	 * @param $id Integer        	
	 * @return Order[]
	 */
	public function getOrderById($id) {
		try {
			return $this->entityManager->find ( "order", $id );
		} catch ( Exception $ex ) {
			echo "getOrderById()-OrderDaoImp" . $ex->getTrace ();
		}
	}
	/**
	 *
	 * @see OrderDao::getOrderByClient()
	 * @return Order
	 */
	public function getOrdersByClient($client) {
		try {
			if ($client instanceof Client) {
				$query = $this->entityManager->createQuery ( 'SELECT o FROM order o WHERE o.client = ' . $client->getId ().'');
				return $query->getResult();
			}else 
				return null;
		} catch ( Exception $ex ) {
			echo "getOrderByClient()-OrderDaoImp: " . $ex->getMessage ();
		}
	}
	public function saveOrder($order) {
		// actually i don't need this function because if just a simple the unitofwork detects a small change it will automaticly save the changes !
	}
	
	/**
	 * 
	 * @see OrderDao[]
	 */
	public function getAllOrders() {
		try {
			$query = $this->entityManager->createQuery ( 'SELECT ord FROM Order ord' );
			return $query->getResult ();
		} catch ( Exception $ex ) {
			echo "OrderDaoImp-getAllOrders(): " . $ex->getMessage ();
		}
	}
	
	
	public function updateOrde($order) {
	}


	public function removeOrder($order){
		try{
			$this->entityManager->beginTransaction();
			$this->entityManager->remove($order);
			$this->entityManager->flush();
			$this->entityManager->commit();
		}catch(Exception $ex){
			$this->entityManager->rollback();
			echo 'OrderDaoImp-removeOrder() '.$ex->getMessage();
		}		
	}


}

?>