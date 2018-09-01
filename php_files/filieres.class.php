<?php
class filiere
{
	private $filieres='';
	private $stm;

	public function __construct($stmm)
	{
		$this->stm = $stmm;
	}

	public function getAll(){
		$query='select * from filieres';
		$donnees = $this->stm->query($query)->fetchAll();
		return $donnees;
	}

	public function get($id){
		$query="select * from filieres where id_filiere=$id";
		return $this->stm->query($query)->fetch();
	}

	public function insert($filiere){
		$query="insert into filieres(libelle) values('$filiere')";
		return $this->stm->exec($query);
	}

	public function update($id,$filiere){
		$query="update filieres set libelle='$filiere' where id_filiere=$id";
		return $this->stm->exec($query);
	}

	public function delete($id){
		$query="delete from filieres where id_filiere=$id";
		return $this->stm->exec($query);
	}
	}

	?>