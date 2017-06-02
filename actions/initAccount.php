<? // A regarder : Yepco_officiel
include_once "../lib/db.funcs.php";

if(!isset($_POST["prenom"]) || !isset($_POST["nom"]) || !isset($_POST["email"]) || !isset($_POST["pass"]) || !isset($_POST["passconf"]) || !isset($_POST['token'])) {
	header('Location: ?u=initAccount&err=fill');
	exit(1);
}
$token = $_POST['token'];
$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$passconf = $_POST["passconf"];
$id_user = $_POST["id_user"];

if(strlen($prenom) > 0 && strlen($nom) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($pass) >= 8 && $pass === $passconf) {
	$options = [
	"cost"=>10,
	];
	$hash = password_hash($pass, PASSWORD_DEFAULT, $options);

	$query = $GLOBALS['db']->prepare("UPDATE users SET email=:email, prenom=:prenom, nom=:nom, pass=:pass WHERE id_user=:id_user");
	$query->bindParam(':prenom', $prenom);
	$query->bindParam(':nom', $nom);
	$query->bindParam(':email', $email);
	$query->bindParam(':id_user', $id_user);
	$query->bindParam(':pass', $hash);
	if(! $query->execute()) {
		header('Location: ?u=initAccount&err=db');
		exit(1);
	}
	useToken($token);
	$auth->tryConnexion($email, $pass);
}
?>