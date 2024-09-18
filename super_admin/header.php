<?php
require_once 'baseUrl.php';
// require_once 'db.php';
$user_data = $_SESSION['user_data'];
?>

<style>
    .badge.btn-warning {
        animation: blink_animate 1.5s linear infinite;
    }

    @keyframes blink_animate {
        0% {
            opacity: 0;
        }

        50% {
            opacity: 0.9;
        }

        100% {
            opacity: 0;
        }
    }
</style>


<!-- Header -->
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">

    <!-- Toogle + Full Screen  -->
    <div class="form-inline me-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-bs-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                    <i data-feather="align-justify"></i>
                </a>
            </li>
            <!--<li>
                <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a>
            </li>-->
        </ul>
    </div>

    <!-- User Profile -->
    <ul class="navbar-nav navbar-right">
        <li>
            <button id="switch_button"  class="btn btn-primary float-end my-2">Switch To Internal Staff</button>
        </li>
        <li class="dropdown">
            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?php echo $baseUrl ?>/internal-staff/assets/img/products/user.png" class="user-img-radious-style">
                <span class="d-sm-none d-lg-inline-block"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title"><?php echo $user_data['name'] ?></div>
                <div class="dropdown-divider"></div>
               <a href="<?php echo $baseUrl ?>/internal-staff/logout" class="dropdown-item has-icon text-secondary">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <a href="<?php echo $baseUrl ?>/internal-staff/logout" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
    
    <script>

        $(document).ready(function () {
            $('#switch_button').click(function () {
                // 1. Get Input Values
                var baseurl = "<?php echo $baseUrl; ?>";
                let email = 'superadminswtch@gmail.com';
                let password = 'Super@123';

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
                       url: baseurl + 'incorporation/api/login_client.php',
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
                                    url: baseurl + 'incorporation/api/refresh_token_docusign.php',
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