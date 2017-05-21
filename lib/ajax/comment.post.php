<?php
if($auth->isAuthenticated() === false) {
	die("ERR_AUTH");
}
include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';

if(!isset($_GET['id']) || $_GET['id'] == "") {
	die('ERR_SYNT');
}

$id_doc=$_GET['id'];
$content=$_GET['content'];
$type=rawurldecode($_GET['type']);
echo postComment($id_doc,$content,$type,$_SESSION['id_user']);

exit();
?>

<? $auth->requiresAuth();