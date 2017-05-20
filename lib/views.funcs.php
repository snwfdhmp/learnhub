<?
include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';
include_once $GLOBALS['config']['paths']['libs'].'std.funcs.php';

function matieres_line_view($promo, $focus = 1) {
	$matieres = getMatieres($promo);

	echo '<div class="col-md-1">';
	echo '<ul class="nav nav-pills nav-stacked">';

	if($matieres == NULL) {
		echo "</div>";
		echo "<div class='col-md-10'> <h2>Il n'y a pas encore de matières pour votre promo ... <a href='?u=addCourse'>Soyez le premier à en créer une.</a></h2>
		</div>";
		return false;
	}

	foreach ($matieres as $matiere) {
		$firstChap = getFirstChap($matiere['id_matiere']);
		echo '<a class="';
		if($matiere['id_matiere'] == $focus)
			echo 'btn btn-primary';
		else
			echo 'label label-default';
		echo ' nav-btn" href="?u='.
		$GLOBALS['active_view'].'&m='.$matiere['id_matiere'].'&c='.$firstChap['id_chapitre'].'">'.$matiere['diminutif'].'</a><br/>';
	}
	echo '<a class="label label-default" href="?u=addMat&promo='.$promo.'"><i class="fa fa-plus-square" aria-hidden="true"></i></a></li>';
	echo'</ul></div>';
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
		if(isset($focus) && $matiere['id_matiere'] == $focus)
			echo ' selected';
		echo '>'.$matiere['diminutif'].'</option>';
	}
	return true;
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
		if(isset($focus) && ($chapitre['id_chapitre'] == $focus))
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
	$chapitre = getChapitre($chapitre);

	if($documents == NULL) {
		echo "<h2>Il n'y a pas encore de documents pour cette matière ... <a href='?u=addCourse&m=".$chapitre['id_matiere']."&c=".$chapitre['id_chapitre']."'>Soyez le premier à poster un document</a>";
		return false;
	}
	$i=0;
	$inners = Array();
	$top ="";
	$bottom ="";
	foreach ($documents as $document) {
		$auteur = getUser($document['id_auteur']);
		if(!isset($inners[doctypeToStr($document['doc_type'])])) $inners[doctypeToStr($document['doc_type'])] = "";

		if(! hasSeen($document['id_doc'], $_SESSION['id_user'])) {
			$notSeen = "<span class='label label-success'>Nouveau !</span>";
		} else {
			$notSeen = "";
		}
		$nbrComs = countComments($document['id_doc']);
		$vues = "<span class='label label-default'>".$document['vues']." vues</span>";
		if($nbrComs > 0)
			$coms = "<span class='label label-primary'>".$nbrComs." réactions</span>";
		else
			$coms = "";
		$inners[doctypeToStr($document['doc_type'])] .= '<tr class="doc-table-view-row"><td><a href="?u=view&id='.$document['id_doc'].'">'.$document['nom'].'</a> '.$vues.' '.$coms.' '.$notSeen.'</td><td><a href="?u=profile&id='.$auteur['id_user'].'">'.$auteur['prenom'].' '.$auteur['nom'].'</a></td><td>'.time2str($document['date_creation']).'</td></tr>';
	}
	echo "<table class='table table-hover'>
			<tr class='doc-table-view-row'><th>Nom</th><th>Auteur</th><th>Date d'ajout</th></tr>";
	foreach($GLOBALS['config']['database']['doctypes'] as $doctype) {
		if(! isset($inners[$doctype])) {
			$bottom .= "<tr><td><div class='badge badge-lg badge-default doc-table-view-type'><a href='?u=addCourse&m=".$chapitre['id_matiere']."&c=".$chapitre['id_chapitre']."&t=".$doctype."'>$doctype +</a></div></td><td></td><td></td></tr>";
		}
		else {
			$top .= "<tr><td><div class='badge badge-lg doc-table-view-type doc-table-view-type-nonvoid'>$doctype</div></td><td></td><td></td></tr>"
			.
			$inners[$doctype]
			.
			'<tr><td><a href="?u=addCourse&m='.$chapitre['id_matiere'].'&c='.$chapitre['id_chapitre'].'&t='.$doctype.'">Ajouter un document...</a></td><td></td><td></td></tr>';
		}
	}
	echo $top;
	echo $bottom;
	echo '</table>';
	return true;
}
function comments_doc_view($id_doc, $logged = false) {
	$comments = getComments($id_doc);

	if($comments==NULL) {
		echo "<p class='well'>Il n'y a pas encore de commentaires sur ce post. Soyez le premier à commenter.</p>";
		return false;
	}

	$inners = Array();

	foreach ($comments as $comment) {
		$auteur = getUser($comment['id_auteur']);
		$likes = getLikes($GLOBALS['config']['database']['type_ref']['comment'], $comment['id_com']);
		echo '
		<div class="comment">
			<div class="panel panel-'.$comment['type'].'">
				<div class="panel-heading">
					<div class="row">
					<span class="col-md-10">'.$auteur['prenom'].' '.$auteur['nom']."</span><span class='col-md-1 col-md-offset-1'>".
					($auteur['id_user'] == $_SESSION['id_user'] ? "<span class='text-right'>&#10008;</span></span>":"")
					.'
				</div></div>
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
									<button class="btn btn-default"> <span class="like-com" id="badge-like-'.$GLOBALS['config']['database']['type_ref']['comment'].'-'.$comment['id_com'].'"> '."$likes".' </span> </button><button class="btn btn-default dislike-btn" onclick="putDislike('.$GLOBALS['config']['database']['type_ref']['comment'].','.$comment['id_com'].')"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
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