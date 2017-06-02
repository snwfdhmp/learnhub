<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();


//inclu le fichier de config adapté à l'environnement actuel
if($_SERVER['SERVER_ADDR'] == "::1")
	require_once('config/globals.config.php');
else
	require_once('config/esy.config.php');

//inclu les libs
require_once($GLOBALS['config']['paths']['libs']."db.funcs.php");
require_once($GLOBALS['config']['paths']['libs']."std.funcs.php");
require_once($GLOBALS['config']['paths']['libs']."class/Authenticator.php");

//crée une instance PDO pour la bdd
$GLOBALS['db'] = getPdoDbObject();

//initialisation de l'Authenticator
$auth = NULL;

//récupération si existant + "superactions"
if(isset($_SESSION['auth'])) {
	$auth = unserialize($_SESSION['auth']);
	if(isset($_GET['r'])) {
		switch ($_GET['r']) {
			case 'logout':
			$auth->disconnect();
			header('Location: ?u=accueil');
			exit();
			break;
			case 'ping':
			echo $auth->ping();
			exit();
			case 'setpromo':
			if(isset($_GET['promo'])) {
				$_SESSION['force_promo']=true;
				$_SESSION['promo']=$_GET['promo'];
			}
			break;
			case 'emailToken':
			if(isset($_GET['id'])) {
				emailToken($_GET['id']);
			}
			break;
			case 'delToken':
			if(isset($_GET['id'])) {
				delToken($_GET['id']);
			}
			break;
			default:
			break;
		}
	}
	
	$auth->ping();
}

//force_promo si admin
if((!isset($_SESSION['force_promo'])) || $_SESSION['force_promo'] != true)
				$_SESSION['force_promo']=false;

//si pas de $auth récupéré de la session, on en créé un
if($auth == NULL)
	$auth = new Authenticator();

//l'utilisateur est-il connecté ?
$auth->verifyAuth();

//set vue par défaut
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
if(array_key_exists($_GET["u"], $GLOBALS['config']["views"])) {
	$GLOBALS['active_view'] = $_GET['u'];
	include($GLOBALS['config']["paths"]["views"].$GLOBALS['config']["views"][$_GET["u"]]);
}
else
	die("Erreur, cet URL n'existe pas.");

?>

<script>
	//fonction de ping
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