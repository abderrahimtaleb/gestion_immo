<?php

    include_once ('cnx.php');
class Tranche
{
   public $id_occupation;
   public $locale;
   public $departement;
   public $nom;
   public $prenom;
   public $matiere;
   public $groupe;
   public $trJ;
   private $db;
   public function __construct(&$db,$Tranche,$filiere,$idJour)
   {
   		$this->db = $db;
   		$this->trJ=$idJour."T".$Tranche;
   		$rqt = 'select id_occupation,O.id_local,nom,prenom,departement,matiere,groupe '.
'from occupations O, matieres M,enseignants E,departements D,locals L '.
'where O.id_local = L.id_local and O.id_enseignant = E.id_enseignant and E.id_departement = D.id_departement  '.
' and O.id_matiere = M.id_matiere and tranche = '.$Tranche.' and jours = '.$idJour.' and id_filiere =  '.$filiere;
        $result = $db->query($rqt);
        $data = $result->fetch(PDO::FETCH_BOTH);
		$this->id_occupation=$data[0]; $this->locale=$data[1]; $this->departement=$data[4];
		$this->nom=$data[2];$this->prenom=$data[3]; $this->matiere=$data[5]; $this->groupe=$data[6];
		unset($result);
   }
}

class Jour
{
	private $idJour;
	public $Tranches;
	private $db;
	private $id_filiere;
	public function __construct(&$db,$idJour,$id_filiere)
   {
   		$this->db = $db;$this->idJour=$idJour;$this->id_filiere=$id_filiere;
   		  	$this->setJour();
   }
   private function setJour()
   {
   		for ($i=1; $i <5 ; $i++) { 
   			$this->Tranches[] = new Tranche($this->db,$i,$this->id_filiere,$this->idJour);
   		}   	
   }
}

class EmploiDuTemps
{
	private $jours;
   	private $db;
	  public function __construct(&$db,$id_filiere)
   {
   	$this->db = $db;
   	$this->setEmploi($id_filiere);
   }
   private function setEmploi($id_filiere)
   {
   		for ($i=1; $i <8 ; $i++) { 
   			$this->jours[] = new Jour($this->db,$i,$id_filiere);
   		}
   }
   public function getEmploie()
   {
   	$emp= array();
   	foreach ($this->jours as $jour) {
   		foreach ($jour->Tranches as $tranche) {

   if(is_null($tranche->nom) or empty($tranche->nom))
   	{$tranche->nom=$tranche->departement;}
   if(!is_null($tranche->nom)){
 	 $emp[] = '<span class="text-primary ici" id='.$tranche->id_occupation.'><strong class="text-danger"> Locale :</strong><span class="locale"> '.$tranche->locale.'</span></span><br>'.
  '<span class="text-primary"><strong class="text-danger"> Enseignant/Departement :</strong> '.$tranche->nom.' '.$tranche->prenom.'</span><br>'.
   '<span class="text-primary"><strong class="text-danger">               Matière :</strong> '.$tranche->matiere.'</span><br>'.
   '<span class="text-primary"><strong class="text-danger">                Groupe :</strong> '.$tranche->groupe.'</span>'.
   '                    	<center>
<span class="text-danger statut disp '.$tranche->id_occupation.'">
<input type="hidden" value="'.$tranche->trJ.'">
 <button class="btn btn-sm btn-warning okSup" value="'.$tranche->id_occupation.'">Supprimer</button><button class="btn btn-sm btn-success NonSup" value="'.$tranche->id_occupation.'">Modifier</button>'.
 '<button class="btn btn-sm btn-info RienO" value="'.$tranche->id_occupation.'">Rien</button></span>
                    	</center>';}
   else
   {
   	$emp[] ='';
   }

   		}
   	}
   	echo json_encode($emp);
   }

}

    $cnx = new connexion();
    $db = $cnx->getDB();
    $EmploiDuTemps = new EmploiDuTemps($db,$_POST['id_filiere']);
    $EmploiDuTemps->getEmploie();

?>