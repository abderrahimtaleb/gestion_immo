<?php
class enseignant
{

	private $stm;


	public function __construct($stmm)
	{
		$this->stm = $stmm;
	}

	public function email($email)
	{
		$sql = "select * from enseignants where email='".$email."'";
		$resp=$this->stm->query($sql);
		return $resp->fetch();
	
	}

	public function getAll(){
		$query='select * from enseignants';
		return $this->stm->query($query)->fetchAll();
		 
	}

	public function get($id){
		$query="select * from enseignants where id_enseignant=$id";
		return $this->stm->query($query)->fetch();
	}

	public function getProf($usr,$pwd)
	{
		$sql = "select * from enseignants where login='".htmlspecialchars($usr)."' and password='".sha1($pwd)."'";
		$resp=$this->stm->query($sql);
		return $resp->fetch();
	
	}
	public function insert($nom,$prenom,$id_departement,$telephone,$email,$login,$password){
	
			$query="insert into enseignants(id_departement,nom,prenom,telephone,email,login,password) values($id_departement,'$nom','$prenom',$telephone,'$email','$login','$password')";
			return $this->stm->exec($query);
		}
	
	public function update($id,$nom,$prenom,$id_departement,$telephone,$email){
		$query="update enseignants set nom='$nom',prenom='$prenom',telephone=$telephone,email='$email',id_departement=$id_departement where id_enseignant=$id";
		return $this->stm->exec($query);
	}

	public function update_pass($id,$password){
		$query="update enseignants set password='$password' where id_enseignant=$id";
		//die("STATU : $query");
		return $this->stm->exec($query);
	}

	public function update_profile($id,$nom,$prenom,$telephone,$email){
		$query="update enseignants set nom='$nom',prenom='$prenom',telephone=$telephone,email='$email' where id_enseignant=$id";
		//die("STATU : $query");
		return $this->stm->exec($query);
	}


	public function delete($id){
		$query="delete from enseignants where id_enseignant=$id";
		return $this->stm->exec($query);
	}
		
		//return $this->stm->query($query)->fetchAll();
	}


	?>