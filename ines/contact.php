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
	<title>Contact -Bibliothèque Ines</title>
</head>
<body>
<header>
	<div class="wrraper">
		
		<?php include("contenus/head.php"); ?>	
		<div id="ligne" class="ligne-contact"><img src="images/ligne.png"></div>
		
	</div>
	
</header>

<!--Code personnaliser -->

<section id="page-contact">
	<div class="wrraper5">
		<div class="left">
			<h4>Contactez nous:</h4>
		<p class="nous">
FSEI Faculté des Sciences Exactes et de l'Informatique <br>
Université de Mostaganem<br>
Chemin des cretes ex INES<br> 
27000 Mostaganem<br>
Tél: +213 0 45 36 64 72<br>
Fax: +213 0 45 36 64 86<br>

admin@fsei.univ-mosta.dz</p>
		</div>
		<div class="left">
			<img class="ines" src="images/5.jpg">
		</div>
		

	</div>

</section>

<footer>
<?php include("contenus/footer.php"); ?>		
</footer>

</body>
</html>
<style >
img[class="ines"]
{
	padding-top: 50px;
}
.left
{
	float: left;
	width: 50%;

}
.nous
	{
		
		font-size: 18px;
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