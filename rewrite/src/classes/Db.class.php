<?

/**
* 
*/
class Db
{
	public $db;
	
	function __construct()
	{
		try {
			$this->db = new PDO('mysql:host='.Config::db_host.';dbname='.Config::db_name, Config::db_user, Config::db_pass);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
			print "Erreur : ". $e->getMessage() . "<br/>";
			die();
		}
	}

	function __destruct() {
		$this->db = null;
	}

	function prepare($arg) {
		return $this->db->prepare($arg);
	}


	function getMatieres($promo) {
		$query = $this->db->query("SELECT * FROM matieres WHERE promo=".$promo." ORDER BY id_matiere");
		$query->execute();
		return $query->fetchAll();
	}

	function getChapitres($id_matiere) {
		$query = $this->db->query("SELECT * FROM chapitres WHERE id_matiere=".$id_matiere." ORDER BY rang");
		$query->execute();
		return $query->fetchAll();
	}

	function getDocuments($chapitre) {
		$query = $this->db->query("SELECT * FROM documents WHERE id_chapitre=".$chapitre." ORDER BY nom");
		$query->execute();
		return $query->fetchAll();
	}

	function getPromos() {
		$query = $this->db->query("SELECT * FROM promos ORDER BY id_promo");
		$query->execute();
		return $query->fetchAll();
	}

	function getNomPromo($id_promo) {
		return fetchFirst("SELECT nom FROM promos WHERE id_promo=".$id_promo)['nom'];
	}

	function getUser($id_user) {
		$query = $this->db->query("SELECT id_user, prenom, nom, email FROM users WHERE id_user=".$id_user."");
		$query->execute();
		$rep = $query->fetch();
		return $rep;
	}

	function fetchFirst($req) {
		$query = $this->db->query($req);
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

		$req=$req."0 LIMIT ".Config::search_max_result;
		$query = $this->db->query($req);
		$query->execute();
		return $query->fetchAll();
	}

	function getComments($id_doc) {
		$query = $this->db->query("SELECT * FROM comments WHERE id_doc=".$id_doc."");
		$query->execute();
		$rep = $query->fetchAll();
		return $rep;
	}

	function getOnlineUsers() {
		$timeover = time() + 200;
		$timeout = Config::user_online_timeout;

		$query = $this->db->query("SELECT id_user, last_ping FROM connexions WHERE last_ping > current_timestamp()-".$timeout/*." ""AND id_user = ".$_SESSION['id_user']*/);
		$query->execute();
		$rep = $query->fetchAll();
		return $rep;
	}

	function getLikes($type_ref, $id_ref) {
		$query = $this->db->query('SELECT * FROM likes WHERE type_ref='.$type_ref.' AND id_ref='.$id_ref);
		$query->execute();
		$rep = $query->fetchAll();
		$sum = 0;
		foreach ($rep as $like) {
			$sum = $sum + $like['valeur'];
		}
		return $sum;
	}

	function putLike($type_ref, $id_ref, $valeur) {
		$query = $this->db->query('SELECT * FROM likes WHERE type_ref='.$type_ref.' AND id_ref='.$id_ref.' AND id_auteur='.$_SESSION['id_user']);
		$query->execute();
		$rep = $query->fetchAll();
		$query="";
		if($rep != NULL) {
			$query = $this->db->prepare("UPDATE likes SET valeur=:valeur WHERE type_ref=:type_ref AND id_ref=:id_ref AND id_auteur=:id_auteur");
		} else {
			$query = $this->db->prepare("INSERT INTO likes (type_ref, id_ref, id_auteur, valeur) VALUES(:type_ref, :id_ref, :id_auteur, :valeur)");
		}
		$query->bindParam(':type_ref', $type_ref);
		$query->bindParam(':id_ref', $id_ref);
		$query->bindParam(':id_auteur', $_SESSION['id_user']);
		$query->bindParam(':valeur', $valeur);
		$query = $query->execute();
		return $query;
	}


	function postComment($id_doc, $content, $id_user) {
		$query = $this->db->prepare("INSERT INTO comments (id_doc, id_auteur, contenu) VALUES(:id_doc, :id_user, :content)");
		$query->bindParam(':id_doc', $id_doc);
		$query->bindParam(':id_user', $id_user);
		$query->bindParam(':content', $content);
		return $query->execute();
	}


	//Connexions

	function validCreds($email, $pass) {
		if(strlen($pass) >= 8) {
			$query = $this->db->prepare("SELECT id_user, pass FROM users WHERE email=:email");
			$query->bindParam(':email', $email);
			$query->execute();
			$answer = $query->fetch();

			if (password_verify($pass, $answer["pass"])) {
				return $answer["id_user"];
			}
			else
				return false;
		}
		else
			return false;
	}

	function getSelfInfos($id_user) {
		$query = $this->db->prepare("SELECT id_user, prenom, nom, email, url_pdp, promo, pseudo_cas FROM users WHERE id_user = :id_user");
		$query->bindParam(':id_user', $id_user);
		$query->execute();
		return $query->fetch();
	}

	function insertConnexion($session_cookie, $id_user, $ip) {
		$query = $this->db->prepare("INSERT INTO connexions (session_cookie, id_user, last_ip) VALUES(:session_cookie, :id_user, :last_ip)");
		$query->bindParam(':session_cookie', $session_cookie);
		$query->bindParam(':id_user', $id_user);
		$query->bindParam(':last_ip', $last_ip);

		$query->execute();
	}

	function ping($session_cookie, $id_user, $ip) {
		$query = $this->db->prepare("UPDATE connexions SET last_ping=current_timestamp(), last_ip=:last_ip WHERE session_cookie=:session_cookie AND id_user=:id_user");
		$query->bindParam(':session_cookie', $session_cookie);
		$query->bindParam(':id_user', $id_user);
		$query->bindParam(':last_ip', $ip);
		return ($query->execute() > 0);
	}

	function validSessionCookie($session_cookie, $id_user, $ip) {
		global $_auth;
		$query = $this->db->prepare('SELECT * FROM connexions WHERE session_cookie=:cookie AND id_user=:id_user AND last_ip=:ip');

		$query->bindParam(':cookie', $session_cookie);
		$query->bindParam(':id_user', $id_user);
		$query->bindParam(':ip', $ip);

		$query->execute();
		$nbRows = $query->rowCount();

		if($nbRows <= 0)
			return false;
		$rep = $query->fetch();
		return $rep['id_user'];
	}

	function deleteOldConnexions() {
		$query = $this->db->prepare("DELETE FROM connexions WHERE last_ping<current_timestamp()-:timeout");
		$timeout = Config::auth_timeout;
		$query->bindParam(':timeout', $timeout);
		$query->execute();
	}

	public function deleteCookie($cookie) {
		$query = $this->db->prepare("DELETE FROM connexions WHERE session_cookie=:session_cookie");
		$query->bindParam(':session_cookie', $cookie);
		$query->execute();
	}
}