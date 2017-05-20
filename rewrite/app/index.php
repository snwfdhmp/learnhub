<?
//Params
error_reporting(-1);
ini_set('display_errors', 'On');

session_start();

//Includes
include_once "config.php";

Config::load_class("MainController");
Config::load_class("Db");
Config::load_class("Authenticator");

//Starting
$_MainController = new MainController(); // Every $_var is global (naming convention)
$_db = new Db();

$_auth = NULL;

if(isset($_SESSION['auth'])) {
	$_auth = unserialize($_SESSION['auth']);
	if(isset($_GET['r'])) {
		if($_GET['r']=='ping') {
			exit($_auth->ping());
		}
		else if($_GET['r']=='logout') {
			$_auth->disconnect();
			header('Location: ?u=accueil');
			exit();
		}
	}
	$_auth->ping();
}

if($_auth == NULL)
	$_auth = new Authenticator();

$_auth->verifyAuth();


//Main
$_MainController->route();


//Exit
if(!isset($_auth))
	$_auth = new Authenticator();
$_SESSION['auth'] = serialize($_auth);
$_db = null;

?>