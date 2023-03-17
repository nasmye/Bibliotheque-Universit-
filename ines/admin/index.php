<?php
	session_start();
	include_once '../function/function.php';
	$bdd = bdd();
	

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="../images/logo2.png" />
	<meta charset="utf-8">
	<link rel="stylesheet" href="admin.css">
	<link rel="stylesheet" href="list.css">
	<title>Administrateur</title>
</head>
<?php
	if(!isset($_SESSION['pseudo']))
	{
		function verifyInput($var)
	{
		$var= trim($var);
		$var= stripcslashes($var);
		$var= htmlspecialchars($var);
		return $var;
	}
	$pseudo= $mdp ="";
	$pseudoError= $mdpError ="";
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$pseudo = verifyInput($_POST['pseudo']);
		$mdp = verifyInput($_POST['mdp']);
		if(empty($pseudo))
		{
			$pseudoError= "Vous n'avez pas entrer le pseudo";
		}
		if(empty($mdp))
		{
			$mdpError= "Vous n'avez pas entrer le mot de passe";
		}
		$sql='SELECT pseudo, motdepasse FROM administrateur';
	    $requete = $bdd->query($sql);
	    while($i=$requete->fetch())
	     {
	          if($pseudo==$i['pseudo'] ){ break; }
	          if(sha1($mdp)==$i['motdepasse'] ){ break; }
	     }
	     
	     if($pseudo!=$i['pseudo'] AND !empty($pseudo))
	     {
	     	$pseudoError="Le pseudo est incorrecte";
	     }
	     if(($mdp!=$i['motdepasse'] AND !empty($mdp)) OR $i['motdepasse']=='000')
	     {
	     	$mdpError="Le mot de passe est incorrecte";
	     }  
	}	
		?>
<body>
	<header>
		<div class="wrraper" >
			<div class="logo">
				<a href="../index.php"><img class="img" src="../images/logo1.png">
				<h1>Bibliothèque</h1><h2>Ines</h2></a>
			</div>
			
		</div>
	</header>
	
	<section>
		<div class="wrraper">
			<div class="container">
				<br>
			<h3>Connexion</h3>

			<?php 
				if(isset($_POST['pseudo']) AND isset($_POST['mdp'])){
				    
				    $sql='SELECT * FROM administrateur WHERE administrateur.pseudo = :pseudo';
			        $requete = $bdd->prepare($sql);
			        $requete->execute(array('pseudo'=> $pseudo));
			        $reponse = $requete->fetch();
			        if($reponse){
			            
			            if(sha1($mdp) == $reponse['motdepasse'] and $reponse['motdepasse']!='000'){
			            	$requete = $bdd->prepare('SELECT * FROM administrateur WHERE pseudo = :pseudo ');
					        $requete->execute(array('pseudo'=>  $pseudo));
					        $requete = $requete->fetch();
					        $_SESSION['pseudo'] = $requete['pseudo'];
			                 header('Location: index.php');
			            }			            			           
			        }		       
			    }
			?>
			
			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
					<div class="all-inp">
						<div class="inp">
							<input type="text" class="connexion" id="pseudo" name="pseudo" placeholder="Pseudo" value="<?php echo $pseudo; ?>">
							<p class="pseudo"><?php echo $pseudoError;  ?></p>
						</div>
					</div>
					<div class="all-inp">
						<div class="inp">
							<input type="password" class="connexion" id="mdp" name="mdp" placeholder="Mot de passe" value="<?php echo $mdp; ?>">
							<p class="pseudo"><?php echo $mdpError;  ?></p>
						</div>
					</div>
				<br>
				<input type="submit" class="btn1" name="connexion" value="Se connecter" >
				<br>
			</form>
			</div>			
		</div>
	</section>
</body>
<?php
}
else
{
	?>
<body>	
	<header>
		<div class="wrraper" >
			<div class="logo">
				<a href="../index.php"><img class="img" src="../images/logo1.png">
				<h1>Bibliothèque</h1><h2>Ines</h2></a>
			</div>
			
		</div>
	</header>
	<section>
		<div class="wrraper2">
			<div class="container2">
				<div class="deconnexion">
	<p class="nom"> <?php echo  $_SESSION['pseudo']; ?> &emsp;-&emsp; <a href="deconnexion-admin.php" class="admin">Deconnexion </a> </p>
</div>
				<script>
				
				function openlist(evt, listname) {				
				

				    var i, tabcontent, tablinks;
				    tabcontent = document.getElementsByClassName("tabcontent");
				    for (i = 0; i < tabcontent.length; i++) {
				        tabcontent[i].style.display = "none";
				    }
				    tablinks = document.getElementsByClassName("tablinks");
				    for (i = 0; i < tablinks.length; i++) {
				        tablinks[i].className = tablinks[i].className.replace(" active", "");
				    }
				    document.getElementById(listname).style.display = "block";
				    evt.currentTarget.className += " active";
				    
				}
				    
					// Get the element with id="defaultOpen" and click on it
				   document.getElementById("defaultOpen").click();
				  /*var def = document.getElementById("defaultOpen");
				  def.className = def.className.replace("tablinks","tablinks active");*/
				</script>
				<div class="tab">
				  <button class="tablinks active" onclick="openlist(event, 'user-list')" id="defaultOpen">Utilisateurs</button>
				  <button class="tablinks" onclick="openlist(event, 'document-list')">Documents</button>
				  <button class="tablinks" onclick="openlist(event, 'emprunt-list')">Emprunts</button>
				  <button class="tablinks" onclick="openlist(event, 'reservation-list')">Reservations</button>
				</div>

				<div id="user-list" class="tabcontent act">
				  
				  <?php include("user/user.php"); ?>	
				</div>

				<div id="document-list" class="tabcontent">
				  
				  <?php include("document/document.php"); ?>	
				  
				</div>

				<div id="emprunt-list" class="tabcontent">
				  <?php include("emprunt/emprunt.php"); ?>
				 
				</div>
				<div id="reservation-list" class="tabcontent">
				 <?php include("reservation/reserve.php"); ?>
				 
				</div>

				
				
			</div>
			
						
			
		</div>
	</section>

</body>

	<?php
}
?>

</html>	
<style >
	.act
	{
		display: block;
	}
	.deconnexion
	{
		margin-top: 10px;
		margin-bottom: 10px;
	}
	p[class="nom"]
	{
	color: #36221d;
	font-family: Calibri !important;
	text-align: center !important;
	font-size: 15px;
	display: block;
	text-transform: uppercase;
	padding-left: 0;
	}
	.admin
{
	color:#1dba54;
	text-decoration: none;
	font-weight: bold;
}
.admin:hover
{
	color: #000;
}
</style>
