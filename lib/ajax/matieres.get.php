<?php

include_once $GLOBALS['config']['paths']['libs'].'views.funcs.php';

$id_promo=$_GET['p'];

matieres_select_view($id_promo);

exit();
?>