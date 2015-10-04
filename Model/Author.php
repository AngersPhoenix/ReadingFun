<?php
if (php_sapi_name() == "cli") {
	require_once 'Book.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once $root.'/phoenix/Project/Model/Book.php';
	require_once $root.'/phoenix/Project/vendor/autoload.php';
}


/**
 * @Entity @Table(name="`author`")
 **/
class Author {
	
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
	
	/**
	 * @Column(name="`recap`",type="string",columnDefinition="text")
	 * 
	 * @var string
	 */
	protected $recap;
	
	/**
	 * @ManyToMany(targetEntity="Book",mappedBy="authors",fetch="EXTRA_LAZY")
	 * 
	 * @var books []
	 *     
	 */
	protected $books;
	public function __construct($name) {
		$this->name = $name;
	}
	public function setRecap($text) {
		if (is_string ( $text ))
			$this->recap = $text;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getName(){
		return $this->name;
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
	 * @param Book $book
	 */
	public function addBook($book){
		if($book instanceof Book)
			$this->books[] = $book;		
	}
	
}

?>