<? // Yepco_officiel
include "connectDb.php";
include "../lib/authenticate.php";
	if(!is_uploaded_file($_FILES["doc"]["tmp_name"])) header('Location: ?u=accueil&x=upfail');;
	$maxsize = 31457280;
	$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png','pdf');
	$extension_upload = strtolower(substr(strrchr($_FILES['doc']['name'], '.'),1));
	if (in_array($extension_upload,$extensions_valides) && $_FILES['doc']['error']==0 && $_FILES['doc']['size'] <= $maxsize){
			$nom = md5(uniqid(rand(), true));
			$cible='../files/'.$nom;
			$resultat = move_uploaded_file($_FILES['doc']['tmp_name'],$cible);
			if($resultat){
				$query = $db->prepare("INSERT INTO documents (id_auteur, id_chapitre, type, nom, url) VALUES(:id_auteur, :id_chapitre, :type, :nom, :url)");
				$query->bindParam(':id_auteur', $_POST["auteur"]);
				$query->bindParam(':id_chapitre', $_POST["chapitre"]);
				$query->bindParam(':type', $_POST["type"]);
				$query->bindParam(':nom', $_POST["nom"]);
				$query->bindParam(':url', $cible);
				$query->execute();
				$result=1;
				header('Location: ?u=accueil&x=upsucc');
			}
	}
	else{
		header('Location: ?u=accueil&x=upfail');
	}
?>