<?php
if(isset($_POST['create']))
{
$root = $_POST['root'];
$pw = $_POST['pw'];
$db = mysqli_connect('localhost',$root,$pw);
if(!$db)
die('Connect Error, did you enter the right information?');
mysqli_query($db,"CREATE DATABASE IF NOT EXISTS band");
$db = mysqli_connect('localhost',$root,$pw,'band');
mysqli_multi_query($db,mysqli_escape_string(file_get_contents("create.sql")));
}
else
{
?>
<html>
<head>
<title> Band Set up page </title>
</head>
<body>
<form method="post" action="setup.php">
Enter the information for your mysql database server.
<br>
Enter Root Name: <input type="text" name="root">
<br>
Enter Root Password: <input type="password" name="pw">
<br>
<input type="submit" name="create" value="Create DB">
</form>
</body>
</html>
<?php
}
?>