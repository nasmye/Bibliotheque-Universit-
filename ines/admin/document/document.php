
<script>
function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display == "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>

<h4>Documents <a href="document/document-ajouter.php" class="btn btn-success btn-lg"> Ajouter </a>
  <!--<button class="btn btn-order btn-lg btn-reserch" onclick="myFunction()">Rechercher</button>  -->
<div class="panel" id="myDIV">
  <form class="search" method="post"  role="form">
                    <input type="text" name="rechercher" class="recherche" placeholder="Rechercher">
                  <select class="control" id="option" name="option">
                             <option value=""></option>
                               <option value="cote" name="cote">Côte</option>
                               <option value="titre" name="titre">Titre</option>
                               <option value="isbn" name="isbn">ISBN</option>
                               <option value="type" name="type">Type</option>
                               <option value="auteur" name="auteur">Auteur</option>
                               <option value="domaine" name="domaine">Domaine</option>
                        </select>
                  <input type="submit" class="button-1" onclick="myFunction()" value="OK">
                  </form>
</div>           
</h4>

<table class="table table-bordered">
        <thead>
                    <tr>
                      <th>Cote</th>
                      <th>Titre</th>
                      <th>Type</th>
                      <th>Quantité</th>
                      <th>Disponibilité</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      
                        if (!isset($_POST['option']) AND !isset($_POST['rechercher'])) {
                          # code...
                          $sql='SELECT cote ,titre ,type ,quantite ,disponibilite ,date_edition FROM document ORDER BY date_edition DESC';
                        $requete = $bdd->query($sql);
                        }
                        
                        while($item = $requete->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $item['cote'] . '</td>';
                            echo '<td>'. $item['titre'] . '</td>';
                            echo '<td>'. $item['type'] . '</td>';
                            echo '<td>'. $item['quantite'] . '</td>';
                            echo '<td>'. $item['disponibilite'] . '</td>';
                            
                            echo '<td width=300>';
                            echo '<a class="btn btn-default" href="document/document-voir.php?cote='.$item['cote'].'"> Voir </a>';
                            echo ' ';
                            echo '<a class="btn btn-primary" href="document/document-modifier.php?cote='.$item['cote'].'"> Modifier </a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="document/document-supprimer.php?cote='.$item['cote'].'"> Supprimer </a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        $requete->closeCursor();

                      ?>
        </tbody>
</table>
<style >
h4
{
  display: inline-block;
}
.btn-reserch
{
  font-size: 20px;
  width: 100px !important;
  padding: 6px 12px;
}
.button-1
{
  top: 10px;
  padding: 10px; 
  width: 50px;
  border: none;
  cursor: pointer;
}
.recherche
{
  font-size: 20px;
  color: #fff;
  height: 50px;
  width: 220px;
  border:none;
  padding: none;
  background: rgba(255,255,255,0.10);
  padding-left: 10px;
}


#myDIV {
    width: 100%;
    padding: 50px 0;
    text-align: center;
    background-color: lightblue;
    margin-top: 20px;
    display: none;
}

</style>