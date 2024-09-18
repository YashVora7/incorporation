<?php
session_start();
$logged_user_id = 2;

$company_id = $_GET['company_id'];


require_once '../baseUrl.php';


require_once '../db.php';

$sql = 'SELECT * FROM register_company WHERE id = ' . $company_id . '';
$result = mysqli_query($link, $sql);
$row_company_data = mysqli_fetch_assoc($result);

if ($row_company_data['company_current_status'] !== 'Payment_and_data_verified') {
    header("Location: " . $baseUrl . "internal-staff/company-dashboard/view_company_details.php?company_id=" . urlencode($company_id));
    exit; // It's a good practice to call exit after a redirect to stop further script execution
}



$sql_officer = 'SELECT * FROM officer WHERE cr_id = ' . $company_id . '';
$result_total_officers = mysqli_query($link, $sql_officer);
$total_officers = mysqli_num_rows($result_total_officers);




$sql_total_directors  = 'SELECT * FROM officer WHERE cr_id = ' . $company_id . ' AND officer_designation = "director"';
$result_total_directors = mysqli_query($link, $sql_total_directors);
$total_directors = mysqli_num_rows($result_total_directors);


$sql_total_shareholders  = 'SELECT * FROM officer where cr_id = ' . $company_id . ' AND officer_designation = "shareholder"';
$result_total_shareholder = mysqli_query($link, $sql_total_shareholders);
$total_shareholder  = mysqli_num_rows($result_total_shareholder);



$sql_total_singapore_directors  = 'SELECT * FROM officer where cr_id = ' . $company_id . ' AND officer_designation = "director" AND is_singapore_citizen = "Yes" ';
$result_total_singapore_directors = mysqli_query($link, $sql_total_singapore_directors);
$total_singapore_directors = mysqli_num_rows($result_total_singapore_directors);







?>


