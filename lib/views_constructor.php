<?
include_once '../lib/db_funcs.php';

function matieres_line_view($promo, $focus = 1) {
	$matieres = getMatieres($promo);

	echo '<ul class="nav nav-pills nav-justified">';

	if($matieres == NULL) {
		echo "<h2>Il n'y a pas encore de documents pour votre promo ... <a href='?u=addCourse'>Soyez le premier à poster un document</a>";
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

	echo '<ul class="nav nav-tabs nav-justified">';

	if($chapitres == NULL) {
		echo "<h2>Il n'y a pas encore de documents pour cette matière ... <a href='?u=addCourse'>Soyez le premier à poster un document</a>";
		return false;
	}

	foreach ($chapitres as $chapitre) {
		echo '<li role="presentation"';
		if($chapitre['id_chapitre'] == $focus)
			echo 'class="active"';
		echo '><a href="?u='.$GLOBALS['active_view'].'&m='.$chapitre['id_matiere'].'&c='.$chapitre['id_chapitre'].'"</a>'.$chapitre['nom'].'</li>';
	}

	echo '</ul>';
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
		echo "<option value='' selected disabled>Il n'y a pas encore de promos dans votre école... </option><p><a href='?u=addCourse'>Soyez le premier à créer une promo</a></p>";
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
		echo '<tr><td>'.$document['nom'].'</td><td><a href="?u=profile&id='.$auteur['id_user'].'">'.$auteur['prenom'].' '.$auteur['nom'].'</a></td><td>'.$document['date_creation'].'</td></tr>';
	}

	echo '</table>';
	return true;
}

function comments_doc_view($id_doc) {
	$comments = getComments($id_doc);

	if($comments==NULL) {
		echo "<p>Les commentaires de ce post n'ont pas pu être chargés.</p>";
		return false;
	}

	foreach ($comments as $comment) {
		$auteur = getUser($comment['id_auteur']);
		echo '<div class="panel panel-default">
		<div class="panel-heading">
		<h3 class="panel-title">'.$auteur['prenom'].' '.$auteur['nom'].'</h3>
		</div>
		<div class="panel-body">
			'.$comment['contenu'].'
		</div>
	</div>';
	}

	return true;

}