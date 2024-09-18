<?php
require_once 'baseUrl.php';
// require_once 'db.php';

session_start();
if (isset($_SESSION["OTP"])) {
    unset($_SESSION["OTP"]);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin - Tianlong Services Pte Ltd</title>
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="icon" type="image/png" href="assets/img/logo.webp">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <script src="plugins/sweet-alert2/sweetalert2.all.min.js"></script>
    <script src="plugins/sweet-alert2/sweet-alert.init.js"></script>
    <style>
        body {
            /* background-image: url("assets/img/image-gallery/study_background.jpg"); */
            background-position: 0% 40%;
            background-color: #f1f5ff;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="loader" style="display:none;"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="card card-primary">
                            <div class="text-center pt-4 pb-3">
                                <img src="<?php echo $baseUrl ?>/incorporation/assets/img/logo.webp" alt="Logo" class="img-fluid" style="width: 25%;">
                            </div>
                            <div class="card-header">
                                <h4>Sign Up</h4>
                            </div>
                            <div class="card-body pt-0">
                                <form method="POST" action="#" class="needs-validation" novalidate="">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input id="first_name" type="text" class="form-control" name="first_name" tabindex="1" required autofocus>
                                                <div class="invalid-feedback">
                                                    Please enter your first name
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input id="last_name" type="text" class="form-control" name="last_name" tabindex="1" required autofocus>
                                                <div class="invalid-feedback">
                                                    Please enter your last name
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email_id">Email ID</label>
                                        <input id="email_id" type="text" class="form-control" name="email_id" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email-id
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email_id">Contact number</label>
                                        <input id="contact_number" type="text" class="form-control" name="email_id" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email-id
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <div class="d-flex align-items-center position-relative">
                                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required>


                                            <i role="button" class="toggle-password fa fa-fw fa-eye-slash position-absolute" style="right: 20px;"></i>
                                        </div>
                                        <p class="text-danger" id="password_error"></p>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <div class="d-flex align-items-center position-relative">
                                            <input id="confirm_password" type="password" class="form-control" name="confirm_password" tabindex="2" required>
                                            <i role="button" class="toggle-password fa fa-fw fa-eye-slash position-absolute" style="right: 20px;"></i>
                                        </div>
                                        <p class="text-danger" id="cpassword_error"></p>

                                        <div class="invalid-feedback">
                                            please fill in your confirm password
                                        </div>
                                    </div>
                                    <!-- toggle password -->
                                    <script>
                                        $(".toggle-password").click(function() {
                                            $(this).toggleClass("fa-eye fa-eye-slash");
                                            input = $(this).parent().find("input");
                                            if (input.attr("type") == "password") {
                                                input.attr("type", "text");
                                            } else {
                                                input.attr("type", "password");
                                            }
                                        });
                                    </script>

                                </form>
                                <div class="form-group">
                                    <input disabled id="login_button" value="Sign up" name="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                </div>
                                <p>Already have an account? <a href="auth-login">Sign in</a></p>

                                <div class="row sm-gutters">
                                    <div class="mt-2 text-muted text-center ps-0 pe-0">
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        let first_name = $('#first_name').val();
        let last_name = $('#last_name').val();
        let email_id = $('#email_id').val();
        let password = $('#password').val();
        let contact_number = $('#contact_number').val();
        let confirm_password = $('#confirm_password').val();


        function validatePassword(password) {
            const minLength = 8;
            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasNumbers = /[0-9]/.test(password);
            const hasSpecialChars = /[!@#\$%\^&\*]/.test(password);

            return password.length >= minLength && hasUpperCase && hasLowerCase && hasNumbers && hasSpecialChars;
        }

        // On input change, validate the password
        $('#password').on('input', function() {
            const password = $(this).val();
            if (validatePassword(password)) {
                $('#password_error').text('');
                $('#login_button').removeAttr('disabled');
            } else {
                $('#password_error').text('Password must be at least 8 characters long, include an uppercase letter, a lowercase letter, a number, and a special character.');
                $('#login_button').attr('disabled', 'true');

            }
        });

        $('#login_button').click(function() {
            let password = $('#password').val();
            let confirm_password = $('#confirm_password').val();
            console.log(password);
            console.log(confirm_password);
            if (password != confirm_password) {
                $('#cpassword_error').text('Password & Confirm password must be the same');
            } else {
                let password = $('#password').val();
                let first_name = $('#first_name').val();
                let last_name = $('#last_name').val();
                let email_id = $('#email_id').val();
                let contact_number = $('#contact_number').val();
                let confirm_password = $('#confirm_password').val();
                
                // Show the loader when the process starts
                $('.loader').show();
                
                // Send AJAX Request
                $.ajax({
                    type: "POST",
                    url: "api/client_register.php",
                    data: {
                        first_name: first_name,
                        last_name: last_name,
                        email_id: email_id,
                        contact_number: contact_number,
                        client_password: password
                    },
                    success: function(response) {
                        // Hide the loader once the process is completed
                        $('.loader').hide();
                        
                        let result = JSON.parse(response);
                        console.log(result); // Log the server's response
                        if (result.message) {
                           
                           if (result.error_flag == 0) {
                               $.ajax({
                                   url: 'api/set_session.php',
                                   type: 'POST',
                                   data: {
                                       session_name: 'user_id',
                                       session_value: result.user_id
                                   },
                                   success: function(response) {
                                       let result = JSON.parse(response);
                                       if (result.error_flag == 0) {
                                           $('#login_error').text(' ');
                                           window.location.href = 'index.php';
                                       }
                                   }
                               });
                           } else {
                               window.location.reload();
                           }

                        }
                    },
                    error: function(error) {
                        // Hide the loader if an error occurs
                        $('.loader').hide();
                        
                        console.error("Login error:", error);
                        alert("An error occurred during login.");
                    }
                });
            }
        });

    </script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>