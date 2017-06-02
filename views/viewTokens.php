<? $auth->requiresAuth();

$GLOBALS['active_view']="docView";
include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LearnHub: Admin</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


	<link rel="stylesheet" href="ressources/css/navbar.css">
	
</head>
<body>
	<? include_once "layouts/navbar.php" ?>
	<div class="container">
		<h1>Overview des tokens</h1>
		<? tokens_list_view($_SESSION['id_user']); ?>
	</div>
</body>
</html>