<?php
include_once('class_User.inc.php');
$error = $user = $pass = "";

if (isset($_POST['user']))
{
	if(User::login($_POST['user'],$_POST['pass'])) {
		header("Location: index.php");
	} else {
		$error = "Error Logging In";
	}
}
include("header.php");
if(User::isLoggedIn()) {
	?>
	Welcome back <?php echo User::getUserName();?>
	<a href="logout.php">Logout</a>
	<?php
} else {
	?>
	<h2>Member Login</h2>
	<b><?php echo $error;?></b>
	<form method='post' action='account.php'>
	Username <input type='text' maxlength='16' name='user' value='<?php echo $user;?>' /><br />
	Password <input type='password' maxlength='16' name='pass' value='<?php echo $pass;?>'> <br />
	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
	<input type='submit' value='Login' />
	</form>
	<p></p>
<p>Not a member? 
<a href="signup.php">Sign Up</a></p>
	<?php
}
?>



<?php include("footer.php");?>