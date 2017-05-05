<?
	if(!$auth->isAuthenticated())
		exit();

	if(!isset($_GET['ref']) || !isset($_GET['val']) || !isset($_GET['type']) || $_GET['type'] == "" || $_GET['type'] == "" || $_GET['val'] == "" ) {
		die("ERR_SYNT");
		exit();
	}

	include_once '../lib/db_funcs.php';

	if($_GET['val'] == "like") {
		putLike($_GET['type'], $_GET['ref'], "1");
	} else if($_GET['val'] == "dislike") {
		putLike($_GET['type'], $_GET['ref'], "-1");
	}

	exit();
	?>