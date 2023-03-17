<?php
session_start();
if(isset($_SESSION['numcarte'])){
include_once '../function/function.php';
$bdd=bdd();
function verifyInput($var)
{
  $var= trim($var);
  $var= stripcslashes($var);
  $var= htmlspecialchars($var);
  return $var;
}

$mdp =$newmdp1 =$newmdp2 =$ok= "";
$mdpError =$newmdp1Error =$newmdp2Error ="";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $mdp = verifyInput($_POST['mdp']);
  $newmdp1 = verifyInput($_POST['newmdp1']);
  $newmdp2 = verifyInput($_POST['newmdp2']);
  if(empty($mdp))
    {
      $mdpError= "Vous n'avez pas entrer votre mot de passe ";
    }
    if(empty($newmdp1))
    {
      $newmdp1Error= "Vous n'avez pas entrer le nouveau mot de passe ";
    }
    if(empty($newmdp2))
    {
      $newmdp2Error= "Veuillez confirmer le nouveau mot de passe";
    }
    $sql='SELECT motdepasse FROM utilisateur WHERE utilisateur.numcarte=:numcarte';
    $requete = $bdd->prepare($sql);
    $requete->execute(array(
        'numcarte'=> $_SESSION['numcarte']
    ));
    $i=$requete->fetch();
    if (sha1($mdp)!=$i['motdepasse']) {
      $mdpError="Le mot de passe est incorrecte";
    }
    if((strlen($newmdp1)<5 OR strlen($newmdp1)>20) AND !empty($newmdp1) )
    {
      $newmdp1Error= "Le mot de passe doit contenir entre 5 et 20 caractères";
    }
    if($newmdp1!=$newmdp2 AND !empty($newmdp1) AND !empty($newmdp2))  
    {
      $newmdp2Error= "Les mots de passe doivent être identiques";
    } 
    
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="icon" type="image/png" href="../images/logo2.png" />
	<link rel="stylesheet" href="profil.css">
	<link rel="stylesheet" href="../page.css">
	<title>Editer le mot de passe -Bibliothèque INES</title>
</head>
<body>
  
	<header>
    <script>
      function myFunction() {
     </script>
    <?php 
        if(!empty($_POST['mdp']) AND !empty($_POST['newmdp1']) AND !empty($_POST['newmdp2']))
        {
                if($_POST['newmdp1']== $_POST['newmdp2'])
                {
                  $sql='SELECT motdepasse FROM utilisateur WHERE utilisateur.numcarte=:numcarte';
                  $requete = $bdd->prepare($sql);
                  $requete->execute(array(
                    'numcarte'=> $_SESSION['numcarte']
                  ));
                  $i=$requete->fetch(); 
                   if (sha1($_POST['mdp'])==$i['motdepasse']) {
                    $requete->closeCursor();
                    $sql2='UPDATE utilisateur SET motdepasse = :motdepasse WHERE utilisateur.numcarte=:numcarte';
                    $requete = $bdd->prepare($sql2);
                    $requete->execute(array(
                      'motdepasse'=> sha1($_POST['newmdp1']),
                      'numcarte'=> $_SESSION['numcarte']
                    ));
                   $requete->closeCursor();
                     $ok="Le mot de passe est bien modifier";
                   }
                   
                }
        }

      ?>

  <script>
    }
    </script>
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
      <h3>Editer Le Mot De Passe</h3>
      <div class="container">
        <div class="form">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">          
          <div class="all-inp">    
             <div class="group-form">
              <label>Ancien Mot de passe:</label><br>
              <input type="password" name="mdp" value="<?php echo $mdp; ?>"><br>
              <p class="email"><?php echo $mdpError;  ?></p>
            </div>
          </div>
          <div class="all-inp">
            <div class="group-form">
              <label>Nouveau Mot de passe:</label><br>
              <input type="password" name="newmdp1" value="<?php echo $newmdp1; ?>"><br>
              <p class="email"><?php echo $newmdp1Error;  ?></p>
            </div>
          </div>
          <div class="all-inp">
            <div class="group-form">
              <label>Confirmer Mot de passe:</label><br>
              <input type="password" name="newmdp2" value="<?php echo $newmdp2; ?>"><br>
              <p class="email"><?php echo $newmdp2Error;  ?></p>
            </div>
          </div>
            <br><br>
            <center><input type="submit" onclick="myFunction()" class="button"></center>
            <p class="ok"><?php echo $ok;  ?></p>
          </form>
            
      </div>
    </div>
    
    </div>

  </section>
  </div>
  </div>
  <footer>
  </footer>
  <style >
    .form
    {
      width: 700px;
      height: 500px;
    }
    .container
    {
      padding: 50px
    }
    label
    {

    }
  </style>
</body>
</html>
<?php
}
else
{
  echo 'Vous devez vous connecter pour voir cette page';
}
?>