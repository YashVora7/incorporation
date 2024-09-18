
<?php 
if (isset($_GET['company_id'])) {
$company_id = isset($_GET['company_id'])?$_GET['company_id']:"";
$sql_company = "SELECT * FROM register_company WHERE id = '$company_id' ";
$sql_excute = mysqli_query($link,$sql_company);
$result = mysqli_fetch_assoc($sql_excute);
}
?>
<style>
    .sidebar-user {
        padding: 15px 10px !important;
    }

    ul:not(.list-unstyled) {
        line-height: 20px !important;
    }

    .main-sidebar .sidebar-menu li.menu-header:not(:first-child) {
        margin-top: 20px !important;
    }

    .main-sidebar .sidebar-menu li a {
        height: 40px !important;
    }

    .light-sidebar.sidebar-mini .main-sidebar .sidebar-user {
        padding: 25px 10px !important;
    }

    .sidebar-user img {
        border-radius: 0px !important;
    }
    .float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color: #25d366;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        font-size: 30px;
        box-shadow: 2px 2px 3px #999;
        z-index: 100;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

        .float:hover {
            background-color: #FFF;
            color: #25d366;
        }

        .float:hover i {
            color: #25d366;
        }

     .float1{
        position:fixed;
        width:60px;
        height:60px;
        bottom:125px;
        right:40px;
        background-color:black;
        color:#FFF;
        border-radius:50px;
        text-align:center;
      font-size:30px;
        box-shadow: 2px 2px 3px #999;
      z-index:100;
    }
     .float1:hover {
            background-color: white;
            color: black;
        }


    .my-float{
        margin-top:16px;
    }
    .my-float1{
        margin-top:16px;
    }
</style>

<!-- sidebar -->
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">

        <!-- User Profile -->
        <div class="sidebar-user">
            <div class="sidebar-user-picture">
                <a class="navbar-brand me-0" href="<?php echo $baseUrl; ?>/internal-staff">
                    <img src="<?php echo $baseUrl ?>/incorporation/assets/img/logo.webp" alt="Logo" class="image-fluid">
                </a>
                <h3 style="font-size: 100%;">Super Admin</h3>
            </div>
        </div>

        <!-- Main Menu -->
        <ul class="sidebar-menu">
            <li class="menu-header">Home</li>

            <li>
                <a href="<?php echo $baseUrl; ?>/super_admin" class="nav-link">
                    <i data-feather="home"></i><span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $baseUrl; ?>/super_admin/new_companies" class="nav-link">
                    <i data-feather="briefcase"></i><span>Companies</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $baseUrl; ?>super_admin/new_companies/only_registered_company.php" class="nav-link">
                    <i data-feather="monitor"></i><span>Registered Company</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $baseUrl; ?>super_admin/new_companies/cddkyc_verify.php" class="nav-link">
                    <i data-feather="check-square"></i><span>CDDKYC Approval</span>
                </a>
            </li>

            <li class="menu-header">Settings</li>

            <li class="dropdown">
                <a role="button" class="nav-link has-dropdown">
                    <i data-feather="users"></i><span>Staff Managements</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo $baseUrl; ?>/super_admin/staff_management" class="nav-link">
                            <i data-feather="user"></i><span>Staff</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $baseUrl; ?>/super_admin/assign_staff" class="nav-link">
                            <i data-feather="user-check"></i><span>Default Staff Assign</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=51955081075&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Varela%202." class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>
<a href="" class="float1" target="_blank">
<i class="fa fa-phone my-float1"></i>
</a>