<?

/**
* 
*/
class Renderer
{
	
	function __construct()
	{
		# code...
	}

	/*public static function render_prefab($name) {
		$func_call = 'render_'.$name;
		$renderer = new Renderer();
		if(method_exists("Renderer", $func_call)) {
			$args = new CachingIterator(new ArrayIterator(func_get_args()));
			$call = array();
			foreach ($args as $arg)
				if($arg != $name)
					array_push($call, $arg);
			call_user_func("call_user_func", array("Renderer", $func_call), $call);
		} else {
			error("Renderer: Unknown prefab ".$name);
		}
	}*/

	function render_image($src) {
		return "<img src='${src}' style='width:50px;'>";
	}

	/*public static function properties_string($properties) {
		$attr_html = "";
		if(is_array($properties)) {
			$prop_iter = new CachingIterator(new ArrayIterator($properties));
			foreach ($prop_iter as $attr) {
				$attr_html .= key($properties).'="';
				if(is_array($attr)) {
					$attr_iter = new CachingIterator(new ArrayIterator($attr));
					foreach ($attr_iter as $set_attr) {
						$attr_html .= $set_attr;
						if($attr_iter->hasNext())
							$attr_html.=' ';
					}
					$attr_html .= '"';
				}
				else {
					$attr_html .= $attr.'"';
				}
				if($prop_iter->hasNext())
					$attr_html .= ' ';
			}
		}
		return $attr_html;
	}*/

	public static function render_tag($tag, $txt = "", $properties = "") {
		return "<${tag} ".Renderer::properties_string($properties).">${txt}</${tag}>";
	}

	public static function provide_and_render($provider, $type, $name) {
		$renderer = new Renderer();
		if(! method_exists($renderer, 'render_'.$type)) {
			error('Renderer: Cannot render type '.$type);
			return -1;
		}

		$ressource = $provider->provide($type, $name);

		if($ressource == -1) {
			error('Renderer: Provider->provide has returned -1');
			return -1;
		}

		return call_user_func(array($renderer, 'render_'.$type), $ressource);
	}

	public static function render_matieres_lines() {
		$matieres = $GLOBALS['db']->getMatieres($promo);

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

	public static function render_matieres_select($promo, $focus = 1) {
		$matieres = $GLOBALS['db']->getMatieres($promo);

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

	public static function render_chapitres_list($matiere, $focus = 1) {
		$chapitres = $GLOBALS['db']->getChapitres($matiere);

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

	public static function render_chapitres_select($matiere, $focus = 1) {
		$matiere;

		$chapitres = $GLOBALS['db']->getChapitres($matiere);


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

	public static function render_promo_select($focus) {
		$promos = $GLOBALS['db']->getPromos();

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

	public static function render_documents_table($chapitre) {
		$documents = $GLOBALS['db']->getDocuments($chapitre);

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

	public static function render_navbar() {
		global $auth;
		global $main;

		$main->body('<nav class="navbar navbar-default">
		<div class="container-fluid navbar-custom">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<a class="navbar-brand" href="?u=accueil"><span class="glyphicon glyphicon-console"></span> ICS</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li '.activeIf('accueil').' ><a href="?u=accueil">Accueil </a></li>
					<li '.activeIf('explore').' ><a href="?u=explore" onclick="changeView(this)">Explorer </a></li>
				</ul>
				<form class="navbar-form navbar-left">
					<div class="form-group input-group">
						<li class="dropdown" style="list-style-type: none">
							<input type="text" class="form-control" id="search-bar" placeholder="Rechercher">
							<button class="btn btn-default" id="search-btn" type="button">Go!</button>
							<ul id="search-view" class="dropdown-menu"></ul>
							<input id="search-toggle" type="hidden" class="dropdown-toggle" data-toggle="dropdown">
						</li>
					</div>
					<button type="submit" id="search-submit" class="btn btn-default">Submit</button>
				</form>
				<ul class="nav navbar-nav navbar-right">');
					if($GLOBALS['active_view']!="accueil") {
						$main->body('<li><a href="#"><span class="server-status" class="server-ping-fire"></span></a></li>');
					}
					$main->body('<li><a href="?u=addCourse">+ Publier</a></li>');
					if(! $auth->isAuthenticated()) { 
						$main->body('<li><a href="?u=login">Se connecter</a></li><li><a href="?u=signup">S\'inscrire</a></li>');
					} 
					else { 
						$main->body('<li><a href="#"><i class="fa fa-bell" aria-hidden="true"></i></a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$_SESSION['prenom'].' '.$_SESSION['nom'].'<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="?u=profile">Voir mon profil</a></li>
								<li><a href="#">Modifier mon profil</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="?r=logout&u=accueil">Se déconnecter</a></li>
							</ul>
						</li>');
					}
					$main->body('</ul>
				</div>
			</div>
		</nav>');

		$main->body('
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

			$("#search-bar").on(\'focusin\', function() {
				$("#search-btn").animate({opacity:\'1\'}, 200);
			});
			$("#search-bar").on(\'keydown\', function() {
				if($("#search-bar").val().length > 0) {
					getSearch();
					openSearchView();
				}
				else {
					closeSearchView();
				}
			});
			$("#search-bar").on(\'keyup\', function() {
				if($("#search-bar").val().length > 0) {
					getSearch();
					openSearchView();
				}
				else {
					closeSearchView();
				}
			});
			$("#search-bar").on(\'focusout\', function() {
				$("#search-btn").animate({opacity:\'0\'}, 400);
				opened = false;
			});

			function getSearch(){
				ajaxGetAndReplace("search&search="+escape($("#search-bar").val()), "search-view");
			}

			function changeview(obj) {
				target = this.prop(\'href\');
				ajaxGetAndReplace(target, "root-dom-tag");
				return false;
			}
		</script>

		<script src="#'./*$this->provide('js', 'ajax').*/'"></script>');
	}

}

function rt($tag, $txt = "", $properties = "")
{
	return Renderer::render_tag($tag, $txt, $properties);
}

function activeIf($view) {
    if($GLOBALS['active_view'] == $view)
        return "class='active'";
}


?>