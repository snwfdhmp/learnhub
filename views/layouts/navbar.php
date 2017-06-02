<?
include_once($GLOBALS['config']['paths']['libs']."std.funcs.php");
include_once($GLOBALS['config']['paths']['libs']."views.funcs.php");

if($auth->isAuthenticated()) {
	$user_note = getGlobalNote($_SESSION['id_user']);
}

?>
<script>
	function easterEgg() {
		window.alert("Vous avez trouvé un easter egg !!");
	}
</script>

<link rel="apple-touch-icon" sizes="57x57" href="ressources/img/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="ressources/img/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="ressources/img/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="ressources/img/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="ressources/img/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="ressources/img/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="ressources/img/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="ressources/img/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="ressources/img/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="ressources/img/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="ressources/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="ressources/img/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="ressources/img/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<nav class="navbar navbar-default" id="navbar">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="?u=accueil"><span class="glyphicon glyphicon-console"></span> Learn<span class="text-warning">Hub</span></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li <?activeIf('accueil')?> ><a href="?u=accueil">Accueil </a></li>
				<li <?activeIf('explore')?> ><a href="?u=explore#explore-view" onclick="changeView(this)">Explorer </a></li>
			</ul>
			<form class="navbar-form navbar-left">
				<div class="form-group input-group">
					<li class="dropdown" style="list-style-type: none">
						<input type="text" class="form-control" id="search-bar" placeholder="Rechercher">
						<button class="btn btn-default" id="search-btn" type="button">Go!</button>
						<ul id="search-view" class="dropdown-menu"></ul>						<input id="search-toggle" type="hidden" class="dropdown-toggle" data-toggle="dropdown">
					</li>
				</div>
				<button type="submit" id="search-submit" class="btn btn-default">Submit</button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<? if($GLOBALS['active_view']!="accueil") { ?>
				<li><a href="#"><span class="server-status" class="server-ping-fire"></span></a></li>
				<? } ?>
				<li><a href="?u=addCourse">+ Publier</a></li>
				<? if(! $auth->isAuthenticated()) {?>
				<li><a href="?u=login">Se connecter</a></li> 
				<li><a href="?u=signup">S'inscrire</a></li> 
				<? } else { ?>
				<li><a href="#"><i class="fa fa-bell" aria-hidden="true"></i></a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><? echo $_SESSION['prenom']." ".$_SESSION['nom']." ".getNoteDisplay($_SESSION['id_user']) ?><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#"><span class="label label-<? echo noteToColor($user_note) ?>"><? echo $user_note ?></span> points</a></li>
						<li><a href="?u=profile">Voir mon profil</a></li>
						<li><a href="#">Modifier mon profil</a></li>
							<li onclick="easterEgg();" role="separator" class="divider"></li>
						<?php if (adminOnly()): ?>
							<li><a href="?u=addAccounts">Ajouter des comptes</a></li>
						<?php endif ?>
						<li><a href="?u=viewTokens">Etat des tokens</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="?r=logout&u=accueil">Se déconnecter</a></li>
					</ul>
				</li>
				<? } ?>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<script>
	var opened = false;

	function openSearchView() {
		if(!opened) {
			$("#search-toggle").dropdown("toggle");
			opened = true;
		}
	}

	function closeSearchView() {
		if(opened) {
			$("#search-toggle").dropdown("toggle");
			opened = false;
		}
	}

	$("#search-bar").on('focusin', function() {
		$("#search-btn").animate({opacity:'1'}, 200);
	});
	$("#search-bar").on('keydown', function() {
		if($("#search-bar").val().length > 0) {
			getSearch();
			openSearchView();
		}
		else {
			closeSearchView();
		}
	});
	$("#search-bar").on('keyup', function() {
		if($("#search-bar").val().length > 0) {
			getSearch();
			openSearchView();
		}
		else {
			closeSearchView();
		}
	});
	$("#search-bar").on('focusout', function() {
		$("#search-btn").animate({opacity:'0'}, 400);
		opened = false;
	});

	function getSearch(){
		ajaxGetAndReplace("search&search="+escape($("#search-bar").val()), "search-view");
	}

	function changeview(obj) {
		target = this.prop('href');
		ajaxGetAndReplace(target, "root-dom-tag");
		return false;
	}
</script>

<script src="<? echo $GLOBALS['config']['paths']['js'].'ajax.funcs.js'?>"></script>