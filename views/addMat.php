<? 
$auth->requiresAuth();
$GLOBALS['active_view']="addCourse";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link rel="stylesheet" href="../ressources/css/navbar.css">
	<link rel="stylesheet" href="../ressources/css/addCourse.css">
	<link rel="stylesheet" href="../ressources/css/menu.css">
	<link rel="stylesheet" href="../ressources/css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script>
		
	</script>
</head>
<body>

	<?
	if(isset($_GET["x"]) && $_GET["x"]=="addFail")
		echo '<p>Ajout Echoué</p>';
	if(isset($_GET["x"]) && $_GET["x"]=="addSucc")
		echo '<p>Ajout Réussi</p>';
	?>

	<a href="?u=accueil">
		<button class="btn btn-danger" style="float: right; margin-right: 150px;">Retour</button>
	</a>
	<div class="container">
			<h1>Ajouter une Matière</h1>
			<? include_once('layouts/addMatForm.php') ?>
		</div>
	</div>
</body>