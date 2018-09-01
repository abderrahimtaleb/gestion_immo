<?php

class Produit
{
	public $id_produit;
	public $titre;	
	public $prix;
	public $db;
	public $pathImgProduit;
	public $desc;
	public $version;
	public $taille;
	public $langue;
	public $compatibilite;
	public $dateCreation;
	public $requirement;
	public $img;
	public	$id_Descriptionproduit;
	public	$historique;
	public	$avantage;
	function __construct($id,&$db)
	{
		$this->id_produit = $id;$this->db =$db ;
		$this->setDataProduit();
	}
		public function setDataProduit()
	{

$rqt = 'SELECT id_produit,path_produit,nomProduit,prix,description,version,requirement,taille,langue,compatibilite,dateCreation,id_Descriptionproduit,historique,avantage FROM (produit P join descriptionproduit D on P.id_produit = D.'.
		'id_Descriptionproduit ) join image_produit I on P.id_produit = I.ref_image_produit where id_produit = '.$this->id_produit;
		$result = $this->db->query($rqt);
		$data = $result->fetch(PDO::FETCH_BOTH);

		if(!is_null($data[1]))
		{
			$this->pathImgProduit = '<img src="'.$data[1].'"  alt="User Image">';
			$this->img = $data[1];
		}
		else {$this->pathImgProduit = '<h2 style="margin-top:0px"><i class="fa fa-user text-info"></i><h2>';}
		unset($result);	
		$this->titre = $data[2];$this->prix = $data[3];$this->desc = $data[4];
		$this->version = $data[5];$this->taille = $data[7];$this->langue = $data[8];	
		$this->requirement = $data[6];$this->compatibilite = $data[9];$this->dateCreation = $data[10];		
		$this->id_Descriptionproduit = $data[11];$this->historique = $data[12];$this->avantage = $data[13];
	}
}

class BoxPoduit
{
	private $Produit = array();
	private $dbb;
	private $format;
	public $nbr = 0;
	public function __construct(&$db)
	{
  		$this->dbb = $db;
		$rqt = 'SELECT id_produit FROM produit';
		$result = $this->dbb->query($rqt);
		$data = $result->fetchAll(PDO::FETCH_BOTH);
		
		foreach ($data as $row) {
			
			$this->Produit[] = new Produit($row[0],$this->dbb);
			$this->nbr++;
		}//
		unset($result);
		$this->Format_HTML_Produit();
	}
	public function getTabProduct(){return $this->Produit;}
	public function Format_HTML_Produit()
	{

		$F_HTML = '';
$i = 0;
		foreach ($this->Produit as $obj) {if($i == 15){break;}$i++;
$F_HTML .='<li class="item"><div class="product-img">'.$obj->pathImgProduit.'</div>'.
			'<form method="post" action="pages/main/info_project.php"><div class="product-info"><button class="btn btn-link product-title">'.$obj->titre.'</button><span class="label label-warning pull-right">'.
			$obj->prix.'DH</span></a>'.'<span class="product-description">'.$obj->desc.'</span></div><input type="hidden" name="idProduit" value="'.$obj->id_produit.'"></form></li>';
		}
		$this->format=$F_HTML;
	}

