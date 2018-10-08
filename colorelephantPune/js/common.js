$(function () { 
	
jQuery("#starRateAdd .rating label").click(function(){
	var checkedFeedRateVal=jQuery(this).prev("input").val();
	jQuery("#checkedFeedRateId").val(checkedFeedRateVal);
});

	if(document.getElementById("DataTables_Table_profile")){
		$("#DataTables_Table_profile").dataTable( {
			"aaSorting": [],
			 'aoColumnDefs': [{
				'bSortable': false,
				'aTargets': ['nosort']
			}],
			"language": {
			"searchPlaceholder": "Search"
			}
		});
	}


});

function validateRating(){
var rating=jQuery("#checkedFeedRateId").val();
if(rating==""){
	jQuery("#ratingErrMsg").html("Please choose rating");
	return false;
} else {
	jQuery("#ratingErrMsg").html("");
}
return true;
}

function validateProfileForm(){
	$('#nameErr').html('');
	$('#emailErr').html('');
	$('#webAddressErr').html('');
	$('#coverLetterErr').html('');
	$('#fileErr').html('');
	$('#questionErr').html('');
	if($('#name').val()==''){
		$('#nameErr').html('Required');
		return false;
	}
	if($('#email').val()==''){
		$('#emailErr').html('Required');
		return false;
	}
	if(!isEmailAddress($('#email').val())){
		$('#emailErr').html('invalid email');
		return false;
	}
	if($('#webAddress').val()==''){
		$('#webAddressErr').html('Required');
		return false;
	}
	if(!isWebAddress($('#webAddress').val())){
		$('#webAddressErr').html('invalid web address');
		return false;
	}
	if($('#coverLetter').val()==''){
		$('#coverLetterErr').html('Required');
		return false;
	}
	if($("#file").val()==""){
		$('#fileErr').html('Required');
		return false;
	}
	if(isValidExt($("#file").val())==-1){
		$('#fileErr').html('valid formats are doc,docx,pdf');
		return false;
	}
	if($('#question').val()==''){
		$('#questionErr').html('Required');
		return false;
	}
	if(!ValidCaptcha()){
		$("#captchaErr").html('captcha not matched');
		return false;
	}
	return true;
}
function isEmailAddress(str) {
   var pattern =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
   return pattern.test(str);  // returns a boolean 
}
function isWebAddress(str){
   var pattern =/^(ftp|http|https):\/\/[^ "]+$/;
   return pattern.test(str);
}
function isValidExt(str){
var lastIndex =str.lastIndexOf('.');
var ext =str.substr((lastIndex+1),(str.length-1));
var arr=['doc','docx','pdf'];
return arr.indexOf(ext);
}
function validateLoginForm(page){
	$('#passwordErr').html('');
	if(page==undefined){
		$('#emailIdErr').html('');
		if($('#emailId').val()==''){
			$('#emailIdErr').html('Required');
			return false;
		}
		if(!isEmailAddress($('#emailId').val())){
			$('#emailIdErr').html('invalid email');
			return false;
		}
	}
	if($('#password').val()==''){
		$('#passwordErr').html('Required');
		return false;
	}
	return true;
}
function validateRegistrationForm(){
	$('#emailIdErr').html('');
	if($('#emailId').val()==''){
		$('#emailIdErr').html('Required');
		return false;
	}
	if(!isEmailAddress($('#emailId').val())){
		$('#emailIdErr').html('invalid email');
		return false;
	}
	return true;
}
function captcha(){
	var a = Math.ceil(Math.random() * 9)+ '';
	var b = Math.ceil(Math.random() * 9)+ '';
	var c = Math.ceil(Math.random() * 9)+ '';
	var d = Math.ceil(Math.random() * 9)+ '';
	var e = Math.ceil(Math.random() * 9)+ '';

	var code = a + b + c + d + e;
	document.getElementById("txtCaptcha").value = code;
	document.getElementById("txtCaptchaVal").value = code;
	//document.getElementById("txtCaptchaDiv").innerHTML = code;
}
function ValidCaptcha(){
	var str1 = document.getElementById('txtCaptcha').value;
	var str2 = document.getElementById('txtInput').value;
	if (str1 == str2){
	return true;
	}else{
	return false;
	}
}
