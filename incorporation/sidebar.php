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
        height: 35px !important;
    }

    .light-sidebar.sidebar-mini .main-sidebar .sidebar-user {
        padding: 25px 10px !important;
    }

    .sidebar-user img {
        border-radius: 0px !important;
    }

    /* Highlight active menu item */
    .sidebar-menu .active {
        background-color: #f0f0f0;
        /* Change this to your preferred active background color */
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
<?php
$data_found2 = false;
$logged_user_id = $_SESSION['user_id'];

$sql = 'SELECT * FROM register_company WHERE user_id = ' . $logged_user_id . '';

$result = mysqli_query($link, $sql);
$numrows = mysqli_num_rows($result);
if ($numrows > 0) {
    $row_company_data = mysqli_fetch_assoc($result);
    $data_found2 = true;
} else {
    $data_found2 = false;
}


?>
<!-- sidebar -->
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">

        <!-- User Profile -->
        <div class="sidebar-user">
            <div class="sidebar-user-picture">
                <a class="navbar-brand me-0" href="<?php echo $baseUrl; ?>/incorporation">
                    <img src="<?php echo $baseUrl ?>/incorporation/assets/img/logo.webp" alt="Logo" class="image-fluid">
                </a>
            </div>
        </div>

        <!-- Main Menu -->
        <ul class="sidebar-menu">
            <li class="menu-header">Home</li>

            <li>
                <a href="<?php echo $baseUrl; ?>/incorporation" class="nav-link <?php if ($currentPage === 'dashboard') echo 'active'; ?>">
                    <i data-feather="home"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="dropdown">
                <a role="button" class="nav-link has-dropdown"><i data-feather="folder-plus"></i><span>Register Company</span></a>
                <ul class="dropdown-menu">
                    <?php if ($data_found2 == false) { ?>
                        <li>
                            <a href="<?php echo $baseUrl; ?>incorporation/register-company" class="nav-link <?php if ($currentPage === 'register_company') echo 'active'; ?>">
                                <i data-feather="clipboard"></i><span>Register Company</span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ($numrows > 0 && $row_company_data['company_current_status'] == 'only_company_registered') { ?>
                        <li>
                            <a href="<?php echo $baseUrl; ?>incorporation/register-company/add_company_officer.php" class="nav-link <?php if ($currentPage === 'add_company_officer') echo 'active'; ?>">
                                <i data-feather="user-plus"></i><span>Add Company Officer</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>

            <?php if ($numrows > 0 && $row_company_data['company_current_status'] != 'only_company_registered') { ?>
                <li>
                    <a href="<?php echo $baseUrl; ?>/incorporation/incorporation-status" class="nav-link <?php if ($currentPage === 'incorporation_status') echo 'active'; ?>">
                        <i data-feather="info"></i><span>Incorporation Status</span>
                    </a>
                </li>
            <?php } ?>

            <?php if ($numrows > 0 && $row_company_data['company_current_status'] == 'Payment_and_data_verified') { ?>
                <li class="menu-header">Before Incorporation</li>
                <li class="dropdown">
                    <a role="button" class="nav-link has-dropdown"><i data-feather="file-text"></i><span>Report & Documents</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php if ($currentPage === 'report_incorporation') echo 'active'; ?>" href="<?php echo $baseUrl; ?>/incorporation/before-incorporation/report-incorporation"><i data-feather="file"></i>Report - Incorporation</a></li>
                        <li><a class="nav-link <?php if ($currentPage === 'form_45') echo 'active'; ?>" href="<?php echo $baseUrl; ?>/incorporation/before-incorporation/form-45"><i data-feather="file-text"></i>Form 45 for Directors</a></li>    
                        <li><a class="nav-link <?php if ($currentPage === 'company_constitution') echo 'active'; ?>" href="<?php echo $baseUrl; ?>/incorporation/before-incorporation/company-constitution"><i data-feather="book"></i>Company Constitution</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if ($numrows > 0 && $row_company_data['company_current_status'] == 'CDDKYC_completed') { ?>
                <li class="menu-header">After Incorporation</li>
                <li class="dropdown">
                    <a role="button" class="nav-link has-dropdown"><i data-feather="book-open"></i><span>Registers & Documents</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link <?php if ($currentPage === 'incorporation_registers') echo 'active'; ?>" href="<?php echo $baseUrl; ?>/incorporation/after-incorporation/incorporation-registers"><i data-feather="archive"></i>Incorporation Registers</a></li>
                        <li><a class="nav-link <?php if ($currentPage === 'incorporation_documents') echo 'active'; ?>" href="<?php echo $baseUrl; ?>/incorporation/after-incorporation/incorporation-documents"><i data-feather="file-text"></i>Incorporation Documents</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo $baseUrl; ?>/incorporation/incorporation-certificates" class="nav-link <?php if ($currentPage === 'incorporation_certificates') echo 'active'; ?>">
                        <i data-feather="award"></i><span>Incorporation Certificates</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </aside>
</div>
<script>
    // Get the current page filename without extension
    var currentPage = location.pathname.split("/").slice(-1)[0];
    if (currentPage === '') {
        currentPage = 'index.php'; // Set default for homepage
    }

    // Remove extension (if any) to match with the menu items
    currentPage = currentPage.replace(/\.[^/.]+$/, "");

    // Add 'active' class to the corresponding menu item
    $('.sidebar-menu a[href="' + currentPage + '"]').addClass('active').closest('.dropdown').addClass('active');
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=51955081075&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Varela%202." class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>
<a href="" class="float1" target="_blank">
<i class="fa fa-phone my-float1"></i>
</a>