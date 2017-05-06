<? include_once($GLOBALS['config']['paths']['libs']."std.funcs.php"); ?>

<nav class="navbar navbar-default">
	<div class="container-fluid navbar-custom">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="?u=accueil"><span class="glyphicon glyphicon-console"></span> ICS</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li <?activeIf('accueil')?> ><a href="?u=accueil">Accueil </a></li>
				<li <?activeIf('explore')?> ><a href="?u=explore" onclick="changeView(this)">Explorer </a></li>
			</ul>
			<form class="navbar-form navbar-left">
				<div class="form-group input-group">
					<li class="dropdown" style="list-style-type: none">
						<input type="text" class="form-control" id="search-bar" placeholder="Rechercher">
						<input id="search-toggle" type="hidden" class="dropdown-toggle" data-toggle="dropdown">
						<span class="input-group-btn">
							<button class="btn btn-default" id="search-btn" type="button">Go!</button>
						</span>
						<ul id="search-view" class="dropdown-menu"></ul>
					</li>
				</div>
				<button type="submit" id="search-submit" class="btn btn-default">Submit</button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" id="server-ping-fire"><span id="server-status"></span></a></li>
				<li><a href="?u=addCourse">+ Publier</a></li>
				<? if(! $auth->isAuthenticated()) { ?>
				<li><a href="?u=login">Se connecter</a></li> 
				<li><a href="?u=signup">S'inscrire</a></li> 
				<? } else { ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Messages</a>
					<ul class="dropdown-menu" id="online-users-view">
					</ul>
				</li>
				<li><a href="#"><i class="fa fa-bell" aria-hidden="true"></i></a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><? echo $_SESSION['prenom']." ".$_SESSION['nom'] ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="?u=profile">Voir mon profil</a></li>
						<li><a href="#">Modifier mon profil</a></li>
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

	function getOnline(){
		ajaxGetAndReplace("online_users", "online-users-view");
	}

	function changeview(obj) {
		target = this.prop('href');
		ajaxGetAndReplace(target, "root-dom-tag");
		return false;
	}

	window.setInterval(getOnline, 2000);
</script>

<script src="<? echo $GLOBALS['config']['paths']['js'].'ajax.funcs.js'?>"></script>