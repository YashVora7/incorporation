<?php
require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql_company_data = mysqli_query($link, 'SELECT * FROM register_company WHERE user_id = ' . $user_id . '');
    
    $row_companys = array();
    while ($row_company_data = mysqli_fetch_assoc($sql_company_data)) {
        $row_companys[] = $row_company_data;
    }
    
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Incorporation Status - Tianlong Services Pte Ltd</title>
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

    <style>
        .text_limit1 {
            display: block;
            width: 100%;
            text-align: right;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .heading {
            background-color: aliceblue;
            padding: 8px 3px;
        }

        @media(min-width: 768px) {
            .side_line {
                border-right: 1px solid #b6b5b5ba;
            }
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
            <?php
            if (isset($_SESSION['user_id'])) {
            ?>
                <div class="main-content">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Incorporation Status</li>
                  </ol>
                </nav>
                   <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card c2">
                                <div class="card-bg">
                                    <div class="col p-3">
                                        <?php foreach ($row_companys as $row_company): ?>
                                            <div class="d-md-flex gap-3">
                                                <p class="fw-bold mb-2 font-20 text-black">Company:
                                                    <span class="fw-normal mb-2 font-20 text-black-50"><?= htmlspecialchars($row_company['company_name']); ?></span>
                                                </p>
                                                <div>
                                                    <h5 class="badge btn-warning shadow-none font-15 mb-0"><?= htmlspecialchars($row_company['company_current_status']); ?></h5>
                                                </div>
                                            </div>

                                            <hr style="margin: .7rem 0;">

                                            <div class="row">
                                                <div class="form-group" style="margin-top: 15px;">
                                                    <p class="fw-bold mb-0 font-20 text-black">DOCUMENT SIGN</p>
                                                </div>
                                                <br>

                                                <?php
                                                // Fetch officers for the current company
                                                $company_id = $row_company['id'];
                                                $sql_officers = mysqli_query($link, 'SELECT * FROM officer WHERE cr_id = ' .  $company_id);

                                                if (mysqli_num_rows($sql_officers) > 0) {
                                                    while ($row_officer = mysqli_fetch_assoc($sql_officers)) :
                                                ?>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-10 side_line">
                                                                   <div class="text-center heading">
                                                                        <span class="mb-0 text-uppercase text-black fw-bold text-sm"><?= htmlspecialchars($row_officer['officer_name']); ?></span>
                                                                         <br>
                                                                        <span class="text-uppercase text-black-50"><?= htmlspecialchars($row_officer['officer_designation']); ?></span>
                                                                    </div>
                                                                    <hr style="margin: .7rem 0;">
                                                                        <div class="row">
                                                                           <?php if ($row_officer['officer_designation'] != 'shareholder'): ?>
                                                                            <div class="col-7">
                                                                                <p class="fw-bold mb-2 font-15 text-black">Form 45</p>
                                                                            </div>
                                                                            <div class="col-5 text-end">
                                                                                <?php if ($row_officer['sign_flag_45'] == 1): ?>
                                                                                    <span class="badge bg-success">Signed</span>
                                                                                <?php else: ?>
                                                                                    <span class="badge bg-warning">Sign Pending</span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    <div class="row">
                                                                        <div class="col-7">
                                                                            <p class="fw-bold mb-2 font-15 text-black">Company Constitution</p>
                                                                        </div>
                                                                        <div class="col-5 text-end">
                                                                            <?php if ($row_officer['sign_flag_company_constitution'] == 1): ?>
                                                                                <span class="badge bg-success">Signed</span>
                                                                            <?php else: ?>
                                                                                <span class="badge bg-warning">Sign Pending</span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                     <div class="d-flex justify-content-between align-items-center">
                                                                        <p class="fw-bold mb-2 font-15 text-black">Report Incorporation</p>
                                                                        <?php if ($row_officer['verify_sign_flag_report_incorporation_pdf'] == 1): ?>
                                                                            <span class="badge bg-success">Signed</span>
                                                                        <?php else: ?>
                                                                            <span class="badge bg-warning">Sign Pending</span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-7">
                                                                            <p class="fw-bold mb-2 font-15 text-black">CDD KYC</p>
                                                                        </div>
                                                                        <div class="col-5 text-end">
                                                                            <?php if ($row_officer['cddkyc_form'] == 1): ?>
                                                                                <span class="badge bg-success">Submitted</span>
                                                                            <?php else: ?>
                                                                                <span class="badge bg-warning">Form Not Submitted</span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                    endwhile;
                                                }
                                                ?>
                                            </div>

                                            <hr style="margin: 2rem 0;">
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                    <section class="section">
                        <div class="row">
                            <div class="col-12">
                                <div class="card c2">
                                    <div class="card-bg">
                                        <div class="col p-3">

                                            <div class="row">
                                                <!-- Incorporation -->
                                                <div class="col-md-4">
                                                    <!-- <div class="form-group"> -->
                                                    <div class="row">
                                                        <div class="col-md-10 side_line">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-0 font-20 text-black">INCORPORATION</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-warning shadow-none">Pending</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- </div> -->
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            <?php   } ?>
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