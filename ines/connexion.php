<?php
	session_start();
	include_once 'function/function.php';
	include_once 'function/connexion.class.php';
	$bdd = bdd();

	$numcarte= $mdp ="";
	$numcarteError= $mdpError ="";
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$numcarte = verifyInput($_POST['numcarte']);
		$mdp = verifyInput($_POST['mdp']);
		if(empty($numcarte))
		{
			$numcarteError= "Vous n'avez pas entrer le numéro de carte";
		}
		if(empty($mdp))
		{
			$mdpError= "Vous n'avez pas entrer le mot de passe";
		}
		$sql='SELECT numcarte, motdepasse FROM utilisateur';
	    $requete = $bdd->query($sql);
	    while($i=$requete->fetch())
	     {
	          if($numcarte==$i['numcarte'] ){ break; }
	          if($mdp==$i['motdepasse'] ){ break; }
	     }
	     if($numcarte==$i['numcarte'] AND $i['motdepasse']=='000')
	     {
	     	$numcarteError="Vous n'êtez pas inscrit";
	     }
	     if($numcarte!=$i['numcarte'] AND !empty($numcarte))
	     {
	     	$numcarteError="Le numéro de carte est incorrecte";
	     }
	     if(($mdp!=$i['motdepasse'] AND !empty($mdp)) OR $i['motdepasse']=='000')
	     {
	     	$mdpError="Le mot de passe est incorrecte";
	     }  
	}	
	function verifyInput($var)
	{
		$var= trim($var);
		$var= stripcslashes($var);
		$var= htmlspecialchars($var);
		return $var;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="images/logo2.png" />
	<meta charset="utf-8">
	<link rel="stylesheet" href="contenus/signup.css">
	<title>Connexion -Bibliothèque Ines</title>
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
			<h3>Connexion</h3>

			<?php 
				if(isset($_POST['numcarte']) AND isset($_POST['mdp'])){
				    
				    $connexion = new connexion($_POST['numcarte'],$_POST['mdp']);
				    $verif = $connexion->verif();
				    if($verif =="ok"){
				      if($connexion->session()){
				          header('Location: index.php');
				      }
				    }
				    else {
				        $erreur = $verif; 
				    } 
				}


			?>
			
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
				
					<div class="all-inp">
						<div class="inp">
							<input type="text" id="numcarte" name="numcarte" placeholder="Numéro de carte" value="<?php echo $numcarte; ?>">
							<p class="numcarte"><?php echo $numcarteError;  ?></p>
						</div>
					</div>
					<div class="all-inp">
						<div class="inp">
							<input type="password" id="mdp" name="mdp" placeholder="Mot de passe" value="<?php echo $mdp; ?>">
							<p class="numcarte"><?php echo $mdpError;  ?></p>
						</div>
						
					</div>
				
				
				<br>
				<input type="submit" class="btn1" name="connexion" value="Se connecter" >
				<br>
				<a href="inscription.php"><u>Vous n'avez pas un compte ?</u></a>

			</form>
			
		</div>
		
	</section>

</body>
</html>