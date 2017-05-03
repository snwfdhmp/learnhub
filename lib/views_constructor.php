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
}