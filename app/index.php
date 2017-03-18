<?php
session_start();

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