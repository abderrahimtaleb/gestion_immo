<?php

class Message 
{
	public $id_message;
	public $refClient;
	public $dest_client;
	public $contenu;
	public $demandeRealisation;
	public $date;
	public $vue;
	public $db;
	public $pathImgClient;
	public $nom_prenomClient;
	public $mail;
	public $objet;
	public $realiser;
	function __construct($id_message,$refClient,$dest_client,$contenu,$demandeRealisation,$date,$vue,$objet,$realiser,&$db)
	{
		$this->id_message = $id_message;$this->refClient = $refClient;$this->dest_client=$dest_client;
		$this->contenu = $contenu;$this->demandeRealisation = $demandeRealisation;
		$this->date = $date;$this->vue = $vue;$this->db = $db;$this->objet = $objet;$this->realiser = $realiser;
		$this->setImgNomClient();
	}
	public function setImgNomClient()
	{
		$rqt = 'SELECT path from image_user where ref_compte_User_Image in '.
		' (select refcompte from client where id_client= '.$this->refClient.') ';
		$result = $this->db->query($rqt);
		$data = $result->fetch(PDO::FETCH_BOTH);
		if(!empty($data))
		{	if($this->verify())
			$this->pathImgClient = '<img src="../../'.$data[0].'" class="img-circle" alt="User Image">';
			else
			$this->pathImgClient = '<img src="'.$data[0].'" class="img-circle" alt="User Image">';
		}
		else {$this->pathImgClient = '<h2 style="margin-top:0px"><i class="fa fa-user text-info"></i><h2>';}
		unset($result);	

		$rqt = 'SELECT nomClient,prenomClient FROM client WHERE id_client = '.$this->refClient;
		$result = $this->db->query($rqt);
		$data = $result->fetch(PDO::FETCH_BOTH);
		$this->nom_prenomClient = $data[0].' '.$data[1];
		unset($result);	

		$rqt = 'SELECT mail FROM compte WHERE idCompte in (select  refCompte from client where id_client = '.$this->refClient.') ';
		$result = $this->db->query($rqt);
		$data = $result->fetch(PDO::FETCH_BOTH);
		$this->mail = $data[0];
	}
	private function verify()
	{

$url =  $_SERVER['PHP_SELF'];
$spited = explode('/',$url);
if(in_array('mailbox',$spited) or in_array('main',$spited))
return 1;
else return 0;
	}
}

class BoxMessage
{
	private $message = array();
	private $dbb;
	private $formatMessageHeader;
	private $formatMessageInbox;
	private $formatMessageInboxEnv;
	private $nbr_vue;
	private $nbrMessageDestClient;
	private $IdMessageVue;
	public function __construct(&$db,$IdMessageVue)
	{
  		$this->dbb = $db;
  		$this->IdMessageVue = $IdMessageVue;
  		if($this->IdMessageVue >=1)
  		{
  			$this->setVue($this->IdMessageVue);
  		}
		$rqt = 'SELECT * FROM message ';
		$result = $this->dbb->query($rqt);
		$data = $result->fetchAll(PDO::FETCH_BOTH);
		foreach ($data as $row) {
			$this->message[] = new Message($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$this->dbb);
		}//
		unset($result);
		$this->nbr_vue=0;$this->nbrMessageDestClient=0;
	}

	private function setVue($Messageid)
	{
		$rqt = 'UPDATE message SET vue=1 WHERE id_message =  '.$Messageid;
		$result = $this->dbb->query($rqt);
	}



	public  function getDemandeRealisation()
	{
		$format = '';

		foreach ($this->message as $message) {
			if($message->date > 0 and !$message->dest_client and $message->demandeRealisation and $message->realiser == 0)
			{

				$format .= '<tr><td><input class="checkbox" type="checkbox" value="'.$message->id_message.'"></td><td>'.$message->nom_prenomClient.'</td><td>'.$message->mail.'</td><td>'.date('d-m-Y',$message->date).'</td>'.
				'<td class="btn-group"><form method="post" class="ForForm" action="client.php"><button data-placement="bottom" class="btn btn-primary btn-sm consulter-Member"><i class="fa fa-external-link"></i></button><input type="hidden" name="idClient" value="'.$message->refClient.'"></form>';
				$format .='<form class="ForForm" action="../mailbox/read-mail.php" method="POST"><button class="btn btn-info btn-sm voirMess" data-placement="bottom"><i class="fa fa-external-link"></i></button>'.
				'<input type="hidden" name="readMessage" value="'.$message->id_message.'"></form>';
				$format .='<button class="btn btn-success btn-sm validerRealisation" data-placement="bottom" value="'.$message->id_message.'"><i class="fa fa-check"></i></button>';
				$format .='</td></tr>';				
			}

		}
		echo $format;
	}

	public  function getDemandeRealisationAccepter()
	{
		$format = '';

		foreach ($this->message as $message) {
			if($message->date > 0 and !$message->dest_client and $message->demandeRealisation and $message->realiser == 1)
			{

				$format .= '<tr><td><input class="checkbox" type="checkbox" value="'.$message->id_message.'"></td><td>'.$message->nom_prenomClient.'</td><td>'.$message->mail.'</td><td>'.date('d-m-Y',$message->date).'</td>'.
				'<td class="btn-group"><form method="post" class="ForForm" action="client.php"><button data-placement="bottom" class="btn btn-primary btn-sm consulter-Member"><i class="fa fa-external-link"></i></button><input type="hidden" name="idClient" value="'.$message->refClient.'"></form>';
				$format .='<form class="ForForm" action="../mailbox/read-mail.php" method="POST"><button class="btn btn-info btn-sm voirMess" data-placement="bottom"><i class="fa fa-external-link"></i></button>'.
				'<input type="hidden" name="readMessage" value="'.$message->id_message.'"></form>';
				$format .='<button class="btn btn-success btn-sm RealisationFini" data-placement="bottom" value="'.$message->id_message.'"><i class="glyphicon glyphicon-stop"></i></button>';
				$format .='<button class="btn btn-danger btn-sm AnnulerRealisation" data-placement="bottom" value="'.$message->id_message.'"><i class="fa fa-times"></i></button>';
				$format .='</td></tr>';				
			}

		}
		echo $format;
	}

