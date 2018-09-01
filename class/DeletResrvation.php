<?php

    include_once ('cnx.php');
    $cnx = new connexion();
    $db = $cnx->getDB();

        $rqt = 'delete from occupations where id_occupation = '.$_POST['idOccupation'];
    
        $db->exec($rqt) or die(0);
    echo 1;
?>