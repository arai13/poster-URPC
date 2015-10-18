function validateEmail() {
	var email =/\S+@earlham.edu/;
	var text = $("#email").val();
	if (text.match(email)){
		$("#submit").prop('disabled', false);
	}	
}

$(document).ready(function(){
	$("#abstract").bind('input propertychange', function(){

		var text = $("textarea#abstract").val();
		text = text.replace(/(^\s*)|(\s*$)/gi,"");
		text = text.replace(/[ ]{2,}/gi," ");
		text = text.replace(/\n /,"\n");
		var count = parseInt(text.split(" ").length);
		$("#wordCount").html("Number of words: " + count);
		if(count<=260) $("#submit").prop('disabled', false);
		else $("#submit").prop('disabled', true);

	});

	var authors = 2;
	var faculty = 2;
	$("#addAuthor").click(function() {
		$('<div class="row"><div class="col-md-6"><label for="author'+authors+'"> Author ' + authors + '</label></div></div><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="authors" name="authors[]" required maxlength=200></div></div>').appendTo($("#authorDiv"));
		$("#authorCount").val(authors);
		authors++;
	});
		
	$("#addFaculty").click(function() {               
		var addrField = "<div class='addr' id='addr" + faculty +"'> " +
					"<div class='row'>" +
						"<div class='col-md-6'>" +
                		 " <label for='institution'>Faculty " + faculty +" Institution Name</label>" +
                              "<input type='text' class='form-control' id='institution' name='institution" + faculty +"' maxlength=200>" +
						"</div>" +
						"<div class='col-md-6'>" +
							        "<label for='department'>Faculty " + faculty +" Department</label>" +
									"<input type='text' class='form-control' name='dep" + faculty +"'/>" +
						"</div>" +
					"</div>" +
					"<div class='row'>" +
						"<div class='col-md-4'>" +
							"<label for='city'>Institution City</label>" +
								"<input type='text' class='form-control' id='city' name='city" + faculty +"' maxlength=200>" +
						"</div>" +
						"<div class='col-md-4'>" +
							"<label for='state'>Institution State</label>" +
	                                        "<select name='state" + faculty +"' id='state' class='form-control'>" +
                                                "<option value='AL'>Alabama</option>" +
                                                "<option value='AK'>Alaska</option>" +
                                                "<option value='AZ'>Arizona</option>" +
                                                "<option value='AR'>Arkansas</option>" +
                                                "<option value='CA'>California</option>" +
                                                "<option value='CO'>Colorado</option>" +
                                                "<option value='CT'>Connecticut</option>" +
                                                "<option value='DE'>Delaware</option>" +
                                                "<option value='DC'>District Of Columbia</option>" +
                                                "<option value='FL'>Florida</option>" +
                                                "<option value='GA'>Georgia</option>" +
                                                "<option value='HI'>Hawaii</option>" +
                                                "<option value='ID'>Idaho</option>" +
                                                "<option value='IL'>Illinois</option>" +
                                                "<option value='IN'>Indiana</option>" +
                                                "<option value='IA'>Iowa</option>" +
                                               " <option value='KS'>Kansas</option>" +
                                                "<option value='KY'>Kentucky</option>" +
                                                "<option value='LA'>Louisiana</option>" +
                                               " <option value='ME'>Maine</option>" +
                                                "<option value='MD'>Maryland</option>" +
                                               " <option value='MA'>Massachusetts</option>" +
                                                "<option value='MI'>Michigan</option>" +
                                                "<option value='MN'>Minnesota</option>" +
                                                "<option value='MS'>Mississippi</option>" +
                                                "<option value='MO'>Missouri</option>" +
                                                "<option value='MT'>Montana</option>" +
                                               " <option value='NE'>Nebraska</option>" +
                                                "<option value='NV'>Nevada</option>" +
                                                "<option value='NH'>New Hampshire</option>" +
                                                "<option value='NJ'>New Jersey</option>" +
                                                "<option value='NM'>New Mexico</option>" +
                                               " <option value='NY'>New York</option>" +
                                                "<option value='NC'>North Carolina</option>" +
                                                "<option value='ND'>North Dakota</option>" +
                                                "<option value='OH'>Ohio</option>" +
                                                "<option value='OK'>Oklahoma</option>" +
                                                "<option value='OR'>Oregon</option>" +
                                                "<option value='PA'>Pennsylvania</option>" +
                                                "<option value='RI'>Rhode Island</option>" +
                                               " <option value='SC'>South Carolina</option>" +
                                                "<option value='SD'>South Dakota</option>" +
                                               " <option value='TN'>Tennessee</option>" +
                                                "<option value='TX'>Texas</option>" +
                                                "<option value='UT'>Utah</option>" +
                                               " <option value='VT'>Vermont</option>" +
                                                "<option value='VA'>Virginia</option>" +
                                               " <option value='WA'>Washington</option>" +
                                                "<option value='WV'>West Virginia</option>" +
                                                "<option value='WI'>Wisconsin</option>" +
                                                "<option value='WY'>Wyoming</option>" +
                                        "</select>" +
						"</div>" +
						"<div class='col-md-4'>" +
							"<label for='postcode'>Institution Postcode</label>" +
	                                                "<input type='text' class='form-control' id='postcode' name='postcode" + faculty +"' maxlength=200>" +
						"</div>" +
					"</div>" +
				"</div>";

		$("#facultyDiv").append('<div class="row"><div class="col-md-6"><label for="faculty'+ faculty +'"> Faculty Advisor ' + faculty + '</label></div></div><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="faculty" name="faculty[]" required maxlength=200></div><div class="col-md-3"> <input type="checkbox" id="defaultAddr" name="addr'+faculty+'" checked> From Earlham </div></div>' + addrField)
		$("div#addr"+faculty).hide();
		$("#facultyCount").val(faculty);
		faculty++;
    });
	

	// initial hide()
	$("div.addr").hide();
	$(document).on('change', ':checkbox', function(){
		$("div#"+this.name).toggle();
	});
	
});





