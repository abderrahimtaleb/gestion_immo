<?php
	session_start();
	if(isset($_SESSION['type']))
	{
		if($_SESSION['type']=='admin')
			header('Location:gest_admins.php');
		else
			header('Location:espaceUser.php');
	}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title> Service de scolarité FSTG</title>
  
  
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:600'>
        <link href="css/animate.css" rel="stylesheet">


      <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">

       <link rel="stylesheet" href="css/style1.css">

      <script src="js/jquery-2.1.1.js"></script>
      <script src="js/bootstrap.min.js"></script>


       <script>
       	$(function(){
			$('#forgot').click(function() {
				$('#myModal5').modal('show');
			});
       	})
       </script>

  
</head>

<body>
  <div class="login-wrap">
	<div class="login-html">
		<center>
				<h1  class="sign-in" >Connexion</h1>
		</center>
		<br />
		<div class="login-form">
			<div class="sign-in-htm">
			  <form method="post" action="admins.php">
				<div class="group">
					<label for="user" class="label"> <i class="glyphicon glyphicon-user"> </i> &nbsp; &nbsp; Nom d'utilisateur</label>


					<input id="user" type="text" class="input" placeholder="username" name="username" maxlength="20" minlength="6" required>
				</div>

				<br />
				<div class="group">
					<label for="pass" class="label"><i class="glyphicon glyphicon-lock"> </i> &nbsp; &nbsp; Mot de passe</label>
					<input id="pass" type="password" name="password" class="input" data-type="password" placeholder="password" maxlength="20" minlength="6" required>
				</div>
				<br />

					<br/>
					<a href="#mdp" id="forgot" style="color: white">Mot de passe oublié ?</a>
				 <div class="hr"></div>


				<div class="group" style="margin-top:-2%">
					<input type="submit" class="button" value="Connexion" name="connect">
				</div>
				</form>

			</div>

		</div>
	</div>
</div>

                           <div class="modal inmodal animated bounceIn" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
                              <div class="modal-dialog modal-md">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
                                       <i class="fa fa-home modal-icon"></i>
                                       <center class="text-primary"><h3 class="modal-title"> <i class="glyphicon glyphicon-refresh"> </i> Récupération du compte</h3></center>
                                    </div>
                                    <div class="modal-body">
                                       <form method="post" class="form-horizontal" action="admins.php">
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Email </label>
                                 <div class="col-sm-9"><input type="email" class="form-control" name="email"  required></div>
                              </div>
                                <div class="form-group">
                                 <label class="col-sm-3 control-label">Compte  </label>
                                 <div class="col-sm-9">
                                 	
                                 <select name="user" class="form-control" required>
                                 	<option value="admin">Administrateur</option>
                                 	<option value="prof">Enseignant</option>
                                 </select>

                                 </div>
                              </div>
                              
                              </div>

                                    <div class="modal-footer">
                                     <button type="button" class="btn btn-white" data-dismiss="modal">Fermer</button>
                                     <button type="submit" name="rec" class="btn btn-primary btn-outline"><i class="fa fa-ok"></i> Envoyer</button>
                                </form>

                                    </div>
                                 </div>
                              </div>
                           </div>
  
	<?php
		if(isset($_GET['err']))
		{
			if($_GET['err']=='inx')
			{
	?>
			<div class="alert alert-danger col-sm-offset-4 col-sm-4 animated bounceIn" style="margin-top: 1%">
				<p style="text-align: center"> Impossible de se connecter ! Login et/ou mot de passe erroné </p>
			</div>
	<?php
	}
	else if($_GET['err']=='email')
	{
		?>
			<div class="alert alert-danger col-sm-offset-4 col-sm-4 animated bounceIn" style="margin-top: 1%">
				<p style="text-align: center"> Email inexistant ! </p>
			</div>
		<?php
	}}
	else if(isset($_GET['email']) and $_GET['email']=='ok')
	{
	?>
			<div class="alert alert-success col-sm-offset-4 col-sm-4 animated bounceIn" style="margin-top: 1%">
				<p style="text-align: center"> Login et mot de passe envoyé , Vérifiez votre E-mail </p>
			</div>

  <?php  } ?>



</body>
</html>
