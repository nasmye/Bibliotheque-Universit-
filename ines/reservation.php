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
if(!empty($_GET['cote']) AND !empty($_GET['numcarte'])) 
    {

    	$date_reservation=date("Y-m-d  h:i");
        $cote = verifyInput($_GET['cote']);
        $numcarte = verifyInput($_GET['numcarte']);
        //$cote = verifyInput($_GET['cote']);
        //$numcarte = verifyInput($_GET['numcarte']);

        $sql="INSERT INTO reservation (date_reservation) values(?)";
        $query=$bdd->prepare($sql);
        $query->execute(array($date_reservation));
        $query->closeCursor();

        $query=$bdd->query("SELECT id_reservation FROM reservation  ORDER BY id_reservation DESC");
        $item= $query->fetch();
        $id_reservation=$item['id_reservation'];
        $query->closeCursor();
       
        $query=$bdd->prepare("INSERT INTO reserver (id_reservation,numcarte,cote) values (?,?,?)");
        $query->execute(array($id_reservation,$numcarte,$cote));
        $query->closeCursor();

        $query=$bdd->prepare("SELECT quantite FROM document WHERE document.cote=?");
        $query->execute(array($cote));
        $item= $query->fetch();
        $quantite=$item['quantite'];
        $query->closeCursor();

        $quantite= $quantite - 1;
        $query=$bdd->prepare("UPDATE document SET quantite=? WHERE cote=?");
        $query->execute(array($quantite,$cote));
        $query->closeCursor();

        $query=$bdd->prepare("SELECT quantite FROM document WHERE document.cote=?");
        $query->execute(array($cote));
        $item= $query->fetch();
        $quantitenew=$item['quantite'];
        $query->closeCursor();
        if($quantitenew==0)
        {
        	$query=$bdd->prepare("UPDATE document SET disponibilite='non' WHERE cote=?");
            $query->execute(array($cote));
        	$query->closeCursor();
        }
        
        header("location:".  $_SERVER['HTTP_REFERER']);

    }	


?>