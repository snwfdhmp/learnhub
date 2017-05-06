<?  if($auth->isAuthenticated() == true) {

include_once $GLOBALS['config']['paths']['libs'].'views.funcs.php'; ?>

<div class="sidebar">
	<h2>En ligne :</h2>
	<? online_users_sidebar() ?>
</div>


<? } ?>