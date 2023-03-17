<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	
	<link rel="icon" type="image/png" href="images/logo2.png" />
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css" >
	<link rel="stylesheet" href="pages.css">
	<link rel="stylesheet" href="contenus/slide.css">
	<title >Bibliothèque Ines</title>
</head>
<body >
		<header>
			<div class="wrraper">
				<?php include("contenus/head.php"); ?>
				<div id="ligne" class="ligne-accueil"><img src="images/ligne.png"></div>
			</div>
		</header>

		<section id="page-accueil">
			<div class="wrraper">
				<p>Cherchez plus vite sur notre site!</p>
			</div>

			<!--Slides-->
			<?php include("contenus/slide.php"); ?>


		</section>

		<footer>
				<?php include("contenus/footer.php"); ?>			
		</footer>

	</body>
</html>