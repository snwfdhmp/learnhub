<?php
	include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';
	$id=$_GET["id"];
	$rep=SendDocMail($_GET["id"],$_SESSION['email']);
	echo "3iw";
	exit();
?>