$(document).ready(function (){
    $("#roles").change(function() {
        if ($(this).val() <= 1) {
            $("#contractorInfo").hide();
            $("#teamInfo").hide();
            $("#cont").prop('required',false);
            $("#tea").prop('required',false);
        }else{
            $('#contractorInfo').show();
            $('#teamInfo').show();
            $("#cont").prop('required',true);
            $("#tea").prop('required',true);
        } 
    });

    var allOptions = $('#tea option')
    $('#cont').change(function () {
        $('#tea option').remove()
        var classN = $('#cont option:selected').prop('class');
        var opts = allOptions.filter('.' + classN);
        $.each(opts, function (i, j) {
            $(j).appendTo('#tea');
        });
    });
    $("#generatePassword").click(function(){
        var password =  Array(10).fill('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz~!@-#$')
        .map(x => x[Math.floor(crypto.getRandomValues(new Uint32Array(1))[0] / (0xffffffff + 1) * x.length)]).join('');
    
        $("#password").val(password);
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

    $('#password, #generatePassword').on('keyup click', function () {
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
