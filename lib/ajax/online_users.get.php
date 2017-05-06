<?
if(! $auth->isAuthenticated()) {
	exit();
}

include $GLOBALS['config']['paths']['libs'].'views.funcs.php';

online_users_sidebar();

exit();
?>