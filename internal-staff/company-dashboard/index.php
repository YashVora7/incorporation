<?php
require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';
$logged_user_id = $_SESSION['user_id'];
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <style>
        .text_limit1 {
            display: block;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        tr,td{
            width: 33.33%;
            text-align: center;
        }
        th{
            text-align: center; 
        }
       .dataTables_filter{
          margin-bottom: 0.5rem;
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
                    <li class="breadcrumb-item active" aria-current="page">Companies</li>
                  </ol>
                </nav>
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card c2">
                                <div class="card-bg">
                                    <div class="col p-3">

                                        <div class="d-md-flex gap-3">
                                            <p class="fw-bold mb-2 font-20 text-black">List of Companies</p>
                                        </div>
                                        <hr style="margin: .7rem 0;">
                                        <div class="row pt-3">
                                            <br>
                                            <?php
                                                $sql_secretary = "SELECT register_company.* 
                                                                  FROM staff_assignments
                                                                  JOIN register_company ON staff_assignments.company_id = register_company.id
                                                                  WHERE staff_assignments.secretary_id = '$logged_user_id'";
                                                $result_secretary = mysqli_query($link, $sql_secretary);

                                                $sql_compliance = "SELECT register_company.* 
                                                                   FROM staff_assignments
                                                                   JOIN register_company ON staff_assignments.company_id = register_company.id
                                                                   WHERE staff_assignments.compliance_id = '$logged_user_id'";
                                                $result_compliance = mysqli_query($link, $sql_compliance);

                                                $sql_incorporator = "SELECT register_company.* 
                                                                     FROM staff_assignments
                                                                     JOIN register_company ON staff_assignments.company_id = register_company.id
                                                                     WHERE staff_assignments.incorporator_id = '$logged_user_id' AND all_cddkyc_sign_done = 1 ";
                                                $result_incorporator = mysqli_query($link, $sql_incorporator);

                                                $sql_incorporator_process = "SELECT register_company.*, incorporate.id AS i_id
                                                                     FROM staff_assignments
                                                                     JOIN register_company ON staff_assignments.company_id = register_company.id
                                                                     JOIN incorporate ON incorporate.company_id = register_company.id  AND incorporation_status = 'pending'
                                                                     WHERE staff_assignments.incorporator_id = '$logged_user_id' AND all_cddkyc_sign_done = 1 ";

                                                $result_incorporator_process = mysqli_query($link, $sql_incorporator_process);

                                                $sql_incorporator_completed = "SELECT register_company.*, incorporate.id AS i_id
                                                                     FROM staff_assignments
                                                                     JOIN register_company ON staff_assignments.company_id = register_company.id
                                                                     JOIN incorporate ON incorporate.company_id = register_company.id  AND incorporation_status = 'completed'
                                                                     WHERE staff_assignments.incorporator_id = '$logged_user_id' AND all_cddkyc_sign_done = 1 ";

                                                $result_incorporator_completed = mysqli_query($link, $sql_incorporator_completed);
                                                ?>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <!-- Secretary Section -->
                                                        <?php if (mysqli_num_rows($result_secretary) > 0): ?>
                                                        <div class="table-responsive border shadow-lg p-3 mb-3">
                                                            <table class="table table-bordered table-sm datatable my-5">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th colspan="2" class="text-center bg-secondary"><h4>Secretary</h4></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th><h4 class="small">Company Name</h4></th>
                                                                        <th><h4 class="small">Action</h4></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php while ($row_company = mysqli_fetch_assoc($result_secretary)): ?>
                                                                        <tr>
                                                                            <td><h5 class="small"><?= $row_company['company_name'] ?></h5></td>
                                                                            <td>
                                                                                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/view_company_details.php?company_id=<?= $row_company['id'] ?>" class="btn btn-outline-primary btn-sm">View Details</a>
                                                                                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/company_edit.php?company_eid=<?= $row_company['id'] ?>" class="btn btn-outline-info btn-sm">Edit Details</a>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endwhile; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <?php endif; ?>

                                                        <!-- Compliance Person Section -->
                                                        <?php if (mysqli_num_rows($result_compliance) > 0): ?>
                                                        <div class="table-responsive border shadow-lg p-3 mb-3">
                                                            <table class="table table-bordered table-sm datatable mb-5">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th colspan="2" class="text-center bg-secondary"><h4>Compliance Person</h4></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th><h4 class="small">Company Name</h4></th>
                                                                        <th><h4 class="small">Action</h4></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php while ($row_company = mysqli_fetch_assoc($result_compliance)): ?>
                                                                        <tr>
                                                                            <td><h5 class="small"><?= $row_company['company_name'] ?></h5></td>
                                                                            <td>
                                                                                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/view_company_details.php?company_id=<?= $row_company['id'] ?>" class="btn btn-outline-primary btn-sm">View Details</a>
                                                                                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/company_edit.php?company_eid=<?= $row_company['id'] ?>" class="btn btn-outline-info btn-sm">Edit Details</a>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endwhile; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <?php endif; ?>

                                                        <!-- Yet To Incorporators Section -->
                                                        <?php if (mysqli_num_rows($result_incorporator) > 0): ?>
                                                        <div class="table-responsive border shadow-lg p-3 mb-3">
                                                            <table class="table table-bordered table-sm datatable mb-5">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th colspan="2" class="text-center bg-secondary"><h4>Incorporator</h4></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th><h4 class="small">Company Name</h4></th>
                                                                        <th><h4 class="small">Action</h4></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php while ($row_company = mysqli_fetch_assoc($result_incorporator)): ?>
                                                                        <tr>
                                                                            <td><h5 class="small"><?= $row_company['company_name'] ?></h5></td>
                                                                            <td>
                                                                                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/full_company_details.php?company_id=<?= $row_company['id'] ?>" class="btn btn-outline-primary btn-sm">View Details</a>
                                                                                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/company_edit.php?company_eid=<?= $row_company['id'] ?>" class="btn btn-outline-info btn-sm">Edit Details</a>
                                                                                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/incorporate_form.php?company_eid=<?= $row_company['id'] ?>" class="btn btn-outline-secondary btn-sm">Incorporate</a>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endwhile; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <?php endif; ?>

                                                        <!-- Pending Incorporators Section -->
                                                        <?php if (mysqli_num_rows($result_incorporator_process) > 0): ?>
                                                        <div class="table-responsive border shadow-lg p-3 mb-3">
                                                            <table class="table table-bordered table-sm datatable mb-5">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th colspan="2" class="text-center bg-secondary"><h4>Pending Incorporators</h4></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th><h4 class="small">Company Name</h4></th>
                                                                        <th><h4 class="small">Action</h4></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php while ($row_company = mysqli_fetch_assoc($result_incorporator_process)): ?>
                                                                        <tr>
                                                                            <td><h5 class="small"><?= $row_company['company_name'] ?></h5></td>
                                                                            <td>
                                                                                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/full_company_details.php?company_id=<?= $row_company['id'] ?>" class="btn btn-outline-primary btn-sm">View Details</a>
                                                                                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/company_edit.php?company_eid=<?= $row_company['id'] ?>" class="btn btn-outline-info btn-sm">Edit Details</a>
                                                                                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/incorporate_form.php?company_eid=<?= $row_company['id'] ?>&incorporate_id=<row_company['i_id'] ?>" class="btn btn-outline-secondary btn-sm">Update Incorporate</a>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endwhile; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <?php endif; ?>


                                                        <!-- Completed Incorporators Section -->
                                                        <?php if (mysqli_num_rows($result_incorporator_completed) > 0): ?>
                                                        <div class="table-responsive border shadow-lg p-3 mb-3">
                                                            <table class="table table-bordered table-sm datatable mb-5">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th colspan="2" class="text-center bg-secondary"><h4>Completed Incorporators</h4></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th><h4 class="small">Company Name</h4></th>
                                                                        <th><h4 class="small">Action</h4></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php while ($row_company = mysqli_fetch_assoc($result_incorporator_completed)): ?>
                                                                        <tr>
                                                                            <td><h5 class="small"><?= $row_company['company_name'] ?></h5></td>
                                                                            <td>
                                                                                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/full_company_details.php?company_id=<?= $row_company['id'] ?>" class="btn btn-outline-primary btn-sm">View Details</a>
                                                                                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/company_edit.php?company_eid=<?= $row_company['id'] ?>" class="btn btn-outline-info btn-sm">Edit Details</a>
                                                                                <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard/incorporate_form.php?company_eid=<?= $row_company['id'] ?>&incorporate_id=<?= $row_company['i_id'] ?>" class="btn btn-outline-secondary btn-sm">Update Incorporate</a>

                                                                            </td>
                                                                        </tr>
                                                                    <?php endwhile; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <?php endif; ?>
                                                    </div>
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
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.6.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script>
        $('.datatable').DataTable({
            paging: true,
            searching: true,
            pageLength: 10,
            lengthChange: true,
            order: [
                [0, 'asc']
            ],
            language: {
                searchPlaceholder: "Search records",
                lengthMenu: "Show _MENU_ entries"
            },
            dom: 'Bfrtip', // Top search box (f), bottom pagination (lp)
            buttons: [
                'excel'
            ],
            columnDefs: [{
                    targets: 0,
                    className: 'text-left'
                }, // Left-align the first column
                {
                    targets: '_all',
                    className: 'text-center'
                } // Center-align all other columns
            ]
        });
    </script>
</body>

</html>
