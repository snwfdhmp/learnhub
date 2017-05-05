<? // Yepco_officiel
include "connectDb.php";

$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$passconf = $_POST["passconf"];
$promo=$_POST["promo"];
if(strlen($prenom) > 0 && strlen($nom) > 0 && $promo>0 && $promo<10 && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($pass) >= 8 && $pass == $passconf) {
	$options = [
	"cost"=>10,
	];
	$hash = password_hash($pass, PASSWORD_DEFAULT, $options);
	$query = $db->prepare("INSERT INTO users (prenom, nom, pass, email,promo) VALUES(:prenom, :nom, :pass, :email,:promo)");
	$query->bindParam(':prenom', $prenom);
	$query->bindParam(':nom', $nom);
	$query->bindParam(':pass', $hash);
	$query->bindParam(':email', $email);
	$query->bindParam(':promo', $promo);
	$query->execute();
} ?>