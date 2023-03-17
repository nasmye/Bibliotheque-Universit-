<?php
    session_start();
    include_once '../../function/function.php';
    $bdd = bdd();
    function verifyInput($var)
    {
      $var= trim($var);
      $var= stripcslashes($var);
      $var= htmlspecialchars($var);
      return $var;
    }

    if(!empty($_GET['numcarte'])) 
    {
        $numcarte = verifyInput($_GET['numcarte']);
    }
     
    $statement = $bdd->prepare("SELECT numcarte,nom,prenom,nb_emprunt,adresse,categorie FROM utilisateur WHERE utilisateur.numcarte = :numcarte");
    $statement->execute(array('numcarte'=> $numcarte));
    $item = $statement->fetch();
    
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="../../images/logo2.png" />
        <meta charset="utf-8">
        <link rel="stylesheet" href="../admin.css">
        <link rel="stylesheet" href="../list.css">
        <title>Voir Utilisateur -Administrateur</title>
      </head>
      <?php
        if(!isset($_SESSION['pseudo']))
        {
          header('Location: ../index.php');
      }
      else
      {
        ?>
    
    <body>
        <header>
    <div class="wrraper" >
      <div class="logo">
        <a href="../../index.php"><img class="img" src="../../images/logo1.png">
        <h1>Bibliothèque</h1><h2>Ines</h2></a>
      </div>
      
    </div>
  </header>
  <section>
    <div class="wrraper2">
      <div class="container2">
        <div class="row">
          <div class="col-sm-6">
                    <b><h4 class="h4">Voir un Utilisateur </h4></b>
                    <br>
                    <form>
                      <div class="form-group">
                        <label>N° carte:</label><?php echo '<p> '.$item['numcarte'].'</p>';?>
                      </div>
                      <div class="form-group">
                        <label>Nom:</label><?php echo ' <p> '.$item['nom'].'</p>';?>
                      </div>
                      <div class="form-group">
                        <label>Prénom:</label><?php echo ' <p> '.$item['prenom'].'</p>';?>
                      </div>
                      <div class="form-group">
                        <label>Nb_emprunt:</label><?php echo ' <p> '.$item['nb_emprunt'].'</p>';?>
                      </div>
                      <div class="form-group">
                        <label>Catégorie:</label><?php echo ' <p> '.$item['categorie'].'</p>';?>
                      </div>
                       <div class="form-group">
                        <label>Adresse:</label><?php echo ' <p> '.$item['adresse'].'</p>';?>
                      </div>
                       
                    </form>
                    <br>
                    <div class="form-actions">
                      <a class="btn btn-primary return" href="../index.php">  Retour  </a>
                    </div>
                </div> 
               <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <img src="../../images/utilisateur.png">
                          <div class="caption">
                            <h4><?php echo '<center> <p class="nomprenom">'.$item['nom'].' '.$item['prenom'].'</p></center>';?></h4>
                            <a href="user-modifier.php?numcarte=<?php echo $item['numcarte'];?>" class="btn btn-order" role="button"> Modifier </a>
                          </div>
                    </div>
                </div>
          
        </div>
      </div>
    </div>
  </section>

</body>

<?php
}
?>

</html>

