<?php
session_start();
if(isset($_SESSION["name"])) {
	unset($_SESSION["name"]);	
	unset($_SESSION["user_id"]);
}
header("Location: index.php");
?>