<?php 
require 'php_files/connexion.class.php'; 
require 'php_files/enseignant.class.php'; 
require 'admins.class.php';  

$stm = new Db_connect();
$ens = new enseignant($stm->connect());
$admin = new Admin($stm->connect());
extract($_POST);
if($action=="chercher") {
  if($_SESSION['type']=='prof')
    $user = $ens->get($_SESSION['id_prof']);
  else {
    $user = $admin->getAdmin($_SESSION['login'],$_SESSION['password']);
  }

?>
<div class="kform">
      <div class="section-divider mb40" id="spy1">
          <span>Informations Personnels</span>
        </div>
  </div>
  <div class="form-group">
        <label class="col-sm-3 control-label">Nom* :</label>
        <div class="col-sm-8">
        <input type="text" class="form-control" name="nom" required="" value="<?php echo $user['nom']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Prenom* :</label>
        <div class="col-sm-8">
        <input type="text" class="form-control" name="prenom" required="" value="<?php echo $user['prenom']; ?>"></div>
    </div>
      <?php if(isset($_SESSION['id_prof'])){ ?>
    <div class="form-group">
         <label class="col-sm-3 control-label">Telephone* :</label>
         <div class="col-sm-8">
         <input type="number" class="form-control" name="telephone" value="<?php echo $user['telephone']; ?>"></div>
      </div>

      <?php } ?>
      <div class="form-group">
         <label class="col-sm-3 control-label">Email* :</label>
         <div class="col-sm-8">
         <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>"></div>
      </div>
                              
       
<?php
}
//var_dump($resultat);
?>
