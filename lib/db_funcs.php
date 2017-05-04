<?

function getPdoDbObject() {
	try {
		$db = new PDO('mysql:host=localhost;dbname=ICS', 'root', 'root');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		print "Erreur : ". $e->getMessage() . "<br/>";
		die();
	}
	return $db;
}

function getMatieres($promo) {
	$db = getPdoDbObject();
	$query = $db->query("SELECT * FROM matieres WHERE promo=".$promo." ORDER BY id_matiere");
	$query->execute();
	$db = null;
	return $query->fetchAll();
}

function getChapitres($id_matiere) {
	$db = getPdoDbObject();
	$query = $db->query("SELECT * FROM chapitres WHERE id_matiere=".$id_matiere." ORDER BY rang");
	$query->execute();
	$db = null;
	return $query->fetchAll();
}

function getPromos() {
	$db = getPdoDbObject();
	$query = $db->query("SELECT * FROM promos ORDER BY id_promo");
	$query->execute();
	$db = null;
	return $query->fetchAll();
}

function getNomPromo($id_promo) {
	$db = getPdoDbObject();
	$query = $db->query("SELECT nom FROM promos WHERE id_promo=".$id_promo."");
	$query->execute();
	$db = null;
	$rep = $query->fetch();
	return $rep['nom'];
}


?>