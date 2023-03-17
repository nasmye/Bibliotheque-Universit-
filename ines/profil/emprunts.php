<?php
session_start();
if(isset($_SESSION['numcarte'])){
include_once '../function/function.php';
$bdd=bdd();
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="icon" type="image/png" href="../images/logo2.png" />
	<link rel="stylesheet" href="profil.css">
	<link rel="stylesheet" href="../page.css">
	<title>Emprunts -Bibliothèque INES</title>
</head>
<body>
  
	<header>
    <div class="wrraper">
      <div class="logo">
        <a href="../index.php"><img class="img" src="../images/logo1.png">
        <h1>Bibliothèque</h1><h2>Ines</h2></a>
      </div>
      <li class="dropdown" >
                <a class="dropbtn" href="">
                  <div class="profil">
                   <a href="">
                    <a href="" class="moi">Profile </a>
                    <img src="../images/user2.png"></a>
                  </div>
                </a>
                <div class="dropdown-content" >
                  <a href="compte.php">Mon compte</a>
                  <a href="../deconnexion.php">Déconnexion</a>
                </div>
      </li>
      
    </div>
		
	</header>
  <?php
      
      $sql='SELECT * FROM utilisateur WHERE utilisateur.numcarte=:numcarte';
      $requete = $bdd->prepare($sql);
      $requete->execute(array('numcarte'=> $_SESSION['numcarte']));
      $reponse = $requete->fetch();
    ?>
  <div class="wast">
    <div class="wrraper">
    <section class="menu">
      <div class="vertical-menu">
  <a  class="user"><img src="../images/user2.png"><p class="cat"><?php echo $reponse['categorie']; ?></p></a>
  <a href="compte.php" class="home"><img src="../images/home.png">Mon Compte</a>
  <a href="editprofile.php">Editer Le Profile</a>
  <a href="editmdp.php">Editer Le MotDePasse</a>
  <a href="emprunts.php">Emprunts</a>
  <a href="reservations.php">Reservations</a>
</div>
    
  </section>
  <section class="main">
    
    <div class="presentation">
      <h3>Mes Emprunts</h3>
      <div class="container">
        <div class="form">
          <table class="table table-bordered">
        <thead>
                    <tr>
                      <th>Titre</th>
                      <th>Date emprunt</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php 
                        $sql='SELECT e.date_emprunt, d.titre FROM emprunter e,document d, utilisateur u WHERE e.cote=d.cote AND u.numcarte=e.numcarte AND u.numcarte=:numcarte ORDER BY e.date_emprunt DESC ';
                        $requete = $bdd->prepare($sql);
                        $requete->execute(array('numcarte'=> $_SESSION['numcarte']));
                        while($item = $requete->fetch()) 
                        {
                            echo '<tr>';
                            echo '<td>'. $item['titre'] . '</td>';
                            echo '<td>'. $item['date_emprunt'] . '</td>';
                            echo '</tr>';
                        }
                        $requete->closeCursor();

                      ?>
        </tbody>
</table>
            
      </div>
    </div>
    
    </div>

  </section>
  </div>
  </div>
  <footer>
  </footer>
  <style >
.form
{
  width: 500px;
  min-height: 50px !important;
  height: inherit;
}
.container
{
background: #fff;
padding: 10px;
width: 500px ;

position: absolute;
margin-top:20px;
border-radius: 10px;
}
.table-bordered {
border: 1px solid #ddd;
}
.table {
width: 95%;

margin-bottom: 20px;
}
table {
border-spacing: 0;
border-collapse: collapse;
display: table;
}
thead {
display: table-header-group;
vertical-align: middle;
border-color: inherit;
color: #919496;
}
tr {
display: table-row;
vertical-align: inherit;
border-color: inherit;
}
.table-bordered thead tr td, .table-bordered thead tr th {
border-bottom-width: 2px;
padding: 8px;
line-height: 1.42857143;
padding: 8px;
line-height: 1.42857143;
}
.table thead tr th {
vertical-align: bottom;
border: 1px solid #ddd;
border-bottom: 2px solid #ddd;

}
.table-bordered tbody tr td
{
border: 1px solid #ddd;
padding: 8px;
line-height: 1.42857143;
vertical-align: top;
}
th {
text-align: left;
font-weight: bold;

}
td, th {
display: table-cell;
text-transform: uppercase;
}

tbody {
display: table-row-group;
vertical-align: middle;
border-color: inherit;
color: #000;
}
tr {
display: table-row;
vertical-align: inherit;
border-color: inherit;
}
tr:nth-child(even) {
    background-color: #f2f2f2;
}
  </style>
</body>
</html>
<?php
}
else
{
  echo 'Vous devez vous connecter pour voir cette page';
}
?>