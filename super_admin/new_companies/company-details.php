<?php
// require_once '../session.php';
// require_once '../db.php';
require_once '../baseUrl.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Company Details - Tianlong Services Pte Ltd</title>
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

                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card c2">
                                <div class="card-bg">
                                    <div class="col p-3">

                                        <div class="d-md-flex gap-3">
                                            <p class="fw-bold mb-2 font-20 text-black">Company:
                                                <span class="fw-normal mb-2 font-20 text-black-50">Tianlong Services Pte Ltd</span>
                                            </p>
                                            <div>
                                                <h5 class="badge btn-warning shadow-none font-15 mb-0">Directors Sign Pending</h5>
                                                <!-- <h5 class="badge btn-warning shadow-none font-15">Shareholders Sign Pending</h5>
                                                <h5 class="badge btn-warning shadow-none font-15">Secretary Sign Pending</h5>
                                                <h5 class="badge btn-warning shadow-none font-15">CCD KYC Pending</h5>
                                                <h5 class="badge btn-warning shadow-none font-15">Pending</h5>
                                                <h5 class="badge btn-success shadow-none font-15">Completed</h5> -->
                                            </div>
                                        </div>

                                        <hr style="margin: .7rem 0;">

                                        <div class="row">
                                            <div class="form-group" style="margin-top: 15px;">
                                                <p class="fw-bold mb-0 font-20 text-black">DOCUMENT SIGN</p>
                                            </div>
                                            <br>
                                            <!-- Directors -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-10 side_line">
                                                            <div class="text-center heading">
                                                                <span class="mb-0 text-uppercase text-black fw-bold text-sm">Directors</span>
                                                            </div>
                                                            <hr style="margin: .7rem 0;">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-2 font-15 text-black">Form 45</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-success shadow-none">Signed</span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-2 font-15 text-black">Form 45</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-warning shadow-none">Pending</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Shareholders -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-10 side_line">
                                                            <div class="text-center heading">
                                                                <span class="mb-0 text-uppercase text-black fw-bold text-sm">Shareholders</span>
                                                            </div>
                                                            <hr style="margin: .7rem 0;">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-2 font-15 text-black">Form 45</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-success shadow-none">Signed</span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-2 font-15 text-black">Form 45</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-success shadow-none">Signed</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Secretary -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-10 side_line">
                                                            <div class="text-center heading">
                                                                <span class="mb-0 text-uppercase text-black fw-bold text-sm">Secretary</span>
                                                            </div>
                                                            <hr style="margin: .7rem 0;">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-2 font-15 text-black">Form 45B</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-success shadow-none">Signed</span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-2 font-15 text-black">Form 45B</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-success shadow-none">Signed</span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="text-end">
                                                                    <a href="#" class="btn btn-primary">Sign Now</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
                                            <!-- CDD KYC -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-10 side_line">
                                                            <div class="row">
                                                                <div class="col-7">
                                                                    <p class="fw-bold mb-0 font-20 text-black">CDD KYC</p>
                                                                </div>
                                                                <div class="col-5 text-end">
                                                                    <span class="badge btn-success shadow-none">Completed</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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