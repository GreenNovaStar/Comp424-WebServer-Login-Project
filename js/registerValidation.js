$(document).ready(function() {
$("#password2").keyup(validate);
});
function validate() {
var password1 = $("#password1").val();
var password2 = $("#password2").val();
if(password1 == password2 && password1!=null && password2!=null) {
$("#passwordMessage").html("<font color=\"green\"><b>Passwords Match</b></font>");
$("input[type=submit]").prop("disabled", false);
// document.getElementById("button").disabled = true;
// $('#Button').removeAttr('disabled');
}
else {
$("#passwordMessage").html("<font color=\"red\"><b>Check Passwords</b></font>");
$("input[type=submit]").prop("disabled", true);
// document.getElementById("button").disabled = true;
// $('#Button').attr('disabled','disabled');
}}

$(document).ready(function() {
$("#emailInput").keyup(validateEmail);
});
function validateEmail() {
var email = $("#emailInput").val();
var mailformat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
if(email.match(mailformat)) {
$("#emailMessage").html("<font color=\"green\"><b>Email Format Valid</b></font>");
$("input[type=submit]").prop("disabled", false);
// document.getElementById("button").disabled = true;
// $('#Button').removeAttr('disabled');
}
else {
$("#emailMessage").html("<font color=\"red\"><b>Invalid Email Input</b></font>");
$("input[type=submit]").prop("disabled", true);
// document.getElementById("button").disabled = true;
// $('#Button').attr('disabled','disabled');
}}
