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
if(!empty($_GET['id_reservation'])) 
    {
    	$date_emprunt=date("Y-m-d");
    	$date_retour_th=date("Y-m-d");
        $id_reservation = verifyInput($_GET['id_reservation']);
        $sql="SELECT numcarte, cote FROM reserver WHERE reserver.id_reservation=?";
		$query=$bdd->prepare($sql);
        $query->execute(array($id_reservation));
        $item= $query->fetch();
        $numcarte=$item['numcarte'];
        $cote=$item['cote'];
        $query->closeCursor();

        $sql="INSERT INTO emprunter (date_emprunt,cote,numcarte) values(?,?,?)";
        $query=$bdd->prepare($sql);
        $query->execute(array($date_emprunt,$cote,$numcarte));
        $query->closeCursor();

        $sql="SELECT nb_emprunt FROM utilisateur WHERE numcarte=?";
        $query=$bdd->prepare($sql);
        $query->execute(array($numcarte));
        $item= $query->fetch();
        $nb_emprunt=$item['nb_emprunt'];
        $query->closeCursor();
        $nb_emprunt++;

        $sql="UPDATE utilisateur SET nb_emprunt=? WHERE numcarte=?";
        $query=$bdd->prepare($sql);
        $query->execute(array($nb_emprunt,$numcarte));
        $query->closeCursor();

        $sql="DELETE FROM reservation WHERE reservation.id_reservation=?";
        $query=$bdd->prepare($sql);
        $query->execute(array($id_reservation));
        $query->closeCursor();

        $sql="DELETE FROM reserver WHERE reserver.id_reservation=?";
        $query=$bdd->prepare($sql);
        $query->execute(array($id_reservation));
        $query->closeCursor();


        header("location:".  $_SERVER['HTTP_REFERER']);

    }	


?>