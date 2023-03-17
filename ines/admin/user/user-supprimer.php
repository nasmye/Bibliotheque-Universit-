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
        $numcarte = verifyInput($_GET['numcarte']);
    }

    if(!empty($_POST)) 
    {
        $numcarte = verifyInput($_POST['numcarte']);
        $statement = $bdd->prepare("DELETE FROM utilisateur  WHERE utilisateur.numcarte =:numcarte");
        $statement->execute(array('numcarte'=> $numcarte));
        header("Location: ../index.php"); 
    }
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="../../images/logo2.png" />
	<meta charset="utf-8">
	<link rel="stylesheet" href="../admin.css">
	<link rel="stylesheet" href="../list.css">
	<title>Supression d'Un Utilisateur -Administrateur</title>
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
					<h4>Supprimer un utilisateur</h4>
						<form class="form" action="user-supprimer.php" role="form" method="post">
	                    <input type="hidden" name="numcarte" value="<?php echo $numcarte;?>"/>
	                    <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
	                    <div class="form-actions">
	                      <button type="submit" class="btn btn-warning">Oui</button>
	                      <a class="btn btn-default" href="../index.php">Non</a>
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
