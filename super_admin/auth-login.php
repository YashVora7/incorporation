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
    <link href="plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <script src="plugins/sweet-alert2/sweetalert2.all.min.js"></script>
    <script src="plugins/sweet-alert2/sweet-alert.init.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="text-center pt-4 pb-3">
                                <img src="<?php echo $baseUrl ?>/incorporation/assets/img/logo.webp" alt="Logo" class="img-fluid" style="width: 40%;">
                            </div>
                            <center><h4>Internal Staff Login</h4></center>
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>
                            <div class="card-body pt-0">
                                <form method="POST" action="#" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email_id">Email ID</label>
                                        <input id="email_id" type="text" class="form-control" name="email_id" tabindex="1" required autofocus value="jeetgandhi@gmail.com">
                                        <p class="text-danger" id="email_error"></p>

                                        <div class="invalid-feedback">
                                            Please fill in your email-id
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>

                                        </div>
                                        <div class="d-flex align-items-center position-relative">
                                            <input id="user_password" type="password" class="form-control" name="password" tabindex="2" required value="Jeet@1412">
                                            <i role="button" class="toggle-password fa fa-fw fa-eye-slash position-absolute" style="right: 20px;"></i>
                                        </div>
                                        <p class="text-danger" id="password_error"></p>

                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                        <div class="float-right">
                                            <a href="auth-forgot-password" class="text-small">
                                                Forgot Password?
                                            </a>
                                        </div>
                                        <p class="text-danger" id="login_error"></p>
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
                                    </div>
                                </form>
                                <div class="form-group">
                                    <input id="login_button" value="Login" name="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                </div>
                                <div class="error-message" style="color: red;"> </div>

                                <div class="row sm-gutters">
                                    <div class="mt-2 text-muted text-center ps-0 pe-0">
                                        <h6 class="mb-0"> WELCOME TO <br>
                                            <span><a>Tianlong Services Pte Ltd</a></span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $('#login_button').click(function() {
                // 1. Get Input Values
                let email = $('#email_id').val();
                let password = $('#user_password').val();
                if (email == '') {

                    $('#email_error').text('Please enter email ID');
                } else {
                    $('#email_error').text('');

                }

                if (password == '') {

                    $('#password_error').text('Please enter Password');
                } else {
                    $('#password_error').text('');

                }
                if (email != '' && password != '') {
                    $.ajax({
                        type: "POST",
                        url: "http://localhost:3000/user/login", // Note the "http://"
                        data: {
                            email: email,
                            password: password
                        },
                        success: function(response) {
                            if (response.Status == 'success') {
                                let logged_in_id = response.Data.user.id;


                                $.ajax({
                                    url: 'api/set_session.php',
                                    type: 'POST',
                                    data: {
                                        session_name: 'staff_id',
                                        session_value: logged_in_id

                                    },
                                    success: function(response) {
                                        let result = JSON.parse(response);
                                        if (result.error_flag == 0) {
                                            $('#login_error').text(' ');
                                            window.location.href = 'index.php';
                                        }
                                    }
                                });











                            }


                        },
                        error: function(error) {
                            // 5. Handle Errors
                            $('#login_error').text('Login failed, Please check your email ID and Password');

                            // alert("An error occurred during login.");
                        }
                    });
                }


                // 3. Send AJAX Request

            });
        });
    </script>
</body>

</html>