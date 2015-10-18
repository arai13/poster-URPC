<?php
if(isset($_SESSION["name"])){
	header("Location: application.php");
}
if(isset($_SESSION["registered"])){
	$msg = $_SESSION["registered"];
	unset($_SESSION["registered"]);
}

include 'include/header.php';
?>

<div class="container">
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<?php
				if(isset($msg)){
					echo "<div class='alert alert-success'>".$msg."</div>";
				}
			?>
			<legend>Create an account </legend>
			<form id="signup" method="post" action="register_user.php">
				<label for="username">Earlham email address</label>
				<input type="email" class="form-control" id="email" onkeydown="validateEmail()" name="username" required>
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" required>
				<br />
				<button id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
			</form>
			<br />
			<div> Forgot your password? 
			 <a href="mailto:cs-webdev@cs.earlham.edu?Subject=Password" target="_top">Contact us </a>to recover your password. </div>
			<br /><div><b> Please follow the ethical guidelines for submitting the abstract.</b> These include, but are not limited to: </div>
			<ul>
				<li>Students should know that people who made major contributions to the work should be included as authors</li>
				<li>People should have an opportunity to review an abstract that they are authored on</li>
				<li>Faculty research mentors should be consulted before abstract submission</li>
			</ul>
		</div>
	</div>
</div>

<?php
include 'include/footer.php';

