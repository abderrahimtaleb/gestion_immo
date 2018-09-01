<?php
    
        include_once (dirname(__FILE__).'/../class/cnx.php');
    function test($val)
    {
        if($_POST[$val] == '')
            return false;
        else
            return true;
    }
    $cnx = new connexion();
    $data = array();
    $db = $cnx->getDB();
    if( test('idLocale') and test('idEns') and test('idMatiere') and test('idFiliere') and test('group'))
    {

        $result = preg_match('/([[:alnum:][:space:]\._]+)/',$_POST['group'],$matches);
        if($result)
        {
        if(!(strlen($matches[0]) === strlen($_POST['group'])) )
         {echo 0; exit(0);}          
        }
        else {echo 0; exit(0);} 
    
    $reqt =   'UPDATE occupations SET id_local=?,id_enseignant=?,id_filiere=?,id_matiere=?,groupe=? WHERE id_occupation= ?';
    $reponse = $db->prepare($reqt);
    $reponse->execute(array($_POST['idLocale'],$_POST['idEns'],$_POST['idFiliere'],$_POST['idMatiere'],$_POST['group'],$_POST['idOccpation'])) or die(0); 
    unset($reponse);

   echo $_POST['idOccpation'];
    }
    else echo 0;
?>