<?php

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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>List of Companies | Admin - Tianlong Services Pte Ltd</title>
    <link rel="stylesheet" href="../assets/css/app.min.css">
    <link rel="stylesheet" href="../assets/bundles/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="../assets/bundles/weather-icon/css/weather-icons.min.css">
    <link rel="stylesheet" href="../assets/bundles/weather-icon/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="../assets/bundles/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="icon" type="image/png" href="../assets/img/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/bundles/footable-bootstrap/css/footable.bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bundles/footable-bootstrap/css/footable.standalone.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="../plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <script src="../plugins/sweet-alert2/sweetalert2.all.min.js"></script>
    <script src="../plugins/sweet-alert2/sweet-alert.init.js"></script>

    <style>
        @media (max-width: 992px) {
            .cc {
                flex: 1 1 calc(100%) !important;
            }
        }

        @media (max-width: 600px) {
            div[style*="flex: 1 1 calc(33.333% - 20px)"] {
                flex: 1 1 calc(100% - 20px);
            }
        }

        .text_limit1 {
            display: block;
            width: 100%;
            text-align: right;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>

</head>

<body>
    
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            <!-- Header + sidebar  -->
            <?php
            require_once '../header.php';
            require_once '../sidebar.php';
            ?>

            <!-- Main Content -->
            <div class="main-content">

                <section class="section">

                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-xl-10 col-md-4 col-sm-6">
                            <div class="card c2">
                                <div class="card-bg">
                                    <div class="col p-3">
                                        <div class="row">
                                            <input style="display: none;" type="text" name="" value="<?= $company_id ?>" id="company_id">
                                            <div style="display: flex; align-items: center; justify-content: space-between; padding: 15px; border: 1px solid #ddd; border-radius: 8px;">
                                                <div style="display: flex; align-items: center;">
                                                    <div style="display: flex; align-items: center; background-color: #dff0d8; color: #3c763d; padding: 5px 10px; border-radius: 20px; margin-right: 15px;">
                                                        <span style="margin-right: 5px;">&#10003;</span> <!-- Check icon -->
                                                        <span><?= $row_company_data['company_current_status']; ?></span>
                                                    </div>
                                                    <h1 style="margin: 0; font-size: 1.5em;"><?= $row_company_data['company_name']; ?></h1>
                                                </div>

                                                <?php
                                                if ($row_company_data['company_current_status'] == 'only_company_registered') {
                                                    ?>
                                                    <button id="verify_data" style="background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; font-size: 1em; cursor: pointer;">
                                                        Verify Payment & Generate Company Documents
                                                    </button>
                                                    <?php
                                                }

                                                if ($row_company_data['company_current_status'] == 'Payment_and_data_verified') {
                                                    // Function to check if all necessary sign flags are set to 1 in the given result set
                                                    function check_sign_flags($result, $flags) {
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
                                                    $all_directors_signed = check_sign_flags($excute_dr, $flags_director);
                                                    $all_officers_signed = check_sign_flags($excute_of, $flags_officer);
                                                    $all_secretaries_signed = check_sign_flags($excute_secretary_sr, $flags_secretary);

                                                    // Check if all documents are signed successfully
                                                    if ($all_directors_signed && $all_officers_signed && $all_secretaries_signed) {
                                                        ?>
                                                        <button style="background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; font-size: 1em; cursor: pointer;">
                                                           All Document Sign Successfully
                                                        </button>
                                                        <?php
                                                    } else {
                                                       echo '<button style="background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; font-size: 1em; cursor: pointer;">
                                                            View Company Document & Status
                                                        </button>';
                                                    }
                                                }
                                                ?>

                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <center>
                        <h3 style="margin-top: 0;">Form 45B (Secretary)</h3>
                    </center>
                    <section class="section">
                        <p class="fw-bold mb-2 font-20 text-black">Form 45B for Secretary</p>
                        <br>

                        <div class="row ">
                            <!-- Director 1 -->
                            <?php  
                                while ($row_secretary = $excute_secretary->fetch_assoc()) : ?>
                                    <div class="col-xl-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <div class="card c2 overflow-hidden mb-2">
                                                <div class="col p-3">
                                                    <div class="d-flex justify-content-between">
                                                        <span class="mb-0 text-uppercase text-black fw-bold text-sm">Form 45</span>
                                                    </div>
                                                    <hr style="margin: .7rem 0;">
                                                    <div class="text-center mb-3">
                                                        <img style="width: 50%; height: auto;" src="<?php echo $baseUrl; ?>/incorporation/assets/img/logo.webp" alt="">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <p class="fw-bold mb-2 font-15 text-black">Director</p>
                                                        </div>
                                                        <div class="col-7 text-end">
                                                            <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?php echo $row_secretary['secretary_name']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-5"></div>
                                                        <div class="col-7 text-end">
                                                            <?php if ($row_secretary['sign_flag_45b'] == 1) : ?>
                                                                <span class="badge btn-success shadow-none shadow-none">Signed</span>
                                                            <?php else : ?>
                                                                <span class="badge btn-warning shadow-none shadow-none">Sign Pending</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pt-3">
                                                    <?php if ($row_secretary['sign_flag_45b'] == 1) : ?>
                                                        <a href="<?php echo $baseUrl . "incorporation/before-incorporation/form-45b/upload_form_45b_verify/" . $row_secretary['verify_sign_document_45b_pdf']; ?>" style="padding: 10px; background-color: aliceblue; text-align: center;" target="_blank">
                                                            <i class="fas fa-file mb-0"></i> Download
                                                        </a>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="row pt-3">
                                                <div class="text-end">
                                                    <?php if($row_secretary['sign_flag_45b'] == 1): ?>
                                                    <a href="#" class="btn btn-success">Already Signed</a>
                                                    <?php else:?>
                                                    <a href="<?php echo $baseUrl . "incorporation/before-incorporation/form-45b/form_45b/"?><?php echo $row_secretary['id']; ?>" class="btn btn-danger">Sign Now</a>
                                                    <?php endif;?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                            <?php endwhile;
                             ?>
                        </div>

                    </section>
                    <hr>
                    <center>
                        <h3 style="margin-top: 0;">Form 45 (Directors)</h3>
                    </center>
                    <section class="section">
                        <p class="fw-bold mb-2 font-20 text-black">Form 45 for Directors</p>
                        <br>

                        <div class="row ">
                            <!-- Director 1 -->
                            <?php  
                                while ($row = $excute->fetch_assoc()) : ?>
                                    <div class="col-xl-3 col-md-4 col-sm-6">
                                        <div class="form-group">
                                            <div class="card c2 overflow-hidden mb-2">
                                                <div class="col p-3">
                                                    <div class="d-flex justify-content-between">
                                                        <span class="mb-0 text-uppercase text-black fw-bold text-sm">Form 45</span>
                                                    </div>
                                                    <hr style="margin: .7rem 0;">
                                                    <div class="text-center mb-3">
                                                        <img style="width: 50%; height: auto;" src="<?php echo $baseUrl; ?>/incorporation/assets/img/logo.webp" alt="">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <p class="fw-bold mb-2 font-15 text-black">Director</p>
                                                        </div>
                                                        <div class="col-7 text-end">
                                                            <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?php echo $row['officer_name']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-5"></div>
                                                        <div class="col-7 text-end">
                                                            <?php if ($row['sign_flag_45'] == 1) : ?>
                                                                <span class="badge btn-success shadow-none shadow-none">Signed</span>
                                                            <?php else : ?>
                                                                <span class="badge btn-warning shadow-none shadow-none">Sign Pending</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row pt-3">
                                                    <?php if ($row['sign_flag_45'] == 1) : ?>
                                                        <a href="<?php echo $baseUrl . "incorporation/before-incorporation/form-45/upload_form_45_verify/" . $row['verify_sign_document_45_pdf']; ?>" style="padding: 10px; background-color: aliceblue; text-align: center;" target="_blank">
                                                            <i class="fas fa-file mb-0"></i> Download
                                                        </a>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="row pt-3">
                                                <div class="text-end">
                                                    <?php if($row['sign_flag_45'] == 1): ?>
                                                    <a href="#" class="btn btn-success">Already Signed</a>
                                                    <?php else:?>
                                                    <a href="<?php echo $baseUrl . "incorporation/before-incorporation/form-45/form_45/"?><?php echo $row['id']; ?>" class="btn btn-danger">Sign Now</a>
                                                    <?php endif;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php endwhile;
                             ?>
                        </div>

                    </section>
                    <hr>
                    <center>
                        <h3 style="margin-top: 0;">Company Constitution (All Members)</h3>
                    </center>
                    <section class="section">
                    <p class="fw-bold mb-2 font-20 text-black">Company Constitution</p>
                    <br>

                    <div class="row ">
                        <!-- Director 1 -->
                        <?php  
                            while ($row2 = $excute2->fetch_assoc()) : ?>
                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <div class="card c2 overflow-hidden mb-2">
                                            <div class="col p-3">
                                                <div class="d-flex justify-content-between">
                                                    <span class="mb-0 text-uppercase text-black fw-bold text-sm">Company Constitution Form<Form></Form></span>
                                                </div>
                                                <hr style="margin: .7rem 0;">
                                                <div class="text-center mb-3">
                                                    <img style="width: 50%; height: auto;" src="<?php echo $baseUrl; ?>/incorporation/assets/img/logo.webp" alt="">
                                                </div>
                                                <div class="row">
                                                    <div class="col-5">
                                                        <p class="fw-bold mb-2 font-15 text-black"><?php echo $row2['officer_designation']; ?></p>
                                                    </div>
                                                    <div class="col-7 text-end">
                                                        <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?php echo $row2['officer_name']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5"></div>
                                                    <div class="col-7 text-end">
                                                        <span class="badge btn-warning shadow-none shadow-none">Sign Pending</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-3">
                                            <?php if ($row2['sign_flag_company_constitution'] == 1) : ?>
                                                        <a href="<?php echo $baseUrl . "incorporation/before-incorporation/company-constitution/upload_verify_company_constitution_form/" . $row2['verify_sign_document_company_constition_pdf']; ?>" style="padding: 10px; background-color: aliceblue; text-align: center;" target="_blank">
                                                            <i class="fas fa-file mb-0"></i> Download
                                                        </a>

                                            <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row pt-3">
                                            <div class="text-end">
                                                <?php if($row2['sign_flag_company_constitution'] == 1): ?>
                                                <a href="#" class="btn btn-success">Already Signed</a>
                                                <?php else:?>
                                                <a href="<?php echo $baseUrl . "incorporation/before-incorporation/company-constitution/company_cpdf/"?><?php echo $row2['id']; ?>" class="btn btn-danger">Sign Now</a>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endwhile;
                          ?>
                    </div>

                </section>


                </section>
            </div>

            <!-- Footer -->
            <?php
            require_once "../footer.php";
            ?>

        </div>
    </div>
    <script>
        $('#verify_data').click(function() {

            swal.fire({
                title: 'Do you want to verify company details and payment details',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then(function(isConfirm) {
                let company_id = $('#company_id').val();
                if (isConfirm.value) {
                    $.ajax({
                        url: '../api/update_company_status.php',
                        type: 'POST',
                        data: {
                            company_id: company_id,
                            new_status: 'Payment_and_data_verified'

                        },
                        success: function(response) {
                            let result = JSON.parse(response);
                            if (result.error_flag == 0) {
                                swal.fire({
                                    title: 'Data verified & Company Documents generated',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Okay'
                                }).then(function(isConfirm) {
                                    let company_id = $('#company_id').val();
                                    if (isConfirm.value) {
                                        window.location = '<?php echo $baseUrl; ?>/internal-staff/company-dashboard/view_company_details.php?company_id=' + company_id;

                                    } else {

                                    }

                                });
                            }
                        }
                    });

                } else {

                }

            });
        })
    </script>

    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/bundles/echart/echarts.js"></script>
    <script src="../assets/bundles/chartjs/chart.min.js"></script>
    <script src="../assets/js/page/index.js"></script>
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/page/footable-data.js"></script>
    <script src="../assets/bundles/footable-bootstrap/js/footable.js"></script>
</body>

</html>