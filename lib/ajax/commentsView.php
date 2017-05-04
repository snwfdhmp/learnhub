<?php
		include_once "../lib/views_constructor.php";

		echo "Comments : ";

		if(!isset($_GET['id']) || $_GET['id'] == "") {
			echo "<p>Les commentaires de ce post n'ont pas pu être chargés.</p>";
		}

	    $id_doc=$_GET['id'];

	    comments_doc_view($id_doc);

		exit();
?>

<? $auth->requiresAuth();