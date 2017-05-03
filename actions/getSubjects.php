<?php
		$promo=$_GET["p"];
		$db = new PDO('mysql:host=localhost;dbname=ICS', 'root', 'RRlocal19');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = $db->prepare("SELECT id_matiere,diminutif from matieres where promo=:promo");
		$query->bindParam(':promo', $promo);
		$query->execute();
		while ($donnees = $query->fetch()){
	    	echo "<option value=$donnees[id_matiere] onclick='getChap(this)'>$donnees[diminutif]</option>";
	    }
	    $id_matiere=$_GET["m"];
		$db = new PDO('mysql:host=localhost;dbname=ICS', 'root', 'RRlocal19');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = $db->prepare("SELECT id_chapitre,nom from chapitres where id_matiere=:id_matiere order by rang");
		$query->bindParam(':id_matiere', $id_matiere);
		$query->execute();
		while ($donnees = $query->fetch()){
	    	echo "<option value=$donnees[id_chapitre]>$donnees[nom]</option>";
		}
?>