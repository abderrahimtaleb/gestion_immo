<?php


/**
* 
*/
class Achat 
{
	public $id;
	public $refProduit;
	public $refClient;
	public $date;
	public $vue;
	public $acheter;
	function __construct($id,$refProduit,$refClient,$date,$vue,$acheter)
	{
		$this->id = $id;$this->refProduit = $refProduit;$this->date=$date;
		$this->vue = $vue;$this->refClient = $refClient;$this->acheter = $acheter;
	}
}

class commentaire 
{
	public $id_commentaire;
	public $refProduit;
	public $refClient; 	
	public $date;
	public $long;
	public $vue;
	function __construct($id,$refProduit,$refClient,$date,$long,$vue)
	{
		$this->id_commentaire = $id;$this->refProduit = $refProduit;$this->date=$date;
		$this->vue = $vue;
		$this->long = $long ;
		$this->refClient = $refClient;
	}
}


class Client 
{
	public $id_client;
	public $nom_prenom;	
	public $new;
	public $info_modif;
	public $DateModification;
	public $DateCreation ;
	public $date;
	public $vue;
	function __construct($id,$nom_prenom,$new,$info_modif,$DateModification,$DateCreation,$vue)
	{
		$this->id_client = $id;$this->nom_prenom = $nom_prenom;$this->new=$new;
		$this->info_modif = $info_modif;$this->DateModification = $DateModification;
		$this->DateCreation = $DateCreation;$this->vue = $vue;
	}
}


class CV 
{
	public $id_cv;
	public $refClient;	
	public $demande_stage;
	public $rejete;
	public $vue;
	public $date;
	public $path;
	function __construct($id,$refClient,$demande_stage,$vue,$date,$rejete,$path)
	{
		$this->id_cv = $id;$this->refClient = $refClient;$this->demande_stage=$demande_stage;
		$this->vue = $vue; $this->date = $date;$this->rejete = $rejete;$this->path = $path;
	}
}

class notification
{
	private $Achat;
	private $commentaire;
	private $Client;
	private $CV;
	private $dbb;
	private $nbr_vue;
	private $format;

	public  function getEmploieRejete()
	{
		$format = '';

		foreach ($this->CV as $CV) {
			if($CV->date > 0 and ($CV->rejete == 1) and (!$CV->demande_stage))
			{
				$rqt = 'SELECT  nomClient, prenomClient,mail FROM client C join compte CO on C.refcompte = CO.idCompte WHERE id_client = '.$CV->refClient;
				$result = $this->dbb->query($rqt);                	
		    	$Client= $result->fetch(PDO::FETCH_BOTH);
		    	unset($result);

				$format .= '<tr><td><input class="checkbox" type="checkbox" value="'.$CV->id_cv.'"></td><td>'.$Client[0].' '.$Client[1].'</td><td>'.$Client[2].'</td><td>'.date('d-m-Y',$CV->date).'</td>'.
				'<td class="btn-group"><form method="post" class="ForForm" action="client.php"><button data-placement="bottom" class="btn btn-primary btn-sm consulter-Member"><i class="fa fa-external-link"></i></button><input type="hidden" name="idClient" value="'.$CV->refClient.'"></form>';
				$format .='<form class="ForForm" action="AppPDF.php" method="POST"><button class="btn btn-info btn-sm voirCV" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-file-pdf-o"></i></button>'.
				'<input type="hidden" name="fichier" value="../../'.$CV->path.'"></form>';
				$format .='<button class="btn btn-success btn-sm validerEmploie" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-check"></i></button>';
				$format .='</td></tr>';				
			}

		}
		echo $format;
	}

