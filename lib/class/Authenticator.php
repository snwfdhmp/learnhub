<?
require_once($conf['paths']['libs'].'db_funcs.php');

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
		return bin2hex(random_bytes($GLOBALS["config"]["authenticator"]["sessionCookieLength"]));
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

	public function requiresAuthentication() {
		verifyAuthenticated();
	}

	public function verifyAuthenticated() {
		if(!isset($_SESSION['sessionCookie']))
			return false;
		$sessionCookie = $_SESSION['sessionCookie'];
		if(!isSessionCookieCorrect())
			return false;
	}

	public function isSessionCookieCorrect() {
		$cookie = $_SESSION['sessionCookie'];
		$id_user = $_SESSION['id_user'];
		$ip = $_SESSION['ip'];
		$db = getPdoDbObject();
		$query = $db->prepare("SELECT * FROM connexions WHERE sessionCookie=:cookie AND id_user=:id_user AND last_ip=:ip");
		$query->bindParam(':cookie', $cookie);
		$query->bindParam(':id_user', $id_user);
		$query->bindParam(':ip', $ip);
		$query->execute();
		$nbRows = $query->rowCount();

		if($nbRows <= 0) //if there's no entry in db, don't go forward
			echo "<p>Pas de correspondances dans la base</p>";
		else
			echo "<p>Success !!!!!!!</p>";

		$db = null;
	}

}