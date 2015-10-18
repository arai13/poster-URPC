<?php
require_once('include/session_controller.php');
include "include/db_connect.php";

// Establishing db connection
$conn = new mysqli("$host", "$username", "$password", "$db");
if ($conn->connect_error){
	die("Connection to the db failed: ". $conn->connect_error);
}

$user_id = $_SESSION["user_id"];
$email = $_POST["email"];
$title = addslashes($_POST["title"]);
$abstract = addslashes($_POST["abstract"]);
$pauthor = addslashes($_POST["pauthor"]);
$department = $_POST["department"];
$authorCount = $_POST["authorCount"];
$facultyCount = $_POST["facultyCount"];
$app_id = $_POST["app_id"];
// echo $title;
// echo "\n";
// echo $abstract;
/*foreach($_POST as $key=> $value){
	echo $key . "<br />";
}*/

// Inserting to applications table
$apps = "UPDATE applications SET email='$email', title='$title', abstract='$abstract', pauthor='$pauthor', department='$department' WHERE app_id='$app_id'";
if($conn->query($apps) === TRUE) {
	echo "New record created in db.";
} else {
	echo "Error" . $conn->error;
}

//$app_id = $conn->insert_id;

// Inserting authors to authors table
foreach($_POST["authors"] as $author){
	$author_sql = "INSERT INTO authors (app_id, author_name) VALUES('$app_id', '$author')";
	if($conn->query($author_sql) === TRUE){
		echo "IT worked!";
	} else {
		echo "Error" . $conn->error;
	}
}

$cnt = 1;

foreach($_POST["faculty"] as $faculty){
	$faculty_sql = "";
	if(isset($_POST["addr".$cnt])){
			$faculty_sql = "INSERT INTO faculty (app_id, name) VALUES('$app_id', '$faculty')";
	} else {
		$ins = $_POST["institution".$cnt];
		$dep = $_POST["dep".$cnt];
		$city = $_POST["city".$cnt];
		$state = $_POST["state".$cnt];
		$postcode = $_POST["postcode".$cnt];
		$faculty_sql = "INSERT INTO faculty (app_id, name, institution, department, city, state, postcode) VALUES('$app_id', '$faculty', '$ins', '$dep', '$city', '$state', '$postcode')";
	}
	if($conn->query($faculty_sql) === TRUE){
		echo "Faculty Added!";
	} else {
		echo "Error" . $conn->error;
	}
	
	$cnt++;
}

header("Location: application.php");
