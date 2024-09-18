<?php
// require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';
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
    <link href="../plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <script src="../plugins/sweet-alert2/sweetalert2.all.min.js"></script>
    <script src="../plugins/sweet-alert2/sweet-alert.init.js"></script>

    <style>
        .text_limit1 {
            display: block;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .formm {
            box-shadow: 1px 2px 5px #00000017 !important;
            border-radius: .25rem !important;
            padding: 1.5rem !important;
            margin-top: .5rem !important;
            margin-bottom: 1.5rem !important;
            background: white;
        }
    </style>

</head>
<body>
    <div class="loader"></div>
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
                    <li class="breadcrumb-item active" aria-current="page">Incorporate</li>
                  </ol>
                </nav>
                <section class="section formm">
                    <div class="container mt-4">
                        <h5 id="welcome_msg">Add Incorporation Details</h5>
                        <!-- enctype="multipart/form-data" is necessary for file uploads -->
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                            <input type="hidden" name="company_id" value="<?php echo $_GET['company_eid']; ?>">
                            <?php if (isset($_GET['incorporate_id'])): ?>
                                <input type="hidden" name="incorporate_id" value="<?php echo $_GET['incorporate_id']; ?>">
                            <?php endif; ?>
                            <div class="mb-3">
                                <label for="transaction_member" class="form-label">Transaction Number</label>
                                <input type="text" class="form-control" id="transaction_member" name="transaction_member" required>
                            </div>
                            <div class="mb-3">
                                <label for="name_application" class="form-label">Name Application</label>
                                <input type="text" class="form-control" id="name_application" name="name_application" required>
                            </div>
                            <div class="mb-3">
                                <label for="receipt" class="form-label">Supporting Document</label>
                                <!-- File input for receipt -->
                                <input type="file" class="form-control" id="receipt" name="receipt" accept=".pdf,.jpg,.jpeg,.png" required>
                            </div>
                            <div class="mb-3">
                                <label for="incorporation_status" class="form-label">Incorporation Status</label>
                                <select class="form-control" id="incorporation_status" name="incorporation_status" required>
                                    <option value="completed">Completed</option>
                                    <option value="pending">Pending</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </section>
            </div>

            <!-- Footer -->
            <?php
            require_once '../footer.php';
            ?>

        </div>
    </div>
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
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $company_id = $_POST['company_id'];
    $transaction_member = $_POST['transaction_member'];
    $name_application = $_POST['name_application'];
    $incorporation_status = $_POST['incorporation_status'];
    $receipt = $_FILES['receipt'];

    // Handle file upload
    $target_dir = "../uploads/incorporate_receipt/";
    $target_file = $target_dir . basename($receipt["name"]);
    $file_name = basename($receipt["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a valid format
    $allowedTypes = array("pdf");
    if (!in_array($fileType, $allowedTypes)) {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        if (move_uploaded_file($receipt["tmp_name"], $target_file)) {
            if (isset($_POST['incorporate_id'])) {
                // Update existing record
                $incorporate_id = $_POST['incorporate_id'];
                $update_sql = "UPDATE incorporate SET transaction_member='$transaction_member', name_application='$name_application', receipt='$file_name', incorporation_status='$incorporation_status' WHERE id='$incorporate_id'";

                if ($link->query($update_sql) === TRUE) {
                    echo "<script>
                        swal.fire({
                            title: 'Incorporate Updated Successfully',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Okay'
                        }).then(function(isConfirm) {
                            if (isConfirm.value) {
                                window.location = '" . $baseUrl . "/internal-staff/';
                            }
                        });
                    </script>";
                } else {
                    echo "<script>
                        swal.fire({
                            title: 'Update Failed',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Okay'
                        }).then(function(isConfirm) {
                            if (isConfirm.value) {
                                window.location = '" . $baseUrl . "/internal-staff/';
                            }
                        });
                    </script>";
                }
            } else {
                // Insert new record
                $insert_sql = "INSERT INTO incorporate (company_id, transaction_member, name_application, receipt, incorporation_status)
                               VALUES ('$company_id', '$transaction_member', '$name_application', '$file_name', '$incorporation_status')";

                if ($link->query($insert_sql) === TRUE) {
                    echo "<script>
                        swal.fire({
                            title: 'Incorporate Successfully',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Okay'
                        }).then(function(isConfirm) {
                            if (isConfirm.value) {
                                window.location = '" . $baseUrl . "/internal-staff/';
                            }
                        });
                    </script>";
                } else {
                    echo "<script>
                        swal.fire({
                            title: 'Incorporate Failed',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Okay'
                        }).then(function(isConfirm) {
                            if (isConfirm.value) {
                                window.location = '" . $baseUrl . "/internal-staff/';
                            }
                        });
                    </script>";
                }
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
