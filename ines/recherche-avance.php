<?php
session_start();
include_once 'function/function.php';
$bdd = bdd();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="images/logo2.png" />
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="pages.css">
	<link rel="stylesheet" href="admin/list.css">
	<title>Recherche avancée -Bibliothèque Ines</title>
</head>
<body>
<header>
			<div class="wrraper">
				<?php include("contenus/head.php"); ?>	
				
			</div>
		</header>

<!--Code personnaliser -->

<section id="page-recherche">
	<div class="wrraper">




<?php
if((isset($_POST['titre']) && $_POST['titre'] != NULL) OR (isset($_POST['isbn']) && $_POST['isbn'] != NULL) OR (isset($_POST['type']) && $_POST['type'] != NULL) OR (isset($_POST['auteur']) && $_POST['auteur'] != NULL) OR (isset($_POST['langue']) && $_POST['langue'] != NULL) OR (isset($_POST['date_edition']) && $_POST['date_edition'] != NULL) OR (isset($_POST['domaine']) && $_POST['domaine'] != NULL)) 
{

$titre = htmlspecialchars($_POST['titre']); 
$isbn = htmlspecialchars($_POST['isbn']); 
$type = htmlspecialchars($_POST['type']); 
$auteur = htmlspecialchars($_POST['auteur']); 
$langue = htmlspecialchars($_POST['langue']); 
$date_edition = htmlspecialchars($_POST['date_edition']); 
$domaine = htmlspecialchars($_POST['domaine']); 

$sql="SELECT * FROM document ";
if(!empty($titre))$sql.=" WHERE titre LIKE '%$titre%'";

if(!empty($isbn) AND !empty($titre))$sql.=" AND isbn LIKE '$isbn'";
if(!empty($isbn) AND empty($titre))$sql.=" WHERE isbn LIKE '$isbn'";

if(!empty($type) AND (!empty($titre) OR !empty($isbn)))$sql.=" AND type LIKE '$type'";
if(!empty($type) AND empty($titre) AND empty($isbn))$sql.=" WHERE type LIKE '$type'";

if(!empty($auteur) AND (!empty($titre) OR !empty($isbn) OR !empty($type)))$sql.=" AND auteur LIKE '%$auteur%'";
if(!empty($auteur) AND empty($titre) AND empty($isbn) AND empty($type) )$sql.=" WHERE auteur LIKE '%$auteur%'";

if(!empty($langue) AND (!empty($titre) OR !empty($isbn) OR !empty($type) OR !empty($auteur)))$sql.=" AND langue LIKE '%$langue%'";
if(!empty($langue) AND empty($titre) AND empty($isbn) AND empty($type) AND empty($auteur))$sql.=" WHERE langue LIKE '%$langue%'";

if(!empty($date_edition) AND (!empty($titre) OR !empty($isbn) OR !empty($type) OR !empty($auteur) OR !empty($langue)))$sql.=" AND date_edition LIKE '%$date_edition%'";
if(!empty($date_edition) AND empty($titre) AND empty($isbn) AND empty($type) AND empty($auteur) AND empty($langue))$sql.=" WHERE date_edition LIKE '%$date_edition%'";

if(!empty($domaine) AND (!empty($titre) OR !empty($isbn) OR !empty($type) OR !empty($auteur) OR !empty($langue) OR !empty($date_edition)))$sql.=" AND domaine LIKE '$domaine'";
if(!empty($domaine) AND empty($titre) AND empty($isbn) AND empty($type) AND empty($auteur) AND empty($langue) AND empty($date_edition))$sql.=" WHERE domaine LIKE '$domaine'";

$sql.=" ORDER BY titre DESC";
$query=$bdd->query($sql);
$nb_resultats = $query->rowCount(); 
if($nb_resultats != 0) 
	{
	if($nb_resultats>1) 
		{ 
			$resultat='Nous avons trouvé '.$nb_resultats.' résultats dans notre base de données. Voici les documents que nous avons trouvées :'; 
		} else 
		{ 
			$resultat='Nous avons trouvé '.$nb_resultats.' résultat dans notre base de données. Voici les documents que nous avons trouvées :'; 
		}

echo '<h4>Résultats de votre recherche.</h4>';
echo '<br><small>' .$resultat. '</small><br>';
		echo'<table class="table table-bordered">';
		        echo'<thead>';
		                    echo'<tr>';
		                      echo'<th>Cote</th>';
		                      echo'<th>Titre</th>';
		                      echo'<th>Auteur</th>';
		                      echo'<th>type</th>';
		                      echo'<th>Quantité</th>';
		                      echo'<th>Disponibilité</th>';
		                      echo'<th>Date d\'édition</th>';
		                      echo'<th>Actions</th>';
		                    echo'</tr>';
		                  echo'</thead>';
		                  echo'<tbody>';

while($item = $query->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $item['cote'] . '</td>';
                            echo '<td>'. $item['titre'] . '</td>';
                            echo '<td>'. $item['auteur'] . '</td>';
                            echo '<td>'. $item['type'] . '</td>';
                            echo '<td>'. $item['quantite'] . '</td>';
                            echo '<td>'. $item['disponibilite'] . '</td>';
                            echo '<td>'. $item['date_edition'] . '</td>';
                            
                            
                            echo '<td width=300>';
                            echo '<a class="btn btn-default" href="voir.php?cote='.$item['cote'].'"> Voir </a>';
                            echo ' ';
                            if(isset($_SESSION['numcarte'])){
                              $sql2="SELECT id_reservation FROM reserver WHERE reserver.numcarte=? AND reserver.cote=?";
                                $requete2= $bdd->prepare($sql2);
                                $requete2->execute(array($_SESSION['numcarte'],$item['cote']));
                                $item2=$requete2->fetch();
                                $sql4="SELECT cote,numcarte FROM emprunter WHERE emprunter.numcarte=? AND emprunter.cote=?";
                                $requete4= $bdd->prepare($sql4);
                                $requete4->execute(array($_SESSION['numcarte'],$item['cote']));
                                $item4=$requete4->fetch();
                              if ($item['disponibilite']=='oui' AND !isset($item2['id_reservation']) AND !isset($item4['cote'])) {

                            echo '<a class="btn btn-primary" onclick="confirm(\'Êtes-vous sûr de vouloir réserver ce document ?\')" href="reservation.php?cote='.$item['cote'].'&numcarte='.$_SESSION['numcarte'].'"> Réserver </a>';
                           
                            
                            }
                            
                              if ($item['disponibilite']=='non' AND !isset($item2['id_reservation']) AND !isset($item4['cote'])) 
                                {
                            echo '<a class="btn btn-danger no-dispo" > Non disponible </a>';

                                }
                                
                              if($item4['cote'])  
                                {
                                
                                echo '<a class="btn btn-emprunt no-dispo"  > Emprunté </a>';
                                
                               }
                               if($item2['id_reservation']) 
                               {
                                $id_reservation=$item2['id_reservation'];
                                echo '<a class="btn btn-annuler" href="annuler_reserver.php?id_reservation='.$id_reservation.'&cote='.$item['cote'].'" > Annuler </a>';
                                
                               }
                            }
                            echo ' ';
                            echo '</td>';
                            echo '</tr>';
                        }
echo'</tbody>';
echo'</table>';


} 
else
{ 
	$resultat='Nous n\'avons trouvé aucun résultat pour votre recherche';
	echo '<h4>Résultats de votre recherche.</h4>';
	echo '<br><small>' .$resultat. '</small><br>';
	

}
$query->closeCursor();
}else
{
	?>
	<form method="post" class="av" action="recherche-avance.php" role="form" enctype="multipart/form-data">
		<div>
			<label for="titre">Titre:</label>
			<input type="text" name="titre" id="titre">
		</div>
		<div>
			<label for="isbn">ISBN:</label>
			<input type="text" name="isbn" id="isbn">
		</div>
		<div>
			<label for="type">Type:</label>
			 <select id="type" name="type">
                        	   <option value="">Type</option>
                               <option value="livre">Livre</option>
                               <option value="memoire">Mémoire</option>
                               <option value="rapport de stage">Rapport De Stage</option>
                               <option value="these">Thèse</option>
                               <option value="dictionnaire">Dictionnaire</option>
                               <option value="cd/dvd memoire">CD/DVD Mémoire</option>
            </select>
		</div>
		<div>
			<label for="auteur">Auteur:</label>
			<input type="text" name="auteur" id="auteur">
		</div>
		<div>
			<label for="langue">Langue:</label>
			<input type="text" name="langue" id="langue">
		</div>
		<div>
			<label for="date_edition">Date d'édition:</label>
			<input type="text" name="date_edition" id="date_edition">
		</div>
		<div>
			<label for="domaine">Domaine:</label>
			 <select id="domaine" name="domaine">
                        	   <option value="">Domaine</option>
                               <option value="informatique">Informatique</option>
                               <option value="mathématique">Mathématique</option>
                               <option value="chimie">Chimie</option>
                               <option value="physique">Physique</option>
            </select>
		</div>
		<div>
			<input type="submit" name="submit" class="submit">
		</div>


	</form>
	<?php
}
?>


	</div>