	public  function getEmploieAccepter()
	{
		$format = '';

		foreach ($this->CV as $CV) {
			if($CV->date > 0 and ($CV->rejete == 0)  and (!$CV->demande_stage))
			{
				$rqt = 'SELECT  nomClient, prenomClient,mail FROM client C join compte CO on C.refcompte = CO.idCompte WHERE id_client = '.$CV->refClient;
				$result = $this->dbb->query($rqt);                	
		    	$Client= $result->fetch(PDO::FETCH_BOTH);
		    	unset($result);

				$format .= '<tr><td><input class="checkbox" type="checkbox" value="'.$CV->id_cv.'"></td><td>'.$Client[0].' '.$Client[1].'</td><td>'.$Client[2].'</td><td>'.date('d-m-Y',$CV->date).'</td>'.
				'<td class="btn-group"><form method="post" class="ForForm" action="client.php"><button data-placement="bottom" class="btn btn-primary btn-sm consulter-Member"><i class="fa fa-external-link"></i></button><input type="hidden" name="idClient" value="'.$CV->refClient.'"></form>';
				$format .='<form class="ForForm" action="AppPDF.php" method="POST"><button class="btn btn-info btn-sm voirCV" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-file-pdf-o"></i></button>'.
				'<input type="hidden" name="fichier" value="../../'.$CV->path.'"></form>';
				$format .='<button class="btn btn-danger btn-sm AnnulerEmploie" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-times"></i></button>';
				$format .='</td></tr>';				
			}

		}
		echo $format;
	}

	public  function getEmploieRecus()
	{
		$format = '';

		foreach ($this->CV as $CV) {
			if($CV->date > 0 and ($CV->rejete == 2)  and (!$CV->demande_stage))
			{
				$rqt = 'SELECT  nomClient, prenomClient,mail FROM client C join compte CO on C.refcompte = CO.idCompte WHERE id_client = '.$CV->refClient;
				$result = $this->dbb->query($rqt);                	
		    	$Client= $result->fetch(PDO::FETCH_BOTH);
		    	unset($result);

				$format .= '<tr id="'.$CV->id_cv.'"><td><input class="checkbox" type="checkbox" value="'.$CV->id_cv.'"></td><td>'.$Client[0].' '.$Client[1].'</td><td>'.$Client[2].'</td><td>'.date('d-m-Y',$CV->date).'</td>'.
				'<td class="btn-group"><form method="post" class="ForForm" action="client.php"><button data-placement="bottom" class="btn btn-primary btn-sm consulter-Member"><i class="fa fa-external-link"></i></button><input type="hidden" name="idClient" value="'.$CV->refClient.'"></form>';
				$format .='<form class="ForForm" action="AppPDF.php" method="POST"><button class="btn btn-info btn-sm voirCV" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-file-pdf-o"></i></button>'.
				'<input type="hidden" name="fichier" value="../../'.$CV->path.'"></form>';
				$format .='<button class="btn btn-success btn-sm validerEmploie" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-check"></i></button>';
				$format .='<button class="btn btn-danger btn-sm AnnulerEmploie" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-close"></i></button>';
				$format .='</td></tr>';				
			}

		}
		echo $format;
	}



	public  function getStageRejete()
	{
		$format = '';

		foreach ($this->CV as $CV) {
			if($CV->date > 0 and ($CV->rejete == 1) and $CV->demande_stage)
			{
				$rqt = 'SELECT  nomClient, prenomClient,mail FROM client C join compte CO on C.refcompte = CO.idCompte WHERE id_client = '.$CV->refClient;
				$result = $this->dbb->query($rqt);                	
		    	$Client= $result->fetch(PDO::FETCH_BOTH);
		    	unset($result);

				$format .= '<tr><td><input class="checkbox" type="checkbox" value="'.$CV->id_cv.'"></td><td>'.$Client[0].' '.$Client[1].'</td><td>'.$Client[2].'</td><td>'.date('d-m-Y',$CV->date).'</td>'.
				'<td class="btn-group"><form method="post" class="ForForm" action="client.php"><button data-placement="bottom" class="btn btn-primary btn-sm consulter-Member"><i class="fa fa-external-link"></i></button><input type="hidden" name="idClient" value="'.$CV->refClient.'"></form>';
				$format .='<form class="ForForm" action="AppPDF.php" method="POST"><button class="btn btn-info btn-sm voirCV" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-file-pdf-o"></i></button>'.
				'<input type="hidden" name="fichier" value="../../'.$CV->path.'"></form>';
				$format .='<button class="btn btn-success btn-sm validerEmploie" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-check"></i></button>';
				$format .='</td></tr>';				
			}

		}
		echo $format;
	}

