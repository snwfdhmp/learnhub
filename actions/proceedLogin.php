<? // Yepco_officiel
include "connectDb.php";
include "../lib/authenticate.php";

$email = $_POST["email"];
$pass = $_POST["pass"];

$login = (authenticate($email, $pass, $db) == true);

if($login) {
	$id_user = $login;
	$bytes = random_bytes(64);
	$id_cookie = bin2hex($bytes);
	$last_ip = $_SERVER['REMOTE_ADDR'];
	$last_ping = time();

	$_SESSION['id_cookie']=$id_cookie;
	$_SESSION['email']=$email;
	$_SESSION['id_user'] = $id_user;

	$query = $db->prepare("INSERT INTO connexions (id_cookie, id_user, last_ip, last_ping) VALUES(:id_cookie, :id_user, :last_ip, :last_ping)");
	$query->bindParam(':id_cookie', $id_cookie);
	$query->bindParam(':id_user', $id_user);
	$query->bindParam(':last_ip', $last_ip);
	$query->bindParam(':last_ping', $last_ping);

	$query->execute();

	/*header('Location: ?u=calendar');
	exit();*/
}
else {
	echo "nop";
}