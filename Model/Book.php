<?php
if (php_sapi_name () == "cli") {
	require_once 'orderbook.php';
	require_once 'Category.php';
	require_once 'Author.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/Model/orderbook.php';
	require_once $root . '/phoenix/Project/Model/Category.php';
	require_once $root . '/phoenix/Project/Model/Author.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
}

use Doctrine\DBAL\Cache\ArrayStatement;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Doctrine\Common\Collections;

/**
 * @Entity @Table(name="`book`")
 */
class Book {
	
	/**
	 * @Id @Column(type="integer") @GeneratedValue
	 *
	 * @var int
	 */
	protected $id;
	
	/**
	 * @Column(name="`title`",type="string",nullable=false)
	 *
	 * @var string
	 */
	protected $title;
	
	/**
	 * @Column(name="`year`",type="datetime")
	 *
	 * @var datetime
	 */
	protected $year;
	
	/**
	 * @Column(name="`imagepath`",type="string",nullable=true)
	 *
	 * @var string
	 */
	protected $img;
	
	/**
	 * @Column(name="`recap`",type="string",nullable=true)
	 *
	 * @var string
	 */
	protected $recap;
	
	/**
	 * @Column(name="`price`",type="float",nullable=false)
	 *
	 * @var float
	 */
	protected $price;
	
	/**
	 * @OneToMany(targetEntity="orderbook", mappedBy="book")
	 *
	 * @var Order_Book[]
	 *
	 */
	protected $order_book;
	
	// * @OneToOne(targetEntity="Category",cascade={"persist"})
	/**
	 * @ManyToMany(targetEntity="Category",inversedBy="books",cascade={"persist"},fetch="EXTRA_LAZY")
	 *
	 * @var Category[]
	 *
	 */
	protected $categories;
	
	/**
	 * @ManyToMany(targetEntity="Author",inversedBy="books",cascade={"persist"},fetch="EXTRA_LAZY")
	 *
	 * @var Author[]
	 *
	 */
	protected $authors;
	public function Book($title, $year, $price,$img='../../img/Small/php.jpg') {
		$this->title = $title;
		$this->year = new DateTime ();
		$this->year->createFromFormat ( 'd/d/m/y', $year );
		$this->price = $price;
		$this->img = $img;
		
		$this->authors = new ArrayCollection ();
		$this->categories = new ArrayCollection ();
	}
	public function addAuthor($author) {
		$this->authors [] = $author;
	}
	public function addCategory($category) {
		$this->categories [] = $category;
	}
	public function setImgPath($path) {
		$this->img = $path;
	}
	public function setRecap($text) {
		if (is_string ( $text ))
			$this->recap = $text;
	}
	
	public function setTitle($title){
		$this->title = $title;
	}
	public function setYear($year){
		$this->year = $year;
	}
	public function setPrice($price){
		$this->price = $price;
	}
	
	/**
	 * 
	 * @return Integer
	 */
	public function getId(){
		return $this->id;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getTitle(){
		return $this->title;
	}

	/**
	 * 
	 * @return datetime
	 */
	public function getYear(){
		return $this->year;
	}
	
	/**
	 * 
	 * @return float
	 */
	public function getPrice(){
		return $this->price;
	}

	/**
	 * 
	 * @return Author[]
	 */
	public function getAuthors(){
		return $this->authors;
	}

	/**
	 * 
	 * @return Category[]
	 */
	public function getCategories(){
		return $this->categories;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getImg(){
		return $this->img;		
	}
	
	public function setImg($img){
		$this->img = $img;	
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getRecap(){
		return $this->recap;	
	}
	
	/**
	 * 
	 * @return Json
	 */
	public function toJson(){
		return json_encode($this->getTitle());
	}
	
	
	
}

?>