$(function() {

            $('#login-form-link').click(function(e) {
                $("#login-form").delay(100).fadeIn(100);
                $("#register-form").fadeOut(100);
                $('#register-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
            $('#register-form-link').click(function(e) {
                $("#register-form").delay(100).fadeIn(100);
                $("#login-form").fadeOut(100);
                $('#login-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });

        });

        var regMail = /\S+@\S+\.\S+/i;
        var regLetters = /^[a-z ]+$/i;
        var regPhone = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;
        var regCAP = /^[0-9]+$/;
        var regVia = /^[a-z 0-9]+$/i;
        function convalidate(value, ip, regexp) {
            if (!regexp.test(value) || value == "") {
                document.getElementById(ip).style.color = "red";
                document.getElementById("register-submit").disabled = true;
                //console.log("enter");
            } else {
                document.getElementById(ip).style.color = "black";
            }
        }
        function confirm() {
            var confirm_password = document.getElementById('confirm-password').value;
            var pass = document.getElementById('pass').value;
            if ((pass == confirm_password) && (pass != "")){
                document.getElementById('register-submit').disabled = false;

            } else {
                document.getElementById('register-submit').disabled = true;
            }
        }

        //RegExp pass minimu
        var regPass = /^(?=.*[0-9])(?=.*[a-z]).{12,25}$/;
        function checkPassword(str) {
            var confirm_password = document.getElementById('confirm-password').value;
            if (!(str == "")) {
                if(!regPass.test(str) || str == ""){
                    document.getElementById('invalid-pass').style.display = "block";
                }else{
                    document.getElementById('invalid-pass').style.display = "none";
                    document.getElementById('confirm-password').disabled = false;
                }
            } else {
                document.getElementById('confirm-password').disabled = true;
            }
            if (str == confirm_password && !(str == "")) {
                document.getElementById('register-submit').disabled = false;
            } else {
                document.getElementById('register-submit').disabled = true;
            }
        }