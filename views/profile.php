<? $auth->requiresAuth();

$GLOBALS['active_view']="profile";
include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';


$id = $_SESSION['id_user'];
if(isset($_GET['id']) && $_GET['id'] != '')
	$id = $_GET['id'];

$user = getUser($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Profil</title>

	<link rel="stylesheet" href="ressources/css/navbar.css">
	<link rel="stylesheet" href="ressources/css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<? include_once "layouts/navbar.php" ?>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2><? echo $user['prenom']." ".$user['nom']." ".getNoteDisplay($user['id_user']) ?></h2>
				<div class="well well-lg">
				Adresse mail : <?= $user['email'] ?>
				<h2>Activité :</h2>
				<span class="btn btn-primary">Commentaires <span class="badge"><? echo getCommentsCount($user['id_user'])?></span></span><br/><br/>
				<span class="btn btn-success">Documents uploadés <span class="badge"><? echo getDocumentsCount($user['id_user']) ?></span></span><br/><br/>
				<span class="btn btn-danger">Note globale <span class="badge"><? echo getGlobalNote($user['id_user']) ?></span></span>
				</div><br/>
			</div>
		</div>
	</div>
</body>
</html>