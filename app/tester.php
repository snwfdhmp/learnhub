<?
error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();

$GLOBALS['config'] = array(
	"appName" => "ICS",
	"version" => "beta 0.1",
	"domain" => "localhost:8888",
	"authenticator" => array(
		"sessionCookieLength" => 40, //length of the connexion cookie
		"connexionTimeout" => 5*3600 //if time-lastPingTime > this, ask for a reconnexion
		),
	"database" => array(
		"host"=>"localhost",
		"username"=>"dev",
		"password"=>"dev",
		"name"=>"ICS"
		),
	"paths" => array(
		"views" => "../views/",
		"actions" => "../actions/",
		"libs" => "$GLOBALS['config']['paths']['libs']"
		),
	"views" => array(
		"accueil" => "accueil.php",
		"calendar" => "calendar.php",
		"signup" => "signup.php",
		"login" => "login.php"
		),
	"actions" => array(
		"signup" => "proceedSignUp.php",
		"login" => "proceedLogin.php"
		),
	);

include_once "../actions/connectDb.php";
include("$GLOBALS['config']['paths']['libs']class/Authenticator.php");

if(!isset($_SESSION['auth']))
	$_SESSION['auth'] = new Authenticator();

$_SESSION['session_cookie'] = "someRandomInfo";
$_SESSION['id_user'] = 3;

$auth->requiresAuth();

?><h2>Welcome to ICS tester</h2><?

?><p><i>Following line should be false.</i></p><?

?><p><i>Following line should be true.</i></p><?

$_SESSION['sessionCookie'] = "tester";
$_SESSION['id_user'] = 1;
$_SESSION['last_ip'] = "127.0.0.1";
$auth->requiresAuth("tester", 1, '127.0.0.1');

echo "<br/>End of tests.";