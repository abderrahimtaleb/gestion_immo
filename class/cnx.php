<?php

class connexion
{

	public $db;
	public function __construct()
	{
		$this->db =  new PDO('mysql:host=localhost;dbname=reservations;charset=utf8mb4','root','') or die('Erreur de la connexion à la base');
	}
	public function getDB()
	{
		return $this->db;
	}
	public function __destruct()
	{
		$this->db = null;
	}
}

?>