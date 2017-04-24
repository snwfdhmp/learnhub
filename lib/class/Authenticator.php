<?
require_once($GLOBALS['config']['paths']['libs'].'db_funcs.php');

class Authenticator {
	private $authenticated;
	private $email;
	private $id_user;
	private $db;

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
		return bin2hex(random_bytes($GLOBALS['config']["authenticator"]["sessionCookieLength"]));
	}


	private function createConnexion() {
		$cookie = $this-> generateSessionCookie();
		echo "<p>Generating a new cookie : ".$cookie."</p>";
	}


	public function writeConnexion($pass) {
		if(strlen($pass) >= 8) {
			$query = $db->prepare("SELECT * FROM users WHERE email=:email");
			$query->bindParam(':email', $email);
			$query->execute();
			$answer = $query->fetch();

			if (password_verify($pass, $answer["pass"]))
			{
				return $answer["id_user"];
			}
			else {
				return false;
			}
		}
		else {
			return false;

		}
	}

	public function requiresAuth() {
		if($this->verifyAuth() === true)
			echo "<p style='color:green'>Fuck yeah !!!!";
		else
			echo "<p style='color:red'>What about no .... :/</p>";
	}

	private function verifyAuth() {
		if(!isset($_COOKIE['session_cookie'])) {
			header('Location: ?u=login');
			exit();
			return false;
		}
		else if(!isSessionCookieCorrect())
			return false;
		else
			return true;
	}

	private function isSessionCookieCorrect() {
		if(!isset($_COOKIE['session_cookie']))
			return false;

		$cookie = $_COOKIE['session_cookie'];
		$id_user = $_SESSION['id_user'];
		$ip = $_SERVER['REMOTE_ADDR'];

		$db = getPdoDbObject();
		$query = $db->prepare("SELECT * FROM connexions WHERE session_cookie=:cookie AND id_user=:id_user AND last_ip=:ip");
		$query->bindParam(':cookie', $cookie);
		$query->bindParam(':id_user', $id_user);
		$query->bindParam(':ip', $ip);
		$query->execute();
		$nbRows = $query->rowCount();

		$db = null;

		if($nbRows <= 0) //if there's no entry in db, don't go forward
			return 0;
		else
			return 1;
	}

}