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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="plugins/sweet-alert2/sweetalert2.all.min.js"></script>
    <script src="plugins/sweet-alert2/sweet-alert.init.js"></script>

    <style>
        body {
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
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>
                            <div class="card-body pt-0">
                                <form method="POST" action="#" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email_id">Email ID</label>
                                        <input id="email_id" type="text" class="form-control" name="email_id" tabindex="1" required autofocus>
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
                                            <input id="user_password" type="password" class="form-control" name="password" tabindex="2" required>
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
                                    </div>
                                </form>
                                <div class="form-group">
                                    <input type="button" id="login_button" value="Login" name="submit" class="btn btn-primary btn-lg btn-block">
                                </div>
                                <p>Don't have an account? <a href="auth-register">Sign up</a></p>
                                <div class="error-message" style="color: red;"></div>
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
    
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
    
    <script>
        $(document).ready(function () {
            $('#login_button').click(function () {
                // 1. Get Input Values
                let email = $('#email_id').val().trim();
                let password = $('#user_password').val().trim();

                if (email === '') {
                    $('#email_error').text('Please enter email ID');
                } else {
                    $('#email_error').text('');
                }

                if (password === '') {
                    $('#password_error').text('Please enter Password');
                } else {
                    $('#password_error').text('');
                }

                if (email !== '' && password !== '') {
                    // Make AJAX call
                    $.ajax({
                        url: 'api/login_client.php',
                        type: 'POST', 
                        data: {
                            email: email,
                            password: password
                        },
                        success: function (response) {
                            let result = JSON.parse(response);
                            if (result.error_flag === 0) {
                                $('#login_error').text('');
                                
                                // Refresh DocuSign token
                                $.ajax({
                                    url: 'api/refresh_token_docusign.php',
                                    type: 'GET',
                                    success: function (tokenResponse) {
                                        let tokenResult = JSON.parse(tokenResponse);
                                        if (tokenResult.success) {
                                            alert('Token refreshed successfully!');
                                        } else {
                                            alert('Failed to refresh token: ' + (tokenResult.message || 'Unknown error'));
                                        }
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        alert('Failed to call refresh token API: ' + textStatus);
                                    }
                                });

                                // Redirect based on user role
                                if (result.user_role === 'super_admin') {
                                    window.location.href = '<?php echo $baseUrl; ?>super_admin';
                                } else if (result.user_role === 'staff') {
                                    window.location.href = '<?php echo $baseUrl; ?>internal-staff';
                                } else {
                                    window.location.href = 'index.php';
                                }
                            } else {
                                $('#login_error').text(result.error_message || 'Login failed. Please try again.');
                            }
                        },
                        error: function () {
                            $('#login_error').text('Login failed, Please check your email ID and Password');
                        }
                    });
                }
            });

            // Toggle password visibility
            $(".toggle-password").click(function () {
                $(this).toggleClass("fa-eye-slash fa-eye");
                let input = $("#user_password");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        });
    </script>
</body>

</html>
