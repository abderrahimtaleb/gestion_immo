<?php
 include_once ('cnx.php');

    $cnx = new connexion();
    $db = $cnx->getDB();
	$rqt = 'delete from occupations ';
	 $db->exec($rqt) or die(0);
	 echo 1;
?>