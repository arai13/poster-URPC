<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<meta charset="UTF-8">
	<title>URPC 2015 Abstract Application</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://code.jquery.com/jquery-git2.min.js"></script>
	<script src="js/app.js"></script>
</head>
<body>
<div class="container">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
					<a href="./application.php" class="navbar-brand">Earlham College</a>
			</div>	
			<div class="container text-center">
<!-- 				<span>2015 Science Division</span> <br />
<span>Undergraduate Research Poster Conference </span> -->
				<ul class="nav navbar-nav navbar-right">
				<!-- User management -->
				<?php
				if(!isset($_SESSION["name"])){
					echo "
					<form class='navbar-form navbar-right' action='checklogin.php' method='post'>
                    <span> Have an account? </span>
                    <div class='form-group'>
                        <input type='text' class='form-control' name='username' placeholder='Earlham email'>
                    </div>
                    <div class='form-group'>
                        <input type='password' class='form-control' name='password' placeholder='Password'>
                    </div>
                    <button type='submit' class='btn btn-default'>Sign In</button>
                </form>
					";
				} else { 
					echo "<span> Logged in as " . $_SESSION["name"] ;
					echo "<li><a href='./logout.php'>Logout</a></li>";
				}
				?>				
			</ul>
			</div>
		</div>
	</nav>
</div>
<div class="page-wrap">