	public  function getDemandeRealisationFini()
	{
		$format = '';

		foreach ($this->message as $message) {
			if($message->date > 0 and !$message->dest_client and $message->demandeRealisation and $message->realiser == 2)
			{

				$format .= '<tr><td><input class="checkbox" type="checkbox" value="'.$message->id_message.'"></td><td>'.$message->nom_prenomClient.'</td><td>'.$message->mail.'</td><td>'.date('d-m-Y',$message->date).'</td>'.
				'<td class="btn-group"><form method="post" class="ForForm" action="client.php"><button data-placement="bottom" class="btn btn-primary btn-sm consulter-Member"><i class="fa fa-external-link"></i></button><input type="hidden" name="idClient" value="'.$message->refClient.'"></form>';
				$format .='<form class="ForForm" action="../mailbox/read-mail.php" method="POST"><button class="btn btn-info btn-sm voirMess" data-placement="bottom"><i class="fa fa-external-link"></i></button>'.
				'<input type="hidden" name="readMessage" value="'.$message->id_message.'"></form>';
				$format .='</td></tr>';				
			}

		}
		echo $format;
	}

	private function verifyURL()
	{

$url =  $_SERVER['PHP_SELF'];
$spited = explode('/',$url);
if(in_array('mailbox',$spited))
$path = 'read-mail.php';
elseif(in_array('main',$spited))
$path = '../mailbox/read-mail.php';
else
$path = 'pages/mailbox/read-mail.php';

return $path;
	}

	public function Format_HTML_Message()
	{

		$this->trieArray($this->message);
		$F_HTML = '';
		$F_HTML_Inbox = '';
		foreach ($this->message as $obj) {
			if($obj->date > 0 and !($obj->dest_client))
			{
$vue =''; $vueInbox = '';$style='';
if(!$obj->vue) {$this->nbr_vue++;$vue='text-blue';$vueInbox = 'info';$style='background:#ff9';}
$F_HTML .='<li style="'.$style.'"><a href="'.$_SERVER["PHP_SELF"].'" class="'.$vue.'"><div class="pull-left">'.$obj->pathImgClient.
             ' </div><h4><form method="post" action="'.$this->verifyURL().'"><button class="btn btn-link">'.$obj->nom_prenomClient.'</button><input type="hidden" name="readMessage" value="'.$obj->id_message.'"></form></h4>'.
              '<span class="'.$vue.'"><small>'.($obj->contenu).'</small></span><small class="pull-right"><i class="fa fa-clock-o"></i>'.Date('d-m-Y H:i:s',$obj->date).'</small></a></li>	';
              	/////////////INBOX////////
$F_HTML_Inbox .= '<tr class="'.$vueInbox.'"><td><input class="checkbox" type="checkbox" value="'.$obj->id_message.'"></td><td class="mailbox-name"><form method="post" action="read-mail.php"><input type="hidden" name="readMessage" value="'.$obj->id_message.'"><button class="btn btn-link">'.$obj->nom_prenomClient.'</button></form></td>'.
					'<td class="mailbox-subject">'.($obj->contenu).'</td><td class="mailbox-date"><small>'.Date('d-m-Y H:i:s',$obj->date).'</small></td>'.
					'<td><form method="post" action="../main/client.php"><input type="hidden" name="idClient" value="'.$obj->refClient.'"><button class="btn btn-link">Consulter</button></form></td></tr>';
			}
			elseif($obj->dest_client)
			{
				$this->nbrMessageDestClient++;
$this->formatMessageInboxEnv .= '<tr><form method="post" action="read-mail.php"><td><input class="checkbox" type="checkbox" value="'.$obj->id_message.'"><input type="hidden" name="readMessage" value="'.$obj->id_message.'"></td><td class="mailbox-name"><button class="btn btn-link">'.$obj->nom_prenomClient.'</button></td>'.
					'<td class="mailbox-subject notifications-menu">'.html_entity_decode($obj->contenu).'</td><td class="mailbox-date"><small>'.Date('d-m-Y H:i:s',$obj->date).'</small></td></form>'.
					'<td><form method="post" action="../main/client.php"><input type="hidden" name="idClient" value="'.$obj->refClient.'"><button class="btn btn-link">Consulter</button></form></td></tr>';		
			}

		}
		$this->formatMessageHeader=$F_HTML;$this->formatMessageInbox=$F_HTML_Inbox;
	}

	public function getFormat()
	{
		echo $this->formatMessageHeader;
	}
	public function getNbrVue()
	{
		return $this->nbr_vue;
	}
	public function getNbrMessDestClient()
	{
		return $this->nbrMessageDestClient;
	}
	private function prepare(&$tab1)
	{
		$Date = new DateTime($tab1->date);
		$tab1->date = $Date->format('U');
	}

	public function getFormatInboxEnv()
	{
		echo $this->formatMessageInboxEnv;
	}

	public function getFormatInbox()
	{
		echo $this->formatMessageInbox;
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

	public function &getMessage($id)
	{
				foreach ($this->message as $obj) {
					if($obj->id_message == $id)
						{return $obj; break;}
				}
	}

}

?>