<?php
session_start();

    include_once ('cnx.php');
    $cnx = new connexion();
    $db = $cnx->getDB();
	$splited = explode('T',$_POST['JourTranche']);
    $reqt =   " select jours from  occupations where  date = '".$_POST['date']."' and jours = ".$splited[0]." and tranche = ".$splited[1]." and id_local = '".$_POST['locale']."'";
    $result = $db->query($reqt);
    $data = $result->fetchAll(PDO::FETCH_BOTH);
    if(empty($data))
    {
  	$reqt =   "INSERT INTO occupations ( id_local, id_enseignant, id_filiere, id_matiere, id_admin, tranche, etat, jours, date, groupe)  values(?,?,null,null,null,?,null,?,?,null)";
    $reponse = $db->prepare($reqt);
    $reponse->execute(array($_POST['locale'],$_SESSION['id_prof'],$splited[1],$splited[0],$_POST['date'])) or die(0); 
    unset($reponse);
    echo 1;}else {echo 0;}
?>