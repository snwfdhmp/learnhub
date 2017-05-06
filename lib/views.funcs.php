<?
include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';
include_once $GLOBALS['config']['paths']['libs'].'std.funcs.php';

function matieres_line_view($promo, $focus = 1) {
	$matieres = getMatieres($promo);

	echo '<ul class="nav nav-pills nav-justified">';

	if($matieres == NULL) {
		echo "<h2>Il n'y a pas encore de documents pour votre promo ... <a href='?u=addCourse'>Soyez le premier à poster un document</a></h2>";
		return false;
	}

	foreach ($matieres as $matiere) {
		echo '<li role="presentation"';
		if($matiere['id_matiere'] == $focus)
			echo 'class="active"';
		echo '><a href="?u='.
		$GLOBALS['active_view'].'&m='.$matiere['id_matiere'].'">'.$matiere['diminutif'].'</a></li>';
	}
	echo'</ul><br/>';
	return true;
}

function matieres_select_view($promo, $focus = 1) {
	$matieres = getMatieres($promo);

	if($matieres == NULL) {
		echo "<option value='' selected disabled>Il n'y a pas encore de matière pour votre promo ... </option><a href='?u=addCourse'>Soyez le premier à créer une matière</a>";
		return false;
	}

	foreach ($matieres as $matiere) {
		echo '<option value="'.$matiere['id_matiere'].'"';
		if($matiere['id_matiere'] == $focus)
			echo ' selected';
		echo '>'.$matiere['diminutif'].'</option>';
	}
}

function chapitres_list_view($matiere, $focus) {
	$chapitres = getChapitres($matiere);

	echo '<ul class="nav nav-tabs">';

	if($chapitres == NULL) {
		echo "<h2>Il n'y a pas encore de chapitres pour cette matière ... <a href='?u=addCourse'>Soyez le premier à poster un document</a></h2>";
		return false;
	}

	foreach ($chapitres as $chapitre) {
		echo '<li role="presentation"';
		if($chapitre['id_chapitre'] == $focus)
			echo 'class="active"';
		echo '><a class="chapitre-menu" href="?u='.$GLOBALS['active_view'].'&m='.$chapitre['id_matiere'].'&c='.$chapitre['id_chapitre'].'">'.$chapitre['nom'].'</a></li>';
	}

	echo '</ul><br/>';
	return true;
}

function chapitres_select_view($matiere, $focus = 1) {
	$chapitres = getChapitres($matiere);


	if($chapitres == NULL) {
		echo "<option value='' selected disabled>Il n'y a pas encore de chapitres dans cette matière... </option><p><a href='?u=addCourse'>Soyez le premier à créer un chapitre</a></p>";
		return false;
	}

	foreach ($chapitres as $chapitre) {
		echo '<option value="'.$chapitre['id_chapitre'].'"';
		if($chapitre['id_chapitre'] == $focus)
			echo ' selected';
		echo '>'.$chapitre['nom'].'</option>';
	}
	return true;
}

function promo_select_view($focus) {
	$promos = getPromos();

	if($promos == NULL) {
		echo "<option value='' selected disabled>Il n'y a pas encore de promo dans votre école... </option><p><a href='?u=addCourse'>Soyez le premier à créer une promo</a></p>";
		return false;
	}

	foreach ($promos as $promo) {
		echo '<option value="'.$promo['id_promo'].'"';
		if($promo['id_promo'] == $focus)
			echo ' selected';
		echo '>'.$promo['nom'].'</option>';
	}
}

function documents_table_view($chapitre) {
	$documents = getDocuments($chapitre);

	if($documents == NULL) {
		echo "<h2>Il n'y a pas encore de documents pour cette matière ... <a href='?u=addCourse'>Soyez le premier à poster un document</a>";
		return false;
	}

	echo '<table class="table table-hover">';
	echo "<tr><th>Nom</th><th>Auteur</th><th>Date d'ajout</th></tr>";
	foreach ($documents as $document) {
		$auteur = getUser($document['id_auteur']);
		echo '<tr><td><a href="?u=view&id='.$document['id_doc'].'">'.$document['nom'].'</a></td><td><a href="?u=profile&id='.$auteur['id_user'].'">'.$auteur['prenom'].' '.$auteur['nom'].'</a></td><td>'.time2str($document['date_creation']).'</td></tr>';
	}

	echo '</table>';
	return true;
}

