<h4>Utilisateurs <a href="user/user-ajouter.php" class="btn btn-success btn-lg"> Ajouter </a></h4>
<table class="table table-bordered">
        <thead>
                    <tr>
                      <th>N° Carte</th>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>Nombre emprunts</th>
                      <th>Catégorie</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        
                        $sql='SELECT numcarte ,nom ,prenom ,nb_emprunt ,categorie ,date_inscription FROM utilisateur ORDER BY date_inscription DESC';
                        $requete = $bdd->query($sql);
                        while($item = $requete->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $item['numcarte'] . '</td>';
                            echo '<td>'. $item['nom'] . '</td>';
                            echo '<td>'. $item['prenom'] . '</td>';
                            echo '<td>'. $item['nb_emprunt'] . '</td>';
                            echo '<td>'. $item['categorie'] . '</td>';
                            
                            echo '<td width=300>';
                            echo '<a class="btn btn-default" href="user/user-voir.php?numcarte='.$item['numcarte'].'"> Voir </a>';
                            echo ' ';
                            echo '<a class="btn btn-primary" href="user/user-modifier.php?numcarte='.$item['numcarte'].'"> Modifier </a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="user/user-supprimer.php?numcarte='.$item['numcarte'].'"> Supprimer </a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        $requete->closeCursor();

                      ?>
        </tbody>
</table>
