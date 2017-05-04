<?php
		if($auth->isAuthenticated() === false) {
			die("ERR_AUTH");
		}
		include_once "../lib/views_constructor.php";

		if(!isset($_GET['search']) || $_GET['search'] == "") {
			die();
		}

	    $search=rawurldecode($_GET['search']);

	    search_view($search);

		exit();
?>

<? $auth->requiresAuth();