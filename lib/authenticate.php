<?

function authenticate($email, $pass, $db) {
	if(filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($pass) >= 8) {
		$query = $db->prepare("SELECT * FROM users WHERE email=:email");
		$query->bindParam(':email', $email);
		$query->execute();
		$answer = $query->fetch();

		if (password_verify($pass, $answer["pass"]))
		{
			return $answer["id_user"];
		}
		else {
			return false;
		}
	}
	else {
		echo false;

	}
}


function verifyConnexion($id_cookie, $db, $id_user) {
	if($id != "" && $cookie != "" && isset($db)) {
		$query = $db->prepare("SELECT * FROM users WHERE id_cookie=:id_cookie AND id_user=:id_user");
		$query->bindParam(':id_cookie', $id_cookie);
		$query->bindParam(':id_user', $id_user);
		
	}
}
?>