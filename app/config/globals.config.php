<?

// Following GLOBALS configuration is inspired by phpSteroid (https://github.com/DarKnight1346/phpSteroid/blob/master/index.php)
$GLOBALS['config'] = array(
	"appName" => "ICS",
	"version" => "beta 0.1",
	"domain" => "localhost",
	"authenticator" => array(
		"sessionCookieLength" => 40, //length of the connexion cookie
		"connexionTimeout" => 3600, //if time-lastPingTime > this, ask for a reconnexion
		"onlineTimeout"=>20 // 20 secondes
		),
	"database" => array(
		"host"=>"localhost",
		"username"=>"dev",
		"password"=>"dev",
		"name"=>"ICS",
		"type_ref" => array("comment"=>"0", "document"=>"1"),
		"doctypes"=>array(
			1=>"Cours",
			2=>"Exercices",
			3=>"Annales",
			4=>"Corrections"
			)
		),
	"paths" => array(
		"views" => "../views/",
		"actions" => "../actions/",
		"libs" => "../lib/",
		"ajax" => "../lib/ajax/",
		"js" => "ressources/js/"
		),
	"views" => array(
		"accueil" => "accueil.php",
		"calendar" => "calendar.php",
		"signup" => "signup.php",
		"login" => "login.php",
		"addCourse" => "addCourse.php",
		"explore" => "explore.php",
		"profile" => "profile.php",
		"view" => "documentView.php",
		"addMat" => "addMat.php"
		),
	"ajax" => array(
		"getchap" => "chapitres.get.php",
		"getmat" => "matieres.get.php",
		"comments" => "comment_view.get.php",
		"postCom" => "comment.post.php",
		"search" => "search.get.php",
		"like" => "like.post.php",
		"online_users" => "online_users.get.php", 
		"sendDocMail" => "sendDocMail.get.php",
		"getlikes" => "like.get.php"
		),
	"actions" => array(
		"signup" => "proceedSignUp.php",
		"login" => "proceedLogin.php",
		"addDoc" => "proceedAddDoc.php",
		"addMat" => "proceedAddMAT.php"
		),
	"upload" => array(
		'valid_extensions' => array(
			'jpg',
			'jpeg',
			'gif',
			'png',
			'pdf',
			'txt',
			'c',
			'cpp')
		),
	"default" => array(
		"view" => "accueil"
		)
	);

?>