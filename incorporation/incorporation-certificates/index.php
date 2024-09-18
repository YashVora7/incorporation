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
    <title>Incorporation Certificates - Tianlong Services Pte Ltd</title>
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
                    <p class="fw-bold mb-2 font-20 text-black">Incorporation Certificates</p>
                    <br>

                    <div class="row ">
                        <!-- Certificate 1 -->
                        <div class="col-xl-3 col-md-4 col-sm-6">
                            <div class="card c2 overflow-hidden">
                                <div class="card-bg">
                                    <div class="col p-3">
                                        <div class="d-flex justify-content-between">
                                            <span class="mb-0 text-uppercase text-black fw-bold text-sm">Certificate <span>1</span></span>
                                        </div>
                                        <hr style="margin: .7rem 0;">
                                        <div class="text-center mb-3">
                                            <img style="width: 50%;" src="<?php echo $baseUrl; ?>/incorporation/assets/img/logo.webp" alt="">
                                        </div>
                                        <p class="fw-normal mb-2 font-15 text-black">10 Ubi Cres, #05-96 Ubi Techpark, Singapore 408564</p>
                                    </div>
                                    <div class="row">
                                        <a href="#" style="padding: 10px; background-color: aliceblue; text-align: center;" download>
                                            <i class="fas fa-file mb-0"></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Certificate 2 -->
                        <div class="col-xl-3 col-md-4 col-sm-6">
                            <div class="card c2 overflow-hidden">
                                <div class="card-bg">
                                    <div class="col p-3">
                                        <div class="d-flex justify-content-between">
                                            <span class="mb-0 text-uppercase text-black fw-bold text-sm">Certificate <span>2</span></span>
                                        </div>
                                        <hr style="margin: .7rem 0;">
                                        <div class="text-center mb-3">
                                            <img style="width: 50%;" src="<?php echo $baseUrl; ?>/incorporation/assets/img/logo.webp" alt="">
                                        </div>
                                        <p class="fw-normal mb-2 font-15 text-black">10 Ubi Cres, #05-96 Ubi Techpark, Singapore 408564</p>
                                    </div>
                                    <div class="row">
                                        <a href="#" style="padding: 10px; background-color: aliceblue; text-align: center;" download>
                                            <i class="fas fa-file mb-0"></i> Download
                                        </a>
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