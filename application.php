<?php
session_start();
if(!isset($_SESSION["name"])){
	header("Location: index.php");
}
include 'include/header.php';
include "include/db_connect.php";

// Fetching the applications associated with the user_id
$table = "applications";
mysql_connect("$host", "$username", "$password") or die("DB connection failed.");
mysql_select_db("$db") or die("DB selection failed.");
$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM applications WHERE user_id='$user_id'";
$result = mysql_query($sql);
$count = mysql_num_rows($result);

?>
<div class="container">
	<h2 class="text-center">My Abstracts</h2>
	<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Abstract Title</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
	<?php
		if($count > 0) {
			while($applications = mysql_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td width='70%'> ". $applications['title'] . "</td>";
				echo "<td width='30%'> <a href='./edit_application.php?id=". $applications['app_id']."&user_id=".$applications['user_id']."' class='btn btn-warning'>Edit</a>   
				<a href='./delete_application.php?id=". $applications['app_id']."&user_id=".$applications['user_id']."' class='btn btn-danger'>Delete</a></td>";
				echo "</tr>";
			}
		}
	?>
		</tbody>
	</table>
	</div>
	<?php
		if($count == 0){
			echo "<div class='text-center alert alert-warning fade-in'>No applications found.</div> ";
		} 
	?>
	<br />
	<div class="container text-center">
		<a href="create_application.php" class="btn btn-primary">Create a new abstract</a>
	</div>
</div>

<?php




include 'include/footer.php';

