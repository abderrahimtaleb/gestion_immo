<?php


class mocale
{
	public $id_local;
	public $db;

	function __construct(&$db)
	{
		$this->db =$db ;
	}
	public function getLocaleValable($jourTranche)
	{
		$localeValable = '';
		$spited = explode('T',$jourTranche);
		$rqt = ' select id_local from locals where id_local not in  '.
		'( select id_local from occupations where tranche='.$spited[1].' and jours='.$spited[0].' )	';
		$result = $this->db->query($rqt);
		$data = $result->fetchAll(PDO::FETCH_BOTH);
		foreach ($data as $row) {
			$localeValable.='<option value="'.$row[0].'">'.$row[0].'</option>';
		}
		return $localeValable;
	
	}
}


class Enseignant
{

	public $db;
	private $departement;
	private $id_enseignant;
	private $nom;
	private $prenom;
	function __construct(&$db)
	{
		$this->db =$db ;
	}
	public function getEnseignant()
	{
		$enseignants = '';
		$repre='';
		$rqt = ' select id_enseignant,nom,prenom,departement from enseignants E , departements D where E.id_departement = D.id_departement; ';
		$result = $this->db->query($rqt);
		$data = $result->fetchAll(PDO::FETCH_BOTH);
		foreach ($data as $row) {
			if(is_null($row[1]) or empty($row[1]))
			$repre = $row[3];
			else
			$repre = $row[1]." ".$row[2];
			$enseignants.='<option value="'.$row[0].'">'.$repre.'</option>';
		}
		return $enseignants;
	
	}
}

class Matiers
{

	public $db;
	private $id_matiere;
	private $matiere;
	function __construct(&$db)
	{
		$this->db =$db ;
	}
	public function getMatiers()
	{
		$matiere = '';
		$rqt = ' select * from matieres; ';
		$result = $this->db->query($rqt);
		$data = $result->fetchAll(PDO::FETCH_BOTH);
		foreach ($data as $row) {
			$matiere.='<option value="'.$row[0].'">'.$row[1].'</option>';
		}
		return $matiere;
	
	}
}

?>
