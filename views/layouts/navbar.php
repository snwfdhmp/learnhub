<<<<<<< HEAD
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="?u=accueil">ICS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Accueil </a></li>
        <li><a href="#">Explorer </a></li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" id="search-bar" placeholder="Rechercher">
        </div>
        <button type="submit" id="search-submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
      <? if(! $auth->isAuthenticated()) { ?>
        <li><a href="?u=login">Se connecter</a></li> 
        <? } else { ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><? echo $_SESSION['prenom']." ".$_SESSION['nom'] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Voir mon profil</a></li>
            <li><a href="#">Modifier mon profil</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Se déconnecter</a></li>
          </ul>
        </li>
        <? } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
=======
<div class="navBar">
	<a href="?v=accueil">
		<img src="../ressources/img/logo_mpm.png" alt="#" id="logo">
	</a>
	<input type="text" id="searchField" placeholder="Rechercher">
	<button id="rechercher"><i class="fa fa-search" aria-hidden="true"></i></button>
	<div class="centerDiv">
		<span id="siteTitle">IG2I COMMUNICATION SERVICE</span>
		<div class="dropdownZone">
			<button>
				<i class="fa fa-users" aria-hidden="true"></i>
			</button>
			<button>
				<i class="fa fa-comments" aria-hidden="true"></i>
			</button>
			<button onclick="onClickNotification()">
				<i class="fa fa-globe" aria-hidden="true"></i>
			</button>
		</div>
	</div>
</div>
>>>>>>> PDF-content
