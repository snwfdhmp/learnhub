<?

include_once "../lib/std.funcs.php";

function getPdoDbObject() {
	try {
		$db = new PDO('mysql:host=localhost;dbname='.$GLOBALS['config']['database']['name'], $GLOBALS['config']['database']['username'], $GLOBALS['config']['database']['password']);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		print "Erreur : ". $e->getMessage() . "<br/>";
		die();
	}
	return $db;
}

function signUp($prenom, $nom, $email, $pass, $passconf, $promo) {
	if(strlen($prenom) > 0 && strlen($nom) > 0 && $promo>0 && $promo<=9 && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($pass) >= 8 && $pass === $passconf) {
		$query = $GLOBALS['db']->prepare("SELECT * FROM users WHERE email=:email OR (prenom=:prenom AND nom=:nom AND promo=:promo)");
		$query->bindParam(':prenom', $prenom);
		$query->bindParam(':nom', $nom);
		$query->bindParam(':email', $email);
		$query->bindParam(':promo', $promo);
		if(! $query->execute()) {
			header('Location: ?u=signup&err=db');
			exit(1);
		}
		$rep = $query->fetch();
		if($rep != NULL) {
			if($rep['email'] == $email)
				header('Location: ?u=signup&err=doubleEmail');
			else if ($rep['prenom'] == $prenom && $rep['nom'] == $nom && $rep['promo'] == $promo)
				header('Location: ?u=signup&err=doubleIdentity');
			exit(1);
		}


		$options = [
		"cost"=>10,
		];
		$hash = password_hash($pass, PASSWORD_DEFAULT, $options);
		$query = $GLOBALS['db']->prepare("INSERT INTO users (prenom, nom, pass, email,promo) VALUES(:prenom, :nom, :pass, :email,:promo)");
		$query->bindParam(':prenom', $prenom);
		$query->bindParam(':nom', $nom);
		$query->bindParam(':pass', $hash);
		$query->bindParam(':email', $email);
		$query->bindParam(':promo', $promo);
		if(! $query->execute()) {
			header('Location: ?u=signup&err=db');
			exit(1);
		}
	}
}

function getMatieres($promo) {
	$query = $GLOBALS['db']->query("SELECT * FROM matieres WHERE promo=".$promo." ORDER BY id_matiere");
	$query->execute();
	return $query->fetchAll();
}

function getMatiere($id_matiere) {
	$query = $GLOBALS['db']->query("SELECT * FROM matieres WHERE id_matiere=".$id_matiere."");
	$query->execute();
	return $query->fetch();
}

function getChapitres($id_matiere) {
	$query = $GLOBALS['db']->query("SELECT * FROM chapitres WHERE id_matiere=".$id_matiere." ORDER BY rang");
	$query->execute();
	return $query->fetchAll();
}

function getChapitre($id_chapitre) {
	$query = $GLOBALS['db']->query("SELECT * FROM chapitres WHERE id_chapitre=".$id_chapitre."");
	$query->execute();
	return $query->fetch();
}

function getFirstChap($id_matiere) {
	$query = $GLOBALS['db']->query("SELECT * FROM chapitres WHERE id_matiere=".$id_matiere." ORDER BY id_chapitre ASC");
	$query->execute();
	return $query->fetch();
}

function getPromoName($id_promo) {
	$query = $GLOBALS['db']->query("SELECT * FROM promos WHERE id_promo=".$id_promo."");
	$query->execute();
	return $query->fetch()['nom'];
}

function getDocuments($chapitre) {
	$query = $GLOBALS['db']->query("SELECT * FROM documents WHERE id_chapitre=".$chapitre." ORDER BY id_doc DESC");
	$query->execute();
	return $query->fetchAll();
}

function getPromos() {
	$query = $GLOBALS['db']->query("SELECT * FROM promos ORDER BY id_promo");
	$query->execute();
	return $query->fetchAll();
}

function getNomPromo($id_promo) {
	return fetchFirst("SELECT nom FROM promos WHERE id_promo=".$id_promo)['nom'];
}