	public  function getStageAccepter()
	{
		$format = '';

		foreach ($this->CV as $CV) {
			if($CV->date > 0 and ($CV->rejete == 0)  and $CV->demande_stage)
			{
				$rqt = 'SELECT  nomClient, prenomClient,mail FROM client C join compte CO on C.refcompte = CO.idCompte WHERE id_client = '.$CV->refClient;
				$result = $this->dbb->query($rqt);                	
		    	$Client= $result->fetch(PDO::FETCH_BOTH);
		    	unset($result);

				$format .= '<tr><td><input class="checkbox" type="checkbox" value="'.$CV->id_cv.'"></td><td>'.$Client[0].' '.$Client[1].'</td><td>'.$Client[2].'</td><td>'.date('d-m-Y',$CV->date).'</td>'.
				'<td class="btn-group"><form method="post" class="ForForm" action="client.php"><button data-placement="bottom" class="btn btn-primary btn-sm consulter-Member"><i class="fa fa-external-link"></i></button><input type="hidden" name="idClient" value="'.$CV->refClient.'"></form>';
				$format .='<form class="ForForm" action="AppPDF.php" method="POST"><button class="btn btn-info btn-sm voirCV" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-file-pdf-o"></i></button>'.
				'<input type="hidden" name="fichier" value="../../'.$CV->path.'"></form>';
				$format .='<button class="btn btn-danger btn-sm AnnulerEmploie" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-times"></i></button>';
				$format .='</td></tr>';				
			}

		}
		echo $format;
	}

	public  function getStageRecus()
	{
		$format = '';

		foreach ($this->CV as $CV) {
			if($CV->date > 0 and ($CV->rejete == 2)  and $CV->demande_stage)
			{
				$rqt = 'SELECT  nomClient, prenomClient,mail FROM client C join compte CO on C.refcompte = CO.idCompte WHERE id_client = '.$CV->refClient;
				$result = $this->dbb->query($rqt);                	
		    	$Client= $result->fetch(PDO::FETCH_BOTH);
		    	unset($result);

				$format .= '<tr id="'.$CV->id_cv.'"><td><input class="checkbox" type="checkbox" value="'.$CV->id_cv.'"></td><td>'.$Client[0].' '.$Client[1].'</td><td>'.$Client[2].'</td><td>'.date('d-m-Y',$CV->date).'</td>'.
				'<td class="btn-group"><form method="post" class="ForForm" action="client.php"><button data-placement="bottom" class="btn btn-primary btn-sm consulter-Member"><i class="fa fa-external-link"></i></button><input type="hidden" name="idClient" value="'.$CV->refClient.'"></form>';
				$format .='<form class="ForForm" action="AppPDF.php" method="POST"><button class="btn btn-info btn-sm voirCV" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-file-pdf-o"></i></button>'.
				'<input type="hidden" name="fichier" value="../../'.$CV->path.'"></form>';
				$format .='<button class="btn btn-success btn-sm validerEmploie" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-check"></i></button>';
				$format .='<button class="btn btn-danger btn-sm AnnulerEmploie" data-placement="bottom" value="'.$CV->id_cv.'"><i class="fa fa-close"></i></button>';
				$format .='</td></tr>';				
			}

		}
		echo $format;
	}
	public  function getAchat()
	{
		$format = '';

		foreach ($this->Achat as $Achat) {
			if($Achat->date > 0 and (!$Achat->acheter))
			{
				$rqt = 'SELECT  nomClient, prenomClient FROM client WHERE id_client = '.$Achat->refClient;
				$result = $this->dbb->query($rqt);                	
		    	$Client= $result->fetch(PDO::FETCH_BOTH);
		    	unset($result);

				$rqt = 'SELECT  nomProduit FROM produit WHERE id_produit = '.$Achat->refProduit;
				$result = $this->dbb->query($rqt);                	
		    	$Produit= $result->fetch(PDO::FETCH_BOTH);
		    	unset($result);

				$format .= '<tr id="'.$Achat->id.'"><td>'.$Produit[0].'</td><td>'.$Client[0].' '.$Client[1].'</td><td>'.date('d-m-Y',$Achat->date).'</td>'.
				'<td class="btn-group"><form method="post" class="ForForm" action="client.php"><button class="btn btn-primary btn-sm consulter-Member"><i class="fa fa-external-link"></i></button><input type="hidden" name="idClient" value="'.$Achat->refClient.'"></form>'.
				'<form class="ForForm" method="post" action="info_project.php"><button class="btn btn-info btn-sm consulter-Pro"><i class="fa fa-external-link"></i></button><input type="hidden" name="idProduit" value="'.$Achat->refProduit.'"></form>';
				if(!$Achat->acheter)
				$format .='<button class="btn btn-success btn-sm validerAchat" value="'.$Achat->id.'"><i class="fa fa-check"></i></button>';
				$format .='<button class="btn btn-warning btn-sm annulerAchat" value="'.$Achat->id.'"><i class="fa fa-close"></i></button>'.
				'</td></tr>';				
			}

		}
		echo $format;
	}

