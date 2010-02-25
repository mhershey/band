<?php
/**
User::create($username,$password);
User::isLoggedIn(); //Boolean
User::login($username,$password);  //Returns false if incorrect data
User::logout();
*/
if(!class_exists('User')) {
class User {
	public static function create($username,$password) {
		$safeUsername = str_replace("'","\'",$username);
		$safePassword = str_replace("'","\'",$password);
		include("db_connect.php");
		mysqli_query($db,"INSERT INTO User (username,password) VALUES('$safeUsername',SHA('$safePassword'))");
		User::login($username,$password);
	}
	
	public static function isLoggedIn() {
		session_start();
		if(isset($_SESSION['userId'])) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function login($username,$password) {
		$safeUsername = str_replace("'","\'",$username);
		$safePassword = str_replace("'","\'",$password);
		include("db_connect.php");
		$result = mysqli_query($db,"SELECT * FROM User WHERE username='$safeUsername' AND password=SHA('$safePassword') LIMIT 1");
		if(mysqli_num_rows($result)==0) {
			return false; //No User Found
		} else {
			$row = mysqli_fetch_array($result);
			session_start();
			$_SESSION['userId'] = $row['userId'];
			return true;
		}
	}
	
	public static function logout() {
		session_destroy();
	}
}
}
?>