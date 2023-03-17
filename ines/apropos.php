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
	<title>A propos -Bibliothèque Ines</title>
</head>
<body>
<header>
			<div class="wrraper">
				<?php include("contenus/head.php"); ?>	
				<div id="ligne" class="ligne-apropos"><img src="images/ligne.png"></div>
			</div>
		</header>
		


<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->


<!--Code personnaliser -->

<section id="page-apropos">
	<div class="wrraper5">
		<h4>Qui sommes nous ?</h4>
		<p class="nous">
			Un binôme d’étude composé de :<br>
•	CHENAFA Yasmine<br>
•	OULD BOUAZZA Feriel<br>
Le binôme est composé en vue de la préparation du projet pour l’obtention de la licence informatique au sein de l’INES Université Abdelhamid IBn Badis Mostaganem et ce sous l’encadrement éclairé du professeur :<br>
•	BENAHMED Siham<br>
</p>
<h4>Projet</h4>
<p class="nous">
	Application Web de gestion de la bibliothèque de l’Université INES Mostaganem
Objectifs principaux de l’application :<br>
1.	Enregistrement, gestion et suivi de tous les documents de la bibliothèque (Mémoires, Livres, thèse etc.)<br>
2.	Gestion des transactions de prêts et des mouvements des documents.<br> 
3.	Gestion des utilisateurs (Etudiants, Enseignants, Employées.)<br>
4.	Inscription et connexion.<br>

</p>
<h4>Comment s'inscrire?</h4>
<p class="nous">
	•	&emsp;Vous devez demander votre carte bibliothèque au près du bibliothécaire.<br>
	•	&emsp;dirigez-vous vers la page d'inscription sur le site.<br>
	•	&emsp;Entrez le numéro de carte et votre E-mail.<br>
	•	&emsp;Connectez vous. <br>
</p>
<h4>Historique de l'Université:</h4>
<p class="nous">
		L’université Abdelhamid Ibn Badis Mostaganem est fondée en 1978. Elle est classée par le U.S. News & World Report au 115e rang du classement régional 2016 des universités arabes.
		La Faculté des Sciences Exactes et de l'Informatique se consacre à l'enrichissement et à la transmission des connaissances au sein de ses départements. Composée de quatre départements : « Mathématiques, Informatique, Physique et Chimie », deux laboratoires de recherche et une bibliothèque.

</p>
	</div>

</section>
<div id="map" style="width:100%;height:300px;"></div>

<script>
function myMap() {
  var mapCanvas = document.getElementById("map");
  var mapOptions = {
    center: new google.maps.LatLng(35.914756, 0.088343), zoom: 17, mapTypeId: google.maps.MapTypeId.HYBRID
  };
  var map = new google.maps.Map(mapCanvas, mapOptions);
}
</script>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo4urOSTdQtYQYBGWWUI-3bghnLhYfZqk&callback=myMap"></script>
 
<footer>
<?php include("contenus/footer.php"); ?>		
</footer>

</body>
</html>
<style >
	.text
	{
		text-align: justify;
		font-size: 20px !important;
		width: 1000px;
		
	}
	.nous
	{
		
		font-size: 15px;
		font-family: Arial;
		font-weight: lighter;
		line-height: 1.82857143;
	}
	.wrraper5
	{
	width:1000px;
	margin: 0 auto;
	padding: 50px;
	
	}
	
	h4
	{
		border-left: 4px #1dba54 solid;
		padding-left: 5px;
		padding-top: 5px;
		font-size: 20px;
		font-family: Arial;
		font-weight: bold;
		text-transform: uppercase;
		margin: 10px;
	}
</style>