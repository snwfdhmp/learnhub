<?php
if($auth->isAuthenticated() === false) {
	die("ERR_AUTH");
}
include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';

if(!isset($_GET['id']) || $_GET['id'] == "") {
	die('ERR_SYNT');
}

$id_doc=$_GET['id'];
$content=rawurldecode($_GET['content']);

echo postComment($id_doc, $content, $_SESSION['id_user']);

exit();
?>

<? $auth->requiresAuth();