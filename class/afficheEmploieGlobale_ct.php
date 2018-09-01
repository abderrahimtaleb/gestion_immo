<?php
class Tranche
{
   public $id_occupation;
   public $locale;
   public $departement;
   public $nom;
   public $prenom;
   public $matiere;
   public $groupe;
   public $filiere;
   public $trJ;
   private $db;
   private $testNull;
   private $date;
   public function __construct(&$db)
   {
   		$this->db = $db;
   }
   public function setInfo($Tranche,$idJour,$header)
   {
      $this->trJ=$idJour."T".$Tranche;
     
    
      $rqt = 'select id_controle,O.id_local,matiere,groupe,libelle '.
'from controles O, matieres M,enseignants E,locals L , filieres F '.
'where O.id_local = L.id_local and O.id_filiere = F.id_filiere  '.
' and O.id_matiere = M.id_matiere and tranche = '.$Tranche.' and jours = '.$idJour.' and O.id_local = "'.$header.'"';
        $result = $this->db->query($rqt);
        $data = $result->fetch(PDO::FETCH_BOTH);
        if(empty($data)){$this->testNull=true;}
    else{$this->id_occupation=$data[0]; $this->locale=$data[1];
     $this->matiere=$data[2]; $this->groupe=$data[3];$this->filiere=$data[4];$this->testNull=false;}
    unset($result);



      $rqt = 'select date from controles  where  tranche = '.$Tranche.' and jours = '.$idJour.' and id_local = "'.$header.'"';
        $result = $this->db->query($rqt);
        $data = $result->fetchAll(PDO::FETCH_BOTH);
        if(empty($data)){$this->testNull=true;}
    else{
      foreach ($data as $row) {$this->date[] = $row[0] ;}
      $this->testNull=false;

      }
    unset($result);

    $data=null;
   }
   public function test(){ if(empty($this->groupe) and !$this->testNull) return "style='color:red'"; }
   public function getInfo()
   {    
        if($this->testNull){$emp="";}
        else if(!empty($this->groupe)){ $emp = '<span class="text-success"><strong class="text-primary">               Matière :</strong> '.$this->matiere.'</span><br>'.
      '<span class="text-success"><strong class="text-primary">               Filière :</strong> '.$this->filiere.'</span><br>'.
   '<span class="text-success"><strong class="text-primary">                Groupe :</strong> '.$this->groupe.'</span>';$this->groupe="";}
   else
   {
    $emp="<div style='color:red'><span class='text-center'>Les dates de réservations : </span><br>";
    foreach ($this->date as $d) 
    {
      $emp.="<span class='text-center'>".$d."</span><br>";
    }
    $emp.="</div>";
    $this->date=null;
   }
      return $emp;
   }
}

?>