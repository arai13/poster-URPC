<?php
require_once('include/session_controller.php');
include "include/db_connect.php";
$user_id = $_SESSION["user_id"];
$author_id = $_GET['author_id'];
$conn = new mysqli("$host", "$username", "$password", "$db");

if ($conn->connect_error){
	die("Connection to the db failed: ". $conn->connect_error);
}

$sql = "DELETE FROM authors WHERE author_id='$author_id'";
if($conn->query($sql) === TRUE){
	echo "Deleted successfully";
} else {
	echo "Error deleting: ". $conn->error;
}
$previous = $_SERVER['HTTP_REFERER'];
header("Location: ".$previous);
$conn->close();