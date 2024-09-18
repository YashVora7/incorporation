<?php
require_once '../session.php';
$logged_user_id = $_SESSION['user_id'];
require_once '../baseUrl.php';
require_once '../db.php';

$sql2 = "SELECT *
    FROM register_company
    WHERE company_current_status = 'only_company_registered'
";
$excute2 = mysqli_query($link, $sql2);
while ($result = mysqli_fetch_assoc($excute2)) {
    $rows[] = $result;
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
                    <li class="breadcrumb-item active" aria-current="page">Only Register Companys</li>
                  </ol>
                </nav>
                <section class="section">
                    <br> 
                    <center>
                        <h3 style="margin-top: 0;">Company List (Only Registered Companies)</h3>
                    </center>
                    <section class="section">
                    <p class="fw-bold mb-2 font-20 text-black">Company List</p>
                    <br>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Company Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sr_no = 1; foreach ($rows as $row2): ?>
                                     <tr>
                                         <td><?php echo $sr_no++ ; ?></td>
                                         <td><?php echo $row2['company_name']." ".$row2['company_suffix']; ?></td>
                                         <td><?php echo $row2['company_current_status']; ?></td>
                                     </tr>
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