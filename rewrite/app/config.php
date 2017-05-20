<?

/**
* 
*/
class Config
{
	// Classes and funcs
	const src_dir = array(
		"classes" => "../src/classes",
		"funcs" => "../src/funcs"
		);
	const classes = array(
		"MainController" => "MainController.class.php",
		"Provider" => "Provider.class.php",
		"Renderer" => "Renderer.class.php",
		"View" => "View.class.php",
		"Db" => "Db.class.php",
		"Authenticator" => "Authenticator.class.php",
		"Tag" => "Tag.class.php"
		);
	const funcs = array(
		);

	//Ressources
	const ressources_dir = array(
		"image" => "../ressources/img",
		"css"=>"../ressources/css",
		"js"=>"../ressources/js",
		"js-dist"=>"",
		"css-dist"=>""
		);
	const ressources = array(
		'image' => array(
			'logo' => 'logo.png'
			),
		'js-dist' => array(
			'bootstrap' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
			'fontawesome' => 'https://use.fontawesome.com/f51a5e5d23.js',
			'jquery' => 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js',
			),
		'css-dist' => array(
			'bootstrap' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'
			),
		'css' => array(
			'navbar' => 'navbar.css'
			)
		);

	//Database
	const db_host = "localhost";
	const db_user = "root";
	const db_pass = "root";
	const db_name = "ICS";

	//Search
	const search_max_result = "7"; //number max of result to be displayed

	//Authenticator
	const user_online_timeout = 600;
	const auth_timeout = 3600;
	const auth_cookie_length = 40;

	//App config
	const app_name = "LearnHub";
	const app_lang = "fr";
	const app_charset = "UTF-8";

	//Defaults
	const default_view="accueil";

	public $app_title = "LearnHub";
	
	function __construct()
	{
		# code...
	}

	public static function load_class($class)
	{
		if(array_key_exists($class, Config::classes))
		{
			include_once Config::src_dir['classes'].'/'.Config::classes[$class];
		}
		else
		{
			error('Config: Unknown class '.$class);
		}
	}
	
	public static function load_funcs($funcs)
	{
		if(array_key_exists($funcs, Config::funcs))
		{
			include_once Config::src_dir['funcs'].'/'.Config::funcs[$funcs];
		}
		else
		{
			error('Config: Unknown funcs '.$funcs);
		}
	}
}

function not_null($var) {
	return (isset($var) && $var != "" && $var != NULL);
}

function url() {
	$args = new CachingIterator(new ArrayIterator(func_get_args()));
	$url="";
	foreach ($args as $arg) {
		if($arg != "") {
			$url.=$arg;
			if($args->hasNext()) {
				$url.='/';
			}
		}
	}
	return $url;
}

?>