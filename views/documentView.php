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
		var id_doc = <? echo $id ?>;
		function init() {
			getComments();
			setInterval(getComments, 2000);
			$("#post-comment").submit(function() {
				sendComment($("#comment-input").val());
				getComments();
				return false;
			});
		}

		function getComments(){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var commentsView = document.getElementById("comments-view");
					if (this.responseText != commentsView.innerHTML)
						commentsView.innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET", "?ajax=comments&id=" + id_doc, true);
			xmlhttp.send();
		}

		function sendComment(text){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if (this.responseText !== false) {
						document.getElementById("comment-input").innerHTML = "";
					}
				}
			};
			xmlhttp.open("GET", "?ajax=postCom&id=" + id_doc +"&content="+escape(text), true);
			xmlhttp.send();
		}
	</script>
</head>
<body onload="init()">
	<? include_once "layouts/navbar.php" ?>
	<div class="container">
		<h2><? echo $document['nom']?></h2>
		<div id="document-view"></div>

		<div class='container'>
			<h3>Commentaires</h3>
			<div id="comments-view"></div>
			<div id="comment comment-me">
				<div class="col-md-6 col-md-offset-3">
					<form id="post-comment">
					<div class="input-group">
						<div class="input-group-addon">
							<?echo $_SESSION['prenom'].' '.$_SESSION['nom'] ?>
						</div>
						<input id="comment-input" type="text" class="form-control" placeholder="Poster un commentaire">
						<div class="input-group-btn">
							<input type="submit" class="btn btn-primary" value="Poster">
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<br/>
</body>
</html>