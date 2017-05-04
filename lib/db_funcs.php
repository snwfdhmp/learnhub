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

function getDocuments($chapitre) {
	$db = getPdoDbObject();
	$query = $db->query("SELECT * FROM documents WHERE id_chapitre=".$chapitre." ORDER BY nom");
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

function getUser($id_user) {
	$db = getPdoDbObject();
	$query = $db->query("SELECT id_user, prenom, nom, email FROM users WHERE id_user=".$id_user."");
	$query->execute();
	$db = null;
	$rep = $query->fetch();
	return $rep;
}

function getDocument($id_doc) {
	$db = getPdoDbObject();
	$query = $db->query("SELECT * FROM documents WHERE id_doc=".$id_doc."");
	$query->execute();
	$db = null;
	$rep = $query->fetch();
	return $rep;
}

function getComments($id_doc) {
	$db = getPdoDbObject();
	$query = $db->query("SELECT * FROM comments WHERE id_doc=".$id_doc."");
	$query->execute();
	$db = null;
	$rep = $query->fetchAll();
	return $rep;
}



?>