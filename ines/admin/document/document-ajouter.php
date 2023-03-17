<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="../../images/logo2.png" />
	<meta charset="utf-8">
	<link rel="stylesheet" href="../admin.css">
	<link rel="stylesheet" href="../list.css">
	<title>Ajout d'Un Document -Administrateur</title>
</head>
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
	$cote= $titre= $isbn= $type =$resume =$langue =$auteur =$quantite  =$disponibilite =$date_edition =$domaine ="";
	
	$coteError= $titreError= $isbnError= $typeError =$resumeError =$langueError =$auteurError =$quantiteError =$date_editionError =$disponibiliteError =$domaineError= "";
	if(!empty($_POST))
	{
		$cote = verifyInput($_POST['cote']);
		$titre = verifyInput($_POST['titre']);
		$isbn = verifyInput($_POST['isbn']);
		$type = verifyInput($_POST['type']);
		$resume = verifyInput($_POST['resume']);
		$langue = verifyInput($_POST['langue']);
		$auteur = verifyInput($_POST['auteur']);
		$quantite = verifyInput($_POST['quantite']);
		$date_edition = verifyInput($_POST['date_edition']);
		$disponibilite = verifyInput($_POST['disponibilite']);
		$domaine = verifyInput($_POST['domaine']);
		$isSuccess= true;
		if(empty($cote))
		{
			$coteError= "Ce champ ne peut pas être vide";
			$isSuccess = false;
		}
		if(empty($titre))
		{
			$titreError= "Ce champ ne peut pas être vide";
			$isSuccess = false;
		}
		if(empty($isbn))
		{
			$isbnError= "";
		}
		if(empty($type))
		{
			$typeError= "Ce champ ne peut pas être vide";
			$isSuccess = false;
		}
		if(empty($resume))
		{
			$resumeError= "";
		}
		if(empty($langue))
		{
			$langueError= "";
		}
		if(empty($auteur))
		{
			$auteurError= "Ce champ ne peut pas être vide";
			$isSuccess = false;
		}
		if(empty($quantite))
		{
			$quantiteError= "Ce champ ne peut pas être vide";
			$isSuccess = false;
		}
		if(empty($date_edition))
		{
			$date_edition= date("Y-m-d ");
			$date_editionError= "";
		}
		if(empty($domaine))
		{
			$domaineError= "Ce champ ne peut pas être vide";
			$isSuccess = false;
		}
		if($isSuccess) 
        {
            $statement = $bdd->prepare("INSERT INTO document (cote,titre,isbn,type,resume,langue,auteur,quantite,disponibilite,date_edition,domaine) values(?, ?, ?, ?, ?, ?, ? ,? ,? ,? ,?)");
            $statement->execute(array($cote,$titre,$isbn,$type,$resume,$langue,$auteur,$quantite,$disponibilite,$date_edition,$domaine));
            $statement->closeCursor();
            header("Location: ../index.php");
        }
	}	
?>

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
					<h4>Ajouter un document</h4>
					<br>
					<form method="post" action="document-ajouter.php" role="form" enctype="multipart/form-data">
						<div class="form-group">
							<label for="cote" class="user">Côte: *</label>
	                        <input type="text" class="form-control" id="cote" name="cote" placeholder="Cote" value="<?php echo $cote;?>">
	                        <span class="help-inline"><?php echo $coteError;?></span>	
						</div>
						<div class="form-group">
							<label for="titre" class="user">Titre: *</label>
	                        <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre" value="<?php echo $titre;?>">
	                        <span class="help-inline"><?php echo $titreError;?></span>	
						</div>
						<div class="form-group">
							<label for="isbn" class="user">Isbn:</label>
	                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Isbn" value="<?php echo $isbn;?>">
	                        <span class="help-inline"><?php echo $isbnError;?></span>	
						</div>
						<div class="form-group">
                        <label for="type">Type: *</label>
                        <select class="form-control" id="type" name="type">
                        	   <option value="">Type</option>
                               <option value="livre">Livre</option>
                               <option value="memoire">Mémoire</option>
                               <option value="rapport de stage">Rapport De Stage</option>
                               <option value="these">Thèse</option>
                               <option value="dictionnaire">Dictionnaire</option>
                               <option value="cd/dvd memoire">CD/DVD Mémoire</option>
                        </select>
                        <span class="help-inline"><?php echo $typeError;?></span>
                    	</div>
						<div class="form-group">
							<label for="resume" class="user">Résumé:</label>
	                        <input type="textfield" class="form-control" id="resume" name="resume" placeholder="Résumé" value="<?php echo $resume;?>">
	                        <span class="help-inline"><?php echo $resumeError;?></span>	
						</div>
						<div class="form-group">
							<label for="langue" class="user">Langue:</label>
	                        <input type="text" class="form-control" id="langue" name="langue" placeholder="Langue" value="<?php echo $langue;?>">
	                        <span class="help-inline"><?php echo $langueError;?></span>	
						</div>
						<div class="form-group">
							<label for="auteur" class="user">Auteur: *</label>
	                        <input type="text" class="form-control" id="auteur" name="auteur" placeholder="Auteur" value="<?php echo $auteur;?>">
	                        <span class="help-inline"><?php echo $auteurError;?></span>	
						</div>
						<div class="form-group">
							<label for="quantite" class="user">Quantité: *</label>
	                        <input type="text" class="form-control" id="quantite" name="quantite" placeholder="Quantité" value="<?php echo $quantite;?>">
	                        <span class="help-inline"><?php echo $quantiteError;?></span>	
						</div>
						<div class="form-group">
							<label for="date_edition" class="user">Date_Edition:</label>
	                        <input type="date" class="form-control" id="date_edition" name="date_edition" placeholder="Date d'edition" value="<?php echo $date_edition;?>">
	                        <span class="help-inline"><?php echo $date_editionError;?></span>	
						</div>
						 <div class="form-group">
                        <label for="disponibilite">Disponibilté:</label>
                        <select class="form-control" id="disponibilite" name="disponibilite">
                               <option value="oui">Oui</option>
                               <option value="non">Non</option>
                        </select>
                        <span class="help-inline"><?php echo $disponibiliteError;?></span>
                    	</div>
                    	<div class="form-group">
							<label for="domaine" class="user">Domaine: *</label>
	                        <input type="text" class="form-control" id="domaine" name="domaine" placeholder="Domaine" value="<?php echo $domaine;?>">
	                        <span class="help-inline"><?php echo $domaineError;?></span>	
						</div>
                    	<br>
	                    <div class="form-actions">
	                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter </button>
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
