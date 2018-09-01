<?php

class Admin
{

	private $bdd;


	public function __construct($bdd)
	{
		$this->bdd=$bdd;

	}

	public function email($email)
	{
		$sql = "select * from admins where email='".$email."'";
		$resp=$this->bdd->query($sql);
		return $resp->fetch();
	
	}

	public function ajout($nom,$prenom,$email,$login,$password)
	{
		$sql='insert into admins(nom,prenom,email,login,password) values (:nm,:pm,:ml,:lg,:pwd)';
		$sth = $this->bdd->prepare($sql);
		$sth->execute(array('nm' => htmlspecialchars($nom), 'pm' => htmlspecialchars($prenom) ,'ml'=>$email, 'lg'=>htmlspecialchars($login), 'pwd'=>sha1($password)));	

	}
	public function isExist($login)
	{
		$sql = "select * from admins where login='".htmlspecialchars($login)."'"; 
		$resp=$this->bdd->query($sql);
		return $resp->fetch();
	}

	public function update($id,$nom,$prenom,$email,$login,$password)
	{
     	$sql = 'update admins set nom=:nm , prenom=:pm , email=:ml, login=:lg ,password=:pwd where id_admin=:id ';
		$sth = $this->bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array('nm' => htmlspecialchars($nom), 'pm' => htmlspecialchars($prenom) , 'lg'=>htmlspecialchars($login), 'ml'=>$email, 'pwd'=>sha1($password) , 'id'=>$id));
	}
		public function updateInfo($id,$nom,$prenom,$email)
	{
     	$sql = 'update admins set nom=:nm , prenom=:pm , email=:ml where id_admin=:id ';
		$sth = $this->bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array('nm' => htmlspecialchars($nom), 'pm' => htmlspecialchars($prenom) , 'ml'=>$email,'id'=>$id));
	}
		public function updatePwd($id,$password)
	{
     	$sql = 'update admins set password=:pwd where id_admin=:id ';
		$sth = $this->bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array('pwd'=>sha1($password),'id'=>$id));
	}
	public function delete($id)
	{
		$sql = 'delete from admins where id_admin= :id';
		$sth = $this->bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':id'=>$id));
	}

	public function getAdmin($usr,$pwd)
	{
		$sql = "select * from admins where login='".htmlspecialchars($usr)."' and password='".sha1($pwd)."'";
		$resp=$this->bdd->query($sql);
		return $resp->fetch();
	
	}

	public function getAdmins()
	{
		$sql = 'select * from admins ';
		$resp=$this->bdd->query($sql);

		return $resp->fetchAll();
	}

}

?>