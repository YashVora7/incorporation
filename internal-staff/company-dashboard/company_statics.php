<?php
require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';

if (isset($_GET['company_id'])) {
    $company_id = $_GET['company_id'];

    $sql_company_data = mysqli_query($link, 'SELECT * FROM register_company WHERE id = ' . $company_id . '');
    $row_company_data = mysqli_fetch_assoc($sql_company_data);
}

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
        .dataTables_filter{
          margin-bottom: 0.5rem;
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
            <?php
            if (isset($_GET['company_id'])) {
            ?>
                <div class="main-content">
                     <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Static Dashboard</li>    
                  </ol>
                </nav>
                    <section class="section">
                        <div class="row">
                            <div class="col-12">
                                <div class="card c2">
                                    <div class="card-bg">
                                        <div class="col p-3">
                                            <div class="d-md-flex gap-3">
                                                <p class="fw-bold mb-2 font-20 text-black">Company:
                                                    <span class="fw-normal mb-2 font-20 text-black-50"><?= $row_company_data['company_name']." ".$row_company_data['company_suffix']; ?></span>
                                                </p>
                                                <div>
                                                    <?php 
                                                    $statusClass = $row_company_data['company_current_status'] === 'only_company_registered' 
                                                        ? 'btn-warning' 
                                                        : ($row_company_data['company_current_status'] === 'Payment_and_data_verified' 
                                                            ? 'btn-success' 
                                                            : ''); 
                                                    ?>
                                                    <h5 class="badge <?= $statusClass; ?> shadow-none font-15 mb-0">
                                                        <?= $row_company_data['company_current_status']; ?>
                                                    </h5>
                                                </div>
                                            </div>

                                            <hr style="margin: .7rem 0;">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="fw-bold mb-0 font-20 text-black">DOCUMENT SIGN</p>
                                                    <br>
                                                    <?php
                                                    $sql_officers_data = mysqli_query($link, 'SELECT * FROM officer WHERE cr_id = ' . $company_id);
                                                    if (mysqli_num_rows($sql_officers_data) > 0) {
                                                    ?>
                                                        <table class="table table-bordered table-striped datatable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Officer Name</th>
                                                                    <th>Designation</th>
                                                                    <th>Form 45</th>
                                                                    <th>Report Incorporation</th>
                                                                    <th>Company Constitution</th>
                                                                    <th>CDD KYC</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                while ($row_officers_data = mysqli_fetch_assoc($sql_officers_data)) {
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-uppercase text-black fw-bold"><?= htmlspecialchars($row_officers_data['officer_name']); ?></td>
                                                                        <td class="text-uppercase text-black-50"><?= htmlspecialchars($row_officers_data['officer_designation']); ?></td>
                                                                        <td>
                                                                            <?php if ($row_officers_data['officer_designation'] != 'shareholder'): ?>
                                                                                <?php if ($row_officers_data['sign_flag_45'] == 1): ?>
                                                                                    <span class="badge bg-success">Signed</span>
                                                                                <?php else: ?>
                                                                                    <span class="badge bg-warning">Sign Pending</span>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php if ($row_officers_data['verify_sign_flag_report_incorporation_pdf'] == 1): ?>
                                                                                <span class="badge bg-success">Signed</span>
                                                                            <?php else: ?>
                                                                                <span class="badge bg-warning">Sign Pending</span>
                                                                            <?php endif; ?>
                                                                        </td> 
                                                                         <td>
                                                                            <?php if ($row_officers_data['sign_flag_company_constitution'] == 1): ?>
                                                                                <span class="badge bg-success">Signed</span>
                                                                            <?php else: ?>
                                                                                <span class="badge bg-warning">Sign Pending</span>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php if ($row_officers_data['cddkyc_form'] == 1): ?>
                                                                                <span class="badge bg-success">Submitted</span>
                                                                            <?php else: ?>
                                                                                <span class="badge bg-warning">Form Not Submitted</span>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    <?php
                                                    } else {
                                                        echo "<p>No officers found.</p>";
                                                    }
                                                    ?>
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