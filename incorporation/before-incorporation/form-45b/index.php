<?php
 require_once '../../session.php';
 require_once '../../db.php';
require_once '../../baseUrl.php';
?>
<?php

    $sql = "SELECT * FROM secretary ";
    $excute = mysqli_query($link,$sql);
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Form 45b - Tianlong Services Pte Ltd</title>
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
                    <p class="fw-bold mb-2 font-20 text-black">Form 45B for Secretary</p>
                    <br>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Document</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($_SESSION['company_id'])) {
                                    while ($row = $excute->fetch_assoc()): ?>
                                        <tr>
                                            <td>Secretary</td>
                                            <td><?php echo $row['secretary_name']; ?></td>
                                            <td>
                                                <?php if($row['sign_flag_45b'] == 1): ?>
                                                    <span class="badge bg-success">Signed</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning">Sign Pending</span>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <a href="<?php echo $baseUrl . "incorporation/before-incorporation/form-45b/upload_form_45b_verify/" . $row['verify_sign_document_45b_pdf']; ?>" target="_blank">
                                                    <i class="fas fa-file"></i> Download
                                                </a>
                                            </td>
                                            <td>
                                                <?php if($row['sign_flag_45b'] == 1): ?>
                                                    <a href="#" class="btn btn-success">Already Signed</a>
                                                <?php else: ?>
                                                    <a href="form_45b/<?php echo $row['id']; ?>" class="btn btn-danger">Sign Now</a>
                                                <?php endif;?>
                                            </td>
                                        </tr>
                                    <?php endwhile; 
                                }?>
                            </tbody>
                        </table>
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