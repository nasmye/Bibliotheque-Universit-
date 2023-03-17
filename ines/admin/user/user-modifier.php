<?php
	session_start();
	include_once '../../function/function.php';
	$bdd = bdd();
	function verifyInput($var)
	{
		$var= trim($var);
		$var= stripcslashes($var);
		$var= htmlspecialchars($var);
		return $var;
	}
	if(!empty($_GET['numcarte'])) 
    {
        $numcarte1 = verifyInput($_GET['numcarte']);
    }
	$statement = $bdd->prepare("SELECT numcarte,nom,prenom,adresse,nb_emprunt,categorie FROM utilisateur WHERE utilisateur.numcarte = :numcarte");
    $statement->execute(array('numcarte'=> $numcarte1));
    $item = $statement->fetch();
	$numcarte= $item['numcarte'];
	$nom= $item['nom'];
	$prenom= $item['prenom'];
	$adresse = $item['adresse'];
	$nb_emprunt= $item['nb_emprunt'];
	$categorie = $item['categorie'];
	$numcarteError= $nomError= $prenomError= $adresseError= $nb_empruntError= $categorieError ="";
	if(!empty($_POST))
	{
		$numcarte = verifyInput($_POST['numcarte']);
		$nom = verifyInput($_POST['nom']);
		$prenom = verifyInput($_POST['prenom']);
		$adresse = verifyInput($_POST['adresse']);
		$categorie = verifyInput($_POST['categorie']);
		$isSuccess          = true;
		if(empty($numcarte))
		{
			$numcarteError= "Ce champ ne peut pas être vide";
			$isSuccess = false;
		}
		if(empty($nom))
		{
			$nomError= "Ce champ ne peut pas être vide";
			$isSuccess = false;
		}
		if(empty($prenom))
		{
			$prenomError= "Ce champ ne peut pas être vide";
			$isSuccess = false;
		}
		if(empty($adresse))
		{
			$adresse= "";
		}
		if(empty($nb_emprunt))
		{
			$nb_emprunt= 0;
		}
		if(empty($categorie))
		{
			$categorieError= "Ce champ ne peut pas être vide";
			$isSuccess = false;
		}
		$syntaxe = '#^[0-9]{3}$#'; 
		if(!preg_match($syntaxe,$numcarte) AND !empty($numcarte))
		{
			$numcarteError= "Le numéro de carte doit contenir 3 chiffres";
			$isSuccess = false;
		}
		if($isSuccess) 
        {
            $statement = $bdd->prepare("UPDATE utilisateur SET numcarte=:numcarte, nom=:nom, prenom=:prenom ,adresse=:adresse, nb_emprunt=:nb_emprunt WHERE utilisateur.numcarte=:numcarte1");
            $statement->execute(array(
            	'numcarte' =>$numcarte,
            	'nom' => $nom,
            	'prenom' => $prenom,
            	'adresse' => $adresse,
            	'nb_emprunt' => $nb_emprunt,
            	'numcarte1' => $numcarte1
            	));
            header("Location: user-voir.php?numcarte=$numcarte");
        }
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="../../images/logo2.png" />
	<meta charset="utf-8">
	<link rel="stylesheet" href="../admin.css">
	<link rel="stylesheet" href="../list.css">
	<title>Modification d'Un Utilisateur -Administrateur</title>
</head>
<?php
	if(!isset($_SESSION['pseudo']))
	{
		header('Location: ../index.php');
}
else
{
	?>
<body>	
	<header>
		<div class="wrraper" >
			<div class="logo">
				<a href="../../index.php"><img class="img" src="../../images/logo1.png">
				<h1>Bibliothèque</h1><h2>Ines</h2></a>
			</div>
			
		</div>
	</header>
	<section>
		<div class="wrraper2">
			<div class="container2">
				<div class="row">
					<h4>Modifier un utilisateur</h4>
					<br>
					<?php
					$statement = $bdd->prepare("SELECT numcarte FROM utilisateur WHERE utilisateur.numcarte = :numcarte");
				    $statement->execute(array('numcarte'=> $_GET['numcarte']));
				    $item = $statement->fetch();
				    ?>
					<form method="post" action="user-modifier.php?numcarte=<?php echo$item['numcarte'];?>" role="form" enctype="multipart/form-data">
						<div class="form-group">
							<label for="numcarte" class="user">N° Carte:</label>
	                        <input type="text" class="form-control" id="numcarte" name="numcarte" placeholder="Numéro de carte" value="<?php echo $numcarte;?>">
	                        <span class="help-inline"><?php echo $numcarteError;?></span>	
						</div>
						<div class="form-group">
							<label for="nom" class="user">Nom:</label>
	                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="<?php echo $nom;?>">
	                        <span class="help-inline"><?php echo $nomError;?></span>	
						</div>
						<div class="form-group">
							<label for="prenom" class="user">Prénom:</label>
	                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" value="<?php echo $prenom;?>">
	                        <span class="help-inline"><?php echo $prenomError;?></span>	
						</div>
						<div class="form-group">
							<label for="adresse" class="user">Adresse:</label>
	                        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse" value="<?php echo $adresse;?>">
	                        <span class="help-inline"><?php echo $adresseError;?></span>	
						</div>
						<div class="form-group">
							<label for="nb_emprunt" class="user">Nombre d'emprunt:</label>
	                        <input type="number" class="form-control" id="nb_emprunt" name="nb_emprunt" placeholder="nb_emprunt" value="<?php echo $nb_emprunt;?>">
	                        <span class="help-inline"><?php echo $nb_empruntError;?></span>	
						</div>
						 <div class="form-group">
                        <label for="categorie">Catégorie:</label>
                        <select class="form-control" id="categorie" name="categorie">
                               <option value="<?php echo $categorie;?>" ><?php echo $categorie;?></option>
                               <option value="etudiant">Etudiant</option>
                               <option value="enseignant">Enseignant</option>
                               <option value="employer">Employer</option>
                        </select>
                        <span class="help-inline"><?php echo $categorieError;?></span>
                    	</div>
                    	<br>
	                    <div class="form-actions">
	                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier </button>
	                        <a class="btn btn-primary" href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour </a>
	                    </div>
					</form>
				</div>
			</div>
		</div>
	</section>
</body>

<?php
}
?>

</html>	
