<?php
require_once '../session.php';
$logged_user_id = $_SESSION['user_id'];

$company_id = $_GET['company_id'];


require_once '../baseUrl.php';


require_once '../db.php';

$sql = 'SELECT * FROM register_company WHERE id = ' . $company_id . '';
$result = mysqli_query($link, $sql);

$row = mysqli_fetch_assoc($result);
$result_row = mysqli_num_rows($result);


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

$sql = "SELECT * FROM officer WHERE officer_designation = 'director' AND cr_id = " . $company_id . "  ORDER BY id DESC";
$excute = mysqli_query($link, $sql);
$excute_dr = mysqli_query($link, $sql);


$sql2 = "SELECT * FROM officer WHERE cr_id = ".$company_id."  ORDER BY id DESC ";
$excute2 = mysqli_query($link, $sql2);
$excute_of = mysqli_query($link, $sql2);

$sql_secretary1 = "SELECT * 
                  FROM staff_assignments
                  JOIN user_roles ON staff_assignments.secretary_id = user_roles.id
                  WHERE staff_assignments.secretary_id = '$logged_user_id' AND staff_assignments.company_id = '$company_id'";

                $excute_secretary_sr = mysqli_query($link, $sql_secretary1);
?>
<?php
$sql3 = "
    SELECT o.*, c.*,o.id AS o_id
    FROM officer o
    LEFT JOIN compliance_sign_cddkyc c ON o.id = c.officer_id
    WHERE o.cr_id = '$company_id'
      AND (o.officer_designation = 'director' OR o.officer_designation = 'shareholder')
";


$excute3 = mysqli_query($link, $sql3);
$excute_of = mysqli_query($link, $sql3);

$rows = array();

