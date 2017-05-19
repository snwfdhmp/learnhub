<?

/**
* 
*/
class Provider
{
	
	function __construct()
	{
		# code...
	}

	function provide($type, $name) {
		return $this->provide_ressource($type, $name);
	}

	public static function provide_ressource($type, $name) {
		if(array_key_exists($type, Config::ressources)) {
			if (array_key_exists($name, Config::ressources[$type])) {
				return url(Config::ressources_dir[$type], Config::ressources[$type][$name]);
			}
			else {
				global $main;
				$main->error("Provider: ${type} does not contain any named '${name}' ressource");
				return -1;
			}
		}
	}

	public static function include($type, $name) {
		global $main;
		$url = Provider::provide_ressource($type, $name);
		$include="";
		switch($type) {
			case "js-dist":
				$include="<script src=\"".$url."\"></script>";
				break;
			case "css":
				$include="<link rel='stylesheet' href='".$url."'>";
				break;
			case "css-dist":
				$include="<link rel='stylesheet' href='".$url."'>";
				break;
		}
		$main->include($include);
	}
}

?>