/*
function comments_doc_view($id_doc, $logged = false) {
	$comments = getComments($id_doc);

	if($comments==NULL) {
		echo "<p class='well col-md-6 col-md-offset-3'>Il n'y a pas encore de commentaires sur ce post. Soyez le premier à commenter.</p>";
		return false;
	}

	foreach ($comments as $comment) {
		$auteur = getUser($comment['id_auteur']);
		$likes = getLikes($GLOBALS['config']['database']['type_ref']['comment'], $comment['id_com']);
		echo '<div class="col-md-4 col-md-offset-4 comment">
		<div class="input-group">
			<div class="input-group-btn"><button onclick="putLike('.$GLOBALS['config']['database']['type_ref']['comment'].','.$comment['id_com'].')" class="btn btn-default">+</button><button class="btn btn-default"><span class="badge" id="badge-like-'.$GLOBALS['config']['database']['type_ref']['comment'].'-'.$comment['id_com'].'">'.$likes.'</span></button><button class="btn btn-default" onclick="putDislike('.$GLOBALS['config']['database']['type_ref']['comment'].','.$comment['id_com'].')">-</button><button class="btn btn-default">
				'.$auteur['prenom'].' '.$auteur['nom'].'</button></div>
				<div class="form-control">
					'.$comment['contenu'].'
				</div>
			</div>
		</div>';
	}
	return true;
}*/

function comments_doc_view($id_doc, $logged = false) {
	$comments = getComments($id_doc);

	if($comments==NULL) {
		echo "<p class='well col-md-6 col-md-offset-3'>Il n'y a pas encore de commentaires sur ce post. Soyez le premier à commenter.</p>";
		return false;
	}

	foreach ($comments as $comment) {
		$auteur = getUser($comment['id_auteur']);
		$likes = getLikes($GLOBALS['config']['database']['type_ref']['comment'], $comment['id_com']);
		echo '
		<div class="col-md-4 col-md-offset-4 comment">
			<div class="panel panel-danger">
				<div class="panel-heading">
					'.$auteur['prenom'].' '.$auteur['nom'].'
				</div>
				<div class="panel-body">
					'.$comment['contenu'].'
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-9 text-muted">
						'.time2str($comment['date_creation']).'
						</div>
						<div class="like-view">
							<div class="btn-toolbar" role="toolbar">
								<div class="btn-group-xs" role="group">
									<button onclick="putLike('.$GLOBALS['config']['database']['type_ref']['comment'].','.$comment['id_com'].')" class="btn btn-default like-btn"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
									<button class="btn btn-default"> <span class="like-com" id="badge-like-'.$GLOBALS['config']['database']['type_ref']['comment'].'-'.$comment['id_com'].'"> '.$likes.' </span> </button><button class="btn btn-default dislike-btn" onclick="putDislike('.$GLOBALS['config']['database']['type_ref']['comment'].','.$comment['id_com'].')"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>';
	}
	return true;
}

function search_view($search) {
	$results = searchDocuments($search);

	if($results == NULL) {
		echo "<li><a href='#'>Pas de résultat</a></li>";
		die();
	}

	foreach ($results as $result) {
		echo "<li><a href='?u=view&id=".$result['id_doc']."'>".$result['nom']."</a></li>";
	}

	return true;
}

function online_users_view() {
	$online = getOnlineUsers();

	if($online == NULL) {
		echo "<li><a href='#'>Personne en ligne actuellement</a></li>";
		die();
	}

	foreach ($online as $on) {
		$id_user = $on['id_user'];
		$user = getUser($id_user);
		echo "<li><a href='?u=profile&id=".$id_user."'><span class='green-dot'></span>".$user['prenom']." ".$user['nom']."</a></li>";
	}

	return true;
}
function online_users_sidebar() {
	$online = getOnlineUsers();

	if($online == NULL) {
		echo "<li><a href='#'>Personne en ligne actuellement</a></li>";
		die();
	}

	foreach ($online as $on) {
		$id_user = $on['id_user'];
		$user = getUser($id_user);
		echo '<div class="user-online-box"><li><a href="?u=profile&id='.$id_user.'"><span class="green-dot"></span>'.$user["prenom"].' '.$user["nom"].'</a><span class="user-online-links"> <a href="?u=profile&id='.$id_user.'"><i class="fa fa-address-card" aria-hidden="true"></i></a> <a><i class="fa fa-comments" aria-hidden="true"></i></a></span></li></div>';
	}

	return true;
}