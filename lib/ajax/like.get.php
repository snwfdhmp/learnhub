<?
if(!$auth->isAuthenticated())
	exit();

if(!isset($_GET['ref']) || !isset($_GET['type']) || $_GET['type'] == "" || $_GET['type'] == "") {
	die("ERR_SYNT");
	exit();
}

include_once $GLOBALS['config']['paths']['libs'].'db.funcs.php';

echo getLikes($_GET['type'], $_GET['ref']);

exit();
?>