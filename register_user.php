<?php
include "include/db_connect.php";
$conn = new mysqli("$host", "$username", "$password", "$db");
if ($conn->connect_error){
	die("Connection to the db failed: ". $conn->connect_error);
}

$username = $_POST["username"];
$password = $_POST["password"];

// Check if a user exists or not
$check = "SELECT * FROM users WHERE username='$username'";
$checkres = $conn->query($check);

if($checkres->num_rows >= 1){
	echo "User exists. Please go back and register with a different username"; 
	exit();
}


$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

if($conn->query($sql) === TRUE) {
	echo "New record created in db.";
} else {
	echo "Error" . $conn->error;
}

$conn->close();
session_start();
$_SESSION['registered'] = 'Account Successfully created. Please log in now';
echo $_SESSION['registered'];
header("Location: index.php");
