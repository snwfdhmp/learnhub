<? $GLOBALS['active_view']="accueil"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ICS</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../ressources/css/style.css">
	<link rel="stylesheet" href="../ressources/css/menu.css">
	<link rel="stylesheet" href="../ressources/css/navbar.css">


	<script>
		function init() {
			addArea= document.getElementById("addArea");
			itemsArea= document.getElementById("itemsArea");
		}

		function getSubjects(obj){
			promo=obj.value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("subjects").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "../actions/getSubjects.php?p=" + promo, true);
			xmlhttp.send();
		}
		function getChap(obj){
			mat=obj.value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("chaps").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "../actions/getSubjects.php?m=" + mat, true);
			xmlhttp.send();
		}
	</script>
</head>
<body onload="init()">
	<? include_once "layouts/navbar.php" ?>
	<div class="container">
		<h1>Bienvenue sur ICS <? if($auth->isAuthenticated()) echo $_SESSION['prenom']. " !"?></h1><br/>
		<? if($auth->isAuthenticated()) {?>
			<h2>Vous n'avez aucune notification. Vous pouvez néanmoins <a href="?u=addCourse">poster un cours</a>.</h2>
		<? } else {?>
			<h2>Vous n'êtes pas connecté.</h2>
		<? } ?>
	</div>
</body>
</html>