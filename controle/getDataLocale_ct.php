<?php
    require (dirname(__FILE__).'/../class/infoLocale.php');
    include_once (dirname(__FILE__).'/../class/cnx.php');
    $cnx = new connexion();
    $data = array();
    $db = $cnx->getDB();
    $locale  = new mocale($db);
    $data[] = $locale->getLocaleValable($_POST['jourTranche']);

    $ens = new Enseignant($db);
    $data[] = $ens->getEnseignant();

    $mtr = new Matiers($db);
    $data[] = $mtr->getMatiers();
    echo json_encode($data);
?>