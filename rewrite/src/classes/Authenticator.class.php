<?

class Authenticator {
	private $authenticated;

	function __construct() {
		$this->authenticated = false;
	}

	public function isAuthenticated() { //returns whether the current user is authenticated or not
		return $this->authenticated;
	}

	public function isAuth() {
		return $this->authenticated;
	}

	public function ping() {
		global $_db;
		if(!(isset($_COOKIE['session_cookie']) && isset($_SESSION['id_user']) && isset($_SERVER['REMOTE_ADDR'])));
			return false;

		if(!$_db->ping($_COOKIE['session_cookie'], $_SESSION['id_user'], $_SERVER['REMOTE_ADDR']))
			return false;

		$_db->deleteOldConnexions();

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

	public function tryConnexion($email, $pass) {
		global $_db;
		$id_user = $_db->validCreds($email, $pass);

		if($id_user === false) {
			header('Location: ?u=login&err=creds');
			die();
		}

		$bytes = random_bytes(64); //random_bytes isn't compatible with every PHP versions (seems not to work on < 7)
		$session_cookie = bin2hex($bytes);
		$last_ip = $_SERVER['REMOTE_ADDR'];

		$_db->insertConnexion($session_cookie, $id_user, $last_ip);

		setcookie("session_cookie",$session_cookie,time()+360000000);

		$this->applyAuth($id_user);
		header('Location: ?u=explore');
		die();
	}

	public function requiresAuth() {
		$id_user = $this->verifyAuth();
		if($id_user !== false)
			return $this->applyAuth($id_user);
		else {
			$this->disconnect();
			header('Location: ?u=login&f=on');
			die();
			return false;
		}
	}

	public function verifyAuth() {
		global $_db;
		if(!isset($_COOKIE['session_cookie']) || !isset($_SESSION['id_user']) || !isset($_SERVER['REMOTE_ADDR']))
			return false;
		$status = $_db->validSessionCookie($_COOKIE['session_cookie'], $_SESSION['id_user'], $_SERVER['REMOTE_ADDR']);
		if($status === false)
			return $this->disconnect() && false;
		return $status;
	}

	private function applyAuth($id_user) {
		$req = $_db->getSelfInfos($id_user);

		$_SESSION['auth'] = serialize($this);
		$_SESSION['id_user'] = $req['id_user'];
		$_SESSION['prenom'] = $req['prenom'];
		$_SESSION['nom'] = $req['nom'];
		$_SESSION['email'] = $req['email'];
		$_SESSION['url_pdp'] = $req['url_pdp'];
		$_SESSION['promo'] = $req['promo'];
		$_SESSION['pseudo_cas'] = $req['pseudo_cas'];

		$this->authenticated = true;
		return true;
	}

	public function disconnect() {
		$this->authenticated=false;
		if(isset($_COOKIE["PHPSESSID"]))
			session_destroy();
		if(isset($_COOKIE['session_cookie'])) {
			global $_db;
			setcookie("session_cookie","",time()-1);
			$_db->deleteCookie($_COOKIE['session_cookie']);
		}
	}

}