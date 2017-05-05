<?php
		include_once "$GLOBALS['config']['paths']['libs']/views.funcs.php";

	    $id_matiere=$_GET['m'];

	    chapitres_select_view($id_matiere);

		exit();
?>