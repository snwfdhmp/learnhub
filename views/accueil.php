<? $GLOBALS['active_view']="accueil";
include_once "../lib/views.funcs.php"
?>
<!DOCTYPE html>
<html lang="en" id="root-dom-tag">
<head>
	<meta charset="UTF-8">
	<title>LearnHub</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="ressources/css/navbar.css">
	<link rel="stylesheet" href="ressources/css/style.css">
	<!--autho-->
	<link rel="stylesheet" href="ressources/css/sidebar.css">
	
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
			<h1>Bienvenue sur LearnHub <? if($auth->isAuthenticated()) echo $_SESSION['prenom']. " !"?></h1><br/>
			<? if($auth->isAuthenticated()) {?>
			<h2>Vous n'avez aucune notification. Vous pouvez néanmoins <a href="?u=addCourse">poster un cours</a></h2>	
			<? if (adminOnly()) {
				echo "<h3>En tant qu'admin vous pouvez changer de promo pour la session :</h3>";
				echo "<h3>";
				select_promo_admin_change($_SESSION['promo']);
				echo "</h3>";
			}
		}
		else {?>
		<h2>Vous n'êtes pas connecté.</h2>
		<? } ?>
	</div>
	<? include_once "layouts/sidebar.php" ?>
</body>
</html>