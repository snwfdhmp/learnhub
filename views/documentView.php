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
	<title><? echo $document['nom']?></title>

	<link rel="stylesheet" href="../ressources/css/documentView.css">
	<link rel="stylesheet" href="../ressources/css/comments.css">
	<link rel="stylesheet" href="../ressources/css/navbar.css">
	<link rel="stylesheet" href="../ressources/css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script>
		function init()
		function getComments(id_doc){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("comments-view").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "?ajax=comments&id=" + id_doc, true);
            xmlhttp.send();
        }
	</script>
</head>
<body onload="init()">
	<? include_once "layouts/navbar.php" ?>
	<div class="container">
		<h2><? echo $document['nom']?></h2>
		<div id="document-view"></div>
		<div id="comments-view"></div>
	</div>
</body>
</html>