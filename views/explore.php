<? $auth->requiresAuth();
$GLOBALS['active_view']="explore";
include_once $GLOBALS['config']['paths']['libs'].'views.funcs.php';
$matiere_focused = 1;
if(isset($_GET['m']) && $_GET['m'] != "") {
	$matiere_focused=$_GET['m'];
} else {
	$matieres = getMatieres($_SESSION['promo']);
	if ($matieres != NULL) {
		$matiere_focused = $matieres[0]['id_matiere'];
	}
	else {
		$matiere_focused = -1;
	}
}
if(isset($_GET['c']) && $_GET['c'] != "") {
	$chapitre_focused=$_GET['c'];
}
else {
	$chapitres = getChapitres($matiere_focused);
	if($chapitres != NULL)
		$chapitre_focused = $chapitres[0]['id_chapitre'];
	else
		$chapitre_focused = -1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Explorer</title>

	<link rel="stylesheet" href="ressources/css/navbar.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="ressources/css/style.css">


	<link rel="apple-touch-icon" sizes="57x57" href="ressources/img/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="ressources/img/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="ressources/img/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="ressources/img/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="ressources/img/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="ressources/img/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="ressources/img/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="ressources/img/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="ressources/img/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="ressources/img/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="ressources/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="ressources/img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="ressources/img/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	
</head>
<body>
	<? include_once "layouts/navbar.php" ?>
	<div class="container" id="explore-view">
		<div class="row">
			<? 
			if(matieres_line_view($_SESSION['promo'], $matiere_focused)) {
				echo "<div class='col-md-10'>";
				if(chapitres_list_view($matiere_focused, $chapitre_focused))
					documents_table_view($chapitre_focused);
				echo "</div>";
			}

			?>
		</div>
	</div>
</body>
</html>