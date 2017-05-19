<? $auth->requiresAuth();

$GLOBALS['active_view']="docView";
include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';

if(!isset($_GET['id']) || $_GET['id'] == '') {
	header('Location: ?u=explore');
	exit();
}

$id = $_GET['id'];
$document = getDocument($id);

putView($id, $_SESSION['id_user']);
$auteur = getUser($document['id_auteur']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><? echo $document['nom']?></title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


	<link rel="stylesheet" href="ressources/css/documentView.css">
	<link rel="stylesheet" href="ressources/css/navbar.css">
	<link rel="stylesheet" href="ressources/css/style.css">
	<link rel="stylesheet" href="ressources/css/comments.css">
	<script src="<? echo $GLOBALS['config']['paths']['js'].'ajax.funcs.js'?>"></script>
	<script>
		var id_doc = <? echo $id ?>;
		var cominp;
		function initDocView() {
			cominp=document.getElementById("coment-input");
			getComments();
			setInterval(getComments, 2000);
			$("#post-comment").submit(function() {
				postComment($("#comment-input").val(),$("#comment-color").val(), id_doc);
				getComments();
				return false;
			});
			changeShadow(document.getElementById('comment-color'));
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
		function changeShadow(obj){
			var type=obj.value;
			switch(type){
				case "primary":
				document.getElementById("comment-input").style.boxShadow = "inset 0 1px 1px blue";
				break;
				case "success":
				document.getElementById("comment-input").style.boxShadow = "inset 0 1px 1px green";
				break;
				case "danger":
				document.getElementById("comment-input").style.boxShadow = "inset 0 1px 1px red"; 
				break;
			}
		}
		function sendDocMail() {
			document.getElementById("sendDocMail").innerHTML="Envoi en Cours....";
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("sendDocMail").innerHTML= this.responseText;
				}
			};
			xmlhttp.open("GET", "?ajax=sendDocMail&id=" + id_doc, true);
			xmlhttp.send();
		}
	</script>
</head>
<body onload="initDocView()">
	<? include_once "layouts/navbar.php" ?>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-10">
				<h1><? echo $document['nom']?> <small>- <? echo getPromoName(getMatiere(getChapitre($document['id_chapitre'])['id_matiere'])['promo']) ?></small></h1>
				<iframe  height="500" width="800" src="<? echo $document['url'] ?>"></iframe>
			</div>
			<div class="col-md-2 col-md-offset-1 col-sm-offset-2 col-xs-offset-2 doc-sidebar-outer">
				<div class="doc-sidebar">
					
				<h2>Document</h2>
				<div class="panel panel-default"><div class="panel-heading">Nom: </div><div class="panel-body"><? echo $document['nom'] ?></div></div>
				<div class="panel panel-default"><div class="panel-heading">Uploadé par: </div><div class="panel-body"><? echo userToStr($auteur) ?></div></div>
				<div class="well"><h3><span><? echo $document['vues'] ?></span> vues</h3></div>
				<div class="well"><h3><? echo countComments($document['id_doc']) ?> commentaires</h3></div>
				<div class="col-md-2" id="sendDocmail" onclick="sendDocMail();"><button id="sendDocMail" class="btn btn-primary">Recevoir par Mail</button></div>
				</div>
			</div>
		</div>
		<div class='container'>
			<div class="col-md-6 col-md-offset-1">
				<div class="col-md-3 col-md-offset-4">
					<h3>Commentaires</h3>
				</div>
				<div id="comments-view" class="col-md-12">
				</div>
				<div id="comment comment-me">
					<div class="col-md-12">
						<form id="post-comment">
							<div class="input-group">
								<div class="input-group-addon">
									<?echo $_SESSION['prenom'].' '.$_SESSION['nom'] ?>
								</div>
								<div class="input-group-addon">
									<select name="type" id="comment-color" onchange="changeShadow(this);">
										<option value="primary" selected>Commenter</option>
										<option value="danger">Avertir</option>
										<option value="success">Recommander</option>
									</select>
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
	</div>
	<br/>
</body>
</html>