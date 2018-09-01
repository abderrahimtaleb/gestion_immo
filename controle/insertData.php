<?php

        include_once (dirname(__FILE__).'/../class/cnx.php');
   extract($_POST);
    function test($idLocale)
    {
        if($_POST[$val] == '')
            return false;
        else
            return true;
    }
    $cnx = new connexion();
    $data = array();
    $db = $cnx->getDB();
    if( !empty($idLocale) and !empty($idEns) and !empty($idMatiere) and !empty($idFiliere) and !empty($group))
    {
                $spited = explode('T',$_POST['jourTranche']);

        $result = preg_match('/([[:alnum:][:space:]\._]+)/',$_POST['group'],$matches);
        if($result)
        {
        if(!(strlen($matches[0]) === strlen($_POST['group'])) )
         {echo 0; exit(0);}          
        }
        else {echo 0; exit(0);} 
$query=" insert into occupations ( id_local, id_enseignant, id_filiere, id_matiere, id_admin, tranche, etat, jours, date, groupe) values('$idLocale',$idEns,$idFiliere,$idMatiere,null,$spited[1],true,$spited[0],null,'$group')";
   $db->exec($query) or die($query);
    echo $db->lastInsertId();
    }
    else echo 0;
?>