<?
error_reporting(E_ALL);
ini_set('display_errors',1);

$conf = array(
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
		"libs" => "../lib/"
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
include("../lib/class/Authenticator.php");

?><h2>Welcome to ICS tester</h2><?

$auth = new Authenticator();
?><p><i>Following line should be false.</i></p><?
$auth->isSessionCookieCorrect("someRandomInfo", 3, '190.190.190.190');

?><p><i>Following line should be true.</i></p><?
$auth->isSessionCookieCorrect("tester", 1, '127.0.0.1');

echo "<br/>End of tests.";