<?php
class departement
{
	private $departement='';
	private $stm;

	public function __construct($stmm)
	{
		$this->stm = $stmm;
	}

	public function getAll(){
		$query='select * from departements';
		$donnees = $this->stm->query($query)->fetchAll();
		return $donnees;
	}

	public function get($id){
		$query="select * from departements where id_departement=$id";
		return $this->stm->query($query)->fetch();
	}

	public function insert($departement){
		$query="insert into departements(departement) values('$departement')";
		return $this->stm->exec($query);
	}

	public function update($id,$departement){
		$query="update departements set departement='$departement' where id_departement=$id";
		return $this->stm->exec($query);
	}

	public function delete($id){
		$query="delete from departements where id_departement=$id";
		return $this->stm->exec($query);
	}
	}

	?>