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
    if( !empty($idLocale) and !empty($idMatiere) and !empty($idFiliere) and !empty($group))
    {
                $spited = explode('T',$_POST['jourTranche']);

        $result = preg_match('/([[:alnum:][:space:]\._]+)/',$_POST['group'],$matches);
        if($result)
        {
        if(!(strlen($matches[0]) === strlen($_POST['group'])) )
         {echo 0; exit(0);}          
        }
        else {echo 0; exit(0);} 
$query="insert into controles(id_local,id_filiere,id_matiere,tranche,etat,jours,date,groupe) values($idLocale,$idFiliere,'$idMatiere',$spited[1],1,$spited[0],null,'$group')";
       
   $db->exec($query) or die($query);
    echo $db->lastInsertId();
    }
    else echo 0;
?>