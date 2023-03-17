<?php

include_once 'function/function.php';
include_once 'function/inscription.class.php';
$bdd = bdd();
include("function/verif.php");
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="images/logo2.png" />
	<meta charset="utf-8">
	<link rel="stylesheet" href="contenus/signup.css">
	<title>Inscription -Bibliothèque Ines</title>
</head>
<body>
	<header>
		<div class="wrraper" >
			<div class="logo">
				<a href="index.php"><img class="img" src="images/logo1.png">
				<h1>Bibliothèque</h1><h2>Ines</h2></a>
			</div>
			
		</div>
	</header>
	<section class="formulaire">
		<div class="wrraper">
			<br>
			<h3>Inscription</h3>
			<script>
			function myFunction() {
			</script>
			<?php
			/*Verifier si tt les champs sont remplis*/
			if(isset($_POST['numcarte']) AND isset($_POST['email']) AND isset($_POST['mdp'])  AND isset($_POST['mdp2'])){
		  
		    $inscription = new inscription($_POST['numcarte'],$_POST['email'],$_POST['mdp'],$_POST['mdp2']);
		    $verif = $inscription->verif();
		    if($verif == "ok"){/*Tout est bon*/
		     if($inscription->enregistrement()){
		           // if($inscription->session()){ 
		            	/*Tout est mis en session*/
		            	echo"<script language=\"javascript\">";
						echo"alert('Vous êtes inscrit ! Vous pouvez vous connecter maintenant');";
						echo"</script>";
		                //header('Location: index.php');
		            //}
		        }
		     else{ /*Erreur lors de l'enregistrement*/
		     	echo"<script language=\"javascript\">";
				echo"alert('une erreur s'est produite veuillez réessayer ultérieurement');";
				echo"</script>";
		        		        
		            //echo 'Une erreur est survenue';
		        }   
		    } 
		}
		
	?>
	<script>
    }
    </script>
			

			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				<div class="all-inp">
					<div class="inp">
						<input type="text" id="numcarte" name="numcarte" placeholder="Votre numéro de carte" value="<?php echo $numcarte; ?>">
						<p class="numcarte"><?php echo $numcarteError;  ?></p>
					</div>
					<div class="inp">
						<input type="text" id="email" name="email" placeholder="Votre Email" value="<?php echo $email; ?>">
						<p class="email"><?php echo $emailError;  ?></p>
					</div>
				</div>
				<div class="all-inp">	
					<div class="inp">
						<input type="password" id="mdp" name="mdp" placeholder="Mot de passe" value="<?php echo $mdp; ?>">
						<p class="mdp"><?php echo $mdpError;  ?></p> 
					</div>
					<div class="inp">
						<input type="password" id="mdp2" name="mdp2" placeholder="Confirmer le mot de passe" value="<?php echo $mdp2; ?>">
						<p class="mdp2"><?php echo $mdp2Error;  ?></p> 
					</div>	
					</div>
				
				
				<br>
				<!--
				<label for="choix">S'inscrire en tant que:</label>
				<select id="choix" name="choix">
					<option value="utilisateur">Utilisateur</option>
					<option value="admin">administrateur</option>
				</select>
				-->
				<br>
				
				<input type="submit" onclick="myFunction()" class="btn1" name="inscrire" value="S'inscrire">
				<br>
				<a href="connexion.php"><u>Vous avez déja un compte ?</u></a>

			</form>
			
		</div>
	
					
	</section>

</body>
</html>