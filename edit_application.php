<?php
require_once('include/session_controller.php');
include 'include/header.php';

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

$sql = "SELECT * FROM applications WHERE app_id='$app_id'";
$authors_sql = "SELECT * FROM authors WHERE app_id='$app_id'";
$result = $conn->query($sql);
$authors_res = $conn->query($authors_sql);
$faculty_sql = "SELECT * FROM faculty WHERE app_id='$app_id'";
$faculty_res = $conn->query($faculty_sql);
$row = $result->fetch_assoc();

?>
<div class="container">
	<form action="update_application.php" method="post" name="PosterApp">
		<div class="row">
			<div class="col-md-8 col-md-offset-1">
				<legend>Update an Abstract</legend>
				<div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required maxlength=200 value="<?php echo $row['title']; ?>">
                                </div>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
        	                                <label for="title">Presenting Author</label>
                	                        <input type="text" class="form-control" id="pauthor" name="pauthor" required maxlength=200 value="<?php echo $row['pauthor']; ?>">
                        	        </div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="department">Department</label>
                          <select class="form-control" id="department" name="department">

                        	<option value="1" <?php if($row['department']==1) echo "selected"; ?>> Biochemistry </option>
                	        <option value="2" <?php if($row['department']==2) echo "selected"; ?>> Biology </option>
        	                <option value="3" <?php if($row['department']==3) echo "selected"; ?>> Chemistry </option>
	                        <option value="4" <?php if($row['department']==4) echo "selected"; ?>> Computer Science </option>
                            <option value="5" <?php if($row['department']==5) echo "selected"; ?>> Environmental Science </option>
                            <option value="6" <?php if($row['department']==6) echo "selected"; ?>> Geology </option>
                            <option value="7" <?php if($row['department']==7) echo "selected"; ?>> Mathematics  </option>
                            <option value="8" <?php if($row['department']==8) echo "selected"; ?>> Museum Studies </option>
                            <option value="9" <?php if($row['department']==9) echo "selected"; ?>> Physics and Astronomy </option>
                            <option value="10" <?php if($row['department']==10) echo "selected"; ?>> Neuroscience </option>
                          </select>
					</div>
				</div>
				</div>
				<div class="row">
					<div class="col-md-6">
                                	        <label for="author"> Other Authors (excluding presenting author)</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					<?php
						if($authors_res->num_rows > 0) {
							echo "<span> To update a author, please delete the previous one and enter a new author. You have previously entered the following authors:</span>";
							$cntf = 1;
							while($author = $authors_res->fetch_assoc()){
								echo '<div class="row"><div class="col-md-6"><label for="author'.$cntf.'"> Author ' . $cntf . '   --   </label><span>'.$author["author_name"] . '</span> </div><div class="col-md-6"><a class="btn btn-danger" href="delete_author.php?author_id='.$author["author_id"].'"> Delete author </a></div></div><br />';
								$cntf++;
							}
						}
					?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label> Author 1 Name </label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<input type="text" class="form-control" id="authors" name="authors[]" maxlength=200 value="<?php if($authors_res->num_rows > 0) {
								while($author = $authors_res->fetch_assoc()){
									echo $author['author_name'];
									break;
								}
							} ?>">
					</div>
					<div class="col-md-3">
						<a class="btn btn-info" id="addAuthor"> Add Author </a>
					</div>
				</div>

				<div id="authorDiv">
				</div>
				<div class="row">
					<div class="col-md-12">
					<?php
						if($faculty_res->num_rows > 0) {
							echo "<span> To update a faculty, please delete the previous one and enter a new faculty. You have previously entered the following faculty:</span>";
							$cntf = 1;
							while($faculty = $faculty_res->fetch_assoc()){
								echo '<div class="row"><div class="col-md-6"><label for="faculty'.$cntf.'"> Faculty ' . $cntf . '   --   </label><span>'.$faculty["name"] . '</span> </div><div class="col-md-6"><a class="btn btn-danger" href="delete_faculty.php?faculty_id='.$faculty["faculty_id"].'"> Delete Faculty </a></div></div><br />';
								$cntf++;
							}
						}
					?>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<div class="col-md-6">
							<label for="faculty">Faculty Advisor 1</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<input type="text" class="form-control" id="faculty" name="faculty[]" maxlength=200 value="">
					</div>
					<div class="col-md-3">
						<input type="checkbox" id="defaultAddr" name="addr1" checked> From Earlham
					</div>
					<div class="col-md-3">
						<a class="btn btn-info" id="addFaculty"> Add Faculty </a>
					</div>
				</div>
				<div class="addr" id="addr1">
					<div class="row">
						<div class="col-md-6">
                		  <label for="institution">Faculty 1 Institution Name</label>
                              <input type="text" class="form-control" id="institution" name="institution1" maxlength=200>
						</div>
						<div class="col-md-6">
							        <label for="department">Faculty 1 Department</label>
									<input type="text" class="form-control" name="dep1"/>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label for="city">Institution City</label>
								<input type="text" class="form-control" id="city" name="city1" maxlength=200>
						</div>
						<div class="col-md-4">
							<label for="state">Institution State</label>
	                                        <select name="state1" id="state" class="form-control">
                                                <option value="AL">Alabama</option>
                                                <option value="AK">Alaska</option>
                                                <option value="AZ">Arizona</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="CA">California</option>
                                                <option value="CO">Colorado</option>
                                                <option value="CT">Connecticut</option>
                                                <option value="DE">Delaware</option>
                                                <option value="DC">District Of Columbia</option>
                                                <option value="FL">Florida</option>
                                                <option value="GA">Georgia</option>
                                                <option value="HI">Hawaii</option>
                                                <option value="ID">Idaho</option>
                                                <option value="IL">Illinois</option>
                                                <option value="IN">Indiana</option>
                                                <option value="IA">Iowa</option>
                                                <option value="KS">Kansas</option>
                                                <option value="KY">Kentucky</option>
                                                <option value="LA">Louisiana</option>
                                                <option value="ME">Maine</option>
                                                <option value="MD">Maryland</option>
                                                <option value="MA">Massachusetts</option>
                                                <option value="MI">Michigan</option>
                                                <option value="MN">Minnesota</option>
                                                <option value="MS">Mississippi</option>
                                                <option value="MO">Missouri</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NV">Nevada</option>
                                                <option value="NH">New Hampshire</option>
                                                <option value="NJ">New Jersey</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="NY">New York</option>
                                                <option value="NC">North Carolina</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="OH">Ohio</option>
                                                <option value="OK">Oklahoma</option>
                                                <option value="OR">Oregon</option>
                                                <option value="PA">Pennsylvania</option>
                                                <option value="RI">Rhode Island</option>
                                                <option value="SC">South Carolina</option>
                                                <option value="SD">South Dakota</option>
                                                <option value="TN">Tennessee</option>
                                                <option value="TX">Texas</option>
                                                <option value="UT">Utah</option>
                                                <option value="VT">Vermont</option>
                                                <option value="VA">Virginia</option>
                                                <option value="WA">Washington</option>
                                                <option value="WV">West Virginia</option>
                                                <option value="WI">Wisconsin</option>
                                                <option value="WY">Wyoming</option>
                                        </select>
						</div>
						<div class="col-md-4">
							<label for="postcode">Institution Postcode</label>
							<input type="text" class="form-control" id="postcode" name="postcode1" maxlength=200>
						</div>
					</div>
				</div>
				<div id="facultyDiv">
					
				</div>
				<div class="form-group">
					<label for="email">Presenting Author's email address</label>
					<input type="email" class="form-control" id="email" name="email" required value="<?php echo $row['email']; ?>">
				</div>
				<div class="form-group">
					<label for="abstract">Abstract (~250 words) </label> <div class="pull-right" id="wordCount"></div>
					<textarea class="form-control" id="abstract" rows="5" name="abstract" required maxlength=5000><?php echo $row['abstract']; ?></textarea>
				</div>
				<input type="hidden" id="facultyCount" name="facultyCount" value="1">
				<input type="hidden" id="authorCount" name="authorCount" value="1">
				<input type="hidden" id="app_id" name="app_id" value="<?php echo $app_id; ?>">
				</fieldset>
				<div class="text-center">
					<button type="submit" class="btn btn-primary" id="submit"> Update Abstract</button>
				</div>
			</div>
		</div>
	</form>
</div>

<?php
include 'include/footer.php';