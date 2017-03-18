<?
try {
	error_reporting(E_ALL);
	ini_set('display_errors',1);
	$db = new PDO('mysql:host=localhost;dbname=ICS', 'root', 'root');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	print "Erreur : ". $e->getMessage() . "<br/>";
	die();
}
?>