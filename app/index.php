<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();

require_once('config/globals.config.php');
require_once($GLOBALS['config']['paths']['libs']."db.funcs.php");

$GLOBALS['db'] = getPdoDbObject();

require_once($GLOBALS['config']['paths']['libs']."class/Authenticator.php");


$auth = NULL;

if(isset($_SESSION['auth'])) {
	$auth = unserialize($_SESSION['auth']);
	if(isset($_GET['r']) && $_GET['r']=='logout') {
		$auth->disconnect();
		header('Location: ?u=accueil');
		exit();
	}
	if(isset($_GET['r']) && $_GET['r']=='ping') {
		echo $auth->ping();
		exit();
	}
	$auth->ping();
}

if($auth == NULL)
	$auth = new Authenticator();

$auth->verifyAuth();

if(!isset($_GET['u']) || $_GET['u']=="")
	$_GET['u'] = $GLOBALS['config']['default']['view'];

//HANDLE ajax
if(isset($_GET['ajax']) && array_key_exists($_GET["ajax"], $GLOBALS['config']["ajax"]))
	include($GLOBALS['config']["paths"]["ajax"].$GLOBALS['config']["ajax"][$_GET["ajax"]]);

//HANDLE actions
if(isset($_POST['action']) && array_key_exists($_POST["action"], $GLOBALS['config']["actions"])) {
	include($GLOBALS['config']["paths"]["actions"].$GLOBALS['config']["actions"][$_POST["action"]]);
}

//HANDLE views
if(array_key_exists($_GET["u"], $GLOBALS['config']["views"]))
	include($GLOBALS['config']["paths"]["views"].$GLOBALS['config']["views"][$_GET["u"]]);
else
	die("Erreur, cet URL n'existe pas.");

?>

<script>
	function ping() {
		var req = new XMLHttpRequest();
		req.onreadystatechange = function(event) {
			if (this.readyState == 4) {
				if (this.status != 200) {
					$(".server-status").html("<i class='fa fa-plug' aria-hidden='true'></i> Serveur inaccessible");
					return false;
				} else if (this.responseText=="pong"){
					$(".server-status").html("<i class='fa fa-check-circle' aria-hidden='true'></i> Connecté");
					return true;
				} else {
					$(".server-status").html("<i class='fa fa-plug' aria-hidden='true'></i> Déconnecté");
					return false;
				}
			}
		};
		req.open("GET", "?r=ping", true);
		req.send();
	}

	function lateInitMain() {
		ping();
		$(".server-status").html("Connexion au serveur...");
		$(".server-ping-fire").on("click", function() {
			$(".server-status").html("Connexion au serveur...");
			//ping();
			alert('yo');
			return false;
		})
		window.setInterval(function() {
			if(ping() == false) {
				$("#sidebar").class('lost-connexion');
				$("#sidebar").class('lost-connexion');
			}
		}, 500);
	}

	ping();
	lateInitMain();
</script>


<?
if(!isset($auth))
	$auth = new Authenticator();
$_SESSION['auth'] = serialize($auth);
$GLOBALS['db']=null;
exit(); 
?>