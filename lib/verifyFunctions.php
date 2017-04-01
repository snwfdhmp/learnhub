<?
function isEmail($email) { //returns whether an email is valid or not
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}
?>