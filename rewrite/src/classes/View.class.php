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

	public function render_index()
	{
		global $main;

		Provider::include('js-dist', 'jquery');
		Provider::include('js-dist', 'bootstrap');
		Provider::include('css-dist', 'bootstrap');

		Renderer::render_navbar();

		$main->body(
			Tag::h1("Coucou".
				Tag::a("Cliquez ici")
				)
			);
	}

	public function render_profil() {
		global $main;
		Provider::include('css-dist', 'bootstrap');

		Renderer::render_navbar();

		Renderer::render_doc($id);

		$main->body(
			Tag::div(Tag::h1("Bonjour"), array("class"=>"container"))
			);
	}

	public function render_accueil()
	{
		global $main;
		global $auth;
		Provider::include('js-dist', 'jquery');
		Provider::include('js-dist', 'fontawesome');
		Provider::include('js-dist', 'bootstrap');
		Provider::include('css', 'navbar');
		Provider::include('css-dist', 'bootstrap');

		Renderer::render_navbar();

		$main->body(
			Tag::div(
				Tag::h1(
					"Bienvenue sur ".Config::app_name." !"
					).($auth->isAuthenticated() ? Tag::h3("Heureux de vous revoir ".$_SESSION['prenom']." ".$_SESSION['nom']." ! :)") : Tag::h3("Vous pouvez vous inscrire")),
				array("class"=> "container")
				)
			);
	}
	public function render_404()
	{
		global $main;
		$main->body("<h2>Erreur : Cette page n'existe pas !!</h2>");
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