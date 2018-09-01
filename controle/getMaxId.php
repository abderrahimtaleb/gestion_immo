<?php
        include_once (dirname(__FILE__).'/../class/cnx.php');

    $cnx = new connexion();
    $data = array();
    $db = $cnx->getDB();
    $result = $db->query("select max(id_occupation) from occupations; ");
    $data = $result->fetch(PDO::FETCH_BOTH);
    echo $data[0];
?>