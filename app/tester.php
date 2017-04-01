<?
error_reporting(E_ALL);
ini_set('display_errors',1);

include_once "../actions/connectDb.php";
include("../lib/class/Authenticator.php");

echo "Welcome to ICS tester<br/>";
$auth = new Authenticator();
$auth->isCookieCorrect("e", 1, '190.190.190.190', $db);
echo "<br/>End of tests.";