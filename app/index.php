<?php
session_start();

// Following GLOBALS configuration is inspired by phpSteroid (https://github.com/DarKnight1346/phpSteroid/blob/master/index.php)
$GLOBALS["config"] = array(
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

	);

$app_urls = array (
	"accueil" => "accueil.php",
	"calendar" => "calendar.php",
	"signup" => "signup.php",
	"login" => "login.php"
);

$app_actions = array (
	"signup" => "proceedSignUp.php",
	"login" => "proceedLogin.php"
);

$views = "../views/";
$actions = "../actions/";

if(!isset($_GET["u"])) {
	$_GET["u"] = "accueil";
}

if(array_key_exists($_POST["action"], $app_actions)) {
	include("../actions/proceedLogin.php");
}

if(array_key_exists($_GET["u"], $app_urls)) {
	include($views.$app_urls[$_GET["u"]]);
}

?>