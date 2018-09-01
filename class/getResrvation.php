<?php

    include_once ('cnx.php');
    $cnx = new connexion();
    $db = $cnx->getDB();
	$splited = explode('T',$_POST['JourTranche']);

        $rqt = 'select id_occupation,nom,prenom,departement,date '.
'from occupations O, enseignants E,departements D '.
'where  O.id_enseignant = E.id_enseignant and E.id_departement = D.id_departement  '.
' and  tranche = '.$splited[1].' and jours = '.$splited[0].' and id_local = "'.$_POST['locale'].'"';
    
    $result = $db->query($rqt);
    $data = $result->fetchAll(PDO::FETCH_BOTH);
    $tmp="";
    foreach ($data as $row) 
    {
    if(is_null($row[1]) or empty($row[1]))
    {$row[1]=$row[3];}
    else {$row[1].=" ".$row[2];}
    $tmp.=' <tr><td>'.$row[1].'</td><td>'.$row[4].'</td><td><button class="btn btn-danger delete" id="'.$row[0].'"><i class="fa fa-times"></i></button></td></tr>'; }
    echo $tmp;
?>