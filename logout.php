<?php
require_once('class_User.inc.php');
User::logout();
header("Location: account.php");
exit();
?>