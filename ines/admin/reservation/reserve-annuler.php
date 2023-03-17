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
if(!empty($_GET['id_reservation']) AND !empty($_GET['cote'])) 
    {
  $id_reservation = verifyInput($_GET['id_reservation']);
  $cote = verifyInput($_GET['cote']);

$sql3="DELETE FROM reservation WHERE reservation.id_reservation=?";
$requete3=$bdd->prepare($sql3);
$requete3->execute(array($id_reservation));
$requete3->closeCursor();

$sql3="DELETE FROM reserver WHERE reserver.id_reservation=?";
$requete3=$bdd->prepare($sql3);
$requete3->execute(array($id_reservation));
$requete3->closeCursor();


$query=$bdd->prepare("SELECT quantite, disponibilite FROM document WHERE document.cote=?");
$query->execute(array($cote));
$item= $query->fetch();
$quantite=$item['quantite'];
$disponibilite=$item['disponibilite'];
$query->closeCursor();

$quantite= $quantite + 1;
if($disponibilite=='non')
{
	$query=$bdd->prepare("UPDATE document SET disponibilite=? ,quantite=? WHERE cote=?");
	$query->execute(array('oui',$quantite,$cote));
	$query->closeCursor();
}
if($disponibilite=='oui')
{
	$query=$bdd->prepare("UPDATE document SET quantite=? WHERE cote=?");
	$query->execute(array($quantite,$cote));
	$query->closeCursor();
}
header("location: ../index.php");
}
?>