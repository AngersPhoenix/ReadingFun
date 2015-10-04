<?php
if (php_sapi_name () == "cli") {
	require_once 'Book.php';
	require_once 'Order.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/Model/Book.php';
	require_once $root . '/phoenix/Project/Model/Order.php';
	require_once $root.'/phoenix/Project/vendor/autoload.php';
}


/**
 * @Entity @Table(name="orderbook")
 */
class orderbook {
	
	/**
	 * @Id @Column(type="integer") @GeneratedValue
	 * 
	 * @var int
	 */
	protected $id;
	
	/**
	 * @ManyToOne(targetEntity="Order", inversedBy="order_book")
	 * 
	 * @var Order
	 *
	 */
	protected $order;
	
	/**
	 * @ManyToOne(targetEntity="Book", inversedBy="order_book")
	 * 
	 * @var Book
	 *
	 */
	protected $book;
	
	/**
	 * @Column(name="`quantity`",type="integer")
	 * 
	 * @var Integer
	 */
	protected $quantity;
	public function setBook($book) {
		if ($book instanceof Book)
			$this->book = $book;
	}
	public function setQuantity($number) {
		$this->quantity = $number;
	}
	public function setOrder($order) {
		if ($order instanceof Order)
			$this->order = $order;
	}
	
	/**
	 * 
	 * @return Book
	 */
	public function getBook(){
		return $this->book; 
	}
	
	/**
	 * 
	 * @return Integer
	 */
	public function getQuantity(){
		return $this->quantity;		
	}
	
	/**
	 * 
	 * @return Integer
	 */
	public function getId(){
		return $this->id;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
}

?>