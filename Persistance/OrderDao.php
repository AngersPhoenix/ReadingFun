<?php

// namespace Project\Persistance;
interface OrderDao{
	public function getOrderById($id);
	public function getOrdersByClient($client);
	public function saveOrder($order);
	public function updateOrde($order);
	public function getAllOrders();
	public function removeOrder($order);
}






?>