// Fetch the data
while ($results = mysqli_fetch_assoc($excute3)) {
    $rows[] = $results;
}
//echo '<pre>';
//print_r($rows); // Print all fetched rows to see the structure
//echo '</pre>';


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
         /* For the first table */
        .first_table th, .first_table td {
            width: 25%;
        }

        /* For the second table */
        .second_table th, .second_table td {
            width: 33.33%;
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
            <div class="main-content " >    
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
                     <li class="breadcrumb-item"><a href="../company-dashboard">Companies</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Company Full Details</li>
                  </ol>
                </nav>
                <section class="section">
                            <center>
                                <h3 style="margin-top: 0;">Company Details</h3>
                            </center>
                            <div class="col-lg-8 m-auto">
    <div class="card">
        <?php 
        $counter = 0; // Initialize a counter to keep track of iterations
        $totalItems = count($row); // Get total number of items
        ?>

        <?php foreach ($row as $column => $value): ?>
            <?php if ($value != '' && $value != 0): // Check if value is not empty or zero ?>
                <?php $counter++; // Increment the counter ?>
                
                <?php if ($counter <= 6 && $counter > 2): // Show only the first 5 cards ?>
                    <div class="card m-2">
                        <div class="card-body d-flex justify-content-between">
                            <h5 class="card-title">
                                <?php 
                                    // Capitalize first letter and replace underscores with spaces
                                    echo htmlspecialchars(ucwords(str_replace('_', ' ', $column))); 
                                ?>:
                            </h5>
                            <p class="card-text">
                                <?php 
                                    // Capitalize first letter and replace underscores with spaces
                                    echo htmlspecialchars(ucwords(str_replace('_', ' ', $value))); 
                                ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if ($counter > 6): // Hide the rest initially and add to dropdown ?>
                    <div class="card m-2 more-cards d-none">
                        <div class="card-body d-flex justify-content-between">
                            <h5 class="card-title">
                                <?php 
                                    echo htmlspecialchars(ucwords(str_replace('_', ' ', $column))); 
                                ?>:
                            </h5>
                            <p class="card-text">
                                <?php 
                                    echo htmlspecialchars(ucwords(str_replace('_', ' ', $value))); 
                                ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Show More Button -->
        <?php if ($counter > 5): ?>
            <button class="btn btn-primary m-3" id="showMoreBtn">Show More</button>
        <?php endif; ?>
    </div>
</div>

                    <script>
                        // JavaScript to handle show more functionality
                        document.getElementById('showMoreBtn').addEventListener('click', function() {
                            const moreCards = document.querySelectorAll('.more-cards');
                            moreCards.forEach(card => {
                                card.classList.toggle('d-none'); // Toggle visibility
                            });

                            // Change button text based on visibility
                            this.textContent = this.textContent === 'Show More' ? 'Show Less' : 'Show More';
                        });
                    </script>
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
                                                        <span><?= $row['company_current_status']; ?></span>
                                                    </div>
                                                    <h1 style="margin: 0; font-size: 1.5em;"><?= $row['company_name']; ?></h1>
                                                </div>

                                                <?php
                                                if ($row['company_current_status'] == 'only_company_registered') {
                                                ?>
                                                <button id="verify_data" style="background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; font-size: 1em; cursor: pointer;">Verify Payment & Generate Company Documents</Buttton>
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
                    <center>
                        <h3 style="margin-top: 0;">Company Officer And Share Details</h3>
                    </center>
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
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1" id="registered_name"><?= $row['number_of_shares'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Issued Shares Captial</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?= $row['issued_share_capital'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Shares Capital Currency</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?= $row['share_capital_currency'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Total Shares Payable</p>
                                            </div>
                                            <div class="col-7">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1" id="registered_contact"><?= $row['share_payable'] ?></p>
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
                    <hr>
                    <center>
                        <h3 style="margin-top: 0;">Payment Details</h3>
                    </center>
                    <?php
                    // Prepare and execute the SQL query
                    $sql_payment = "SELECT * FROM payments WHERE company_id = '$company_id'";
                    $excute_payment = mysqli_query($link,$sql_payment);
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
                                                    <p class="fw-normal mb-2 font-15 text-black-50"><?= $row['company_name']; ?></p>
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
                                    <p style="margin: 5px 0;"><strong>Shares:</strong> <?= $row_officer_data['percentage_of_shares'] ?></p>
                                    <p style="margin: 5px 0;"><strong>Total Capital:</strong> <?= $row_officer_data['issued_share_capital_allocation'] ?></p>
                                    <p style="margin: 5px 0;"><strong>Type:</strong> <?= $row_officer_data['officer_type'] ?></p>
                                    <p style="margin: 5px 0;"><strong>Is of Singapore:</strong> <?= $row_officer_data['is_singapore_citizen'] ?></p>
                                </div>
                            </div>
                        <?php
                        }

                        ?>

                        <!-- End of Officer Card -->


                    </div>



                </section>
            </div>

            <!-- Main Content -->
            <div class="main-content">

                <section class="section">
                   
                   <?php
                    $sql_secretary = "SELECT * 
                                      FROM staff_assignments
                                      JOIN user_roles ON staff_assignments.secretary_id = user_roles.id
                                      WHERE staff_assignments.secretary_id = '$logged_user_id' AND staff_assignments.company_id = '$company_id'";

                    $excute_secretary = mysqli_query($link, $sql_secretary);

                    if ($excute_secretary && mysqli_num_rows($excute_secretary) > 0) :
                    ?> 
                    <center>
                        <h3 style="margin-top: 0;">Form 45B (Secretary)</h3>
                    </center>
                    <section class="section">
                        <p class="fw-bold mb-2 font-20 text-black">Form 45B for Secretary</p>
                        <br>
                        <table class="table table-bordered first_table">
                            <thead>
                                <tr>
                                    <th>Form 45B</th>
                                    <th>Director</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row_secretary = $excute_secretary->fetch_assoc()) : ?>
                                    <tr>
                                        <td>Form 45B</td>
                                        <td><?php echo htmlspecialchars($row_secretary['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php if ($row_secretary['secretary_sign_form45b'] == 1) : ?>
                                                <span class="badge btn-success shadow-none">Signed</span>
                                            <?php else : ?>
                                                <span class="badge btn-warning shadow-none">Sign Pending</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($row_secretary['secretary_sign_form45b'] == 1) : ?>
                                                <a href="<?php echo $baseUrl . "incorporation/before-incorporation/form-45b/upload_form_45b_verify/" . htmlspecialchars($row_secretary['secretary_sign_form45b_doc'], ENT_QUOTES, 'UTF-8'); ?>" style="padding: 10px; background-color: aliceblue; text-align: center;" target="_blank">
                                                    <i class="fas fa-file mb-0"></i> Download
                                                </a>
                                                <a href="#" class="btn btn-success mt-2">Already Signed</a>
                                            <?php else : ?>
                                                <a href="<?php echo $baseUrl . "incorporation/before-incorporation/form-45b/form_45b?s_id=" . htmlspecialchars($row_secretary['id'], ENT_QUOTES, 'UTF-8') . "&c_id=" . htmlspecialchars($company_id, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-danger mt-2">Sign Now</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </section>
                    <hr>
                <?php endif; ?>
                    

                    <center>
                        <h3 style="margin-top: 0;">Form 45 (Directors)</h3>
                    </center>

                    <section class="section">
                        <p class="fw-bold mb-2 font-20 text-black">Form 45 for Directors</p>
                        <br>
                        <table class="table table-bordered second_table">
                            <thead>
                                <tr>
                                    <th>Form 45</th>
                                    <th>Director</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $excute->fetch_assoc()) : ?>
                                    <tr>
                                        <td>Form 45</td>
                                        <td><?php echo htmlspecialchars($row['officer_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php if ($row['sign_flag_45'] == 1) : ?>
                                                <span class="badge btn-success shadow-none">Signed</span>
                                            <?php else : ?>
                                                <span class="badge btn-warning shadow-none">Sign Pending</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($row['sign_flag_45'] == 1) : ?>
                                                <a href="<?php echo $baseUrl . "incorporation/before-incorporation/form-45/upload_form_45_verify/" . htmlspecialchars($row['verify_sign_document_45_pdf'], ENT_QUOTES, 'UTF-8'); ?>" style="padding: 10px; background-color: aliceblue; text-align: center;" target="_blank">
                                                    <i class="fas fa-file mb-0"></i> Download
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </section>

                    <hr>
                    <br>    
                    <center>
                        <h3 style="margin-top: 0;">Company Constitution (All Members)</h3>
                    </center>

                    <section class="section">
                        <p class="fw-bold mb-2 font-20 text-black">Company Constitution</p>
                        <br>
                        <table class="table table-bordered first_table">
                            <thead>
                                <tr>
                                    <th>Company Constitution</th>
                                    <th>Officer Designation</th>
                                    <th>Officer Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row2 = $excute2->fetch_assoc()) : ?>
                                    <tr>
                                        <td>Company Constitution Form</td>
                                        <td><?php echo htmlspecialchars($row2['officer_designation'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($row2['officer_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <span class="badge btn-warning shadow-none">Sign Pending</span>
                                        </td>
                                        <td>
                                            <?php if ($row2['sign_flag_company_constitution'] == 1) : ?>
                                                <a href="<?php echo $baseUrl . "incorporation/before-incorporation/company-constitution/upload_verify_company_constitution_form/" . htmlspecialchars($row2['verify_sign_document_company_constition_pdf'], ENT_QUOTES, 'UTF-8'); ?>" style="padding: 10px; background-color: aliceblue; text-align: center;" target="_blank">
                                                    <i class="fas fa-file mb-0"></i> Download
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?> 
                            </tbody>
                        </table>
                    </section>

                </section>
            </div>
            <!-- Main Content -->
            <div class="main-content">

                <section class="section">
                    <center>
                        <h3 style="margin-top: 0;">CDDKYC FORM (All Members)</h3>
                    </center>
                    <section class="section">
                    <p class="fw-bold mb-2 font-20 text-black">CDDKYC FORM</p>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Designation</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Customer Report PDF</th>
                                    <th>CDDKYC Form</th>
                                    <th>CDDKYC Sign </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $row2): ?>
                                    <?php if (($row2['officer_designation'] == 'shareholder' && $row2['percentage_of_shares'] >= 25) || $row2['officer_designation'] == 'director'): ?>
                                        <tr>
                                            <td><?php echo $row2['officer_designation']; ?></td>
                                            <td><?php echo $row2['officer_name']; ?></td>
                                            <td>
                                                <?php if ($row2['cddkyc_form'] == 1) : ?>
                                                    <span class="badge bg-success">Submitted</span>
                                                <?php else : ?>
                                                    <span class="badge bg-warning">Form Not Submitted</span>
                                                <?php endif ;?>
                                            </td>
                                            <td >
                                                <?php if ($row2['cddkyc_customer_pdf'] !=''): ?>
                                                    <a href="<?php echo $baseUrl . "internal-staff/uploads/customer_acceptance_form/" . $row2['cddkyc_customer_pdf']; ?>" target="_blank">
                                                    <i class="fas fa-file"></i> Download
                                                </a>
                                                 <?php else: ?>
                                                    <p>NO PDF</p>
                                                <?php endif; ?>
                                            </td>
                                            <td >
                                                <?php if ($row2['compliance_sign_cddkyc_doc'] !=''): ?>
                                                    <a href="<?php echo $baseUrl . "internal-staff/uploads/cddkyc_form_sign_by_compliance/" . $row2['compliance_sign_cddkyc_doc']; ?>" target="_blank">
                                                    <i class="fas fa-file"></i> Download
                                                </a>
                                                 <?php else: ?>
                                                    <p>NO PDF</p>
                                                <?php endif; ?>
                                            </td>
                                            <td >
                                                <?php if ($row2['compliance_sign_cddkyc'] == 1): ?>
                                                    <a href="#" class="btn btn-success">Already Sign</a>
                                                <?php else: ?>
                                                    <a href="#" class="btn btn-danger">Not Signed</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif;?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
</body>
</html>
