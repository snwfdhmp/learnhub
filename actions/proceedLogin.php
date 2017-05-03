<? // Note à aller voir : Yepco_officiel

if(isset($_POST['email']) && isset($_POST['pass']) && isset($auth)) {
	$email = $_POST["email"];
	$pass = $_POST["pass"];

	$auth->tryConnexion($email, $pass);

	$_SESSION['auth'] = serialize($auth);
}
else {
	header('Location: ?u=login&err=undef');
}
?>