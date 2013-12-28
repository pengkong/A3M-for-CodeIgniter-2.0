/*
 * Setups all the checks for login
 * @param string modal_value For modal sign up functionality or similar
 */
function setUpMessages(modal_value)
{
	fieldErrorCheck("username", modal_value);
	fieldErrorCheck("email", modal_value);
	fieldErrorCheck("password", modal_value);
	fieldErrorCheck("confirm_password", modal_value);
	
	errorNote("username",validateUser, "", modal_value);
	errorNote("email",validateEmail, "", modal_value);
	errorNote("password",validatePass, "", modal_value);
	errorNote("confirm_password",validatePass, "", modal_value);
}

/*
 * Checks the specific field for errors
 * @param string field
 * @param string modal For modal sign up functionality or similar
 */
function fieldErrorCheck(field, modal){
	if($("#"+field+"_controls"+modal+" .help-inline").length){
		//it exists
		$("#"+field+"_controls"+modal+" .help-inline").attr("id",field+"Help-Inline"+modal);
		$("#"+field+"_Help-Inline"+modal+" .field_error").removeClass("label label-warning label-success").addClass("label label-danger");
	}else{
		//create it
		$("#"+field+"_controls"+modal).append('<span id = "'+field+'Help-Inline'+modal+'" class = "help-inline"></span>');
		$("#"+field+"_Help-Inline"+modal).append('<span class = "field_error"></span>');
	}
}

/*
 * The function should be blank initially, but if not, then write the appropriate error.
 * @param string field
 * @param string func The appropriate function name to call after this function is done.
 * @param string text Any additional text inside the field error to put in.
 * @param string modal For modal sign up functionality or similar
 */
function errorNote(field, func, text, modal){
	if(text !== ""){
		$("#"+field+"_Help-Inline"+modal+" .field_error").removeClass("label label-warning label-success").addClass("label label-danger");
		$("#"+field+"_Help-Inline"+modal+" .field_error").text(text);
	}
	$("#sign_up_"+field+modal).on('input', func);
}
			
var myTimeout;

/*
 * Function to check if userame is available
 * @param evt evt
 */
function validateUser(evt){
	var modal = $(this).attr("id").indexOf("modal") > 0 ? "_modal" : "";
	var value = $(this).val();
	var test = checkUser(value, modal);
	window.clearTimeout(myTimeout);
	if(test === true){
		$("#username_Help-Inline"+modal+" .field_error").removeClass("label label-danger label-success").addClass("label label-warning");
		$("#username_Help-Inline"+modal+" .field_error").text(_s_checking);
		myTimeout = window.setTimeout(function() {
			$.ajax({url:"/account/profile/username_exists/"+value}).done(function(check){
				if(checkUser($("#sign_up_username"+modal).val(), modal) === true){
					if(check == 1){
						$("#username_Help-Inline"+modal+" .field_error").removeClass("label label-warning label-success").addClass("label label-danger");
						$("#username_Help-Inline"+modal+" .field_error").text(_u_alreadyExists);
					}else{
						$("#username_Help-Inline"+modal+" .field_error").removeClass("label label-danger label-warning").addClass("label label-success");
						$("#username_Help-Inline"+modal+" .field_error").text(_u_avail);
					}
				}
			});}, 300);
	}
}

/*
 * Checks that the username is legitimate
 * @param string value
 * @param string modal For modal sign up or similar
 */
function checkUser(value, modal){
	var re = /^[a-z,A-Z,0-9,_,-]+$/i;
	if(value === ""){
		$("#username_Help-Inline"+modal+" .field_error").removeClass("label label-warning label-success").addClass("label label-danger");
		$("#username_Help-Inline"+modal+" .field_error").text(_u_noUsername);
		return false;
	}else if(value.length < 2){
		$("#username_Help-Inline"+modal+" .field_error").removeClass("label label-warning label-success").addClass("label label-danger");
		$("#username_Help-Inline"+modal+" .field_error").text(_u_tooShort);
		return false;
	}else if(value.length > 24){
		$("#username_Help-Inline"+modal+" .field_error").removeClass("label label-warning label-success").addClass("label label-danger");
		$("#username_Help-Inline"+modal+" .field_error").text(_u_tooLong);
		return false;
	}else if(!re.test(value)){
		$("#username_Help-Inline"+modal+" .field_error").removeClass("label label-warning label-success").addClass("label label-danger");
		$("#username_Help-Inline"+modal+" .field_error").text(_u_inVaildChars);
		return false;
	}else{
		return true;
	}
}

/*
 * Checks if the e-mail is formatted correctly
 * @param evt evt
 */
function validateEmail(evt)
{
	var modal = $(this).attr("id").indexOf("modal") > 0 ? "_modal" : "";
	//re is possible vaild email configurations 
	var re = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	var value = $(evt.target).val();
	if(!re.test(value)){
		$("#email_Help-Inline"+modal+" .field_error").removeClass("label label-warning label-success").addClass("label label-danger");
		$("#email_Help-Inline"+modal+" .field_error").text(_e_invaild);
	}else{
		$("#email_Help-Inline"+modal+" .field_error").removeClass("label label-danger label-warning").addClass("label label-success");
		$("#email_Help-Inline"+modal+" .field_error").text(_e_vaild);
	}
}

/*
 * Checks if the password is the appropriate lenght
 * @param evt evt
 */
function validatePass(evt)
{
	var modal = $(this).attr("id").indexOf("modal") > 0 ? "_modal" : "";
	var phife = $("#password_Help-Inline"+modal+" .field_error");
	var cphife = $("#confirm_password_Help-Inline"+modal+" .field_error");
	var vpv = $("#sign_up_password"+modal).val();
	var vcv = $("#sign_up_confirm_password"+modal).val();
	
	//checks that there is an actual imput
	if(vpv === ""){
		phife.removeClass("label label-warning label-success").addClass("label label-danger");
		phife.text(_p_no);
		
		cphife.removeClass("label label-danger label-success").addClass("label label-warning");
		cphife.text(_cp_dot);
	}
	//checks that the minimum length for password has been met
	else if(vpv.length < 6)
	{
		phife.removeClass("label label-warning label-success").addClass("label label-danger");
		phife.text(_p_tooShort);
		
		cphife.removeClass("label label-danger label-success").addClass("label label-warning");
		cphife.text(_cp_dot);
	}
	//checks that the confirm password matches the original password
	else
	{
		phife.removeClass("label label-danger label-warning").addClass("label label-success");
		phife.text(_p_good);
		
		//check that we have input
		if(vcv === "")
		{
			cphife.removeClass("label label-danger label-success").addClass("label label-warning");
			cphife.text(_cp_dot);
		}
		//check that the passwords match
		else if(vpv != vcv)
		{		
			cphife.removeClass("label label-warning label-success").addClass("label label-danger");
			cphife.text(_cp_noMatch);
		}
		else
		{		
			cphife.removeClass("label label-danger label-warning").addClass("label label-success");
			cphife.text(_cp_match);
		}
	}
}