	public  function getAchatValider()
	{
		$format = '';

		foreach ($this->Achat as $Achat) {
			if($Achat->date > 0 and $Achat->acheter)
			{
				$rqt = 'SELECT  nomClient, prenomClient FROM client WHERE id_client = '.$Achat->refClient;
				$result = $this->dbb->query($rqt);                	
		    	$Client= $result->fetch(PDO::FETCH_BOTH);
		    	unset($result);

				$rqt = 'SELECT  nomProduit FROM produit WHERE id_produit = '.$Achat->refProduit;
				$result = $this->dbb->query($rqt);                	
		    	$Produit= $result->fetch(PDO::FETCH_BOTH);
		    	unset($result);

				$format .= '<tr id="'.$Achat->id.'"><td>'.$Produit[0].'</td><td>'.$Client[0].' '.$Client[1].'</td><td>'.date('d-m-Y',$Achat->date).'</td>'.
				'<td class="btn-group"><form method="post" class="ForForm" action="client.php"><button class="btn btn-primary btn-sm consulter-Member"><i class="fa fa-external-link"></i></button><input type="hidden" name="idClient" value="'.$Achat->refClient.'"></form>'.
				'<form class="ForForm" method="post" action="info_project.php"><button class="btn btn-info btn-sm consulter-Pro"><i class="fa fa-external-link"></i></button><input type="hidden" name="idProduit" value="'.$Achat->refProduit.'"></form>';
				$format .='<button class="btn btn-warning btn-sm annulerAchat" value="'.$Achat->id.'"><i class="fa fa-close"></i></button>'.
				'</td></tr>';				
			}

		}
		echo $format;
	}


	public function __construct(&$db)
	{
  		$this->dbb = $db;

  		//ACHAT
		$rqt = 'SELECT * FROM demandeachat';
		$result = $this->dbb->query($rqt);
		$dataAchat = $result->fetchAll(PDO::FETCH_BOTH);
		foreach ($dataAchat as $row) {
			$this->Achat[] = new Achat($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]);
		}//
		unset($result);

  		//commentaire
		$rqt = 'SELECT * FROM commentaire';
		$result = $this->dbb->query($rqt);
		$dataCom= $result->fetchAll(PDO::FETCH_BOTH);
		foreach ($dataCom as $row) {
			if(!is_null($row[1]) and !is_null($row[2]))
			$this->commentaire[] = new commentaire($row[0],$row[2],$row[1],$row[4],$row[5],$row[6]);
		}//
		unset($result);

  		//Client
  		$newClient = array();
  		$ClientModif = array();
		$rqt = 'SELECT id_client, nomClient, prenomClient, new, info_modif,DateModification,DateCreation,vue '.
		' FROM client CL join compte CO on CL.refcompte = CO.idCompte';
		$result = $this->dbb->query($rqt);
		$dataCV= $result->fetchAll(PDO::FETCH_BOTH);
		foreach ($dataCV as $row) {
			if($row[3])
				$newClient[] = new Client($row[0],$row[1].' '.$row[2],$row[3],0,$row[5],$row[6],$row[7]);
			if($row[4])
				$ClientModif[] = new Client($row[0],$row[1].' '.$row[2],0,$row[4],$row[5],$row[6],$row[7]);
		}
		$this->Client = array_merge($newClient,$ClientModif);
		unset($result);

  		//CV

