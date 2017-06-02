<? 
if(!$auth->isAuthenticated()) {
	if (!empty($_SERVER['HTTP_REFERER']))
		header("Location: ".$_SERVER['HTTP_REFERER']);
	else
		header("Location: ?u=accueil");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LearnHub: Créer des comptes</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="ressources/css/signup.css">

	<script src="https://use.fontawesome.com/f51a5e5d23.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<!-- Pour les photos de profil 
		<script src="https://gist.github.com/snwfdhmp/a98c4189e3d78c06876a91b4085d3081.js"></script>
	-->

	<script>
		function setState(bool_etat, selector, default_class, to_add) {
			if(bool_etat) {
				$(selector).attr("class", default_class);
			}
			else {
				$(selector).attr("class", default_class + " " + to_add);
			}
		}

		function verifyAll() {
			prenom = verifyPrenom();
			nom = verifyNom();
			pass = verifyPass();
			email = verifyEmail();
			passconf = verifyPassConf();

			formState = prenom && nom && pass && email && passconf;
			setState(formState, "#submit", "btn btn-lg btn-primary btn-block", "inactiveButton");
			$("#submit").prop("disabled", !formState);


			return ;
		}

		function verifyEmail() {
			regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			state = (regex.test($("#email").val()));
			setState(state, "#email", "form-control attached-top", "wrong");
			return state;

		}

		function verifyPass() {
			state = ($("#pass").val().length >= 8);
			setState(state, "#pass", "form-control attached", "wrong");
			return state;
		}
		function verifyPassConf() {
			state = ($("#passconf").val() == $("#pass").val() && $("#pass").val().length >= 8)
			setState(state, "#passconf", "form-control attached-bottom", "wrong");
			return state;
		}
		function init() {
			$(".form-control").bind("keyup", verifyAll);
		}

	</script>
</head>
<body onload="init()">

	<? include_once "layouts/navbar.php" ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="account-wall">
					<h1 class="text-center login-title">Ajout de comptes automatisé</h1>
						<? if(isset($_GET['err'])) {
							if($_GET['err'] == "db")
								echo "<p class='text-danger text-center'>Erreur de connexion avec la base de données.</p>";
							if($_GET['err'] == "doubleEmail")
								echo "<p class='text-danger text-center'>Erreur: Cette addresse email est déjà utilisée.</p>";
							if($_GET['err'] == "doubleIdentity")
								echo "<p class='text-danger text-center'>Erreur: Cette personne existe déjà.</p>";
							if($_GET['err'] == "fill")
								echo "<div class='alert alert-danger'>Veuillez remplir tous les champs.</div>";
						} ?>
						<p class='text-center'>Vous pouvez ajouter des comptes de manière automatique en mettant un compte par ligne comme ceci<br/><i>prenom:nom:email@email.com:codepromo</i><br/>
						Les code promos actuellement disponibles sont : <br/>
						LE1 -> 1<br/>
						LE2 -> 2<br/>
						LE3 -> 3<br/>
						LE4 -> 4<br/>
						LE5 -> 5<br/>
						LA1 -> 6<br/>
						LA2 -> 7<br/>
						LA3 -> 8<br/>
						</p>
					<form class="form-signin" method="post" action="?u=accueil">
					<textarea name="content" style="font-size:12px" id="input-content" cols="48" rows="10" placeholder="Martin:Joly:martin.joly@ig2i.centralelille.fr:1&#10;Riad:Zoubiri:riad.zoubiri@ig2i.centralelille.fr:1&#10;Rémi:Deledalle:remi.deledalle@ig2i.centralelille.fr:2"></textarea>
					<div class="text-center"><button class="btn btn-lg btn-primary" name="action" value="addAccounts" type="submit">Ajouter les comptes</button></div>
					</form>
				</div>
				<a href="?u=accueil" class="text-center new-account">Revenir sur le site </a>
			</div>
		</div>
	</div>

</body>
</html>