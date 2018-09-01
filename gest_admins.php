<?php
 session_start();

?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>FSTG KESH</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
      <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
      <link href="css/animate.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
      <link href="css/forms/kforms.css" rel="stylesheet">
      <!-- Data Tables -->
      <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
      <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
      <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
            <script src="js/jquery-2.1.1.js"></script>

                     <script> 
                           $(function(){

                                 $('.delbtn').click(function(){
                                    var id = $(this).attr('id');
                                    $('#spanid').empty().append(id);
                                    $('#confirmdel').click(function(){
                                          $(location).attr("href","admins.php?op=del&id="+id);
                            });
                                 });


                           })
                   </script>

   </head>
   <body>
      <div id="wrapper">
          <?php include('header.php'); ?>

            <div style="clear: both; height: 61px;"></div>
            <div class="wrapper wrapper-content animated fadeInRight" style="margin-left:15%">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="inqbox float-e-margins">
                        <div class="inqbox-content">
                           <h2 class="text-primary"><i class="fa fa-users fa-2x "></i> Gestion Des Administrateurs </h2>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
               <div class="col-md-12">
                     <div class="tab-block">
                        <ul class="nav nav-tabs">

                           <li class="<?php if(!isset($_GET['errorup']) and !isset($_GET['errorin'])) echo 'active' ?>" id="home">
                              <a href="#tab2" data-toggle="tab"><i class="fa fa-table text-primary"></i> Consulter / Supprimer un compte Administrateur </a>
                           </li>
                               <li id="insert" class="<?php if(isset($_GET['errorin'])) echo 'active' ?>">
                              <a href="#tab1" data-toggle="tab"><i class="fa fa-plus text-primary"></i> Ajouter un Administrateur</a>
                           </li>
                              <li id="#update" class="<?php if(isset($_GET['errorup'])) echo 'active' ?>">
                              <a href="#tab3" data-toggle="tab"><i class="fa fa-refresh text-primary"></i> Modifier les informations du compte</a>
                           </li>

                           
                        </ul>
                        <div class="tab-content p30" style="height: 730px;">
                           <div id="tab1" class="tab-pane <?php if(isset($_GET['errorin'])) echo 'active' ?>">
                           <form method="post" class="form-horizontal" action="admins.php">
                           <div class="kform">
                               <div class="section-divider mb40" id="spy1">
                                    <h2>Informations De L'administrateur</h2>
                                 </div>
                            <?php 
                              if(isset($_GET['errorin']) )
                              {
                                  if($_GET['errorin']=='mdp') 
                                  {
                                    echo '<BR /> <div class="alert alert-danger col-sm-4 col-sm-offset-4 animated bounceIn"> Mots de passe non identiques ! </div>';
                                  } 
                                  else if($_GET['errorin']=='login') 
                                  {
                                    echo '<BR /> <div class="alert alert-danger col-sm-4 col-sm-offset-4 animated bounceIn"> Login et/ou E-mail déja existant ! </div>';
                                  } 

                              
                               } 
                               ?>
                           </div>
                               <div class="form-group has-success" style="margin-top: 8%">
                                 <label class="col-sm-4 control-label">Nom* :</label>
                                 <div class="col-sm-4">
                                 <input type="text" class="form-control" name="nom"  required></div>
                              </div>

                              <div class="form-group has-success">
                                 <label class="col-sm-4 control-label">Prénom* :</label>
                                 <div class="col-sm-4">
                                 <input type="text" class="form-control" name="prenom" required></div>
                              </div>
                              <div class="form-group has-success">
                                 <label class="col-sm-4 control-label">Email* :</label>
                                 <div class="col-sm-4">
                                 <input type="email" class="form-control" name="email" required></div>
                              </div>
                              <div class="form-group has-success">
                                 <label class="col-sm-4 control-label">Login* :</label>
                                 <div class="col-sm-4">
                                 <input type="text" class="form-control" name="login" minlength="6" maxlength="20" required></div>
                              </div>
                              <div class="form-group has-success">
                                 <label class="col-sm-4 control-label">Mot de Pass* :</label>
                                 <div class="col-sm-4">
                                 <input type="password" class="form-control" name="password" minlength="6" maxlength="20" required></div>
                              </div>
                              <div class="form-group has-success">
                                 <label class="col-sm-4 control-label">Resaisire le Mot de Pass* :</label>
                                 <div class="col-sm-4">
                                 <input type="password" class="form-control" name="password2" required ></div>
                              </div>
                              <div class="form-group">
                                 <div class="col-sm-8">
                                 <div class="pull-right">
                                    <button type="reset" class="btn btn-white" type="reset">Annuler</button>
                                    
                                    <button class="btn btn-success btn-outline" type="submit" name="ajout">Ajouter <i class="fa fa-download"></i></button>
                                 </div>
                                 </div>
                              </div>
                           </form>
                           </div>



						<div id="tab3" class="tab-pane <?php if(isset($_GET['errorup'])) echo 'active'; ?>">
                           <form method="post" class="form-horizontal" action="admins.php">
                           <div class="kform">
                               <div class="section-divider mb40" id="spy1">
                                    <h2>Informations De Compte</h2>

                                 </div>
                           </div>

                              <?php 
                              if(isset($_GET['errorup']) )
                              {
                                  if($_GET['errorup']=='mdp') 
                                  {
                                    echo '<BR /> <div class="alert alert-danger col-sm-4 col-sm-offset-4 animated bounceIn"> Mots de passe non identiques ! </div>';
                                  } 
                                  else if($_GET['errorup']=='login') 
                                  {
                                    echo '<BR /> <div class="alert alert-danger col-sm-4 col-sm-offset-4 animated bounceIn"> Login déja existant ! </div>';
                                  } 

                              
                               } 
                               ?>


                               <div class="form-group has-primary" style="margin-top: 10%">
                                 <label class="col-sm-4 control-label">Nom* :</label>
                                 <div class="col-sm-4">
                                 <input type="text" class="form-control" name="nom" value="<?php echo $_SESSION['nom'] ?>" required></div>
                              </div>

                              <div class="form-group has-primary">
                                 <label class="col-sm-4 control-label">Prénom* :</label>
                                 <div class="col-sm-4">
                                 <input type="text" class="form-control" name="prenom"  value="<?php echo $_SESSION['prenom'] ?>" required></div>
                              </div>
                              <div class="form-group has-primary">
                                 <label class="col-sm-4 control-label">Email* :</label>
                                 <div class="col-sm-4">
                                 <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['email'] ?>" required></div>
                              </div>
                              <div class="form-group has-primary">
                                 <label class="col-sm-4 control-label">Login* :</label>
                                 <div class="col-sm-4">
                                 <input type="text" class="form-control" name="login" minlength="6" maxlength="20" value="<?php echo $_SESSION['login'] ?>" required></div>
                              </div>
                              <div class="form-group has-primary">
                                 <label class="col-sm-4 control-label">Mot de Pass* :</label>
                                 <div class="col-sm-4">
                                 <input type="password" class="form-control" name="password" minlength="6" maxlength="20" value="<?php echo $_SESSION['password'] ; ?>" required></div>
                              </div>
                              <div class="form-group has-primary">
                                 <label class="col-sm-4 control-label">Resaisire le Mot de Pass* :</label>
                                 <div class="col-sm-4">
                                 <input type="password" class="form-control" name="password2" required ></div>
                              </div>
                              <div class="form-group">
                                 <div class="col-sm-8">
                                 <div class="pull-right">
                                    <button type="reset" class="btn btn-white" type="reset">Annuler</button>
                                    
                                    <button class="btn btn-primary btn-outline" type="submit" name="update">Modifier <i class="fa fa-pencil"></i></button>
                                 </div>
                                 </div>
                              </div>
                           </form>

                           </div>


                     <div class="modal inmodal animated bounceIn" id="modaldel" tabindex="-1" role="dialog"  aria-hidden="true" style="margin-top:15%;">
                              <div class="modal-dialog modal-md">
                                 <div class="modal-content">
                                    <div class="modal-body">
                                          <center class="text-warning"> <i class="fa fa-warning fa-3x"></i> </center>
                                          <center> <h2 class="text-warning "> Etes-vous sur de vouloir supprimer L'Professeur N° <span id="spanid"></span> </h2>  </center>    
                                    </div>
                                    <div class="modal-footer">
                                     <button type="button" class="btn btn-warning" data-dismiss="modal">Non</button>
                                     <button type="button" id="confirmdel" class="btn btn-succes btn-outline"><i class="fa fa-ok"></i> Oui</button>

                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div id="tab2" class="tab-pane <?php if(!isset($_GET['errorup']) and !isset($_GET['errorin'])) echo 'active'; ?>"
                           <div class="row">
                           
                  <div class="col-md-12">
                     
                              <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" style="text-align: center">
                                 <thead>
                                    <tr>
                                       <th>ID ADMIN</th>
                                       <th>NOM ET PRENOM</th>
                                     
                                       <th>EMAIL</th>
                                       <th>LOGIN</th>
                                       <th width="180">OPERATION</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    	//include('list_admins.php');
                                    ?>
                                    
                                 </tbody>
                                 
                              </table>
                           </div>


                           </div>
                           </div>


                           </div>
                           </div>

                     </div>

                  </div>
                  
            </div>
            
         </div>

      </div>
      <!-- Mainly scripts -->
      <script src="js/bootstrap.min.js"></script>
      <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
      <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
      <!-- Custom and plugin javascript -->
      <script src="js/main.js"></script>
      <script src="js/plugins/pace/pace.min.js"></script>
      <script src="js/plugins/jeditable/jquery.jeditable.js"></script>
      <!-- Data Tables -->
      <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
      <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
      <script src="js/plugins/dataTables/dataTables.responsive.js"></script>
      <script src="js/plugins/dataTables/dataTables.tableTools.min.js"></script>

      <!-- Page-Level Scripts -->
      <script type="text/javascript">
         $(document).ready(function () {
             "use strict";
             
             $('.dataTables-example').dataTable({
                 responsive: true,
                 "dom": 'T<"clear">lfrtip',
                 "tableTools": {
                     "sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
                 }
             });
         
         });
         
   
      </script>
      <style>
          body.DTTT_Print {
              background: #fff;
          }
          .DTTT_Print #page-wrapper {
              margin: 0;
              background:#fff;
          }
          button.DTTT_button, div.DTTT_button, a.DTTT_button {
              border: 1px solid #e7eaec;
              background: #fff;
              color: #676a6c;
              box-shadow: none;
              padding: 6px 8px;
          }
          button.DTTT_button:hover, div.DTTT_button:hover, a.DTTT_button:hover {
              border: 1px solid #d2d2d2;
              background: #fff;
              color: #676a6c;
              box-shadow: none;
              padding: 6px 8px;
          }
          .dataTables_filter label {
              margin-right: 5px;
          }
      </style>
   </body>
</html>