</section>

<footer>
<?php include("contenus/footer.php"); ?>		
</footer>

</body>
</html>
<style >

form[class="av"]
{
	width: 1000px;
	margin: 0 auto;
	padding: 0 5px;

}
form[class="av"] div
{
	width: 1000px;
	height: 50px;
	padding: 10px 20px;
}
.submit
{

	margin-top: 20px;
	font-family: 'montserrat-n';
	font-weight: normal;
	font-size: 20px;
	border-radius: 500px;
	padding: 10px 90px;
	color: #fff;
	background-color: #1db954;
	text-align: center;
	border: none;
	margin: 20px 350px;
}
.submit:hover
{
	background-color: #1ed760;
}
form[class="av"] div input[type="text"], input[type="date"],select
{
	width: 60%;
	height: 34px;
	padding: 6px 12px;
	font-size: 14px;
	line-height: 1.42857143;
	color: #555;
	background-color: #fff;
	background-image: none;
	border: 1px solid #ccc;
	border-radius: 4px;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
	-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	
}
form[class="av"] div label
{
	color: #919496;
    font-size: 25px;
    font-family: 'montserrat-n';
	padding: 6px 12px;
	width: 200px;
	position: unset;
	float: left;
}
table
{
  width: 95% !important;
  margin: auto;
}
h4
{
  display: inline-block;
  font-size: 30px;
  font-family: 'raleway';
  font-weight: bold;
  margin-left: 30px;
  margin-bottom: 20px;
}
small
{
	font-size: 20px;
	font-family: 'raleway';
    margin-left: 30px;
    display: inline-block;
	margin-bottom: 20px;
}
.no-dispo
{
  cursor: default;
}
.btn-annuler
{
color: #fff;
background-color: #6424c9;
}
</style>