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
function isEmail($var)
{
  return filter_var($var, FILTER_VALIDATE_EMAIL);
}
$email =$ok= "";
$emailError ="";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $email = verifyInput($_POST['email']);
  if(empty($email))
    {
      $emailError= "Vous n'avez pas entrer l'email";
    }
    if(!isEmail($email) AND !empty($email))
  {
    $emailError= "Syntaxe de l'adresse email incorrect"; 
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
	<title>Editer le profil -Bibliothèque INES</title>
</head>
<body>
  
	<header>
    <?php 
        if(isset($_POST['email']))
        {
            $syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,4}$#'; 
                if(preg_match($syntaxe,$_POST['email']))
                {
                  $sql='UPDATE utilisateur SET email = :email WHERE utilisateur.numcarte=:numcarte';
                  $requete = $bdd->prepare($sql);
                  $requete->execute(array(
                    'email'=> $_POST['email'],
                    'numcarte'=> $_SESSION['numcarte']
                  ));
                   $requete->closeCursor();
                   $ok="L'email est bien modifier";
                }
        }

      ?>
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
      <h3>Editer Le Profile</h3>
      <div class="container">
        <div class="form">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">              
             <div class="group-form">
              <label>Ancien Email:</label>
              <p><?php echo $reponse['email']; ?></p>
            </div>
            <div class="group-form">
              <label>Nouveau Email:</label><br>
              <input type="text" name="email" value="<?php echo $email; ?>"><br>
              <p class="email"><?php echo $emailError;  ?></p>
            </div>

            <br><br>
            <center><input type="submit" class="button"></center>
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
      height: 350px;
    }
    .container
    {
      padding: 50px
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