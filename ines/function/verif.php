<?php
$numcarte= $email = $mdp =$mdp2 ="";
$numcarteError= $emailError = $mdpError =$mdp2Error ="";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$numcarte = verifyInput($_POST['numcarte']);
	$email = verifyInput($_POST['email']);
	$mdp = verifyInput($_POST['mdp']);
	$mdp2 = verifyInput($_POST['mdp2']);
	if(empty($numcarte))
		{
			$numcarteError= "Vous n'avez pas entrer le numéro de carte";
		}
	if(empty($email))
		{
			$emailError= "Vous n'avez pas entrer l'email";
		}
	if(empty($mdp))
		{
			$mdpError= "Vous n'avez pas entrer le mot de passe";
		}
	if(empty($mdp2))
		{
			$mdp2Error= "Veuillez confirmer votre mot de passe ";
		}	
	if(!isEmail($email) AND !empty($email))
	{
		$emailError= "Syntaxe de l'adresse email incorrect"; 
	}
	if((strlen($mdp)<5 OR strlen($mdp)>20) AND !empty($mdp) )
	{
		$mdpError= "Le mot de passe doit contenir entre 5 et 20 caractères";
	}
	if($mdp!=$mdp2 AND !empty($mdp) AND !empty($mdp2))	
	{
		$mdp2Error= "Les mots de passe doivent être identiques";
	}		
	$sql='SELECT numcarte ,motdepasse FROM utilisateur';
    $requete = $bdd->query($sql);
    while($i=$requete->fetch())
     {
     	if($numcarte==$i['numcarte'] AND $i['motdepasse']!= '000')
     	{
     		$numcarteError='Vous êtez dèja inscrit';
     	}
         if($numcarte==$i['numcarte']){ break; }
     }

     
     if($numcarte!=$i['numcarte'] AND !empty($numcarte) )
     {
     	$numcarteError="Le numéro de carte n'existe pas";
     } 
} 
function isEmail($var)
{
	return filter_var($var, FILTER_VALIDATE_EMAIL);
}
function verifyInput($var)
{
	$var= trim($var);
	$var= stripcslashes($var);
	$var= htmlspecialchars($var);
	return $var;
}
?>