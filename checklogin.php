<?php
	include "include/db_connect.php";
	$table = "users";

	mysql_connect("$host", "$username", "$password") or die("DB connection failed.");
	mysql_select_db("$db") or die("DB selection failed.");

	$username = $_POST["username"];
	$password = $_POST["password"];

	// Some security measures from mysql injection
	$username = stripslashes($username);
	$password = stripslashes($password);
	$password = stripslashes($password);
	$username = mysql_real_escape_string($username);
	$password = mysql_real_escape_string($password);

	// sql query for checking user
	$sql = "SELECT * FROM users WHERE username='$username' and password='$password'";
	$result = mysql_query($sql);
	$user = mysql_fetch_assoc($result);
	$count = mysql_num_rows($result);

	// Successful login
	if($count == 1){
		session_start();
		$_SESSION["name"] = $username;
		$_SESSION["user_id"] = $user['user_id'];
		header("Location: application.php");
	} else { 
		// Login fail
		echo "Wrong username or password";
	}
?>

