<?php

class filiere
{
	private $id_filiere;
	private $libelle;

	public function __construct($id_filiere,$libelle)
	{
		$this->id_filiere = $id_filiere;$this->libelle=$libelle;
	}
	public function getId(){return $this->id_filiere;}
	public function getLib(){return $this->libelle;}
}

class SelectionFiliere
{
	private $tabFilier;

	public function __construct(&$db)
	{
		$rqt = 'SELECT * from filieres ';
        $result = $db->query($rqt);
        $data = $result->fetchAll(PDO::FETCH_BOTH);
		foreach ($data as $row) {
		$this->tabFilier[] = new filiere($row[0],$row[1]);}
	}
	public function getSelections()
	{
		$options='';
				foreach ($this->tabFilier as $row) {
		$options .= '<option value="'.$row->getId().'">'.$row->getLib().'</option>';}
		return $options;
	}


}
?>