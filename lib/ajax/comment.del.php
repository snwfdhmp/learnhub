<?php
if($auth->isAuthenticated() === false) {
	die("ERR_AUTH");
}
include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';

if(!isset($_GET['id']) || $_GET['id'] == "") {
	die('ERR_SYNT');
}

$id = $_GET['id'];
delComment($id);

exit();
?>