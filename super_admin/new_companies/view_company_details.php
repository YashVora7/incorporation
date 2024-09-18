<?php
session_start();
$logged_user_id = 2;

$company_id = isset($_GET['company_id'])?$_GET['company_id']:$_POST['company_id'];

require_once '../baseUrl.php';


require_once '../db.php';

$sql = "SELECT rc.*, sa.* FROM register_company rc LEFT JOIN staff_assignments sa ON rc.id = sa.company_id WHERE rc.id = '$company_id'";
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
        .theme-white .text-primary {
             color: #0d6efd !important;
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
                    <li class="breadcrumb-item active" aria-current="page">View Company Details</li>
                  </ol>
                </nav>
                <section class="section">
                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-xl-10 col-md-4 col-sm-6">
                            <div class="card c2">
                                <div class="card-bg">
                                    <div class="col pt-1">
                                        <div class="row">
                                            <input style="display: none;" type="text" name="" value="<?= $company_id ?>" id="company_id"><h4 id="assign_staff" class="text-primary m-2">Assign Staff to <?= $row_company_data['company_name']; ?></h4>
                                           <div class="container p-4 " style="background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 12px;">
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    
                                                </div>

                                                <?php
                                                // Database connection

                                                // Fetch users for each role
                                                $staff = $link->query("SELECT id, name FROM user_roles WHERE isAdmin = 3");

                                                $staff_array = [];
                                                while ($row = $staff->fetch_assoc()) {
                                                    $staff_array[] = $row;
                                                }
                                                ?>
                                                
                                                <form class="row g-3" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                                    <input type="hidden" name="company_id" id="company_id" value="<?php echo $company_id; ?>">

                                                    <?php
                                                    $secretary_id = $row_company_data['secretary_id']; 
                                                    $compliance_id = $row_company_data['compliance_id']; 
                                                    $incorporator_id = $row_company_data['incorporator_id']; 
                                                    ?>

                                                    <div class="col-md-4">
                                                        <label for="secretary" class="form-label text-secondary">Assign Secretary</label>
                                                        <select class="form-select" id="secretary" name="secretary_id">
                                                            <option value="">Select Secretary</option>
                                                            <?php foreach ($staff_array as $row): ?>
                                                                <option value="<?= $row['id'] ?>" <?= ($secretary_id == $row['id']) ? 'selected' : '' ?>>
                                                                    <?= $row['name'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="compliance" class="form-label text-secondary">Assign Compliance Person</label>
                                                        <select class="form-select" id="compliance" name="compliance_id">
                                                            <option value="">Select Compliance Person</option>
                                                            <?php foreach ($staff_array as $row): ?>
                                                                <option value="<?= $row['id'] ?>" <?= ($compliance_id == $row['id']) ? 'selected' : '' ?>>
                                                                    <?= $row['name'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="incorporator" class="form-label text-secondary">Assign Incorporator</label>
                                                        <select class="form-select" id="incorporator" name="incorporator_id">
                                                            <option value="">Select Incorporator</option>
                                                            <?php foreach ($staff_array as $row): ?>
                                                                <option value="<?= $row['id'] ?>" <?= ($incorporator_id == $row['id']) ? 'selected' : '' ?>>
                                                                    <?= $row['name'] ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>

                                                    <div class="d-flex justify-content-end mt-4">
                                                        <?php if ($row_company_data['id'] != null): ?>
                                                            <button type="submit" name="update" class="btn btn-success px-4">Update Staff</button>
                                                        <?php else: ?>
                                                            <button type="submit" name="submit" class="btn btn-primary px-4">Assign Staff</button>
                                                        <?php endif; ?>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <hr>
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
                                                <span class="mb-0 text-black fw-bold text-sm">Payment Details</span>
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
                    <center>
                        <h3 style="margin-top: 0;">Company Officers</h3>
                    </center>
                    <style>
                        .officer-card:hover {
                            transform: translateY(-10px);
                            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                        }
                    </style>
                    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin: 20px auto; max-width: 1200px; font-family: Arial, sans-serif;">
                        <!-- Officer Card -->

                        <?php
                        $result_fetch_officer = mysqli_query($link, 'SELECT * FROM officer WHERE cr_id = ' . $company_id . '');

                        while ($row_officer_data = mysqli_fetch_assoc($result_fetch_officer)) {
                        ?>
                            <div class="officer-card" style="flex: 1 1 calc(33.333% - 20px); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px; overflow: hidden; background-color: #fff; margin-bottom: 20px; transition: transform 0.3s ease;">
                                <div style="padding: 20px;">
                                    <h3 style="margin-top: 0; font-size: 20px; color: #0073e6;"><?= $row_officer_data['officer_name'] ?></h3>
                                    <p style="margin: 10px 0; font-size: 14px; color: #666;"><strong>Designation:</strong> <?= ucwords($row_officer_data['officer_designation']) ?></p>
                                    <p style="margin: 10px 0; font-size: 14px; color: #666;"><strong>Email:</strong> <?= $row_officer_data['officer_email_address'] ?></p>
                                    <p style="margin: 10px 0; font-size: 14px; color: #666;"><strong>Contact:</strong> <?= $row_officer_data['officer_contact'] ?></p>
                                    <p style="margin: 10px 0; font-size: 14px; color: #666;"><strong>Shares:</strong> <?= $row_officer_data['percentage_of_shares'] ?>%</p>
                                    <p style="margin: 10px 0; font-size: 14px; color: #666;"><strong>Type:</strong> <?= $row_officer_data['officer_type'] ?></p>
                                    <p style="margin: 10px 0; font-size: 14px; color: #666;"><strong>Is Singapore Citizen?</strong> <?= ucfirst($row_officer_data['is_singapore_citizen']) ?></p>
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


       <?php
           if (isset($_POST['update'])) {
            print_r($_POST);
                $id = $row_company_data['id'];
                $company_id = $_POST['company_id'];
                $secretary_id=$_POST['secretary_id'];
                $compliance_id=$_POST['compliance_id'];          
                $incorporator_id=$_POST['incorporator_id'];
                 $update_stmt ="UPDATE staff_assignments SET secretary_id = '$secretary_id', compliance_id = '$compliance_id', incorporator_id = '$incorporator_id' WHERE  company_id= '$company_id' AND id = '$id'";

               if (mysqli_query($link, $update_stmt)) {
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Staff assignment updated successfully!',
                                confirmButtonText: 'OK'
                            }).then(function(isConfirm) {
                                if (isConfirm.value) {
                                      window.location = '" . $baseUrl . "/super_admin/new_companies/view_company_details.php?company_id=" . $company_id . "';
                                }
                            });
                          </script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                icon: 'fail',
                                title: 'fail',
                                text: ' Staff assignment not updated successfully!',
                                confirmButtonText: 'OK'
                            }).then(function(isConfirm) {
                                if (isConfirm.value) {
                                      window.location = '" . $baseUrl . "/super_admin/new_companies/view_company_details.php?company_id=" . $company_id . "';
                                }
                            });
                          </script>";
                }
            }
            if (isset($_POST['submit'])) {
                // Get form data
                $company_id = $_POST['company_id'];
                $secretary_id=$_POST['secretary_id'];
                $compliance_id=$_POST['compliance_id'];          
                $incorporator_id=$_POST['incorporator_id'];                

                // Insert data into the database
                $stmt = $link->prepare("INSERT INTO staff_assignments (company_id, secretary_id, compliance_id, incorporator_id) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiii", $company_id, $secretary_id, $compliance_id, $incorporator_id);

               if (mysqli_query($link, $update_stmt)) {
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Staff assigned successfully!',
                                confirmButtonText: 'OK'
                            }).then(function(isConfirm) {
                                if (isConfirm.value) {
                                      window.location = '" . $baseUrl . "/super_admin/new_companies/view_company_details.php?company_id=" . $company_id . "';
                                }
                            });
                          </script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Error:".$stmt->error."',
                                confirmButtonText: 'OK'
                            }).then(function(isConfirm) {
                                if (isConfirm.value) {
                                      window.location = '" . $baseUrl . "/super_admin/new_companies/view_company_details.php?company_id=" . $company_id . "';
                                }
                            });
                          </script>";
                }
                if ($stmt->execute()) {
                    echo "Staff assigned successfully!";
                } else {
                    echo "Error: " . $stmt->error;
                }

            }
        ?>

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
