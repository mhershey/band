<?php include("header.php"); ?>

<?php
$error = $user = $pass = "";

if (isset($_POST['user']))
{
	
	$user = str_replace("'","\'",$_POST['user']);
	$pass = str_replace("'","\'",$_POST['pass']);
	
	if ($user == "" || $pass == "")
	{
		$error = "Not all fields were entered<br />";
	}
	else
	{
		$query = "SELECT user,pass FROM login
				  WHERE user='$user' AND pass='$pass'";

		if (mysqli_num_rows(mysqli_query($db,$query)) == 0)
		{
			$error = "Username/Password invalid<br />";
		}
		else
		{
			
			$_SESSION['user'] = $user;
			$_SESSION['pass'] = $pass;
			echo "<h3>You are now logged in. Please
			   <a href='index.php?view=$user'>click here</a>.</h3>";
			
		}
	}
}


echo <<<_END
<h2>Member Login</h2>
<form method='post' action='account.php'><b>$error</b>
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