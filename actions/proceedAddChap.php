<? // Yepco_officiel
include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';

$auth->requiresAuth();
	if(isset($_POST["matiere"]) && isset($_POST["nom"])) {
		$query = $GLOBALS['db']->prepare("SELECT * FROM chapitres WHERE id_matiere = :matiere AND nom=:nom");
			$query->bindParam(':nom', $_POST['nom']);
			$query->bindParam(':matiere', $_POST["matiere"]);
			$query->execute();
			if($query->fetchAll() != NULL)
				header('Location: ?u=addChap&x=exist');

		$query = $GLOBALS['db']->prepare("INSERT INTO `chapitres`(`nom`, `id_matiere`, `rang`) VALUES (:nom,:matiere, 100)");
			$query->bindParam(':nom', $_POST['nom']);
			$query->bindParam(':matiere', $_POST["matiere"]);
			$query->execute();
			header('Location: ?u=explore&m='.$_POST["matiere"].'&c='.$GLOBALS['db']->lastInsertId());
		}
	
	else{
		header('Location: ?u=addChap&x=fill');
	}
	?>