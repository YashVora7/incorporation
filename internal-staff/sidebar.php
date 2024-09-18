<?php
$logged_user_id  =$_SESSION['user_id'];
if (isset($_GET['company_id'])) {
$company_id = isset($_GET['company_id'])?$_GET['company_id']:"";

$sql_company = "SELECT * FROM register_company WHERE id = '$company_id' ";
$sql_excute = mysqli_query($link,$sql_company);
$result = mysqli_fetch_assoc($sql_excute);
}
?>
<?php
if (isset($_GET['company_id'])) {
$company_id = $_GET['company_id'];
$sql = "SELECT * FROM officer WHERE officer_designation = 'director' AND cr_id = " . $company_id . "  ORDER BY id DESC";
$excute = mysqli_query($link, $sql);
$excute_dr = mysqli_query($link, $sql);

$sql2 = "SELECT * FROM officer WHERE cr_id = ".$company_id."  ORDER BY id DESC ";
$excute2 = mysqli_query($link, $sql2);
$excute_of = mysqli_query($link, $sql2);

$sql_secretary = 'SELECT * FROM secretary WHERE cr_id = ' . $company_id . '';
$excute_secretary = mysqli_query($link, $sql_secretary);
$excute_secretary_sr = mysqli_query($link, $sql_secretary);

$sql_compliance = "SELECT * FROM staff_assignments WHERE company_id = '$company_id' AND compliance_id = '$logged_user_id'";
$excute_compliance = mysqli_query($link, $sql_compliance);
$result_compliance = mysqli_fetch_assoc($excute_compliance);
$total_row_compliance = mysqli_num_rows($excute_compliance);
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
                <h3 style="font-size:100%;">Internal Staff</h3>
            </div>
        </div>
        <ul class="sidebar-menu">
        <?php if (isset($_GET['company_id']) && $total_row_compliance > 0): ?>
            <?php if ($total_row_compliance > 0): ?>
                <?php if ($result_compliance['company_id'] == $company_id && $result_compliance['compliance_id'] == $logged_user_id) : ?>
                <!-- Additional conditions for compliance could be added here -->
                <?php endif; ?>
            <?php endif; ?>
        <!-- Main Menu -->
        <li class="menu-header">Home</li>
        <?php else: ?> 
            <li>
                <a href="<?php echo $baseUrl; ?>/internal-staff" class="nav-link">
                    <i data-feather="home"></i><span>Dashboard</span>
                </a>
            </li> 
            <li>
                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard" class="nav-link">
                    <i data-feather="briefcase"></i><span>Company Dashboard</span>
                </a>
            </li>   
            <li>
                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/only_register_company.php" class="nav-link">
                    <i data-feather="user-check"></i><span>Registered Company</span>
                </a>
            </li>      
        <?php endif;?>
        
        <?php if (isset($_GET['company_id'])): ?>
            <li>
                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/company_statics.php?company_id=<?php echo $company_id; ?>" class="nav-link">
                    <i data-feather="bar-chart"></i><span>Statics Dashboard</span>
                </a>
            </li>
            <?php if ($result['company_current_status'] == 'Payment_and_data_verified' || $result['company_current_status'] == 'only_company_registered'): ?>
                <li class="menu-header">Company Detail</li>
                <li>
                    <a class="nav-link" href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/view_company_details.php?company_id=<?= $result['id'] ?>"><i data-feather="info"></i><span>View Company Detail</span></a>
                </li>
            <?php endif; ?>

            <?php if ($result['company_current_status'] == 'Payment_and_data_verified'): ?>
                <li class="dropdown">
                    <a class="nav-link" href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/view_company_documents.php?company_id=<?= $result['id'] ?>"><i data-feather="file-text"></i><span>View Company Documents</span></a>
                </li>
            <?php endif; ?>
            
            <?php
            function check_sign_flags1($result, $flags) {
                while ($sign_check_row = mysqli_fetch_assoc($result)) {
                    foreach ($flags as $flag) {
                        if (!isset($sign_check_row[$flag]) || $sign_check_row[$flag] != 1) {
                            return false;
                        }
                    }
                }
                return true;
            }
            // Define the flags to check
            $flags_director = ['sign_flag_45'];
            $flags_officer = ['sign_flag_company_constitution'];
            $flags_secretary = ['sign_flag_45b'];

            // Check if all flags are set to 1 in the results
            $all_directors_signed = check_sign_flags1($excute_dr, $flags_director);
            $all_officers_signed = check_sign_flags1($excute_of, $flags_officer);
            $all_secretaries_signed = check_sign_flags1($excute_secretary_sr, $flags_secretary);
            ?>
            <?php if ($result['company_current_status'] == 'Payment_and_data_verified') : ?>
                <?php if ($total_row_compliance > 0): ?>
                    <?php if ($result_compliance['company_id'] == $company_id && $result_compliance['compliance_id'] == $logged_user_id) : ?>
                        <li class="menu-header">CDDKYC Management</li>
                        <li class="dropdown">
                            <a class="nav-link" href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/cddkyc.php?company_id=<?= $result['id'] ?>"><i data-feather="shield"></i><span>CDDKYC</span></a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif;?>
        <?php endif;?>
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