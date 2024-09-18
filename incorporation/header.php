<?php
require_once 'baseUrl.php';
require_once 'session.php';
 
$user_id = $_SESSION['user_id'];

$sql = 'SELECT * FROM user_roles WHERE id = '.$user_id.'';
$result = mysqli_query($link,$sql);

$row2 = mysqli_fetch_assoc($result);

$full_name = $row2['name'];
 
 
// require_once 'db.php';
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
       
        </ul>
    </div>

    <!-- User Profile -->
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?php echo $baseUrl ?>/incorporation/assets/img/products/user.png" class="user-img-radious-style">
                <span class="d-sm-none d-lg-inline-block"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title"><?= $full_name?></div>
                <div class="dropdown-divider"></div>
                <a href="<?php echo $baseUrl ?>/internal-staff/logout" class="dropdown-item has-icon text-secondary">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <a href="<?php echo $baseUrl ?>/incorporation/logout" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>

</nav>