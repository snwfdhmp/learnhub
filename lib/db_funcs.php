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

function searchDocuments($search) {
	$db = getPdoDbObject();
	/* ONE WAY TO DO 
	$arraySearch = explode(" ",$search);


	$req = "SELECT * FROM documents WHERE ";
	$targets=array("nom");

	foreach ($targets as $target) {
		foreach($arraySearch as $word) {
			$req = $req.'LOWER('.$target.') LIKE(LOWER("%'.$word.'%")) OR ';
		}
	}*/

	$arraySearch = explode(" ",$search);


	$req = "SELECT * FROM documents WHERE ";
	$targets=array("nom");

	foreach ($targets as $target) {
		$req= $req.'LOWER('.$target.') LIKE(LOWER("';
		foreach($arraySearch as $word) {
			$req = $req.'%'.$word.'%';
		}
		$req=$req.'")) OR ';
	}

	$req=$req."0 LIMIT 7";
	$query = $db->query($req);
	$query->execute();
	$db = null;
	return $query->fetchAll();
}

function getComments($id_doc) {
	$db = getPdoDbObject();
	$query = $db->query("SELECT * FROM comments WHERE id_doc=".$id_doc."");
	$query->execute();
	$db = null;
	$rep = $query->fetchAll();
	return $rep;
}

function getLikes($type_ref, $id_ref) {
	$db = getPdoDbObject();
	$query = $db->query('SELECT * FROM likes WHERE type_ref='.$type_ref.' AND id_ref='.$id_ref);
	$query->execute();
	$db = null;
	$rep = $query->fetchAll();
	$sum = 0;
	foreach ($rep as $like) {
		$sum = $sum + $like['valeur'];
	}
	return $sum;
}

function putLike($type_ref, $id_ref, $valeur) {
	$db = getPdoDbObject();
	$query = $db->query('SELECT * FROM likes WHERE type_ref='.$type_ref.' AND id_ref='.$id_ref);
	$query->execute();
	$db = null;
	$rep = $query->fetchAll();
	$query="";
	if($rep != NULL) {
		$query = $db->prepare("INSERT INTO likes (type_ref, id_ref, id_auteur, valeur) VALUES(:type_ref, :id_ref, :id_auteur, :valeur)");
	} else {
		$query = $db->prepare("UPDATE likes SET (valeur) VALUES(:valeur) WHERE type_ref=:type_ref, id_ref=:id_ref, id_auteur=:id_auteur");
	}
	$query->bindParam(':type_ref', $type_ref);
	$query->bindParam(':id_ref', $id_ref);
	$query->bindParam(':id_auteur', $_SESSION['id_user']);
	$query->bindParam(':valeur', $valeur);
	$query = $query->execute();
	$db = null;
	return $query;
}


function postComment($id_doc, $content, $id_user) {
	$db = getPdoDbObject();
	$query = $db->prepare("INSERT INTO comments (id_doc, id_auteur, contenu) VALUES(:id_doc, :id_user, :content)");
	$query->bindParam(':id_doc', $id_doc);
	$query->bindParam(':id_user', $id_user);
	$query->bindParam(':content', $content);
	return $query->execute();
}

?>