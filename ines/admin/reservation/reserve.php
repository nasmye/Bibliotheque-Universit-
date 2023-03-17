<h4>Reservations </h4>
<table class="table table-bordered">
        <thead>
                    <tr>
                      <th>Côte</th>
                      <th>Titre</th>
                      <th>N° Carte</th>
                      <th>Nom</th>
                      <th>Date reservation</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                        $sql='SELECT u.numcarte , u.nom , u.prenom ,u.categorie ,d.cote ,d.titre ,r.date_reservation,r.id_reservation FROM utilisateur u,document d,reservation r,reserver WHERE reserver.numcarte=u.numcarte AND reserver.cote=d.cote AND reserver.id_reservation=r.id_reservation ORDER BY r.date_reservation DESC';
                        $requete = $bdd->query($sql);
                        while($item = $requete->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $item['cote'] . '</td>';
                            echo '<td>'. $item['titre'] . '</td>';
                            echo '<td>'. $item['numcarte'] . '</td>';
                            echo '<td>'. $item['nom'] . ' '. $item['prenom'] . '</td>';
                            echo '<td>'. $item['date_reservation'] . '</td>';
                            
                            
                            echo '<td width=300>';
                            echo '<a class="btn btn-valider" href="../emprunter.php?id_reservation='.$item['id_reservation'].'"> Valider </a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="reservation/reserve-supprimer.php?cote='.$item['cote'].'&id_reservation='.$item['id_reservation'].'"> Supprimer </a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        $requete->closeCursor();

                      ?>
        </tbody>
</table>