function getUser($id_user) {
	$query = $GLOBALS['db']->query("SELECT id_user, prenom, nom, email, promo, permissions FROM users WHERE id_user=".$id_user."");
	$query->execute();
	$rep = $query->fetch();
	return $rep;
}

function fetchFirst($req) {
	$query = $GLOBALS['db']->query($req);
	$query->execute();
	$rep = $query->fetch();
	return $rep;
}

function getDocument($id_doc) {
	return fetchFirst("SELECT * FROM documents WHERE id_doc=".$id_doc);
}

function searchDocuments($search) {
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

	$req=$req."0 ORDER BY date_creation DESC LIMIT 7";
	$query = $GLOBALS['db']->query($req);
	$query->execute();
	return $query->fetchAll();
}
function putView($id_doc, $id_user) {
	if($id_user != null) {
		if(!hasSeen($id_doc, $id_user)) {
			$query = $GLOBALS['db']->prepare('INSERT INTO vues (id_doc, id_user, count) VALUES(:id_doc, :id_user, 1)');
			$query->bindParam(':id_doc', $id_doc);
			$query->bindParam(':id_user', $id_user);
			$query->execute();
		}
		else {
			$query = $GLOBALS['db']->prepare('UPDATE vues SET count=count+1 WHERE id_user=:id_user AND id_doc = :id_doc');
			$query->bindParam(':id_doc', $id_doc);
			$query->bindParam(':id_user', $id_user);
			$query->execute();
		}
	}

	$query = $GLOBALS['db']->prepare('UPDATE documents SET vues=vues+1 WHERE id_doc=:id_doc');
	$query->bindParam(':id_doc', $id_doc);

	return $query->execute();
}

function hasSeen($id_doc, $id_user) {
	$query = $GLOBALS['db']->prepare('SELECT count FROM vues WHERE id_doc=:id_doc AND id_user=:id_user');
	$query->bindParam(':id_doc', $id_doc);
	$query->bindParam(':id_user', $id_user);
	$query->execute();
	$rep = $query->fetchAll();
	return $rep != null;
}

function getComments($id_doc = "id_doc") {
	$query = $GLOBALS['db']->query("SELECT * FROM comments WHERE id_doc=".$id_doc." ORDER BY likes DESC");
	$query->execute();
	$rep = $query->fetchAll();
	return $rep;
}

function countComments($id_doc) {
	return count(getComments($id_doc));
}

function getOnlineUsers() {
	$timeover = time() + 200;
	$timeout = $GLOBALS['config']['authenticator']['onlineTimeout'];

	$query = $GLOBALS['db']->query("SELECT id_user, last_ping FROM connexions WHERE last_ping > current_timestamp()-".$timeout." AND id_user!='".$_SESSION['id_user']."'");
	$query->execute();
	$rep = $query->fetchAll();
	return $rep;
}

function getLikes($type_ref, $id_ref) {
	$query = $GLOBALS['db']->query('SELECT * FROM likes WHERE type_ref='.$type_ref.' AND id_ref='.$id_ref);
	$query->execute();
	$rep = $query->fetchAll();
	$sum = 0;
	foreach ($rep as $like) {
		$sum = $sum + $like['valeur'];
	}
	return $sum;
}