		$rqt = 'SELECT * FROM CV';
		$result = $this->dbb->query($rqt);
		$dataCl= $result->fetchAll(PDO::FETCH_BOTH);
		foreach ($dataCl as $row) {
			$this->CV[] = new CV($row[0],$row[1],$row[2],$row[4],$row[5],$row[6],$row[3]);
		}//
		unset($result);
		//print_r($this->Client);
		/*$this->Initialise();
		print_r(array_merge($this->Achat,$this->commentaire,$this->Client,$this->CV));*/
		$this->nbr_vue=0;
	}
	public function Format_HTML_Notification()
	{
		$this->Initialise();
		$arr = array_merge($this->Achat,$this->commentaire,$this->Client,$this->CV);
		$this->trieArray($arr);
		$F_HTML = '';

$url =  $_SERVER['PHP_SELF'];
$spited = explode('/',$url);
if(in_array('mailbox',$spited))
$path = '../main/';
elseif(in_array('main',$spited))
$path = '';
else
$path = 'pages/main/';
		foreach ($arr as $obj) {
			if($obj instanceOf Client and $obj->date > 0)
			{	$vue ='';
				if(!$obj->vue) {$vue='text-blue';}
				if($obj->new)
				{
					if(!$obj->vue) {$this->nbr_vue++;}
                    $F_HTML.= '<li style="text-color:blue"><a  href="'.$path.'client.php?idClient='.$obj->id_client.'"class="'.$vue.'">'.
                    '<i class="fa fa-users text-aqua"></i>'.$obj->nom_prenom.
                    ' est un(e) membre dans votre site'.
                    '<br><small class="pull-right"><i class="fa fa-clock-o"></i>'.Date('d-m-Y H:i:s',$obj->DateCreation).'</small></a></li>';
                }
                elseif($obj->info_modif)
                { if(!$obj->vue) {$this->nbr_vue++;}
                     $F_HTML.= '<li><a href="'.$path.'client.php?idClient='.$obj->id_client.'" class="'.$vue.'"><i class="fa fa-user text-red"></i>'.$obj->nom_prenom.' a modifié ses informations'.
                     '<br><small class="pull-right"><i class="fa fa-clock-o"style="margin-right:5px"></i>'.Date('d-m-Y H:i:s',$obj->DateModification).'</small></a></li>'  ;               	
                }
			}

			elseif($obj instanceOf Achat and $obj->date > 0 and !$obj->acheter)
			{$vue ='';
				if(!$obj->vue) {$this->nbr_vue++;$vue='text-blue';}
	
					$rqt = 'SELECT  nomClient, prenomClient FROM client WHERE id_client = '.$obj->refClient;
					$result = $this->dbb->query($rqt);                	
                	$dataAchat= $result->fetch(PDO::FETCH_BOTH);
				$F_HTML.= '<li><a href="'.$path.'demande_achat.php?idAchat='.$obj->id.'"class="'.$vue.'"><i class="fa fa-shopping-cart text-green"></i>'.$dataAchat[0].' '.$dataAchat[1].' a demandé l\'achat d\'un produit '.
				'<br><small class="pull-right"><i class="fa fa-clock-o"></i>'.Date('d-m-Y H:i:s',$obj->date).'</small></a></li>';unset($result);
			}

			elseif($obj instanceOf CV and $obj->date > 0)
			{$vue ='';
				if(!$obj->vue) {$this->nbr_vue++;$vue='text-blue';}
					$rqt = 'SELECT  nomClient, prenomClient FROM client WHERE id_client = '.$obj->refClient;
					$result = $this->dbb->query($rqt);                	
                	$dataCV= $result->fetch(PDO::FETCH_BOTH);unset($result);
                	if($obj->demande_stage)
                	{
				$F_HTML.= '<li><a href="'.$path.'demande_recustage.php?idCV='.$obj->id_cv.'"class="'.$vue.'"><i class="fa fa-file-pdf-o text-red"></i>'.$dataCV[0].' '.$dataCV[1].' a demandé un stage '.
				'<br><small class="pull-right"><i class="fa fa-clock-o"></i>'.Date('d-m-Y H:i:s',$obj->date).'</small></a></li>';}
                	else
                	{
				$F_HTML.= '<li><a href="'.$path.'demande_recus.php?idCV='.$obj->id_cv.'"class="'.$vue.'"><i class="fa fa-file-pdf-o text-blue"></i>'.$dataCV[0].' '.$dataCV[1].' a demandé un emploie '.
				'<br><small class="pull-right"><i class="fa fa-clock-o"></i>'.Date('d-m-Y H:i:s',$obj->date).'</small></a></li>';}			
			}

			elseif($obj instanceOf commentaire and $obj->date > 0)
			{$vue ='';
				if(!$obj->vue) {$this->nbr_vue++;$vue='text-blue';}
					$rqt = 'SELECT  nomClient, prenomClient FROM client WHERE id_client = '.$obj->refClient;
					$result = $this->dbb->query($rqt);                	
                	$dataCV= $result->fetch(PDO::FETCH_BOTH);unset($result);
                	if($obj->long)
                	{
				$F_HTML.= '<li><a href="'.$path.'info_project.php?idProduit='.$obj->refProduit.'&comment='.$obj->id_commentaire.'"class="'.$vue.'"><i class="fa fa-warning text-yellow"></i>'.$dataCV[0].' '.$dataCV[1].' a dépassé le nombre de caractère autoriser dans un commentaire  '.
				'<br><small class="pull-right"><i class="fa fa-clock-o"></i>'.Date('d-m-Y H:i:s',$obj->date).'</small></a></li>';}
                	else
                	{
				$F_HTML.= '<li><a href="'.$path.'info_project.php?idProduit='.$obj->refProduit.'&comment='.$obj->id_commentaire.'"class="'.$vue.'"><i class="fa fa-comment text-gray"></i>'.$dataCV[0].' '.$dataCV[1].' a commenté sur un produit '.
				'<br><small class="pull-right"><i class="fa fa-clock-o"></i>'.Date('d-m-Y H:i:s',$obj->date).'</small></a></li>';}
			}
			
		}
		$this->format=$F_HTML;
	}

	public function getFormat()
	{
		echo $this->format;
	}
	public function getNbrVue()
	{
		return $this->nbr_vue;
	}
	private function verifyOBJ(&$obj)
	{
		if($obj->date == '0000-00-00')
		{
			$date = new DateTime($obj->date); 
			$obj->date = $date->format('U');
			return 0;
		}
		else return 1;
	}
	

	private function prepare(&$tab1)
	{
			if($this->verifyOBJ($tab1))
			{
				if($tab1 instanceOf Client )
				{
					if($tab1->new)
					{
					$DateCreation = new DateTime($tab1->DateCreation); 
					$tab1->DateCreation = $DateCreation->format('U');
					$tab1->date =	$tab1->DateCreation;
					}
					if($tab1->info_modif)
					{
					$DateModification = new DateTime($tab1->DateModification); 
					$tab1->DateModification = $DateModification->format('U');		
					$tab1->date =	$tab1->DateModification;			
					}
				}else
				{
					$Date = new DateTime($tab1->date); 
					$tab1->date = $Date->format('U');					
				}

			}

	}


	private function trieArray(&$tab)
	{
		for ($j = 0; $j < count($tab); $j++) {
		$this->prepare($tab[$j]);
		}

		$i=0;
		do
		{
		$i++;$etat=0;
		for ( $j = 0; $j < count($tab) - $i; $j++) {

			if($tab[$j]->date < $tab[$j+1]->date)
			{
				$tmp = $tab[$j];
				$tab[$j] = $tab[$j+1];
				$tab[$j+1] = $tmp ; $etat = 1;
			}

		};
		}while($etat);	

	}

	private function Initialise()
	{
		if(is_null($this->Achat)) $this->Achat = array(new Achat(0,0,0,'0000-00-00',0,0));
		if(is_null($this->commentaire)) $this->commentaire = array(new Achat(0,0,0,'0000-00-00',0,0));
		if(is_null($this->Client)) $this->Client = array(new Achat(0,0,0,'0000-00-00',0,0));
		if(is_null($this->CV)) $this->CV = array(new Achat(0,0,0,'0000-00-00',0,0));
	}
}


function marqueAchatVue($idAchat,&$db)
{
			$rqt = 'UPDATE demandeachat SET vue=1 WHERE id_demandeAchat = '.$idAchat;
		$result = $db->query($rqt) or die(0);
}
function marqueClientVue($idClient,&$db)
{
			$rqt = 'UPDATE client SET vue=1,info_modif=0,new = 0 WHERE id_client = '.$idClient;
		$result = $db->query($rqt) or die(0);
}
function marqueCVvue($idCV,&$db)
{
			$rqt = 'UPDATE cv SET vue=1 WHERE id_cv = '.$idCV;
		$result = $db->query($rqt) or die(0);	
}
function marqueCommentvue($idC,&$db)
{
			$rqt = 'UPDATE commentaire SET vue=1 WHERE id_commentaire  = '.$idC;
		$result = $db->query($rqt) or die(0);	
}

?>