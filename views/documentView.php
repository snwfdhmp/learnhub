<? $auth->requiresAuth();

$GLOBALS['active_view']="profile";
include_once '../lib/db_funcs.php';

if(!isset($_GET['id']) || $_GET['id'] == '') {
	header('Location: ?u=explore');
	exit();
}

$id = $_GET['id'];
$document = getDocument($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Explorer</title>

	<link rel="stylesheet" href="../ressources/css/navbar.css">
	<link rel="stylesheet" href="../ressources/css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<? include_once "layouts/navbar.php" ?>
	<div class="container">
		<h2><? echo $user['prenom']." ".$user['nom'] ?></h2>
		<div class="text-center"><p>Contact : <a mailto="<? echo $user['email'] ?>"><? echo $user['email'] ?></a></p></div>
	</div>
</body>
</html>