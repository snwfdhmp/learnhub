<?
Config::load_class("View");
Config::load_class("Provider");


/**
* 
*/
class MainController
{
	public $provider = NULL;
	public $config;

	//different html doc parts
	public $include = "";
	public $body = "";

	function __construct()
	{
		$this->config = new Config();
		$this->provider = new Provider();
	}

	function __destruct()
	{
		print '<!DOCTYPE html>';
		print '<html lang="'.Config::app_lang.'">';
		print '<head>';
		print '<meta charset="'.Config::app_charset.'">';

		print'<title>'.$this->config->app_title.'</title>';
		print $this->include;
		print'</head>';
		print'<body>';
		print $this->body;
		print'</body>';
		print'</html>';
	}

	function call_view($view_name) {
		$func_call = 'render_'.$view_name;
		$view = new View();
		//$view = View::withMain($this);
		if(method_exists($view, $func_call)) {
			$GLOBALS['active_view'] = $view_name;
			call_user_func(array($view, $func_call));
		} else {
			call_user_func(array($view, 'render_404'));
		}
	}

	function error($err) {
		die($err);
	}

	function route() {
		if(not_null($_GET['u'])) {
			$GLOBALS['main']->call_view($_GET['u']);
		}
	}

	function body($str, $overwrite=false) {
		if($overwrite)
			$this->body="";
		$this->body.=$str;
		return true;
	}

	function include($str, $overwrite=false) {
		if($overwrite)
			$this->include="";
		$this->include.=$str;
		return true;
	}

}

function error($err) {
	if(! isset($GLOBALS['main']))
		die('No global MainController. (isset($GLOBALS[\'main\']) -> false)');
	
	$GLOBALS['main']->error($err);
}

?>