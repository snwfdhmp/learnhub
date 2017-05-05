<?
	if(! $auth->isAuthenticated()) {
		exit();
	}

	include '../lib/views_constructor.php';

	online_users_view();

	exit();
	?>