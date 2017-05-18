<? // Yepco_officiel
include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';

$auth->requiresAuth();
$db = getPdoDbObject();
	if(!isset($_POST["promo"]) || !isset($_POST["Dimunituf"]) || !isset($_POST["nom"])){
		$query = $db->prepare("INSERT INTO `matieres`(`nom_matiere`, `diminutif`, `promo`) VALUES (:nom_mat,:dim,:promo)");
			$query->bindParam(':nom_mat', $_POST['nom']);
			$query->bindParam(':dim', $_POST["Dimunituf"]);
			$query->bindParam(':promo', $_POST["promo"]);
			$query->execute();
			header('Location: ?u=explore');
		}
	
	else{
		header('Location: ?u=addMat&x=addfail');
	}
	?>