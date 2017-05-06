<? $auth->requiresAuth();

$GLOBALS['active_view']="docView";
include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';

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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


	<link rel="stylesheet" href="../ressources/css/documentView.css">
	<link rel="stylesheet" href="../ressources/css/navbar.css">
	<link rel="stylesheet" href="../ressources/css/style.css">
	<link rel="stylesheet" href="../ressources/css/comments.css">
	<script src="<? echo $GLOBALS['config']['paths']['js'].'ajax.funcs.js'?>"></script>
	<script>
		var id_doc = <? echo $id ?>;
		function initDocView() {
			getComments();
			setInterval(getComments, 2000);
			$("#post-comment").submit(function() {
				postComment($("#comment-input").val(), id_doc);
				getComments();
				return false;
			});
		}
 
		function getComments(){
			ajaxGetAndReplace("comments&id="+id_doc, "comments-view");
		}

		function resizeFrameToContent( frame ) {
			frame.width  = frame.contentWindow.document.body.scrollWidth;
			frame.height = frame.contentWindow.document.body.scrollHeight;
		}

		function expand() {
			resizeFrameToContent(document.getElementById("doc-frame"));
		}
	</script>
</head>
<body onload="initDocView()">
	<? include_once "layouts/navbar.php" ?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h2><? echo $document['nom']?></h2>
				<iframe class="doc-frame col-md-12" height="500" src="<? echo $document['url'] ?>"></iframe>
			</div>
		</div>
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