function putLike($type_ref, $id_ref, $valeur) {
	$query = $GLOBALS['db']->query('SELECT * FROM likes WHERE type_ref='.$type_ref.' AND id_ref='.$id_ref.' AND id_auteur='.$_SESSION['id_user']);
	$query->execute();
	$rep = $query->fetchAll();
	$query="";
	if($rep != NULL) {
		$queryLikes = $GLOBALS['db']->prepare("UPDATE likes SET valeur=:valeur WHERE type_ref=:type_ref AND id_ref=:id_ref AND id_auteur=:id_auteur");
	} else {
		$queryLikes = $GLOBALS['db']->prepare("INSERT INTO likes (type_ref, id_ref, id_auteur, valeur) VALUES(:type_ref, :id_ref, :id_auteur, :valeur)");

	}
	$queryLikes->bindParam(':type_ref', $type_ref);
	$queryLikes->bindParam(':id_ref', $id_ref);
	$queryLikes->bindParam(':id_auteur', $_SESSION['id_user']);
	$queryLikes->bindParam(':valeur', $valeur);

	$queryLikes = $queryLikes->execute();


	$updateCom = $GLOBALS['db']->prepare("UPDATE comments SET likes=:likes WHERE id_com=:id_com");

	$updateCom->bindParam(':likes', $likes);
	$updateCom->bindParam(':id_com', $id_com);
	$comments = getComments();
	foreach ($comments as $comment) {
		$id_com = $comment['id_com'];
		$likes = getLikes($GLOBALS['config']['database']['type_ref']['comment'], $id_com);
		$updateCom->execute();
	}

	return $queryLikes;
}

function getCommentsCount($id_user) {
	$query = $GLOBALS['db']->prepare("SELECT COUNT(*) as nb FROM comments WHERE id_auteur=:id_user");
	$query->bindParam(":id_user", $id_user);
	$query->execute();
	return $query->fetch()['nb'];
}

function getDocumentsCount($id_user) {
	$query = $GLOBALS['db']->prepare("SELECT COUNT(*) as nb FROM documents WHERE id_auteur=:id_user");
	$query->bindParam(":id_user", $id_user);
	$query->execute();
	return $query->fetch()['nb'];
}

function getGlobalNote($id_user) {
	$note = 0;

	// Points for DocLike
	$query = $GLOBALS['db']->prepare("SELECT SUM(l.valeur) as likesCount FROM documents d, likes l WHERE l.type_ref=1 AND d.id_doc=l.id_ref AND d.id_auteur=:id_user");

	$query->bindParam(":id_user", $id_user);
	$query->execute();
	$note += $GLOBALS['config']['values']['docLike']*($query->fetch()['likesCount']);

	// Points for doc upload
	$query = $GLOBALS['db']->prepare("SELECT COUNT(*) as count FROM documents WHERE id_auteur=:id_user");

	$query->bindParam(":id_user", $id_user);
	$query->execute();
	$note += $GLOBALS['config']['values']['doc']*($query->fetch()['count']);

	// Points for comment posting
	$query = $GLOBALS['db']->prepare("SELECT COUNT(*) as count FROM comments WHERE id_auteur=:id_user");

	$query->bindParam(":id_user", $id_user);
	$query->execute();
	$note += $GLOBALS['config']['values']['comment']*($query->fetch()['count']);

	// Points for comment like
	$query = $GLOBALS['db']->prepare("SELECT SUM(likes) as likesCount FROM comments WHERE id_auteur=:id_user");

	$query->bindParam(":id_user", $id_user);
	$query->execute();
	$note += $GLOBALS['config']['values']['commentLike']* $query->fetch()['likesCount'];

	return $note;
}

function postComment($id_doc, $content,$type, $id_user) {
	$nowdate=date('Y-m-d H:i:s');
	$query = $GLOBALS['db']->prepare("INSERT INTO comments (id_doc, id_auteur, contenu,date_creation,type) VALUES(:id_doc, :id_user,:content,:daten,:type)");
	$query->bindParam(':id_doc', $id_doc);
	$query->bindParam(':id_user', $id_user);
	$query->bindParam(':daten',$nowdate);
	$query->bindParam(':content', $content);
	$query->bindParam(':type', $type);
	return $query->execute();
}

function delComment($id) {
	if(adminOnly()) {
		$query = $GLOBALS['db']->prepare("DELETE FROM comments WHERE id_com=:id");
		$query->bindParam(':id', $id);
		return $query->execute();
	} else {
		$query = $GLOBALS['db']->prepare("DELETE FROM comments WHERE id_com=:id AND id_user=:id_user");
		$query->bindParam(':id', $id);
		$query->bindParam(':id_user', $_SESSION['id_user']);
		return $query->execute();
	}
}

