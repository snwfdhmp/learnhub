<?
Config::load_class("Provider");
Config::load_class("MainController");
Config::load_class("Renderer");

/**
* 
*/
class View
{
	public $layouts_url = "../views/layouts";
	public $views_url = "../views";
	protected $attached_main_controller = NULL;
	protected $provider = NULL;
	
	public function __construct()
	{
		Config::load_class("Tag");
		$this->provider = new Provider();
	}

	// calling constructor with a MainController in param 1 will attach this MainController to this View. It will cause the View to use MainController provider.
	public static function withAttachedMainController(MainController $obj)
	{
		$instance = new self();
		$instance->attachMain($obj);
		return $instance;
	}

	public static function withMain(MainController $obj)
	{
		return View::withAttachedMainController($obj);
	}

	public function attachMain(MainController $obj)
	{
		$this->attached_main_controller = $obj;
		$this->provider = $obj->provider;
	}

	public function render_accueil()
	{
		global $_MainController;
		global $_auth;
		Provider::include('js-dist', 'jquery');
		Provider::include('js-dist', 'fontawesome');
		Provider::include('js-dist', 'bootstrap');
		Provider::include('css', 'navbar');
		Provider::include('css-dist', 'bootstrap');

		Renderer::render_navbar();

		$_MainController->body('
			<div class="container" id="main-container">
				<h1>Bienvenue sur '.Config::app_name.' '.($_auth->isAuth() ? $_SESSION['prenom'] : "").' ! </h1>
				'.($_auth->isAuth() ? '<h2>Vous n\'avez aucune notification. Vous pouvez néanmoins <a href="?u=addCourse">poster un cours</a></h2>' : "<h2>Vous n'êtes pas connecté").'
			</div>
			');
	}
	public function render_404()
	{
		global $_MainController;
		$_MainController->body("<h2>Erreur : Cette page n'existe pas !!</h2>");
	}



	public function provide($type, $name)
	{
		return $this->provider->provide($type, $name);
	}

	public function pr($type, $name)
	{
		return Renderer::provide_and_render($this->provider, $type, $name);
	}

}

?>