var SignUp = {
    check: function (id) {
        if ($.trim($("#" + id)[0].value) == '') {
            $("#" + id)[0].focus();
            $("#" + id + "_alert").show();

            return false;
        };

        return true;
    },
    validate: function () {
        if (SignUp.check("registration_name") == false) {
            return false;
        }
        if (SignUp.check("registration_username") == false) {
            return false;
        }
        if (SignUp.check("registration_email") == false) {
            return false;
        }
        if (SignUp.check("registration_password") == false) {
            return false;
        }
        if ($("#registration_password")[0].value != $("#registration_repeatPassword")[0].value) {
            $("#registration_repeatPassword")[0].focus();
            $("#repeatPassword_alert").show();

            return false;
        }
        $("#registerForm")[0].submit();
    }
}

$(document).ready(function () {
    $("#registerForm .alert").hide();
});
