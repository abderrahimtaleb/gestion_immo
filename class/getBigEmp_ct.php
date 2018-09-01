<?php
	  include_once('afficheEmploieGlobale_ct.php');
	class LocaleEmploiTable
{
	private $id_local;
	private $db;
	private $nbrColumn;
	private $headerLocale;
	function __construct(&$db)
	{
		$this->db =$db ;
		$this->nbrColumn = 0;
	}
	public function getLocaleHeader()
	{
		$localeHeader = '';
		$rqt = ' select id_local,capacite,vedio_projecteur from locals order by id_local; ';
		$result = $this->db->query($rqt);
		$data = $result->fetchAll(PDO::FETCH_BOTH);
		foreach ($data as $row) {
			$pro = ($row[2])?' Sans video projecteur ':' Avec video projecteur ';
			$localeHeader.='<th class="text-center">'.$row[0].'<br><small class="text-danger">Capacité('.$row[1].')</small><br>'.
			'<small class="text-warning">'.$pro.'</small></th>';
			$this->nbrColumn++;
			$this->headerLocale[]=$row[0];
		}
		return $localeHeader;
	
	}


		public function getLocaleBody()
	{
		$localeBody = '';
		$indexJour=0;
		$jours = array('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
		$jour=$jours[$indexJour];
		$SpanRow=1;
		$T=1;
		$Tranche = new Tranche($this->db);
		for ($i=1;$i<25;++$i) {
			$localeBody.='<tr>';
			$T=$SpanRow;
			if($SpanRow==1){$localeBody.=' <td class="text-primary warning" rowspan="4"><strong>'.$jour.'</strong></td>';++$SpanRow;}
			else if($SpanRow==4){$SpanRow=1;}
			else {++$SpanRow;} 
			for ($j=1;$j<=$this->nbrColumn;++$j) {
				$Tranche->setInfo($T,($indexJour+1),$this->headerLocale[$j-1]);
				$localeBody.='<td id="'.($indexJour+1).'T'.$T.'" class="'.$this->headerLocale[$j-1].'" '.$Tranche->test().'>'.$Tranche->getInfo().'</td><input type="hidden" value="'.$jour.'">';
			}
			$localeBody.='</tr>';
			if(!($i%4) and $indexJour < 5){++$indexJour;$jour=$jours[$indexJour];}
		}
		return $localeBody;
	}

		/*public function getLocaleBody2()
	{
		$localeBody = '';
		$rqt = ' select id_local from locals  ';
		$result = $this->db->query($rqt);
		$data = $result->fetchAll(PDO::FETCH_BOTH);
		foreach ($data as $row) {
			$localeBody.='<th class="text-center">'.$row[0].'</th>';
			$this->nbrColumn++;
		}
		return $localeBody;
	}*/
}
/*class Locale
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
}*/

?>

