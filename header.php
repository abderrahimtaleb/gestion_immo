<?php

 //if(!isset($_SESSION['login']))
   // header('Location:/projet');
?>
<?php
/*@session_start();
extract($_POST); 
if (isset($modifierpass)) {
   if(!empty($password1) AND !empty($password2) AND !empty($ancienpass)){
      if ($password1 == $password2) {
         require 'php_files/connexion.class.php';
         require 'php_files/departement.class.php';
         require 'php_files/enseignant.class.php'; 
         require 'admins.class.php';
         $stm = new Db_connect();
         $ens = new enseignant($stm->connect());
         $admin = new Admin($stm->connect());
         if ($_SESSION['type']=="admin") {
             $adm = $admin->getAdmin($_SESSION['login'],$_SESSION['password']);
            if ($adm['password'] == sha1($ancienpass)) {
               $statu = $admin->updatePwd($_SESSION['id_admin'],$password1);
               if ($statu) {
               $_SESSION['message']="Le Mot de Pass est bien Modifié.";
                  } 
                  else $_SESSION['erreur']="Une Erreur se produite lors de la modification !";
               } else $_SESSION['erreur']="L'ancien Mot de pass est incorect !";
         }else{
            $ensei = $ens->get($_SESSION['id_prof']);
            if ($ensei['password'] == sha1($ancienpass)) {
               $statu = $ens->update_pass($_SESSION['id_prof'],sha1($password1));
               //die("STATU : $statu");
               if ($statu) {
               $_SESSION['message']="Le Mot de Pass est bien Modifié.";
                  } 
                  else $_SESSION['erreur']="Une Erreur se produite lors de la modification !";
               } else $_SESSION['erreur']="L'ancien Mot de pass est incorect !";
            }
          
      } else $_SESSION['erreur']="Les deux Mot de Passes doivent etre identiques !";

   } else $_SESSION['erreur']="Vous devez remplire tous les champs !";
 header("Location: " . $_SERVER["HTTP_REFERER"]);
}




if (isset($modifierprof)) {
   if (!empty($nom) AND !empty($prenom)) {
         require 'php_files/connexion.class.php';
         require 'php_files/enseignant.class.php';
         require 'admins.class.php';
         $stm = new Db_connect();
         $ens = new enseignant($stm->connect());
         $adm = new Admin($stm->connect());


        if($_SESSION['type']=='prof'){
  
           $statu = $ens->update_profile($_SESSION['id_prof'],$nom,$prenom,$telephone,$email);
            if ($statu) {
         $_SESSION['message']="Le profile est Bien Modfié.";
          } else $_SESSION['erreur']="Une Erreur est produite lors de la modification !";
           }
           else {

            $statu = $adm->updateInfo($_SESSION['id_admin'],$nom,$prenom,$email);
            if ($statu) {
         $_SESSION['message']="Le profile est Bien Modfié.";
          } else $_SESSION['erreur']="Une Erreur est produite lors de la modification !";
           };


} else $_SESSION['erreur']="Vous devez remplire tous les champs !";
header("Location: " . $_SERVER["HTTP_REFERER"]);

}
*/
 ?>
 <script  src="js/profile.js"></script>
