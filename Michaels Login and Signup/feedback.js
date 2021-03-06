$(document).ready(init);

function init() {

    $(".error").hide();
    //    1) All fields are required
    $("#submit_btn").click(validate);
}

function validate(event) {
    $(".error").hide();
    var firstName = $("#firstName").val();
    var lastName = $("#lastName").val();
    var email = $("#email").val();
    var subject = $("#subject").val();
    var allFields = firstName + lastName + email + phone;
    var hasNumber = /\d/;
    var hasLetter = /\[a-zA-Z]/;
    var hasSpecial = /\[$!]/;
    //


    if (firstName == "") {
        $("label#firstName_error").show();
    }

    if (lastName == "") {
        $("label#lastName_error").show();
    }

    if (email == "") {
      $("label#email_error").show();
    }

    if ((firstName == "")||(lastName == "")||(email == "")||(phone == "")) {
        return false;
    }

    if((hasNumber.test(firstName) || hasNumber.test(lastName)) == true){
        alert("You have numbers in your name?");
        return false;
    }

    if (firstName != "" && lastName != "" && email != ""){
        alert("Thank you for your submission!");
    }

alert("All Fields: " + allFields);
}
