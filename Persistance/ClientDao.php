<?php
// namespace Project\Persistance;
interface clientDao {
	public function getClientById($id);
	public function getClientByEmail($email);
	public function saveClient($client);
	public function updateClient($client);
	public function getAllClients();
	public function removeClient($client);
}

?>