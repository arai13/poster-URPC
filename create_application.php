<?php
require_once('include/session_controller.php');
include 'include/header.php';
?>
<div class="container">
	<form action="save_application.php" method="post" name="PosterApp">
		<div class="row">
			<div class="col-md-8 col-md-offset-1">
				<legend>Create Abstract</legend>
				<div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required maxlength=200>
                                </div>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
        	                                <label for="title">Presenting Author</label>
                	                        <input type="text" class="form-control" id="pauthor" name="pauthor" required maxlength=200>
                        	        </div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="department">Department</label>
                          <select class="form-control" id="department" name="department">
                        	<option value="1"> Biochemistry </option>
                	        <option value="2"> Biology </option>
        	                <option value="3"> Chemistry </option>
	                        <option value="4"> Computer Science </option>
                            <option value="5"> Environmental Science </option>
                            <option value="6"> Geology </option>
                            <option value="7"> Mathematics  </option>
                            <option value="8"> Museum Studies </option>
                            <option value="9"> Physics and Astronomy </option>
                            <option value="10"> Neuroscience </option>
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
					<div class="col-md-6">
						<label> Author 1 Name </label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<input type="text" class="form-control" id="authors" name="authors[]" required maxlength=200>
					</div>
					<div class="col-md-3">
						<a class="btn btn-info" id="addAuthor"> Add Author </a>
					</div>
				</div>

				<div id="authorDiv">

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
						<input type="text" class="form-control" id="faculty" name="faculty[]" required maxlength=200>
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
					<input type="email" class="form-control" id="email" name="email" required>
				</div>
				<div class="form-group">
					<label for="abstract">Abstract (~250 words) </label> <div class="pull-right" id="wordCount"></div>
					<textarea class="form-control" id="abstract" rows="5" name="abstract" required maxlength=5000></textarea>
				</div>
				<input type="hidden" id="facultyCount" name="facultyCount" value="1">
				<input type="hidden" id="authorCount" name="authorCount" value="1">
				</fieldset>
				<div class="text-center">
					<button type="submit" class="btn btn-primary" id="submit" disabled> Submit Form</button>
				</div>
			</div>
		</div>
	</form>
</div>

<?php
include 'include/footer.php';
