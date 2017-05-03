<div class="right">
	<? if($auth->isAuthenticated()) { ?>
		<div class="user-infos">
			<p class="username"><? echo $_SESSION['prenom']." ".$_SESSION['nom']?></p>
		</div>
	<? } ?>
	NEWSFEED
</div>