<?php
include_once('class_User.inc.php');
$error = $user = $pass = "";

if (isset($_POST['user']))
{
	if(User::create($_POST['user'],$_POST['pass'])) {
		header("Location: bands.php");
	} else {
		$error = "Error: Username already exists";
	}
}
include("header.php");

echo <<<_END
<h2>Create Account</h2>
<b>$error</b>
<p>Select a username and password.</p>
<form method='post' action='signup.php'>
Username <input type='text' maxlength='16' name='user'
	value='$user' /><br />
Password <input type='password' maxlength='16' name='pass'
	value='$pass' /><br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<input type='submit' value='Create & Login' />
</form>
_END;

?>


<?php include("footer.php");?>