<nav class="navbar-default navbar-static-side fixed-menu" role="navigation">
            <div class="sidebar-collapse">
               <div id="hover-menu"></div>
               <ul class="nav metismenu" id="side-menu">
                  <li>
                     <div class="logopanel" style="margin-left: 0px;">
                        <div class="profile-element">
                           <h2><a href="#">E-Imm</a></h2>
                        </div>
                        <div class="logo-element">
                          E-R
                        </div>
                     </div>
                  </li>
                  <li>
                     <div class="leftpanel-profile">
                        
                        <div class="media-body profile-name" style="white-space: nowrap;">
                           <h4 class="media-heading"><?php// echo $_SESSION['nom']." ".$_SESSION['prenom']; ?><a data-toggle="collapse" data-target="#loguserinfo" class="pull-right"><i class="fa fa-angle-down"></i></a></h4>
                           <span>    <?php /*if($_SESSION['type']=='prof')
                                             echo 'Enseignant';
                                          else
                                             echo 'Administrateur';*/

                                       ?>
                        </span>
                        </div>
                     </div>
                     <div class="leftpanel-userinfo collapse" id="loguserinfo" style="position: absolute; background: #3b4354!important">
                        
                        <h5 class="sidebar-title">Contact</h5>
                        <ul class="list-group">

                           <li class="list-group-item">
                              <label class="pull-left">Telephone</label>
                              <span class="pull-right">0653969237</span>
                           </li>

                           <li class="list-group-item">
                              <label class="pull-left">Email</label>
                              <span class="pull-right"><?php //echo $_SESSION['email'];?>abderra.taleb@gmail.com</span>
                           </li>
                        </ul>
                     </div>
                  </li>
                  <li>
                     <!-- START : Left sidebar -->
                     <div class="nano left-sidebar">
                        <div class="nano-content">
                           
                            <?php include('side_admin.php'); ?>
                        </div>
                     </div>
                     <!-- END : Left sidebar -->
                  </li>
               </ul>
            </div>
         </nav>

         <div id="<?php  //if($_SESSION['type']=='admin') { echo 'page-wrapper';} ?>" class="gray-bg">
            <div>
               <nav class="navbar navbar-fixed-top white-bg show-menu-full" id="nav" role="navigation" style="margin-bottom: 0">
                   <div class="navbar-header">
                  </div>

                  <?php //} ?> 
                 

                  <ul class="nav navbar-top-links navbar-right">
                     
                     <li class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <span class="pl15"> <?php //echo $_SESSION['nom']." ".$_SESSION['prenom']; ?> </span>
                        <span class="caret caret-tp"></span>
                        </a>
                        <ul class="dropdown-menu animated m-t-xs">
                        <li>
                        <a href="#" class="animated animated-short fadeInUp profile" data-toggle="modal" data-target="#my2">
                        <i class="fa fa-user"></i> Profile
                        </a>
                        </li>
                        <li><a href="#" class="animated animated-short fadeInUp" data-toggle="modal" data-target="#my1"><i class="fa fa-lock"></i> Modifier le Mot de Pass</a></li>
                           <li><a href="logout.php" class="animated animated-short fadeInUp"> <span class="fa fa-sign-out" > </span> Logout</a></li>
                        </ul>
                     </li>
                  </ul>
               </nav>
            </div>

            <div class="modal inmodal fade" id="my1" tabindex="-1" role="dialog"  aria-hidden="true">
                              <div class="modal-dialog modal-sm">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
                                       <i class="fa fa-lock modal-icon"></i>
                                       <h4 class="modal-title">Modifier le Mot de Pass</h4>
                                    </div>
                                    <form method="post" class="form-horizontal" action="header.php">
                                    <div class="modal-body">
                                       <div class="form-group">
                                       <label>Ancien Mot de Pass* :</label> 
                                       <input type="password" placeholder="Entrer le mot de pass" class="form-control" required="" aria-required="true" name="ancienpass">
                                       </div>
                                       <div class="form-group">
                                       <label>Nouveau Mot de Pass* :</label> 
                                       <input type="password" placeholder="Entrer le mot de pass" class="form-control" required="" aria-required="true" name="password1">
                                       </div>
                                       <div class="form-group">
                                       <label>Repeter le Nouveau Mot de Pass* :</label> 
                                       <input type="password" placeholder="Entrer le mot de pass" class="form-control" required="" aria-required="true" name="password2">
                                       </div>
                                    
                                   
                                   
                              

                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-white" data-dismiss="modal">Fermer</button>
                                       <button name="modifierpass" type="submit" class="btn btn-primary btn-outline"><i class="fa fa-ok"></i> Enregistrer</button>
                                    </div>
                                    </form>
                                 </div>
                              </div>
                           </div>


                           <div class="modal inmodal fade" id="my2" tabindex="-1" role="dialog"  aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
                                       <i class="fa fa-user modal-icon"></i>
                                       <h4 class="modal-title">Modifier le profile</h4>
                                    </div>
                                    <form method="post" class="form-horizontal" action="header.php">
                                    <div class="modal-body" id="prf">
                                       
                                    
                                   
                                
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-white" data-dismiss="modal">Fermer</button>
                                       <button name="modifierprof" type="submit" class="btn btn-primary btn-outline"><i class="fa fa-download"></i> Enregistrer</button>
                                    </div>
                                    </form>
                                 </div>
                              </div>
                           </div>


