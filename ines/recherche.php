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
	<title>Recherche -Bibliothèque Ines</title>
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
if(isset($_POST['recherche']) && $_POST['recherche'] != NULL) 
{

$recherche = htmlspecialchars($_POST['recherche']); 
$query = $bdd->query("SELECT * FROM document WHERE titre LIKE '%$recherche%' OR auteur LIKE '%$recherche%' OR date_edition LIKE '%$recherche%' ORDER BY date_edition DESC"); 
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
	$resultat='Nous n\'avons trouvé aucun résultat pour votre recherche ';
	echo '<h4>Résultats de votre recherche.</h4>';
	echo '<br><small>' .$resultat. '</small><br>';
}
$query->closeCursor();
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