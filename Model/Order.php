<?php
if (php_sapi_name() == "cli") {
	require_once 'orderbook.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once $root.'/phoenix/Project/Model/orderbook.php';
	require_once $root.'/phoenix/Project/vendor/autoload.php';
}
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Doctrine\Common\Collections;

/**
 * @Entity @Table(name="`order`")
 **/
class Order{
	
	/**
	 * @Id @Column(type="integer") @GeneratedValue
	 * @var int
	 */	
	protected  $id;
	
	
	/**
	 * @ManyToOne(targetEntity="Client", inversedBy="orders")
	 * @var Client
	 **/
	protected $client;
	
	
	/**
	* @Column(name="`ordre_date`",type="datetime") 
	* @var datetime
	*/
	protected $date_order;
	
	
	/**
	 * @OneToMany(targetEntity="orderbook", mappedBy="order",cascade={"persist"})
	 * @var orderbook[]
	 **/
	protected $order_book;
	
	
	/**
	* @Column(name="`valid`",type="boolean") 
	* @var boolean
	*/
	protected $valid;
	
	/**
	 * @var $date datetime
	 * @uses the constructor of Order class
	 * @return new instance of Order class
	 * @author ROUINEB Hamza
	 * */
	public function __construct($date){
		$this->date_order = new DateTime();
		$this->date_order->createFromFormat('d/m/y', $date);
		$this->valid = false;
		$this->order_book = new ArrayCollection();
	}
	
	
	public function setClient($client){
		$this->client = $client;
	}
	
	public function addOrderBook($orderbook){
		if($orderbook instanceof orderbook)
			$this->order_book[] = $orderbook;
	}
	
	/**
	 * 
	 * @return Integer
	 */
	public function getId(){
		return $this->id;
	}
	
	/**
	 * @return boolean
	 * @param boolean $flag
	 */
	public function setValid($flag){
// 		if($this->valid!=$flag)
			$this->valid=$flag;
	}
	
	/**
	 * returns if the order was paid or not 
	 * @return boolean
	 */
	public function getValid(){
		return $this->valid;
	}
	
	/**
	 * 
	 * @return orderbook[]
	 */
	public function getOrderBook(){
		return $this->order_book;
	}
	/**
	 * 
	 * @return Client
	 */
	public function getClient(){
		return $this->client;		
	}
	/**
	 * 
	 * @return datetime
	 */
	public function getDate(){
		return $this->date_order;
	}
	
	public function setOrderDate($date){
		if ($date instanceof DateTime){
			$this->date_order = $date;
		}
	}
	
	public function removeOrderBook($orderbook){
		$tmp = new ArrayCollection($this->order_book);
		if($tmp->contains($orderbook)){
			$tmp->removeElement($orderbook);
		}
		$this->order_book = $tmp;
	}
	
	
	
}





?>