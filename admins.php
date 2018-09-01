<?php
	include('connexion.class.php');
	include('admins.class.php');
	require 'php_files/enseignant.class.php'; 
	require('phpmailer/class.phpmailer.php');
	require('phpmailer/class.smtp.php');



	   	$bdd = new Db_connect();
   		$admin=new Admin($bdd->connect());
   		$prof=new enseignant($bdd->connect());

function str_random($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}


if(isset($_POST['connect']))
{
   if(!empty($_POST['username']) and !empty($_POST['password']))
   {
   	if($_POST['user']=='admin')
   	{
   		if($adm = $admin->getAdmin($_POST['username'],$_POST['password']))
   		{
   			session_start();
   			$_SESSION['id_admin']=$adm['id_admin'];
   			$_SESSION['nom']=$adm['nom'];
   			$_SESSION['prenom']=$adm['prenom'];
   			$_SESSION['email']=$adm['email'];
   			$_SESSION['login']=$adm['login'];
   			$_SESSION['password']=$_POST['password'];
   			$_SESSION['type']='admin';
   			header('Location:gest_admins.php');
   		}
		else
   		{
   			header('Location:index.php?err=inx');
   		}
   	}
   	else
   	{
		if($prof = $prof->getProf($_POST['username'],$_POST['password']))
   		{
   			session_start();
   			$_SESSION['id_prof']=$prof['id_enseignant'];
   			$_SESSION['nom']=$prof['nom'];
   			$_SESSION['prenom']=$prof['prenom'];
   			$_SESSION['email']=$prof['email'];
   			$_SESSION['login']=$prof['login'];
   			$_SESSION['telephone']=$prof['telephone'];
   			$_SESSION['password']=$_POST['password'];
   			$_SESSION['type']='prof';
   			header('Location:espaceUser.php');
   		}
		else
   		{
   			header('Location:index.php?err=inx');
   		}
   	}


   }

}
else if(isset($_POST['ajout']))
{
	//print_r($_POST);
 if($_POST['password']==$_POST['password2'])
	{
	   session_start();


		if(($admin->isExist($_POST['login'])) or ($admin->email($_POST['email'])))
		{
		    header('Location:gest_admins.php?errorin=login');

		}
		else{
			$admin->ajout($_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['login'],$_POST['password']);
   			header('Location:gest_admins.php');	
		}
	}
	else{
			header('Location:gest_admins.php?errorin=mdp');
	
	}



}
else if(isset($_POST['update']))
{
	//print_r($_POST);
	if($_POST['password']==$_POST['password2'])
	{
	   session_start();


		if($_POST['login'] != $_SESSION['login'] and $admin->isExist($_POST['login']))
		{
		    header('Location:gest_admins.php?errorup=login');

		}
		else{
	        $admin->update($_SESSION['id_admin'],$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['login'],$_POST['password']);
	   		$_SESSION['nom']=$_POST['nom'];
   			$_SESSION['prenom']=$_POST['prenom'];
   			$_SESSION['email']=$_POST['email'];
   			$_SESSION['login']=$_POST['login'];
   			$_SESSION['password']=$_POST['password'];
   			header('Location:gest_admins.php');	
		}
	}
	else{
			header('Location:gest_admins.php?errorup=mdp');
	
	}

}

if(isset($_GET['op']) and $_GET['op']=='del')
{
	$admin->delete(htmlspecialchars($_GET['id']));
	session_start();
	if($_GET['id']==$_SESSION['id_admin'])
		header('Location:logout.php');
	else
		header('Location:gest_admins.php');
}

if(isset($_POST['rec']))
{
	if(($admin->email($_POST['email'])) or ($prof->email($_POST['email'])))
	{
			$mail = new PHPMailer;

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'pfe.ecomm@gmail.com';                 // SMTP username
			$mail->Password = 'ltpsaerkqkxvkqbi';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->From = 'fstg.scolarite@gmail.com';
			$mail->FromName = 'Service de scolarite Fstg';     // Add a recipient
			$mail->addAddress($_POST['email']);               // Name is optional
			$mail->addReplyTo('fstg.scolarite@gmail.com', 'Information');
			$mail->addCC($_POST['email']);


   // Optional name
			$mdp=str_random(8);
			$mail->isHTML(true);                                  // Set email format to HTML
			if($_POST['user']=='admin')
			{
			$infos=$admin->email($_POST['email']);
			$mail->Subject = 'Demande de Recuperation Du Mot de passe';
			$mail->Body = "<html> <body> Compte Administrateur Votre Login est <strong>".$infos['login']." </strong><br/> Votre Nouveau Mot de passe est:<strong> ".$mdp."</strong>
			</body></html>";

			$admin->updatePwd($infos['id_admin'],$mdp);
			}
			else
			{
			$infos=$prof->email($_POST['email']);
			$mail->Subject = 'Demande de Recuperation Du Mot de passe';
			$mail->Body = "<html> <body> Compte Enseignant Votre Login est <strong>".$infos['login']." </strong><br/> Votre Nouveau Mot de passe est:<strong> ".$mdp."</strong>
			</body></html>";
			$prof->update_pass($infos['id_enseignant'],sha1($mdp));
			}
			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				header('Location:index.php?email=ok');

			}
	}
	else
	{
		header('Location:index.php?err=email');

	}
}
?>