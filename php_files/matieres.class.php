<?php
class matieres
{
	private $matiere='';
	private $semestre='';
	private $stm;

	public function __construct($stmm)
	{
		$this->stm = $stmm;
	}

	public function getAll(){
		$query='select * from matieres';
		$donnees = $this->stm->query($query)->fetchAll();
		return $donnees;
	}

	public function get($id){
		$query="select * from matieres where id_matiere=$id";
		return $this->stm->query($query)->fetch();
	}

	public function insert($matiere){
		$query="insert into matieres(matiere) values('$matiere')";
		return $this->stm->exec($query);
	}

	public function update($id,$matiere){
		$query="update matieres set matiere='$matiere' where id_matiere=$id";
		return $this->stm->exec($query);
	}

	public function delete($id){
		$query="delete from matieres where id_matiere=$id";
		return $this->stm->exec($query);
	}
	}

	?>	