<? $auth->requiresAuth();

$GLOBALS['active_view']="explore";
include_once '../lib/views_constructor.php';

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
	<link rel="stylesheet" href="../ressources/css/addCourse.css">
	<link rel="stylesheet" href="../ressources/css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<? include_once "layouts/navbar.php" ?>
	<div class="container">
		<? 
			if(!matieres_line_view($_SESSION['promo'], $matiere_focused))
	  	   	chapitres_list_view($matiere_focused, $chapitre_focused);
		?>
	</div>
</body>
</html>