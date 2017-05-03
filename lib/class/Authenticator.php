<?
require_once ($GLOBALS['config']['paths']['libs'].'db_funcs.php');

class Authenticator {
	private $authenticated;
	public $email;
	private $id_user;
	private $db;

	function connectDb() {
		if($this->db == NULL)
			$this->db = getPdoDbObject();
	}

	function closeDb() {
		$this->db = NULL;
	}

	function __construct() {
		$authenticated = false;
		$email = "";
		$id_user = "";
	}

	public function isAuthenticated() { //returns whether the current user is authenticated or not
		return $this->authenticated;
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
		return bin2hex(random_bytes($GLOBALS["config"]["authenticator"]["sessionCookieLength"]));
	}

	private function createConnexion() {
		$cookie = $this-> generateSessionCookie();
		echo "<p>Generating a new cookie : ".$cookie."</p>";
	}


	private function validateCredentials($email, $pass) {
		$this->connectDb();
		if(strlen($pass) >= 8) {
			$query = $this->db->prepare("SELECT id_user, pass FROM users WHERE email=:email");
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
		$this->closeDb();
	}

	public function tryConnexion($email, $pass) {
		$id_user = $this->validateCredentials($email, $pass);

		$this->connectDb();

		if($id_user === false) {
			header('Location: ?u=login&err=creds');
			exit();
		}
		$bytes = random_bytes(64);
		$session_cookie = bin2hex($bytes);
		$last_ip = $_SERVER['REMOTE_ADDR'];
		$last_ping = time();

		$_SESSION['session_cookie']=$session_cookie;
		$_SESSION['email']=$email;
		$_SESSION['id_user'] = $id_user;

		//$query = $this->db->query('SELECT * FROM connexions WHERE 1');
		$query = $this->db->prepare("INSERT INTO connexions (session_cookie, id_user, last_ip, last_ping) VALUES(:session_cookie, :id_user, :last_ip, :last_ping)");
		$query->bindParam(':session_cookie', $session_cookie);
		$query->bindParam(':id_user', $id_user);
		$query->bindParam(':last_ip', $last_ip);
		$query->bindParam(':last_ping', $last_ping);

		$query->execute();

		setcookie("session_cookie",$session_cookie,time()+3600);

		$this->applyAuth($id_user);

		$this->closeDb();

		header('Location: ?u=explore');
	}

	public function requiresAuth() {
		$id_user = $this->verifyAuth();
		if($id_user !== false) {
			$this->applyAuth($id_user);
			return true;
		}
		else {
			$this->authenticated = false;
			header('Location: ?u=login');
			exit();
			return false;
		}
	}

	private function verifyAuth() {
		if(!isset($_COOKIE['session_cookie']))
			return false;

		$this->connectDb();

		$cookie = $_COOKIE['session_cookie'];
		$id_user = $_SESSION['id_user'];
		$ip = $_SERVER['REMOTE_ADDR'];

		$this->db = getPdoDbObject();
		$query = $this->db->prepare("SELECT * FROM connexions WHERE session_cookie=:cookie AND id_user=:id_user AND last_ip=:ip");

		$query->bindParam(':cookie', $cookie);
		$query->bindParam(':id_user', $id_user);
		$query->bindParam(':ip', $ip);
		$query->execute();
		$nbRows = $query->rowCount();
		$this->closeDb();

		if($nbRows <= 0) //if there's no entry in db, don't go forward
			return false;
		else 
			return $id_user;
	}

	private function applyAuth($id_user) {
		$this->connectDb();
		$query = $this->db->prepare("SELECT id_user, prenom, nom, email, url_pdp, promo, pseudo_cas FROM users WHERE id_user = :id_user");
		$query->bindParam(':id_user', $id_user);
		$query->execute();
		$req = $query->fetch();

		$this->closeDb();

		$_SESSION['auth'] = serialize($this);
		$_SESSION['id_user'] = $req['id_user'];
		$_SESSION['prenom'] = $req['prenom'];
		$_SESSION['nom'] = $req['nom'];
		$_SESSION['email'] = $req['email'];
		$_SESSION['url_pdp'] = $req['url_pdp'];
		$_SESSION['promo'] = $req['promo'];
		$_SESSION['pseudo_cas'] = $req['pseudo_cas'];

		$this->authenticated = true;
		$this->closeDb();
	}

	public function disconnect() {
		session_destroy();
		setcookie("session_cookie","",time()-1);
		header('Location: ?u=accueil');
	}

}