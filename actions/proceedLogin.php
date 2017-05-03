<? // Note à aller voir : Yepco_officiel
include "connectDb.php";
include "../lib/authenticate.php";

if(isset($_POST['email']) && isset($_POST['pass']) && isset($auth)) {
$email = $_POST["email"];
$pass = $_POST["pass"];

$auth->tryConnexion($email, $pass);

$_SESSION['auth'] = serialize($auth);

header('Location: ?u=accueil');
exit();
}
else {
	header('Location: ?u=login&err=undef');
}