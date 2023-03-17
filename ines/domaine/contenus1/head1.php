<div class="high">
					<a href="../index.php"><img class="img" src="../images/logo1.png">
				    <h1>Bibliothèque</h1><h2>Ines</h2></a>
				    <div class="search">
				    <form method="post" action="../recherche.php">
				    		<input type="submit" class="button-1" value="">
				    		
				    		<input type="text" name="recherche" class="recherche" placeholder="Quel Document cherchez Vous ? ">
				    </form>
					</div>
					<?php
					if(!isset($_SESSION['numcarte'])){

					    ?>
						<a class="connexion" href="../connexion.php">Connexion</a>
						<a class="inscription" href="../inscription.php">Inscription</a>
					    <?php
					}
					else {
					 
					    ?>
					    <li class="dropdown" id="profil">
						   <div class="dropup">
						   		<label>PROFILE</label><i class="arrow down"></i>
						    	<img class="icon" src="../images/user2.png">
						   </div>
						    	
						    
						    <div class="dropdown-content" id="profildown">
						      <a href="../profil/compte.php"><img src="../images/profile2.png"><?php echo '<b>'.$_SESSION['nom'].' '.$_SESSION['prenom'].'</b>'; ?></a>
						      <a href="../profil/emprunts.php">Mes Emprunts</a>
						      <a href="../profil/reservations.php">Mes Reservation</a>
						      <a href="../deconnexion.php"><img src="../images/deconnexion2.png"> Déconnexion</a>
						    </div>
						  </li>
					    
					    <?php

					}

					?>
				    
				    <a class="avancée" href="../recherche-avance.php"><u>Recherche avancée</u></a>
				</div>
			
				<div class="menu">
					<nav>
					<ul>
						<li><a href="../index.php">Accueil</a></li>
						

						<li><a href="../categories.php">Catégories</a></li>
						 <li class="dropdown">
						    <a href="../domaines.php" class="dropbtn" >Domaines</a>
						    <div class="dropdown-content">
						      <a href="informatique.php">Informatique</a>
						      <a href="mathematique.php">Mathématique</a>
						      <a href="chimie.php">Chimie</a>
						      <a href="physique.php">Physique</a>
						    </div>
						  </li>
						
						<li><a href="../apropos.php">A propos</a></li>
						<li><a href="../contact.php">Contact</a></li>
					</ul>
					</nav>	
				</div>	
<style type="text/css">
i {
    border: solid white;
    border-width: 0 3px 3px 0;
    display: inline-block;
    padding: 3px;
    margin-top: 25px;
	float: right;

}
.down {
    transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
}
label
{
	padding-top: 15px;
	padding-left: 60px;
	position: absolute;
	
}
li.dropdown {
    display: inline-block;
}

#profil
{
	text-transform: uppercase;
	font-weight: normal;
	float: right;
	margin-top: 25px;
	margin-right: 50px;
	font-size: 25px;
	color: #fff;
	width: 200px;
}

.dropup
{
	display: inline-block;
	height: 70px;
	width: 160px;
}
.dropup:hover
{
	color: #1dba54;
}
#profildown a
{
	color: #696969;
	background: rgb(255,255,255);
    border: 1px solid #696969;
    border-bottom: none;
    width: 200px;

}
#profildown a:hover
{
	color: #fff;
	background-color: #696969;
}

.dropdown-content {
    display: none;
    position: absolute;
    background: rgba(19,12,10,0.90);
    min-width: 120px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    
}
.dropdown-content a img
{
	vertical-align: middle;
}

#profildown
{
	margin-right: 100px;
    right: 0;
}
.dropdown-content a {
	font-size:20px;
    color: #fff;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}
.dropdown:hover .dropdown-content {
    display: block;
}
</style>