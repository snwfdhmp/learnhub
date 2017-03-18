<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Se connecter - ICS</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/f51a5e5d23.js"></script>

    <link rel="stylesheet" href="../ressources/css/login.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <h1 class="text-center login-title">Connectez-vous pour utiliser ICS</h1>
                <div class="profile-img">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                </div>
                <form class="form-signin" method="post">
                <input type="hidden" name="action" id="action" value="login">
                <input type="text" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Mot de passe" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Se connecter</button>
                <label class="checkbox pull-left">
                    <input type="checkbox" value="remember-me">
                    Se souvenir de moi
                </label>
                <a href="#" class="pull-right need-help">Besoin d'aide? </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="?u=signup" class="text-center new-account">Créer un compte </a>
        </div>
    </div>
</div>
    
</body>
</html>