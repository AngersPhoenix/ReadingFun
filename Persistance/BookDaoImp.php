<?php
// namespace Project\Persistance;
if (php_sapi_name () == "cli") {
	require_once 'BookDao.php';
	require_once 'Dao.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/Persistance/BookDao.php';
	require_once $root . '/phoenix/Project/Persistance/Dao.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
}
class BookDaoImp extends Dao implements BookDao {
	
	/**
	 *
	 * @param Doctrine\ORM\EntityManager $entityManager        	
	 */
	public function __construct($entityManager) {
		parent::__construct ( $entityManager );
	}
	
	/**
	 * get the book by its id or null if not found
	 *
	 * @param $id Integer        	
	 * @return Book
	 */
	public function getBookById($id) {
		try {
			return $this->entityManager->find ( "Book", $id );
		} catch ( Exception $ex ) {
			echo "getBookById()-BookDaoImp" . $ex->getTrace ();
		}
	}
	
	/**
	 * gets all the books in the database or else a null value returned as a result if none was found
	 *
	 * @return Book[]
	 */
	public function getAllBooks() {
		try {
			$query = $this->entityManager->createQuery ( 'SELECT b FROM Book b' );
			return $query->getResult ();
		} catch ( Exception $ex ) {
			echo "BookDaoImp-getAllBooks(): " . $ex->getTrace ();
			return null;
		}
	}
	public function saveBook($book) {
		try {
			if ($book != null) {
				$this->entityManager->beginTransaction ();
				$this->entityManager->persist ( $book );
				$this->entityManager->flush ();
				$this->entityManager->commit ();
			}
		} catch ( Exception $ex ) {
			$this->entityManager->rollback ();
			"BookDaoImp-save(): " . $ex->getMessage ();
		}
	}
	
	public function removeBook($book){
		try{
			$this->entityManager->beginTransaction();
			$this->entityManager->remove($book);
			$this->entityManager->flush();
			$this->entityManager->commit();
		}catch(Exception $ex){
			$this->entityManager->rollback();
			echo 'BookDaoImp-removeClients() '.$ex->getMessage();
		}
	}
	
	
	
	
}

?>