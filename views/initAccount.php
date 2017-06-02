<? 
include_once "../lib/db.funcs.php";
if($auth->isAuthenticated() && (!isset($_GET['f']) || $_GET['f'] != "on")) {
	if (!empty($_SERVER['HTTP_REFERER']))
		header("Location: ".$_SERVER['HTTP_REFERER']);
	else
		header("Location: ?u=accueil");
}

if(!isset($_GET['token']))
	exit("Erreur: Pas de token spécifié.");
$id_user = getInitTokenUserId($_GET['token']);

if($id_user === false) {
	exit("Ce token n'existe pas.");
}

$user = getUser($id_user);

if($user === false) {
	exit("Ce token n'est pas valide.");
}

	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>LearnHub: Préférences</title>
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

		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-md-offset-4">
					<div class="account-wall">
						<h1 class="text-center login-title">Activez votre compte LearnHub</h1>
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
						<form class="form-signin" method="post" action="?u=accueil">
							<input type="hidden" name="token" value="<?= $_GET['token'] ?>">
							<input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
							<input type="hidden" id="action" name="action" value="initAccount">
							<input type="text" id="prenom" name="prenom" class="form-control attached-top" placeholder="Prénom" value="<?= $user['prenom'] ?>" required>
							<input type="text" id="nom" name="nom" class="form-control attached" placeholder="Nom" value="<?= $user['nom'] ?>" required >
							<input type="text" id="email" name="email" class="form-control attached-top" placeholder="Email" value="<?= $user['email'] ?>" required >
							<input type="password" id="pass" name="pass" class="form-control attached" placeholder="Mot de passe" required autofocus>
							<input type="password" id="passconf" name="passconf" class="form-control attached-bottom" placeholder="Confirmer le mot de passe" required>
							<button class="btn btn-lg btn-primary btn-block" id="submit" type="submit">
								Activer mon compte</button>
							</form>
						</div>
						<a href="?u=login" class="text-center new-account">J'ai déjà un compte </a>
					</div>
				</div>
			</div>

		</body>
		</html>