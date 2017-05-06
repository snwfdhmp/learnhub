<? $GLOBALS['active_view']="accueil"; ?>
<!DOCTYPE html>
<html lang="en" id="root-dom-tag">
<head>
	<meta charset="UTF-8">
	<title>ICS</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../ressources/css/navbar.css">
	<link rel="stylesheet" href="../ressources/css/style.css">
	<? if ($auth->isAuthenticated() == true) { ?>
	<link rel="stylesheet" href="../ressources/css/sidebar.css">
	<? } ?>
	<script>
		function init() {
			<? if ($auth->isAuthenticated() == true) { ?>
			$("#main-container").addClass("col-md-8");
			$("#main-container").addClass("col-md-offset-1");
			$("#main-container").addClass("col-sm-8");
			$("#main-container").addClass("col-sm-offset-1");
			<? } ?>
		} 
	</script>
</head>
<body onload="init()">
	<? include_once "layouts/navbar.php" ?>
	<div class="container" id="main-container">
		<h1>Bienvenue sur ICS <? if($auth->isAuthenticated()) echo $_SESSION['prenom']. " !"?></h1><br/>
		<? if($auth->isAuthenticated()) {?>
			<h2>Vous n'avez aucune notification. Vous pouvez néanmoins <a href="?u=addCourse">poster un cours</a>. Ceci dit, ce texte est là pour voir s'il n'y a pas un genre d'erreur avec le menu que vous pourrez bientôt voir sur votre droite. -> oui juste ici</h2>
		<? } else {?>
			<h2>Vous n'êtes pas connecté.</h2>
		<? } ?>
	</div>
	<? include_once "layouts/sidebar.php" ?>
</body>
</html>