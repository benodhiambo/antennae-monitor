jQuery(document).ready(function () {
    jQuery('#hideshow').on('click', function (event) {
        jQuery('#content').toggle('show');
    });

    $( "#updateProfile" ).submit(function( event ) {
        var rol = $( "#roles" ).val();
        $("#roles" ).val(rol);
    });

    $("#roles").on('change', function() {
        if ($(this).val() <= 1) {
            $("#contractorInfo").hide();
            $("#teamInfo").hide();
            $("#contractor").prop('required',false);
            $("#team").prop('required',false);
        }else{
            $('#contractorInfo').show();
            $('#teamInfo').show();
            $("#contractor").prop('required',true);
            $("#team").prop('required',true);
        } 
    });

    var allOptions = $('#team option')
    $('#contractor').change(function () {
        $('#team option').remove()
        var classN = $('#contractor option:selected').prop('class');
        var opts = allOptions.filter('.' + classN);
        $.each(opts, function (i, j) {
            $(j).appendTo('#team');
        });
    });

    $('.passwords, #resetDetails').on('keyup focus click', function () {
        //Store the field objects into variables ...
        var password = $('#password');
        var confirm  = $('#confirmPassword');
        var message  = $('#confirmMessage');
        
        //Set the colors we will be using ...
        var good_color = "#66cc66";
        var bad_color  = "#ff6666";

        if(password.val() == confirm.val()){
            document. getElementById("submitDetails").disabled = false;
            confirm.css('background-color', good_color);
            message.css('color', good_color).html("Passwords Match!");
        } else {
            document. getElementById("submitDetails").disabled = true;
            confirm.css('background-color', bad_color);
            message.css('color', bad_color).html("Passwords Do Not Match!");
        }
    });
    
    var strength = {
        0: "Very Weak",
        1: "Weak",
        2: "Average",
        3: "Good",
        4: "Strong"
    }

    var password = document.getElementById('password');
    var meter = document.getElementById('password-strength-meter');
    var text = document.getElementById('password-strength-text');

    password.addEventListener('input', function() {
        var val = password.value;
        var result = zxcvbn(val);

        // Update the password strength meter
        meter.value = result.score;

        // Update the text indicator
        if (val !== "") {
            text.innerHTML = "Password Strength: " + strength[result.score];

            switch (meter.value) {
                case 0:
                    text.style.color = "blue";
                    break;
                case 1:
                    text.style.color = "red";
                    break;
                case 2:
                    text.style.color = "orange";
                    break;
                case 3:
                    text.style.color = "rgb(138, 216, 50)";
                    break;
                case 4:
                    text.style.color = "green";
                    break;
              }

            if (meter.value <= 2) {
                document. getElementById("submitDetails").disabled = true;
            } else {
                document. getElementById("submitDetails").disabled = false;
            }
        } else {
            text.innerHTML = "Too short";
        }
    });
});