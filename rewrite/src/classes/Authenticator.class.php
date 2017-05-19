<?

class Authenticator {
	private $authenticated;
	public $email;
	private $id_user;

	function __construct() {
		$authenticated = false;
		$email = "";
		$id_user = "";
	}

	public function isAuthenticated() { //returns whether the current user is authenticated or not
		return $this->authenticated;
	}

	public function ping() {
		$query = $GLOBALS['db']->db->prepare("UPDATE connexions SET last_ping=current_timestamp(), last_ip=:last_ip WHERE session_cookie=:session_cookie AND id_user=:id_user");
		$query->bindParam(':session_cookie', $_COOKIE['session_cookie']);
		$query->bindParam(':id_user', $_SESSION['id_user']);
		$query->bindParam(':last_ip', $_SERVER['REMOTE_ADDR']);
		if(!$query->execute())
			return -1;

		$query = $GLOBALS['db']->db->prepare("DELETE FROM connexions WHERE last_ping<current_timestamp()-:timeout");
		$timeout = Config::auth_timeout;
		$query->bindParam(':timeout', $timeout);
		$query->execute();

		return "pong";
	}

	public function setEmail($newEmail) { //set object's email
	if(isEmail($newEmail)) {
		$this->email = $newEmail;
		return true;
	}
	else {
		return false;
	}
}

	private function generateSessionCookie() { //generateSessionCookie
		return bin2hex(random_bytes(Config::auth_cookie_length));
	}

	private function createConnexion() {
		$cookie = $this-> generateSessionCookie();
		echo "<p>Generating a new cookie : ".$cookie."</p>";
	}


	private function validateCredentials($email, $pass) {
		if(strlen($pass) >= 8) {
			$query = $GLOBALS['db']->prepare("SELECT id_user, pass FROM users WHERE email=:email");
			$query->bindParam(':email', $email);
			$query->execute();
			$answer = $query->fetch();

			if (password_verify($pass, $answer["pass"])) {
				$this->email = $email;
				return $answer["id_user"];
			}
			else
				return false;
		}
		else
			return false;
	}

	public function tryConnexion($email, $pass) {
		$id_user = $this->validateCredentials($email, $pass);

		if($id_user === false) {
			header('Location: ?u=login&err=creds');
			exit();
		}
		$bytes = random_bytes(64); //random_bytes n'est pas comptaibe avec toute les versions de PHP
		$session_cookie = bin2hex($bytes);
		$last_ip = $_SERVER['REMOTE_ADDR'];

		//$query = $GLOBALS['db']->query('SELECT * FROM connexions WHERE 1');
		$query = $GLOBALS['db']->prepare("INSERT INTO connexions (session_cookie, id_user, last_ip) VALUES(:session_cookie, :id_user, :last_ip)");
		$query->bindParam(':session_cookie', $session_cookie);
		$query->bindParam(':id_user', $id_user);
		$query->bindParam(':last_ip', $last_ip);
		$_SESSION['email']=$email;
		$_SESSION['id_user'] = $id_user;

		$query->execute();

		setcookie("session_cookie",$session_cookie,time()+360000000);

		$this->applyAuth($id_user);
		//die("${_SESSION['prenom']}");
		header('Location: ?u=explore');
	}

	public function requiresAuth() {
		$id_user = $this->verifyAuth();
		if($id_user !== false) {
			$this->applyAuth($id_user);
			return true;
		}
		else {
			$this->disconnect();
			header('Location: ?u=login&f=on');
			exit();
			return false;
		}
	}

	public function verifyAuth() {
		if(!isset($_COOKIE['session_cookie']))
			return false;

		$GLOBALS['db'] = getPdoDbObject();
		$query = $GLOBALS['db']->prepare('SELECT * FROM connexions WHERE session_cookie=:cookie AND id_user=:id_user AND last_ip=:ip');

		$query->bindParam(':cookie', $_COOKIE['session_cookie']);
		$query->bindParam(':id_user', $_SESSION['id_user']);
		$query->bindParam(':ip', $_SERVER['REMOTE_ADDR']);

		$query->execute();
		$nbRows = $query->rowCount();
		$rep = $query->fetch();

		if($nbRows <= 0) { // || intval($rep['last_ping']) < $timeout
			if($this->isAuthenticated() == true) {
				$this->disconnect();
			}
			return false;
		}
		return $rep['id_user'];
	}

	private function applyAuth($id_user) {
		$query = $GLOBALS['db']->prepare("SELECT id_user, prenom, nom, email, url_pdp, promo, pseudo_cas FROM users WHERE id_user = :id_user");
		$query->bindParam(':id_user', $id_user);
		$query->execute();
		$req = $query->fetch();


		$_SESSION['auth'] = serialize($this);
		$_SESSION['id_user'] = $req['id_user'];
		$_SESSION['prenom'] = $req['prenom'];
		$_SESSION['nom'] = $req['nom'];
		$_SESSION['email'] = $req['email'];
		$_SESSION['url_pdp'] = $req['url_pdp'];
		$_SESSION['promo'] = $req['promo'];
		$_SESSION['pseudo_cas'] = $req['pseudo_cas'];

		$this->authenticated = true;
	}

	public function disconnect() {
		session_destroy();
		$this->authenticated=false;
		if(isset($_COOKIE['session_cookie'])) {
			setcookie("session_cookie","",time()-1);
			$this->deleteCookie($_COOKIE['session_cookie']);
		}
	}

	public function deleteCookie($cookie) {
		$query = $GLOBALS['db']->prepare("DELETE FROM connexions WHERE session_cookie=:session_cookie");
		$query->bindParam(':session_cookie', $cookie);
		$query->execute();
	}

}