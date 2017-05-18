<? $auth->requiresAuth();
$GLOBALS['active_view']="explore";
include_once $GLOBALS['config']['paths']['libs'].'views.funcs.php';
$matiere_focused = 1;
if(isset($_GET['m']) && $_GET['m'] != "")
	$matiere_focused=$_GET['m'];
$chapitre_focused = 1;
if(isset($_GET['c']) && $_GET['c'] != "")
	$chapitre_focused=$_GET['c'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Explorer</title>

	<link rel="stylesheet" href="../ressources/css/navbar.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="../ressources/css/style.css">
</head>
<body>
	<? include_once "layouts/navbar.php" ?>
	<div class="row">
	<div class="container col-md-10 col-md-offset-1">
		<? 
			if(matieres_line_view($_SESSION['promo'], $matiere_focused))
	  	   		if(chapitres_list_view($matiere_focused, $chapitre_focused))
	  	   			documents_table_view($chapitre_focused);

		?>
	</div>
	<div class="container col-md-1"></div>
	</div>
</body>
</html>