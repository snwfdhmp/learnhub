<?php

include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';
include_once $GLOBALS['config']['paths']['libs'].'std.funcs.php';

if((!isset($_POST['content'])) || $_POST['content'] == "")
	header('Location: ?u=addAccounts&err=fill');

$query = $GLOBALS['db']->prepare("INSERT INTO users (prenom, nom, pass, email,promo) VALUES(:prenom, :nom, :pass, :email,:promo)");


$verif = $GLOBALS['db']->prepare("SELECT * FROM users WHERE email=:email OR (prenom=:prenom AND nom=:nom AND promo=:promo)");

$pass = "Not initialized.";

echo '<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';

foreach(preg_split("/((\r?\n)|(\r\n?))/", $_POST['content']) as $line){
	$data = explode(":", $line);

	$verif->bindParam(':prenom', $data[0]);
	$verif->bindParam(':nom', $data[1]);
	$verif->bindParam(':email', $data[2]);
	$verif->bindParam(':promo', $data[3]);
	$verif->execute();
	$rep = $verif->fetchAll();
	if($rep == NULL){
		$query->bindParam(':prenom', $data[0]);
		$query->bindParam(':nom', $data[1]);
		$query->bindParam(':pass', $pass);
		$query->bindParam(':email', $data[2]);
		$query->bindParam(':promo', $data[3]);
		$query->execute();
		$id = $GLOBALS['db']->lastInsertId();
		$token = createInitTokenUserId($id);

		emailToken($token);
		//Envoyer le mail à $data[2]
	}
} 

$_GET['u']="viewTokens";
?>