<?php
		if($auth->isAuthenticated() === false) {
			echo "<p>Il semblerait que vous n'êtes pas identifié</p>";
			exit();
		}

		include_once "$GLOBALS['config']['paths']['libs']/views.funcs.php";

		if(!isset($_GET['id']) || $_GET['id'] == "") {
			echo "<p>Les commentaires de ce post n'ont pas pu être chargés.</p>";
		}

	    $id_doc=$_GET['id'];

	    comments_doc_view($id_doc, $auth->isAuthenticated());

		exit();
?>