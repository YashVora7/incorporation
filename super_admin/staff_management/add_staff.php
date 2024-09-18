<?php
require_once '../session.php';
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
            <div class="main-content ">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item">Staff Management</li>
                        <li class="breadcrumb-item">Staffs</li>
                        <li class="breadcrumb-item active" aria-current="page">Add Staff</li>
                      </ol>
                </nav>
                <section class="section">
                    <div class="container mt-4 formm">  
                     <h5 id="welcome_msg">Add Staff</h5>   
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="tel" class="form-control" id="contact" name="contact" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Password</label>
                                <input type="tel" class="form-control" id="password" name="password" required>
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
if (isset($_POST['submit'])) {
  // Sanitize and get form data
    $name = isset($_POST['name']) ? $link->real_escape_string($_POST['name']) : null;
    $email = isset($_POST['email']) ? $link->real_escape_string($_POST['email']) : null;
    $contact = isset($_POST['contact']) ? $link->real_escape_string($_POST['contact']) : null;
    $password = isset($_POST['password']) ? $link->real_escape_string($_POST['password']) : null;

    // Insert query
    $sql = "INSERT INTO user_roles (name, email, contact,password) VALUES ('$name', '$email', '$contact','$password')";

    if ($link->query($sql) === TRUE) {
        echo "<script>
            swal.fire({
                title: 'New Staff Inserted Successfully',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okay'
            }).then(function(isConfirm) {
                
                if (isConfirm.value) {
                    window.location = '" . $baseUrl . "/super_admin/staff_management/index.php';
                }
            });
            </script>";
        } else {
            echo "<script>
            swal.fire({
                title: 'New Staff Insert Failed',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okay'
            }).then(function(isConfirm) {
                if (isConfirm.value) {
                  window.location = '" . $baseUrl . "/super_admin/staff_management/add_staff.php';
                }
            });
            </script>";
        }
}


?>
