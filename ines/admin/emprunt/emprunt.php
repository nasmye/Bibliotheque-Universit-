<h4>Emprunts </h4>
<table class="table table-bordered">
        <thead>
                    <tr>
                      <th>Côte</th>
                      <th>Titre</th>
                      <th>N° Carte</th>
                      <th>Nom</th>
                      <th>Date emprunt</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                        $sql="SELECT u.numcarte , u.nom , u.prenom ,u.categorie ,d.cote ,d.titre ,e.date_emprunt FROM utilisateur u,document d,emprunter e WHERE e.numcarte=u.numcarte AND e.cote=d.cote ORDER BY e.date_emprunt DESC";
                        $requete = $bdd->query($sql);
                        while($item = $requete->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $item['cote'] . '</td>';
                            echo '<td>'. $item['titre'] . '</td>';
                            echo '<td>'. $item['numcarte'] . '</td>';
                            echo '<td>'. $item['nom'] . ' '. $item['prenom'] . '</td>';
                            echo '<td>'. $item['date_emprunt'] . '</td>';
                            
                            
                            echo '<td width=300>';
                            echo '<a class="btn btn-valider" href="emprunt/rendu.php?cote='.$item['cote'].'&numcarte='.$item['numcarte'].'"> Rendu </a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        $requete->closeCursor();

                      ?>
        </tbody>
</table>
