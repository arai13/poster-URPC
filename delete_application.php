<?php
require_once('include/session_controller.php');
include "include/db_connect.php";
$user_id = $_SESSION["user_id"];
$app_id = $_GET['id'];
if($_GET['user_id'] != $user_id) {
	echo "Unauthorized operation!";
	header("Location: index.php");
	exit();
}

$conn = new mysqli("$host", "$username", "$password", "$db");

if ($conn->connect_error){
	die("Connection to the db failed: ". $conn->connect_error);
}

$sql = "DELETE FROM applications WHERE app_id='$app_id'";
if($conn->query($sql) === TRUE){
	echo "Deleted successfully";
} else {
	echo "Error deleting: ". $conn->error;
}
header("Location: application.php");
$conn->close();