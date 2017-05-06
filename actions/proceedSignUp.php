<? // Yepco_officiel
include_once "../lib/db.funcs.php";

if(!isset($_POST["prenom"]) || !isset($_POST["nom"]) || !isset($_POST["email"]) || !isset($_POST["pass"]) || !isset($_POST["passconf"]) || !isset($_POST["promo"])) {
	header('Location: ?u=signup&err=fill');
	exit(1);
}

$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$passconf = $_POST["passconf"];
$promo = $_POST["promo"];

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
	$auth->tryConnexion($email, $pass);
} ?>