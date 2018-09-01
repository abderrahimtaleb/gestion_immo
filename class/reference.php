<?php

class Societe 
{
	public $id_societe;
	public $nomSociete;
	private $db;
	function __construct($id_societe,$db)
	{
		$this->db = $db;
		$this->id_societe = $id_societe;

		$rqt = 'SELECT nomSociete  FROM societe WHERE id_societe = '.$this->id_societe ;
		$result = $this->db->query($rqt);
		$data = $result->fetch(PDO::FETCH_BOTH);
		$this->nomSociete = $data[0];
		unset($result);		
	}
}


class Reference 
{
	public $id_reference;
	public $titre;
	public $tabSociete = array();
	public $db;
	function __construct($id_reference,$db)
	{
		$this->db = $db;
		$this->id_reference = $id_reference;

		$rqt = 'SELECT id_societe  FROM societe WHERE id_reference = '.$this->id_reference ;
		$result = $this->db->query($rqt);
		$data = $result->fetchAll(PDO::FETCH_BOTH);
		foreach ($data as $row) {
			$this->tabSociete[] = new Societe($row[0],$this->db);
		}//
		unset($result);	

		$rqt =  'SELECT  titre FROM reference WHERE id_reference = '.$this->id_reference ;
		$result = $this->db->query($rqt);
		$data = $result->fetch(PDO::FETCH_BOTH);
		$this->titre = $data[0];
		unset($result);	
	}
}

class TabReference 
{
	private $TabReference = array();
	private $db;
	function __construct($db)
	{
		$this->db = $db;
		$rqt = 'SELECT id_reference FROM reference ';
		$result = $this->db->query($rqt);
		$data = $result->fetchAll(PDO::FETCH_BOTH);
		foreach ($data as $row) {
			$this->TabReference[] = new Reference($row[0],$this->db);
		}//
		unset($result);

	}
	public function getTabRef(){return  $this->TabReference;}
	public function AfficheReference()
	{

		$format = '';
		foreach ($this->TabReference as $reference) {
			$format .= '<tr class="forTR info"><td ><i class="glyphicon glyphicon-hand-right" style="margin-right:10px;color:olive"></i>'.stripslashes($reference->titre).'</td>'.
			'<td class="btn-group"><button class="btn btn-danger btn-sm supR" id="'.$reference->id_reference.'rs"><i class="fa fa-eraser"></i></button><button class="btn btn-info btn-sm  modR"  id="'.$reference->id_reference.'rm"><i class="glyphicon glyphicon-pencil"></i></button>'.
			'<button class="btn btn-success btn-sm ajoutSoc"  id="'.$reference->id_reference.'ra"><i class="glyphicon glyphicon-plus"></i></button></td></tr>';
		foreach ($reference->tabSociete as $societe) {
			$format .='<tr><td><i class="forTR-body glyphicon glyphicon-hand-up" style="margin-right:10px;color:olive"></i>'.stripslashes($societe->nomSociete).'</td>'.
			'<td class="btn-group"><button class="btn btn-warning supS btn-sm" id="'.$societe->id_societe.'ss"><i class="fa fa-eraser"></i></button><button class="btn btn-info btn-sm modS" id="'.$societe->id_societe.'sm"><i class="glyphicon glyphicon-pencil"></i></button></td></tr>';
								}
		}
		echo  $format;
	}

}
?>
                          
                          