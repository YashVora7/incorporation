<?php
require_once 'baseUrl.php';
// require_once 'db.php';

session_start();
if (isset($_SESSION["OTP"])) {
    unset($_SESSION["OTP"]);
}

$message = "";
if (count($_POST) > 0) {
    $email_id = mysqli_real_escape_string($link, $_POST["email_id"]);
    $password = $_POST["password"];

    $sql = mysqli_query($link, "SELECT admin_id, password FROM admin WHERE email_id = '$email_id'");
    $row = mysqli_fetch_assoc($sql);

    // Verify the password
    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['adminid'] = $row['admin_id'];
        header("Location:  " . $baseUrl . "/internal-staff");
        exit();
    } else {
        $message = "*Invalid Email ID or Password!";
    }
}


if (isset($_SESSION['adminid'])) {
    header("Location: " . $baseUrl . "/internal-staff");
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
                                        <label for="password">Password</label>
                                        <div class="d-flex align-items-center position-relative">
                                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                            <i role="button" class="toggle-password fa fa-fw fa-eye-slash position-absolute" style="right: 20px;"></i>
                                        </div>
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
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input id="phone_number" type="text" class="form-control" name="phone_number" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            please enter your phone number
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Sign up" name="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    </div>
                                    <p>Already have an account? <a href="auth-login">Sign in</a></p>
                                    <div class="error-message" style="color: red;"><?php echo $message; ?></div>
                                </form>
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
</body>

</html>