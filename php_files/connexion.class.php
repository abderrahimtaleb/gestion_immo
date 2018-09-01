<?php
session_start();
if(!isset($_SESSION['login']))
  header('Location:/projet');

class Db_connect
{
	private $host='mysql:host=localhost;dbname=reservations';
	private $login='root';
	private $passwd='';
	private $connecx=null;

	public function __construct()
	{
		try{
			$this->connecx= new PDO($this->host, $this->login, $this->passwd);
		   }
		catch (PDOException$e) {
			print"Erreur! : " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function connect()
	{
		return $this->connecx;

	}

}


?>