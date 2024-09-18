<?php
require_once 'baseUrl.php';
session_start();
$otp = $_SESSION["OTP"];
$admin_id = $_GET['id'];
$adminId = urldecode($admin_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?php echo $baseUrl; ?>/internal-staff/">

    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin - Tianlong Services Pte Ltd</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/bundles/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="assets/bundles/weather-icon/css/weather-icons.min.css">
    <link rel="stylesheet" href="assets/bundles/weather-icon/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="assets/bundles/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="assets/bundles/prism/prism.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">

    <!-- Table  CSS -->
    <link rel="stylesheet" href="assets/bundles/footable-bootstrap/css/footable.bootstrap.min.css">
    <link rel="stylesheet" href="assets/bundles/footable-bootstrap/css/footable.standalone.min.css">
    <link rel="stylesheet" href="../../../../../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Sweet Alert  -->
    <link href="plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <script src="plugins/sweet-alert2/sweetalert2.all.min.js"></script>
    <script src="plugins/sweet-alert2/sweet-alert.init.js"></script>

    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href="assets/img/logo.webp" />

    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

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
    <div class="center"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Verify Your OTP</h4>
                            </div>
                            <div class="card-body">
                                <form name="" action="" method="POST">
                                    <input style="display: none;" type="text" name="" id="otp" value="<?php echo $otp; ?>">
                                    <input style="display: none;" type="text" name="" id="admin_id" value="<?php echo $admin_id; ?>">
                                    <div class="form-group">
                                        <label for="otp">Enter Your OTP</label>
                                        <input id="entered_otp" type="text" class="form-control" name="otp" tabindex="1" required autofocus maxlength="4">
                                    </div>

                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <div class="d-flex align-items-center position-relative">
                                            <input id="new_password" type="text" class="form-control" name="new_password" tabindex="1" required autofocus disabled>
                                            <i role="button" class="toggle-password fa fa-fw fa-eye-slash position-absolute" style="right: 20px;"></i>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password</label>
                                        <div class="d-flex align-items-center position-relative">
                                            <input id="confirm_password" type="text" class="form-control" name="confirm_password" tabindex="1" required autofocus disabled>
                                            <i role="button" class="toggle-password fa fa-fw fa-eye-slash position-absolute" style="right: 20px;"></i>
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

                                    <div class="row sm-gutters">
                                        <div class="mt-5 text-muted text-center">
                                            <h6 style="color:red;"><?php echo $error; ?><?php echo $error2; ?></h6>
                                        </div>
                                    </div>
                                </form>
                                <input name="submit" id="submit_pass" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" value="Update Password" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>

    <script>
        $('#entered_otp').keyup(function() {
            var inputValue = $('#entered_otp').val();

            if (inputValue.length === 4) {

                let otp = $("#otp").val();
                let entered_otp = $('#entered_otp').val();

                if (entered_otp == '') {
                    alert('please enter OTP');
                } else {
                    if (otp != entered_otp) {
                        swal.fire({
                            title: 'OTP is incorrect',
                            type: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        $('#new_password').removeAttr('disabled');
                        $('#confirm_password').removeAttr('disabled');
                        $('#submit_pass').removeAttr('disabled');
                        $('#entered_otp').attr('disabled', 'true');
                    }
                }
            }

        });


        $('#submit_pass').click(function() {
            let pass = $("#new_password").val();
            let cpass = $('#confirm_password').val();

            if (pass != cpass) {
                swal.fire({
                    title: 'Password & Confirm password must be same',
                    type: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Okay'
                });
            } else {
                let admin_id = $("#admin_id").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo $baseUrl; ?>/apis/update_password_api",
                    data: {
                        admin_id: admin_id,
                        new_pass: pass,
                    },

                    success: function(data) {
                        let result = JSON.parse(data);

                        if (result.error_flag == 0) {
                            swal.fire({
                                title: 'Password is Updated Successfully',
                                type: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Okay'
                            }).then(function(isConfirm) {

                                if (isConfirm.value) {
                                    window.location = '<?php echo $baseUrl; ?>/internal-staff/auth-login';
                                } else {

                                }

                            });
                        }

                    }
                });
            }
        });
    </script>
</body>

</html>