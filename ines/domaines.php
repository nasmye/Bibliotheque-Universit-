<!--Code pour tout les pages -->
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="images/logo2.png" />
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="pages.css">
	<title>Domaines -Bibliothèque Ines</title>
</head>
<body>
<header>
	<div class="wrraper">
		<?php include("contenus/head.php"); ?>
		<div id="ligne" class="ligne-domaines"><img src="images/ligne.png"></div>
		
	</div>
	
</header>

<!--Code personnaliser -->

<section id="page-domaines">
		<div class="wrraper">
		<center><p>LES DOMAINES:</p></center>
		<section id="possibilities1">
			
					<article style="background-image: url('images/domaine1.jpg');">
						<div class="overlay1">
							<h4>Informatique</h4>
							
							<a href="domaine/informatique.php" class="button-2">Accéder</a>
						</div>
						
					</article>

					<article style="background-image: url('images/domaine2.jpg'); vertical-align: middle;">
						<div class="overlay1">
							<h4>Mathématique</h4>
							
							<a href="domaine/mathematique.php" class="button-2">Accéder</a>
						</div>
						
					</article>

					<article style="background-image: url('images/domaine3.jpg'); vertical-align: middle;">
						<div class="overlay1">
							<h4>Chimie</h4>
							<p><small>
							
							<a href="domaine/chimie.php" class="button-2">Accéder</a>
						</div>
						
					</article>
					<article style="background-image: url('images/domaine4.jpg'); vertical-align: middle;">
						<div class="overlay1">
							<h4>Physique</h4>
							
							<a href="domaine/physique.php" class="button-2">Accéder</a>
						</div>
						
					</article>
					<div class="clear"></div>
					
		</section>

	</div>

</section>

<footer>
<?php include("contenus/footer.php"); ?>		
</footer>

</body>
</html>