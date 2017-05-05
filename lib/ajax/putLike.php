<?
	if(!$auth->isAuthenticated)
		exit();

	if(!isset($_GET['ref']) && !isset($_GET['val']) && !isset($_GET['type']) && $_GET['type'] != "" && $_GET['type'] != "" && $_GET['val'] == "")
		exit();

	include_once '../lib/db_funcs.php';

	if($_GET['val'] == "like") {
		putlike($_GET['type'], $_GET['ref'], 1);
	} else if($_GET['val'] == "dislike") {
		putlike($_GET['type'], $_GET['ref'], -1);
	}
	
	?>