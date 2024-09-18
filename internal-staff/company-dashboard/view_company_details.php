<?php
require_once '../session.php';
$logged_user_id = $_SESSION['user_id'];

$company_id = $_GET['company_id'];


require_once '../baseUrl.php';


require_once '../db.php';

$sql = 'SELECT * FROM register_company WHERE id = ' . $company_id . '';
$result = mysqli_query($link, $sql);
$row_company_data = mysqli_fetch_assoc($result);



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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


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

        .page-break {
            page-break-after: always;
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
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="../company-dashboard">Companies</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Company Details</li>
                    </ol>
                </nav>
                <section class="section" id="content">
                    <a href="#" id="download" class="btn btn-primary float-end">Download as PDF</a>
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
                                                    <h1 style="margin: 0; font-size: 1.5em;"><?= $row_company_data['company_name'] . " " . $row_company_data['company_suffix']; ?></h1>
                                                </div>

                                                <?php
                                                if ($row_company_data['company_current_status'] == 'only_company_registered') {
                                                ?>
                                                    <button id="verify_data" style="background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; font-size: 1em; cursor: pointer;">Verify Payment & Generate Company Documents</Buttton>

                                                    <?php
                                                }
                                                if ($row_company_data['company_current_status'] == 'Payment_and_data_verified') {
                                                    ?>
                                                        <a href="view_company_documents.php?company_id=<?= $company_id; ?>" style="background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; font-size: 1em; cursor: pointer;">View Company Document & Status</a>

                                                    <?php
                                                }

                                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xl-2 col-md-4 col-sm-6"></div>
                        <div class="col-xl-4 col-md-4 col-sm-6">
                            <div class="card c2">
                                <div class="card-bg">
                                    <div class="col p-3">

                                        <div class="d-flex justify-content-between">
                                            <span class="mb-0 text-uppercase text-black fw-bold text-sm">Company Info</span>
                                        </div>
                                        <hr style="margin: .7rem 0;">
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Total Officers</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1" id="registered_name"><?= $total_officers ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Total Directors</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?= $total_directors ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Singapore Directors</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?= $total_singapore_directors ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Total Shareholders</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1" id="registered_contact"><?= $total_shareholder ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-9"></div>
                                            <div class="col-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-6">
                            <div class="card c2">
                                <div class="card-bg">
                                    <div class="col p-3">

                                        <div class="d-flex justify-content-between">
                                            <span class="mb-0 text-uppercase text-black fw-bold text-sm">Company Captial & Shares Details</span>
                                        </div>
                                        <hr style="margin: .7rem 0;">
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Total Number of Shares</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1" id="registered_name"><?= $row_company_data['number_of_shares'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Issued Shares Captial</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?= $row_company_data['issued_share_capital'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Shares Capital Currency</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?= $row_company_data['share_capital_currency'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Total Shares Payable</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1" id="registered_contact"><?= $row_company_data['share_payable'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-9"></div>
                                            <div class="col-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="page-break"></div>
                    <hr>
                    <center>
                        <h3 style="margin-top: 0;">Payment Details</h3>
                    </center>
                    <?php
                    // Prepare and execute the SQL query
                    $sql_payment = "SELECT * FROM payments WHERE company_id = '$company_id'";
                    $excute_payment = mysqli_query($link, $sql_payment);
                    // Fetch the payment details
                    $payment_data = mysqli_fetch_assoc($excute_payment);
                    ?>
                    <?php if ($payment_data): ?>
                        <div class="row">
                            <div class="col-xl-4 col-md-4 col-sm-6">
                                <div class="card c2">
                                    <div class="card-bg">
                                        <div class="col p-3">
                                            <div class="d-flex justify-content-between">
                                                <span class="mb-0 text-uppercase text-black fw-bold text-sm">Payment Details</span>
                                            </div>
                                            <hr style="margin: .7rem 0;">

                                            <div class="row mb-3">
                                                <div class="col-5">
                                                    <p class="fw-bold mb-2 font-15 text-black">Company Name</p>
                                                </div>
                                                <div class="col-7">
                                                    <p class="fw-normal mb-2 font-15 text-black-50"><?= $row_company_data['company_name']; ?></p>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-5">
                                                    <p class="fw-bold mb-2 font-15 text-black">Amount</p>
                                                </div>
                                                <div class="col-7">
                                                    <p class="fw-normal mb-2 font-15 text-black-50"><?= htmlspecialchars($payment_data['amount']) ?></p>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-5">
                                                    <p class="fw-bold mb-2 font-15 text-black">Currency</p>
                                                </div>
                                                <div class="col-7">
                                                    <p class="fw-normal mb-2 font-15 text-black-50"><?= htmlspecialchars($payment_data['currency']) ?></p>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-5">
                                                    <p class="fw-bold mb-2 font-15 text-black">Description</p>
                                                </div>
                                                <div class="col-7">
                                                    <p class="fw-normal mb-2 font-15 text-black-50"><?= htmlspecialchars($payment_data['description']) ?></p>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-5">
                                                    <p class="fw-bold mb-2 font-15 text-black">Stripe Payment Intent ID</p>
                                                </div>
                                                <div class="col-7">
                                                    <p class="fw-normal mb-2 font-15 text-black-50"><?= htmlspecialchars($payment_data['stripe_payment_intent_id']) ?></p>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-5">
                                                    <p class="fw-bold mb-2 font-15 text-black">Status</p>
                                                </div>
                                                <div class="col-7">
                                                    <p class="fw-normal mb-2 font-15 text-success"><?= htmlspecialchars($payment_data['status']) ?></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <h4 class=" text-center text-danger">Payment Not Done Yet.....</h4>
                    <?php endif; ?>

                    <hr>
                    <div class="page-break"></div>
                    <center>
                        <h3 style="margin-top: 0;">Company Officers</h3>
                    </center>
                    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin: 20px auto; max-width: 1200px; font-family: Arial, sans-serif;">
                        <!-- Officer Card -->

                        <?php

                        $result_fetch_officer = mysqli_query($link, 'SELECT * FROM officer WHERE cr_id = ' . $company_id . '');

                        while ($row_officer_data = mysqli_fetch_assoc($result_fetch_officer)) {
                        ?>
                            <div class="cc" style="flex: 1 1 calc(33.333% - 20px); box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); border-radius: 10px; overflow: hidden; background-color: #fff; margin-bottom: 20px;">
                                <div style="padding: 20px;">
                                    <h3 style="margin-top: 0;"><?= $row_officer_data['officer_name'] ?></h3>
                                    <p style="margin: 5px 0;"><strong>Designation:</strong> <?= $row_officer_data['officer_designation'] ?></p>
                                    <p style="margin: 5px 0;"><strong>Email:</strong> <?= $row_officer_data['officer_email_address'] ?></p>
                                    <p style="margin: 5px 0;"><strong>Contact:</strong> <?= $row_officer_data['officer_contact'] ?></p>
                                    <p style="margin: 5px 0;"><strong>Shares:</strong> <?= intval($row_officer_data['percentage_of_shares']) . '%' ?></p>
                                    <p style="margin: 5px 0;"><strong>Total Capital:</strong> <?= $row_officer_data['issued_share_capital_allocation'] ?></p>
                                    <p style="margin: 5px 0;"><strong>Type:</strong> <?= $row_officer_data['officer_type'] ?></p>
                                    <p style="margin: 5px 0;"><strong>Nationality:</strong> <?= $row_officer_data['officer_passport_nationality'] ?></p>
                                    <div class=" d-flex">
                                        <!-- Download buttons -->
                                        <?php if (!empty($row_officer_data['business_registration_certificate_of_entity']) && $row_officer_data['business_registration_certificate_of_entity'] !== 'NA') { ?>
                                            <p style="margin: 5px 0;" class="mx-2">
                                                <a href="<?= $baseUrl ?>incorporation/uploads/<?= $row_officer_data['business_registration_certificate_of_entity'] ?>" download class="btn btn-primary">Download Business Registration Certificate</a>
                                            </p>
                                        <?php } ?>

                                        <?php if (!empty($row_officer_data['passport_image']) && $row_officer_data['passport_image'] !== 'NA') { ?>
                                            <p style="margin: 5px 0;">
                                                <a href="<?= $baseUrl ?>incorporation/uploads/<?= $row_officer_data['passport_image'] ?>" download class="btn btn-primary">Download Passport Image</a>
                                            </p>
                                        <?php } ?>
                                    </div>
                                    <div class=" d-flex">
                                        <?php if (!empty($row_officer_data['proof_of_address_image']) && $row_officer_data['proof_of_address_image'] !== 'NA') { ?>
                                            <p style="margin: 5px 0;" class="mx-2">
                                                <a href="<?= $baseUrl ?>incorporation/uploads/<?= $row_officer_data['proof_of_address_image'] ?>" download class="btn btn-primary">Download Proof of Address</a>
                                            </p>
                                        <?php } ?>

                                        <?php if (!empty($row_officer_data['officer_nric_id_image']) && $row_officer_data['officer_nric_id_image'] !== 'NA') { ?>
                                            <p style="margin: 5px 0;">
                                                <a href="<?= $baseUrl ?>incorporation/uploads/<?= $row_officer_data['officer_nric_id_image'] ?>" download class="btn btn-primary">Download NRIC ID Image</a>
                                            </p>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        <?php
                        }

                        ?>

                        <!-- End of Officer Card -->
                    </div>
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
        });

        $(document).ready(function() {
            $('#download').on('click', function(e) {
                e.preventDefault(); // Prevent default anchor behavior
                $('#download').hide();

                const element = $('#content').get(0); // Get the DOM element

                html2pdf()
                    .from(element)
                    .set({
                        margin: 0.7, // Adjust margin (in inches)
                        filename: 'download.pdf',
                        image: {
                            type: 'jpeg',
                            quality: 0.98
                        },
                        html2canvas: {
                            scale: 2 // Increase scale for better quality
                        },
                        jsPDF: {
                            unit: 'in',
                            format: 'letter',
                            orientation: 'landscape' // Change page size and orientation
                        }
                    })
                    .save()
                    .then(() => {
                        $('#download').show();
                    });
            });
        });
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