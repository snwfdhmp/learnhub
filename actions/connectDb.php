<?
try {
	$db = new PDO('mysql:host=localhost;dbname=share2i','root','rootdbs1');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
	print "Erreur : ". $e->getMessage() . "<br/>";
	die();
}
?>