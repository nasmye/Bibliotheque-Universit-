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
	<title>Catégories -Bibliothèque Ines</title>
</head>
<body>
<header>
	<div class="wrraper">
		<?php include("contenus/head.php"); ?>	
		<div id="ligne" class="ligne-categories"><img src="images/ligne.png"></div>
		
	</div>
	
</header>

<!--Code personnaliser -->

<section id="page-categories">
	<div class="wrraper">
		<center><p>LES CATEGORIES:</p></center>
		<section id="possibilities">
			
					<article style="background-image: url('images/article1.jpg');">
						<div class="overlay">
							<h4>Livres</h4>
							<p><small>"L'important n'est pas de lire vite mais de lire chaque livre concerné à la vitesse qu'il mérite"<br>   Jacques Bonnet</small></p>
							<a href="categorie/livre.php" class="button-2">Accéder</a>
						</div>
						
					</article>

					<article style="background-image: url('images/article2.jpg'); vertical-align: middle;">
						<div class="overlay">
							<h4>Rapports De Stages</h4>
							<p><small>
							Il s’agit d’un document basé sur l’analyse pertinente d’une étude ,en mettant l’accent sur le rôle de l’étudiant.</small></p>
							<a href="categorie/rapport-de-stage.php" class="button-2">Accéder</a>
						</div>
						
					</article>

					<article style="background-image: url('images/article3.jpg'); vertical-align: middle;">
						<div class="overlay">
							<h4>Mémoires</h4>
							<p><small >
							Exposer son opinion concernant un sujet donné en s'appuyant logiquement sur une série de faits pour en arriver à une recommandation.</small></p>
							<a href="categorie/memoire.php" class="button-2">Accéder</a>
						</div>
						
					</article>
					<div class="clear"></div>
					<article style="background-image: url('images/article4.jpg'); vertical-align: middle;">
						<div class="overlay">
							<h4>Thèses</h4>
							<p><small>
							Résume le déroulement des travaux de recherches auquel l’étudiant peut obtenir un diplôme plus élevé.</small></p>
							<a href="categorie/these.php" class="button-2">Accéder</a>
						</div>
						
					</article>
					<article style="background-image: url('images/article5.jpg'); vertical-align: middle;">
						<div class="overlay">
							<h4>Dictionnaires</h4>
							<p style="text-align: center !important;"><small>
							Dictionnaire <br>Français-Français<br>Anglais-Français. </small></p>
							<a href="categorie/dictionnaire.php" class="button-2">Accéder</a>
						</div>
						
					</article>
					<article style="background-image: url('images/article6.jpg'); vertical-align: middle;">
						<div class="overlay">
							<h4>CDs /DVDs</h4>
							<p><small>
							LEs CDs /DVDs des mémoires</small></p>
							<a href="categorie/cd-dvd.php" class="button-2">Accéder</a>
						</div>
						
					</article>
		</section>

	</div>

</section>

<footer>
<?php include("contenus/footer.php"); ?>		
</footer>

</body>
</html>