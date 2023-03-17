<?php
session_start();
if(isset($_SESSION['numcarte'])){
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="icon" type="image/png" href="../images/logo2.png" />
	<link rel="stylesheet" href="profil.css">
	<link rel="stylesheet" href="../page.css">
	<title>Profil -Bibliothèque INES</title>
</head>
<body>
  <?php  include_once '../function/function.php'; ?>
	<header>
    <div class="wrraper">
      <div class="logo">
        <a href="../index.php"><img class="img" src="../images/logo1.png">
        <h1>Bibliothèque</h1><h2>Ines</h2></a>
      </div>
      <li class="dropdown" >
                <a class="dropbtn" href="">
                  <div class="profil">
                   <a href="">
                    <a href="" class="moi">Profile </a>
                    <img src="../images/user2.png"></a>
                  </div>
                </a>
                <div class="dropdown-content" >
                  <a href="compte.php">Mon compte</a>
                  <a href="../deconnexion.php">Déconnexion</a>
                </div>
      </li>
      
    </div>
		
	</header>
  <?php
      $bdd=bdd();
      $sql='SELECT * FROM utilisateur WHERE utilisateur.numcarte=:numcarte';
      $requete = $bdd->prepare($sql);
      $requete->execute(array('numcarte'=> $_SESSION['numcarte']));
      $reponse = $requete->fetch();
    ?>
  <div class="wast">
    <div class="wrraper">
    <section class="menu">
      <div class="vertical-menu">
  <a  class="user"><img src="../images/user2.png"><p class="cat"><?php echo $reponse['categorie']; ?></p></a>
  <a href="compte.php" class="home"><img src="../images/home.png">Mon Compte</a>
  <a href="editprofile.php">Editer Le Profile</a>
  <a href="editmdp.php">Editer Le MotDePasse</a>
  <a href="emprunts.php">Emprunts</a>
  <a href="reservations.php">Reservations</a>
</div>
    
  </section>
  <section class="main">
    
    <div class="presentation">
      <h3>Aperçu Du Compte</h3>
      <div class="container">
        <div class="form">

            <div class="group-form">

              <label>Numéro de carte:</label>
              <p><?php echo $_SESSION['numcarte']; ?></p>
            </div>
             <div class="group-form">
              <label>Email:</label>
              <p><?php echo $reponse['email']; ?></p>
            </div>
            <div class="group-form">
              <label>Nom:</label>
              <p class="up"><?php echo $reponse['nom']; ?></p>
            </div>
            <div class="group-form">
              <label >Prénom:</label>
              <p class="up"><?php echo $reponse['prenom']; ?></p>
            </div>
            <div class="group-form">
              <label>Date d'inscription:</label>
              <p><?php echo $reponse['date_inscription']; ?></p>
            </div><br><br>
            <center><a href="editprofile.php" class="button">Editer Le Profile</a></center>
      </div>
    </div>
    <div class="container2">
      <div class="password">
        <div class="group-form2">
          <label><center>Mot de passe</center></label>
          <p><center>Vous pouver changer votre mot de passe </center></p>
        </div><br><br>
        <center><a href="editmdp.php" class="button">Editer Le Mot De Passe</a></center>
      </div><br>
      <div class="password">
        <div class="group-form2">
          <label><center>Emprunt</center></label>
          <p><center>Vous pouver voir vos emprunts </center></p>
        </div><br><br>
        <center><a href="emprunts.php" class="button">Consulter Les Emprunts</a></center>
      
      </div>
    </div>  
    
    </div>

  </section>
  </div>
  </div>
  
  <footer>
    
  </footer>



</body>
</html>
<?php
}
else
{
  header('Location: ../index.php');
}
?>