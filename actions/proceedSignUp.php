<? // Yepco_officiel
include "connectDb.php";

$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$passconf = $_POST["passconf"];

if(strlen($prenom) > 0 && strlen($nom) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($pass) >= 8 && $pass == $passconf) {
	
	$salt = openssl_random_pseudo_bytes(262);

	$options = [
	"cost"=>10,
	];
	$hash = password_hash($pass, PASSWORD_DEFAULT, $options);

	$query = $db->prepare("INSERT INTO users (prenom, nom, pass, email) VALUES(:prenom, :nom, :pass, :email)");
	$query->bindParam(':prenom', $prenom);
	$query->bindParam(':nom', $nom);
	$query->bindParam(':pass', $hash);
	$query->bindParam(':email', $email);
	$req = "INSERT INTO users (prenom, nom, pass, email) VALUES('".$prenom."','".$nom."', '".$pass."', '".$email."')";
	$query = $db->exec($req);
	$query->execute();
} ?>