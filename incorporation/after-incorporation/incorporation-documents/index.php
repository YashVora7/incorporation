<?php
 require_once '../../session.php';
 require_once '../../db.php';
require_once '../../baseUrl.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Incorporation Documents - Tianlong Services Pte Ltd</title>
    <link rel="stylesheet" href="../../assets/css/app.min.css">
    <link rel="stylesheet" href="../../assets/bundles/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="../../assets/bundles/weather-icon/css/weather-icons.min.css">
    <link rel="stylesheet" href="../../assets/bundles/weather-icon/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="../../assets/bundles/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/components.css">
    <link rel="stylesheet" href="../../assets/css/custom.css">
    <link rel="icon" type="image/png" href="../../assets/img/logo.webp">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/bundles/footable-bootstrap/css/footable.bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/bundles/footable-bootstrap/css/footable.standalone.min.css">

    <style>
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
            require_once '../../header.php';
            require_once '../../sidebar.php';
            ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <p class="fw-bold mb-2 font-20 text-black">Incorporation Documents</p>
                    <br>

                    <div class="row ">
                        <!-- RORC -->
                        <div class="col-xl-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <div class="card c2 overflow-hidden mb-2">
                                    <div class="col p-3">
                                        <div class="d-flex justify-content-between">
                                            <span class="mb-0 text-uppercase text-black fw-bold text-sm">RORC</span>
                                        </div>
                                        <hr style="margin: .7rem 0;">
                                        <div class="text-center mb-3">
                                            <img style="width: 50%;" src="<?php echo $baseUrl; ?>/incorporation/assets/img/logo.webp" alt="">
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Register</p>
                                            </div>
                                            <div class="col-7 text-end">
                                                <span class="badge btn-warning shadow-none">Sign Pending</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-3">
                                        <a href="#" style="padding: 10px; background-color: aliceblue; text-align: center;">
                                            <i class="fas fa-file mb-0"></i> Download
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-end">
                                        <a href="#" class="btn btn-primary">Sign Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- DRIW Director 1 -->
                        <div class="col-xl-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <div class="card c2 overflow-hidden mb-2">
                                    <div class="col p-3">
                                        <div class="d-flex justify-content-between">
                                            <span class="mb-0 text-uppercase text-black fw-bold text-sm">DRIW</span>
                                        </div>
                                        <hr style="margin: .7rem 0;">
                                        <div class="text-center mb-3">
                                            <img style="width: 50%;" src="<?php echo $baseUrl; ?>/incorporation/assets/img/logo.webp" alt="">
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Director</p>
                                            </div>
                                            <div class="col-7 text-end">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1">Mr. ABC</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5"></div>
                                            <div class="col-7 text-end">
                                                <span class="badge btn-warning shadow-none">Sign Pending</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-3">
                                        <a href="#" style="padding: 10px; background-color: aliceblue; text-align: center;">
                                            <i class="fas fa-file mb-0"></i> Download
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-end">
                                        <a href="#" class="btn btn-primary">Sign Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- DRIW Director 2 -->
                        <div class="col-xl-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <div class="card c2 overflow-hidden mb-2">
                                    <div class="col p-3">
                                        <div class="d-flex justify-content-between">
                                            <span class="mb-0 text-uppercase text-black fw-bold text-sm">DRIW</span>
                                        </div>
                                        <hr style="margin: .7rem 0;">
                                        <div class="text-center mb-3">
                                            <img style="width: 50%;" src="<?php echo $baseUrl; ?>/incorporation/assets/img/logo.webp" alt="">
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="fw-bold mb-2 font-15 text-black">Director</p>
                                            </div>
                                            <div class="col-7 text-end">
                                                <p class="fw-normal mb-2 font-15 text-black-50 text_limit1">Mr. PQR</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5"></div>
                                            <div class="col-7 text-end">
                                                <span class="badge btn-success shadow-none shadow-none">Signed</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-3">
                                        <a href="#" style="padding: 10px; background-color: aliceblue; text-align: center;" download>
                                            <i class="fas fa-file mb-0"></i> Download
                                        </a>
                                    </div>
                                </div>
                                <div class="row d-none">
                                    <div class="text-end">
                                        <a href="#" class="btn btn-primary">Sign Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>

            <!-- Footer -->
            <?php
            require_once '../../footer.php';
            ?>

        </div>
    </div>
    <script src="../../assets/js/app.min.js"></script>
    <script src="../../assets/bundles/echart/echarts.js"></script>
    <script src="../../assets/bundles/chartjs/chart.min.js"></script>
    <script src="../../assets/js/page/index.js"></script>
    <script src="../../assets/js/scripts.js"></script>
    <script src="../../assets/js/custom.js"></script>
    <script src="../../assets/js/page/footable-data.js"></script>
    <script src="../../assets/bundles/footable-bootstrap/js/footable.js"></script>
</body>

</html>