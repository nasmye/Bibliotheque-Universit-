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

    if(!empty($_GET['cote'])) 
    {
        $cote = verifyInput($_GET['cote']);
    
     
    $statement = $bdd->prepare("SELECT cote,titre,isbn,type,resume,langue,auteur,quantite,disponibilite,date_edition,domaine FROM document WHERE document.cote = :cote");
    $statement->execute(array('cote'=> $cote));
    $item = $statement->fetch();
    
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="../../images/logo2.png" />
        <meta charset="utf-8">
        <link rel="stylesheet" href="../admin.css">
        <link rel="stylesheet" href="../list.css">
        <title>Voir Document -Administrateur</title>
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
                    <b><h4 class="h4">Voir un Document </h4></b>
                    <br>
                    <form>
                      <div class="form-group">
                        <label>Cote:</label><?php echo '<p> '.$item['cote'].'</p>';?>
                      </div>
                      <div class="form-group">
                        <label>Titre:</label><?php echo ' <p> '.$item['titre'].'</p>';?>
                      </div>
                      <div class="form-group">
                        <label>ISBN:</label><?php echo ' <p> '.$item['isbn'].'</p>';?>
                      </div>
                      <div class="form-group">
                        <label>Type:</label><?php echo ' <p> '.$item['type'].'</p>';?>
                      </div>
                      <div class="form-group">
                        <label>Resumé:</label><?php echo ' <p> '.$item['resume'].'</p>';?>
                      </div>
                       <div class="form-group">
                        <label>Langue:</label><?php echo ' <p> '.$item['langue'].'</p>';?>
                      </div>
                      
                       <div class="form-group">
                        <label>Auteur:</label><?php echo ' <p> '.$item['auteur'].'</p>';?>
                      </div>
                      
                       <div class="form-group">
                        <label>Quantité:</label><?php echo ' <p> '.$item['quantite'].'</p>';?>
                      </div>
                      <div class="form-group">
                        <label>Disponibilité:</label><?php echo ' <p> '.$item['disponibilite'].'</p>';?>
                      </div>
                      
                       <div class="form-group">
                        <label>Date d'edition:</label><?php echo ' <p> '.$item['date_edition'].'</p>';?>
                      </div>
                      
                       <div class="form-group">
                        <label>Domaine:</label><?php echo ' <p> '.$item['domaine'].'</p>';?>
                      </div>
                      
                       
                    </form>
                    <br>
                    <div class="form-actions">
                      <a class="btn btn-primary return" href="../index.php">  Retour  </a>
                    </div>
                </div> 
               <div class="col-sm-6 site" style="float: right;">
                    <div class="thumbnail">
                        <img src="../../images/document.png">
                          <div class="caption">
                            <h4><?php echo '<center> <p >'.$item['titre'].'</p></center>';?></h4>
                            <a href="document-modifier.php?cote=<?php echo $item['cote'];?>" class="btn btn-order" role="button"> Modifier </a>
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
<?php
}
?>
<style >
  label
  {
    font-size: 20px;
  }
  p
  {
    font-size: 18px;
  }
</style>


