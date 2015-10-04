<?php
if (php_sapi_name () == "cli") {
	require_once 'Book.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/Model/Book.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
}

use Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity @Table(name="`category`")
 */
class Category {
	
	/**
	 * @Id @Column(type="integer") @GeneratedValue
	 *
	 * @var int
	 */
	protected $id;
	
	/**
	 * @Column(name="`name`",type="string",nullable=false)
	 *
	 * @var string
	 */
	protected $name;
	// * @OneToOne(targetEntity="Category",cascade={"persist"})
	/**
	 * @ManyToMany(targetEntity="Book",inversedBy="categories",cascade={"persist"},fetch="EXTRA_LAZY")
	 *
	 * @var Book[]
	 *
	 */
	protected $books;
	public function __construct($name) {
		$this->name = $name;
		$this->books = new ArrayCollection ();
	}
	
	/**
	 * adds a new book to this category
	 * @param Book $book
	 * @return void
	 */
	public function addBook($book) {
		if ($book instanceof Book)
			$this->books [] = $book;
	}
	
	/**
	 * @return string
	 */
	public function getName(){
		return $this->name;
	}
		
	/**
	 * @return Integer
	 */
	public function getId(){
		return $this->id;
	}
	
	/**
	 * @return Book[]
	 */
	public function getBooks(){
		return $this->books;
	}
	
}

?>