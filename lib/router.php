<? function activeIf($view) {
	if($GLOBALS['active_view'] == $view)
		echo "class='active'";
}
?>