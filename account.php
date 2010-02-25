<?php
include_once('class_User.inc.php');
$error = $user = $pass = "";

if (isset($_POST['user']))
{
	if(User::login($_POST['user'],$_POST['pass'])) {
		header("Location: bands.php");
	} else {
		$error = "Error Logging In";
	}
}
include("header.php");

echo <<<_END
<h2>Member Login</h2>
<b>$error</b>
<form method='post' action='account.php'>
Username <input type='text' maxlength='16' name='user'
	value='$user' /><br />
Password <input type='password' maxlength='16' name='pass'
	value='$pass' /><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<input type='submit' value='Login' />
</form>
_END;

?>

<?php include("footer.php");?>