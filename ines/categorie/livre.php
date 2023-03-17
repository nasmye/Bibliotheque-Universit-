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
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../admin/list.css">
  <link rel="stylesheet" href="../pages.css">
  <title>Livres -Bibliothèque Ines</title>
</head>
<body>
<header>
  <div class="wrraper">
    <?php include("contenus1/head1.php"); ?>  
    <div id="ligne" class="ligne-categories"><img src="../images/ligne.png"></div>
    
  </div>
  
</header>
<section id="page-categories">
  <div class="wrraper">
<h4>Livres</h4>
<table class="table table-bordered">
        <thead>
                    <tr>
                      <th>Cote</th>
                      <th>Titre</th>
                      <th>Auteur</th>
                      <th>Quantité</th>
                      <th>Disponibilité</th>
                      <th>Date d'édition</th>
                      <th>Domaine</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>

                      <?php
                        $type='livre';
                        $sql='SELECT cote ,titre ,auteur ,quantite ,disponibilite ,date_edition,domaine FROM document WHERE document.type=:type ORDER BY date_edition DESC';
                        $requete = $bdd->prepare($sql);
                        $requete->execute(array('type' => $type));
                        $i=0;
                        while($item = $requete->fetch()) 
                        {
                            $i++;
                            echo '<tr>';
                            echo '<td>'. $item['cote'] . '</td>';
                            echo '<td>'. $item['titre'] . '</td>';
                            echo '<td>'. $item['auteur'] . '</td>';
                            echo '<td>'. $item['quantite'] . '</td>';
                            echo '<td>'. $item['disponibilite'] . '</td>';
                            echo '<td>'. $item['date_edition'] . '</td>';
                            echo '<td>'. $item['domaine'] . '</td>';
                            
                            echo '<td width=300>';
                            echo '<a class="btn btn-default" href="../voir.php?cote='.$item['cote'].'"> Voir </a>';
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

                            echo '<a class="btn btn-primary" onclick="confirm(\'Êtes-vous sûr de vouloir réserver ce document ?\')" href="../reservation.php?cote='.$item['cote'].'&numcarte='.$_SESSION['numcarte'].'"> Réserver </a>';
                           
                            
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
                                echo '<a class="btn btn-annuler" href="../annuler_reserver.php?id_reservation='.$id_reservation.'&cote='.$item['cote'].'" > Annuler </a>';
                                
                               }
                            }
                            
                            echo ' ';
                            echo '</td>';
                            echo '</tr>';
                            //$i++;
                        }
                        $requete->closeCursor();

                      ?>
        </tbody>
</table>
</div>
</section>

<footer>
<?php include("contenus1/footer1.php"); ?>  
</footer>

</body>
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
</html>