function getdocpath($id_doc){
	$query = $GLOBALS['db']->query("SELECT url,nom FROM documents WHERE id_doc=".$id_doc);
	$query->execute();
	$rep = $query->fetchAll();
	return $rep;

}
function SendDocMail($id_doc,$email) {
	$url=getdocpath($id_doc);
	$path=$url[0]["url"];
	$nom=$url[0]["nom"];
	require '../mailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	//$mail->SMTPDebug = 3; 
	$mail->CharSet = 'UTF-8';                             
	$mail->SetFrom('noreply@learnhub.esy.es', 'LearnHub');
	$mail->AddAddress($email);     
	$mail->AddReplyTo('noreply@learnhub.esy.es', 'NO-REPLY');
	$mail->AddAttachment($path, 'Share2i-'.$nom.'.pdf');    
	$mail->IsHTML(true);
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
		); 
	$mail->Subject = 'Votre Document Share2i';
	$mail->Body    = 'Bonjour '.$_SESSION['prenom'].' '.$_SESSION['nom'].' ,<br>
	Vous trouverez en pièce jointe le document " '.$nom.' "<br />
	Cordialement,<br>
	Share2i';
	$mail->AltBody = 'Bonjour'.$_SESSION['prenom'].' '.$_SESSION['nom'].',
	Vous trouverez en pièce jointe le document " '.$nom.' "
	Cordialement,
	Share2i';
	if(!$mail->Send()) {
		echo 'Erreur '.$mail->ErrorInfo;
	} else {
		echo 'Envoyé';
	}
}

function createInitTokenUserId($id_user) {
	if((!isset($id_user)) || $id_user == "" )
		return false;

	$token = bin2hex(random_bytes(48));
	$query = $GLOBALS['db']->prepare("INSERT INTO tokens (id_user, type, value, id_owner) VALUES (:id_user, :type, :token, :id_owner)");
	$query->bindParam(":id_user", $id_user, PDO::PARAM_INT);
	$query->bindParam(":token", $token);
	$query->bindParam(":id_owner", $_SESSION['id_user']);
	$query->bindParam(":type", $GLOBALS['config']['database']['token_types']['initAccount']);
	$query->execute();
	return $token;
}

function getUserTokens($id_user) {
	$query = $GLOBALS['db']->prepare("SELECT * FROM tokens WHERE id_owner=:id_user");
	$query->bindParam(":id_user", $id_user);
	$query->execute();
	$rep = $query->fetchAll();
	if($rep == NULL)
		return false;
	return $rep;
}

function getTokenById($token) {
	$query = $GLOBALS['db']->prepare("SELECT * FROM tokens WHERE id=:id");
	$query->bindParam(":id", $token);
	$query->execute();
	$rep = $query->fetch();
	if($rep == NULL)
		return false;
	return $rep;
}

function getToken($token) {
	$query = $GLOBALS['db']->prepare("SELECT * FROM tokens WHERE value=:value AND type=:type AND used=0");
	$query->bindParam(":value", $token);
	$query->bindParam(":type", $GLOBALS['config']['database']['token_types']['initAccount']);
	$query->execute();
	$rep = $query->fetch();
	if($rep == NULL)
		return false;
	return $rep;
}

function getInitTokenUserId($token) {
	$rep = getToken($token);
	if($rep == NULL)
		return false;
	return $rep['id_user'];
}

function useToken($token) {
	$rep = getToken($token);
	$query = $GLOBALS['db']->prepare("UPDATE tokens SET used=1 WHERE value=:value AND id=:id AND type=:type AND id_user=:id_user");
	$query->bindParam(":value", $rep['value']);
	$query->bindParam(":type", $rep['type']);
	$query->bindParam(":id", $rep['id']);
	$query->bindParam(":id_user", $rep['id_user']);
	$query->execute();
	return $query;
}

function delToken($id) {
	$query = $GLOBALS['db']->prepare("DELETE FROM tokens WHERE id=:id");
	$query->bindParam(":id", $id);
	if (! $query->execute())
		return false;
	return true;
}


?>