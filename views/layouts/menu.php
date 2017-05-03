<div class="menu">
	<button id="menuExpander" onclick="expandMenu()" >
		<i class="fa fa-bars" aria-hidden="true"><span class="menuText"> Menu</span></i>
	</button><br><br>
	<a href="?u=accueil">
		<button class="menuBtn">
			<i class="fa fa-home" aria-hidden="true"><span class="menuText"> Accueil</span></i>
		</button>
	</a><br>
	<a href="?u=calendar">
		<button class="menuBtn">
			<i class="fa fa-calendar" aria-hidden="true"><span class="menuText"> Evènements</span></i>
		</button>
	</a><br>
	<button class="menuBtn">
		<i class="fa fa-comments" aria-hidden="true"><span class="menuText"> Messages</span></i>
	</button><br>
	<? if(! $auth->isAuthenticated()) { ?>
		<a href="?u=login">
			<button class="menuBtn signUpText">
				<i class="fa fa-power-off" aria-hidden="true"><span class="menuText signUpText"> Se connecter</span></i>
			</button>
		</a><br>
		<a href="?u=signup">
			<button class="menuBtn signUpText">
				<i class="fa fa-plus-square" aria-hidden="true"><span class="menuText signUpText"> S'inscrire</span></i>
			</button>
		</a><br>
	<?} else {?>
		<button class="menuBtn deconnexionText">
			<i class="fa fa-power-off" aria-hidden="true"><span class="menuText deconnexionText"> Déconnexion</span></i>
		</button>
		<i class="fa fa-plus-square" aria-hidden="true"></i>
	<?}?>
</div>