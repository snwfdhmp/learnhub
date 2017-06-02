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

$chapitre = getChapitre($document['id_chapitre']);
$matiere = getMatiere($chapitre['id_matiere']);
$promoName = getPromoName($matiere['promo']);
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
	<link rel="stylesheet" href="ressources/css/doc-view.css">
	<script src="<? echo $GLOBALS['config']['paths']['js'].'ajax.funcs.js'?>"></script>
	<script>
		var id_doc = <? echo $id ?>;
		var cominp;
		function initDocView() {
			cominp=document.getElementById("coment-input");
			getComments();
			setInterval(getComments, 2000);
			$("#post-comment").submit(function() {
				if($("#comment-input").val().replace(/\s+/g, '').length > 0) {
					postComment($("#comment-input").val(),$("#comment-color").val(), id_doc);
					getComments();
				}
				return false;
			});
			changeShadow(document.getElementById('comment-color'));
			ajaxGetAndReplace("getlikes&type=" + '<?echo $GLOBALS['config']['database']['type_ref']['document']."&ref=".$document['id_doc']?>' <? ?>, "doc-likes-count");
		}

		function getComments(){
			ajaxGetAndReplace("comments&id="+id_doc, "comments-view");
		}

		function getCommentsAndScroll() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var targetView = document.getElementById("comments-view");
					if (htmlEncode(this.responseText) != targetView.innerHTML) {
						targetView.innerHTML = unescape(this.responseText);
						$("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
					}
				}
			};
			xmlhttp.open("GET", "?ajax="+"comments&id="+id_doc, true);
			xmlhttp.send();
			xmlhttp = null;
		}

		function resizeFrameToContent( frame ) {
			frame.width  = frame.contentWindow.document.body.scrollWidth;
			frame.height = frame.contentWindow.document.body.scrollHeight;
		}

		function expand() {
			resizeFrameToContent(document.getElementById("doc-frame"));
		}
		function changeBg(obj){
			var type=obj.value;
			var shadow;
			switch(type){
				case "primary":
				shadow = "rgba(66,139,202, 0.2)";
				break;
				case "success":
				shadow = "rgba(92,184,92, 0.2)";
				break;
				case "danger":
				shadow = "rgba(217,83,79,0.2)"; 
				break;
			}
			document.getElementById("comment-input").style.background = shadow;
			document.getElementById('post-comment-btn').className = "btn btn-"+type;
		}
		function changeShadow(obj){
			var type=obj.value;
			var shadow;
			switch(type){
				case "primary":
				shadow = "inset 0 1px 1px blue";
				break;
				case "success":
				shadow = "inset 0 1px 1px green";
				break;
				case "danger":
				shadow = "inset 0 1px 1px red"; 
				break;
			}
			document.getElementById("comment-input").style.boxShadow = shadow;
		}
		function sendDocMail() {
			var btn = document.getElementById("sendDocMail");
			btn.innerHTML="Envoi en Cours....";
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					btn.innerHTML= this.responseText;
					if(this.responseText == "Erreur") {
						console.log("Erreur");
						$("#sendDocMail").prop("class", "btn btn-danger");
						btn.innerHTML="Une erreur s'est produite<br/>Merci de réessayer";
					}
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
				<h1><a href='index.php?u=explore' class='btn btn-danger btn-xs'><i class='fa fa-arrow-left' aria-hidden='true'></i> </a> <?= $document['nom']?> <small>- <?= $matiere['nom_matiere'].": ".$chapitre['nom']." [".$promoName."]"?></small></h1>
				<iframe  height="500" width="800" src="<?= $document['url'] ?>"></iframe>
			</div>
			<div class="col-md-2 col-md-offset-1 col-sm-offset-2 col-xs-offset-2 doc-sidebar-outer">
				<div class="doc-sidebar">
					<div class="panel panel-default"><div class="panel-heading">Nom: </div><div class="panel-body"><? echo $document['nom'] ?></div></div>
					<div class="panel panel-default"><div class="panel-heading">Uploadé par: </div><div class="panel-body"><a href="?u=profile&id=<? echo $auteur['id_user'] ?>"><? echo userToStr($auteur) ?></a></div></div>
					<div class="well well-sm text-center doc-like-count" id="doc-like">Note : 
						<span id="doc-likes-count">
						</span></div>
						<div class="well well-sm text-center" id="doc-like"><i class="fa fa-thumbs-o-up text-primary doc-like" aria-hidden="true" onclick="putLike(<?echo $GLOBALS['config']['database']['type_ref']['document'].",".$document['id_doc']?>)"></i><i class="fa fa-thumbs-o-down text-danger doc-dislike" aria-hidden="true" onclick="putDislike(<?echo $GLOBALS['config']['database']['type_ref']['document'].",".$document['id_doc']?>)"></i><br/>
						</div>
						<div class="well"><h3><span><? echo $document['vues'] ?></span> vues</h3></div>
						<div class="well"><h3><? echo countComments($document['id_doc']) ?> commentaires</h3></div>
						<div class="col-md-2" id="sendDocmail" onclick="sendDocMail();"><button id="sendDocMail" class="btn btn-primary">Recevoir par mail <i class="fa fa-paper-plane" aria-hidden="true"></i></button></div>

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
										<button type="submit" class="btn btn-primary" id="post-comment-btn"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
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