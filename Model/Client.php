<?php
if (php_sapi_name () == "cli") {
	require_once 'Order.php';
	require_once 'vendor/autoload.php';
} else {
	$root = $_SERVER ['DOCUMENT_ROOT'];
	require_once $root . '/phoenix/Project/Model/Order.php';
	require_once $root . '/phoenix/Project/vendor/autoload.php';
}

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="`client`")
 */
class Client {
	
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
	 * @Column(name="`age`",type="integer")
	 *
	 * @var int
	 */
	protected $age;
	
	/**
	 * @Column(name="`email`",type="string",nullable=false)
	 *
	 * @var string
	 */
	protected $email;
	
	/**
	 * @Column(name="`password`",type="string",nullable=false)
	 *
	 * @var string
	 */
	protected $password;
	
	/**
	 * @Column(name="`level`",type="integer",nullable=false)
	 *
	 * @var int
	 */
	protected $level;
	
	/**
	 * @OneToMany(targetEntity="Order", mappedBy="client",cascade={"persist"})
	 *
	 * @var Order[]
	 *
	 */
	protected $orders;
	public function __construct($name, $age, $email, $password, $level = 0) {
		$this->name = $name;
		$this->age = $age;
		$this->email = $email;
		$this->password = md5 ( $password );
		$this->level = $level;
		
		// initialize the arraycollections :
		$this->orders = new ArrayCollection ();
	}
	
	/**
	 *
	 * @var Order
	 * @uses this method allows you to add a new order made by the client
	 * @author ROUINEB Hamza
	 * @return void
	 *
	 */
	public function addOrder($order) {
		$this->orders [] = $order;
	}
	
	/**
	 *
	 * @return Integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	/**
	 *
	 * @return Integer
	 */
	public function getAge() {
		return $this->age;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 *
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}
	
	/**
	 *
	 * @return $orders Doctrine\Common\Collections\ArrayCollection
	 */
	public function getOrders() {
		return $this->orders;
	}
	
	/**
	 *
	 * @param Integer $id        	
	 * @return void
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * returns the level that specify it's privileges
	 *
	 * @return Integer
	 */
	public function getLevel() {
		return $this->level;
	}
	public function setName($name) {
		if (strlen ( $name ) > 0)
			$this->name = $name;
	}
	public function setAge($age) {
		$this->age = $age;
	}
	public function setEmail($email) {
		if (strlen ( $email ) > 0)
			$this->email = $email;
	}
	public function setPassword($password) {
		if (strlen ( $password ) > 0)
			$this->password = $password;
	}
	public function setLevel($level) {
		if ($level == 0 || $level == 1)
			$this->level = $level;
	}
	
	/**
	 *
	 * @return Integer
	 */
	public function getNumberOrders() {
		$cpt = 0;
		foreach($this->orders as $order)
			if(!$order->getValid()) $cpt++;
		return $cpt;
	}
	
	/**
	 * An array of default properties, with the key being the name of the property and the value being the default value of the property
	 *
	 * @return array
	 */
	public function getProprities() {
		return array (
				"id" => $this->id,
				"name" => $this->name,
				"age" => $this->age,
				"email" => $this->email,
				"pasword" => $this->password,
				"level" => $this->level 
		);
	}
}

?>