<!--Code pour tout les pages -->
<?php
session_start();
include_once 'function/function.php';
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
	$query=$bdd->prepare("SELECT * FROM document WHERE cote=?");
	$query->execute(array($cote));
	$item = $query->fetch();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="images/logo2.png" />
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="pages.css">
	<link rel="stylesheet" href="admin/list.css">
	<title><?php echo $item['titre']; ?> -Bibliothèque Ines</title>
</head>
<body>
<header>
	<div class="wrraper">
		<?php include("contenus/head.php"); ?>
		
	</div>
	
</header>

<!--Code personnaliser -->

<section id="page-voir">
		<div class="wrraper">
		<div class="row1">
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
                      <a class="btn btn-primary return" href="javascript:history.back()" style="width: 100px;">  Retour  </a>
                    </div>
                    
                </div> 
               <div class="col-sm-6 site" style="float: right;">
                    <div class="thumbnail">
                        <img src="images/document.png">
                          <div class="caption">
                            <h4><?php echo '<center> <p >'.$item['titre'].'</p></center>';?></h4>
                            
                          </div>
                    </div>
                </div>
          
        </div>

		</div>


</section>

<footer>
<?php include("contenus/footer.php"); ?>		
</footer>

</body>

</html>
<?php
}
?>