	public function getFormat()
	{
		echo $this->format;
	}

public function getFormatProduit()
{
		$F_HTML = '';
		foreach ($this->Produit as $obj) {
		//settype($obj->id_Descriptionproduit, 'string');
$F_HTML .= '<div class="col-sm-6" id="p'.$obj->id_produit.'"><div class="single-blog" style="box-shadow:inset 5px 0px 5px #444,  -20px 19px 5px 0;">'.
'<img src="../../'.$obj->img.'" class="img-thumbnail col-md-6" style="margin-right:10px;"alt="" /><center><h2><span class="text-danger nom">'.$obj->titre.'</span></h2></center>'.
'<div class="table-responsive"><ul class="nav nav-stacked"><table class="table table-condensed"><tbody>'.
'<tr style="margin-top:10px"><td><li><strong>Version</strong></li></td><td class="version">'.$obj->version.'</td> </tr>'.
'<tr style="margin-top:10px"><td><li><strong>Requirement</strong></li></td><td class="req">'.$obj->requirement.'</td> </tr>'.
'<tr style="margin-top:10px"><td><li><strong>Taille</strong></li></td><td class="taille">'.$obj->taille.'</td> </tr>'.                  
 '<tr style="margin-top:10px"><td><li><strong>Langue</strong></li></td><td class="lan">'.$obj->langue.'</td> </tr> '.                   
   '<tr style="margin-top:10px"><td><li><strong>Compatibilite</strong></li></td><td class="comp">'.$obj->compatibilite.'</td> </tr> '.    
    '<tr style="margin-top:10px"><td><li><strong>Prix</strong></li></td><td class="prix">'.$obj->prix.' DH</td> </tr> '.                     
    '<tr style="margin-top:10px"><td><li><strong>Date création</strong></li></td><td>'.$obj->dateCreation.'</td> </tr></tbody> '.                   
' </table></ul>'.
'<a style="margin-top:10px" href="" class="btn btn-primary" data-toggle="modal" data-target="#'.$obj->id_Descriptionproduit.'">Voire la description</a><br>'.
'<br><button class="btn btn-default btn-block Modifier" id="'.$obj->id_produit.'p"><i class="fa fa-edit pull-left"></i>Modifier</button><br>'.
'<button class="btn btn-default btn-block CommentUser" id="'.$obj->id_produit.'pr"><i class="fa fa-comments-o pull-left"></i>Voire les commentaires</button><br>'.
'<button class="btn btn-danger btn-block SupprimerProduct" id="'.$obj->id_produit.'supr"><i class="fa fa-times pull-left"></i>Supprimer</button>'.
'</div></div>'.
'<div class="modal fade " id="'.$obj->id_Descriptionproduit.'" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog">'.
'<div class="modal-content"><div class="modal-body row">'.
'<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'.
'<img src="../../'.$obj->img.'" class="col-sm-6 img-thumbnail" alt="" style="margin-bottom:50px;"/>'.
'<div class="col-sm-6"><h4 ><strong class="text-info">Description</strong></h4><blockquote><small class="desc">'.$obj->desc.                         
'</small></blockquote><h4><strong class="text-danger">Historique</strong></h4><blockquote><small class="histo">'.$obj->historique.
'</small></blockquote><h4><strong class="text-warning">Avantage</strong></h4><blockquote><small class="avantage">'.$obj->avantage.'</small></blockquote></div></div></div></div></div></div>';
}
		echo($F_HTML);
}
}
	
function insertProduit(&$db)
{
$rqt =  $db->prepare("INSERT INTO produit VALUES ('',?,?,?,?,?,?,?,now())");
$rqt->execute(array($_SESSION['NProduit'],$_SESSION['prix'],$_SESSION['version'],$_SESSION['requirement'],$_SESSION['taille'],$_SESSION['langue'],$_SESSION['compatibilite']))or die('Erreur au niveau  d\'insersion du produit');
return 1;
}
function insertDescriptionProduit(&$db)
{
$id = $db->lastInsertId();
$rqt =  $db->prepare("INSERT INTO DescriptionProduit VALUES (?,?,?,?)");
$rqt->execute(array($id,$_SESSION['description'],$_SESSION['historique'],$_SESSION['avantage']))or die('Erreur au niveau  d\'insersion du produit');
return $id;		
}
function insertImageProduit(&$db,$id,$fichier)
{
$rqt =  $db->prepare("INSERT INTO image_produit VALUES ('',?,?)");
$rqt->execute(array($id,$fichier)) or die('Erreur au niveau  d\'insersion du produit');
}

function TestImg(&$db,$extension)
{
		$fichier = htmlentities('dist/imgProduct/'.str_shuffle('abcfg123679qwzp').'.'.$extension); 
		$result =  $db->query('SELECT path_produit FROM image_produit where path_produit = "'.$fichier.'"');
		$res = $result->fetchAll();
		while (!empty($res)) {
		unset($res);
		$fichier = htmlentities('dist/imgProduct/'.str_shuffle('abcfg123679qwzp').'.'.$extension); 
		$res =  $db->query('SELECT path_produit FROM image_produit where path_produit = "'.$fichier.'"');	}
		if(is_int(insertProduit($db)))
		{		$i = insertDescriptionProduit($db);
		
			 	insertImageProduit($db,$i,$fichier);
			 	unset($_SESSION['prix']);
			 
		}
		              return $fichier;
}
?>
