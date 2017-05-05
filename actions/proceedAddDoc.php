<? // Yepco_officiel
include_once '$GLOBALS['config']['paths']['libs']/db.funcs.php';

$auth->requiresAuth();
$db = getPdoDbObject();

if(!is_uploaded_file($_FILES["doc"]["tmp_name"])) header('Location: ?u=accueil&x=upfail');;
	$maxsize = 31457280; // 30 Mo
	$extension_upload = strtolower(substr(strrchr($_FILES['doc']['name'], '.'),1));
	if (in_array($extension_upload,$GLOBALS['config']['upload']['valid_extensions']) && $_FILES['doc']['error']==0 && $_FILES['doc']['size'] <= $maxsize){
		$nom = md5(uniqid(rand(), true));
		$cible='../files/'.$nom;
		$resultat = move_uploaded_file($_FILES['doc']['tmp_name'],$cible);
		if($resultat){
			$query = $db->prepare("INSERT INTO documents (id_auteur, id_chapitre, doc_type, nom, url) VALUES(:id_auteur, :id_chapitre, :type, :nom, :url)");
			$query->bindParam(':id_auteur', $_SESSION['id_user']);
			$query->bindParam(':id_chapitre', $_POST["chapitre"]);
			$query->bindParam(':type', $_POST["type"]);
			$query->bindParam(':nom', $_POST["nom"]);
			$query->bindParam(':url', $cible);
			$query->execute();
			$result=1;

			$query = $db->prepare('SELECT id_doc FROM documents WHERE id_auteur=:id_auteur AND id_chapitre=:id_chapitre AND doc_type=:type AND nom=:nom AND url=:url');
			$query->bindParam(':id_auteur', $_SESSION['id_user']);
			$query->bindParam(':id_chapitre', $_POST["chapitre"]);
			$query->bindParam(':type', $_POST["type"]);
			$query->bindParam(':nom', $_POST["nom"]);
			$query->bindParam(':url', $cible);
			$query->execute();

			$id_doc = $query->fetch()['id_doc'];

			header('Location: ?u=view&id='.$id_doc);
		}
	}
	else{
		header('Location: ?u=accueil&x=upfail');
	}
	?>