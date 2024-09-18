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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <style>
        .text_limit1 {
            display: block;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
         thead,th{
            width: 33.33%;
            text-align: center !important;
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
                    <li class="breadcrumb-item active" aria-current="page">New Companies</li>
                  </ol>
                </nav>
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                                    <div class="col p-3">
                                        <div class="d-md-flex gap-3">
                                            <p class="fw-bold mb-2 font-30 text-black">List of New Register Companies</p>
                                        </div>
                                        <hr style="margin: .7rem 0;">
                                        <div class="row pt-3 text-center">
                                            <br>
                                            <?php
                                                // Query to get all companies with or without staff assignments
                                                $sql = "SELECT rc.*, sa.secretary_id, sa.compliance_id, sa.incorporator_id
                                                        FROM register_company rc
                                                        LEFT JOIN staff_assignments sa ON rc.id = sa.company_id";
                                                $result_company = mysqli_query($link, $sql);

                                                $total_row_company = mysqli_num_rows($result_company);
                                                if($total_row_company > 0) {
                                                    // Separate companies based on their status
                                                    $payment_and_data_verified = [];
                                                    $only_company_registered = [];

                                                    while ($row_company = mysqli_fetch_assoc($result_company)) {
                                                        if ($row_company['company_current_status'] == 'Payment_and_data_verified') {
                                                            $payment_and_data_verified[] = $row_company;
                                                        } elseif ($row_company['company_current_status'] == 'only_company_registered') {
                                                            $only_company_registered[] = $row_company;
                                                        }
                                                    }

                                                    // Display companies with Payment and Data Verified status
                                                    if (!empty($payment_and_data_verified)) {
                                                        echo '<div class="table-responsive border shadow-lg p-3">';
                                                        echo " <p class='fw-bold font-20 text-black text-start'>Payment And Data Verified</p>";
                                                        echo '<table class="table table-striped datatable mt-5 mb-2">';
                                                        echo '<thead class="table-dark">';
                                                        echo '<tr><th><h6>Company Name</h6></th><th><h6>Staff Assign Status</h6></th><th><h6>Action</h6></th></tr></thead><tbody>';
                                                        
                                                        foreach ($payment_and_data_verified as $row_company) {
                                                            echo '<tr class="align-middle">';
                                                            echo '<td class="text-start"><small>' . $row_company['company_name'] . '</small></td>'; // Smaller text for company name
                                                            echo '<td>';
                                                            
                                                            $secretary_id = $row_company['secretary_id'];
                                                            $compliance_id = $row_company['compliance_id'];
                                                            $incorporator_id = $row_company['incorporator_id'];

                                                            // Logic to determine the badge
                                                            if (($secretary_id == 0 || is_null($secretary_id)) && 
                                                                ($compliance_id == 0 || is_null($compliance_id)) && 
                                                                ($incorporator_id == 0 || is_null($incorporator_id))) {
                                                                echo '<span class="badge bg-warning text-dark shadow-none"><small>Assign Pending</small></span>';
                                                            } elseif ($secretary_id == 0 || is_null($secretary_id)) {
                                                                echo '<span class="badge bg-warning text-dark shadow-none"><small>Secretary Assignment Pending</small></span>';
                                                            } elseif ($compliance_id == 0 || is_null($compliance_id)) {
                                                                echo '<span class="badge bg-warning text-dark shadow-none"><small>Compliance Officer Assignment Pending</small></span>';
                                                            } elseif ($incorporator_id == 0 || is_null($incorporator_id)) {
                                                                echo '<span class="badge bg-warning text-dark shadow-none"><small>Incorporator Assignment Pending</small></span>';
                                                            } else {
                                                                echo '<span class="badge bg-success shadow-none"><small>Assigned</small></span>';
                                                            }

                                                            echo '</td>';
                                                            echo '<td><a href="' . $baseUrl . 'super_admin/new_companies/view_company_details.php?company_id=' . $row_company['id'] . '" class="btn btn-primary btn-sm shadow-none">View Details</a></td>';
                                                            echo '</tr>';
                                                        }

                                                        echo '</tbody></table></div>';
                                                    }


                                                    // Display companies with Only Company Registered status
                                                    if (!empty($only_company_registered)) {
                                                        echo '<div class="table-responsive my-5 mx-auto border shadow-lg p-3">';
                                                        echo " <p class='fw-bold font-20 text-black text-start'>Only Company Registered</p>";
                                                        echo '<table class="table table-bordered table-hover table-striped datatable mt-5">';
                                                        echo '<thead class="table-dark">';
                                                        echo '<tr><th><h6>Company Name</h6></th><th><h6>Staff Assign Status</h6></th><th><h6>Action</h6></th></tr></thead><tbody>';
                                                        
                                                        foreach ($only_company_registered as $row_company) {
                                                            echo '<tr class="align-middle">';
                                                            echo '<td class="text-start"><small>' . $row_company['company_name'] . '</small></td>'; // Smaller text for company name
                                                            echo '<td>';
                                                            
                                                            $secretary_id = $row_company['secretary_id'];
                                                            $compliance_id = $row_company['compliance_id'];
                                                            $incorporator_id = $row_company['incorporator_id'];

                                                            // Logic to determine the badge
                                                            if (($secretary_id == 0 || is_null($secretary_id)) && 
                                                                ($compliance_id == 0 || is_null($compliance_id)) && 
                                                                ($incorporator_id == 0 || is_null($incorporator_id))) {
                                                                echo '<span class="badge bg-warning text-dark shadow-none"><small>Assign Pending</small></span>';
                                                            } elseif ($secretary_id == 0 || is_null($secretary_id)) {
                                                                echo '<span class="badge bg-warning text-dark shadow-none"><small>Secretary Assignment Pending</small></span>';
                                                            } elseif ($compliance_id == 0 || is_null($compliance_id)) {
                                                                echo '<span class="badge bg-warning text-dark shadow-none"><small>Compliance Officer Assignment Pending</small></span>';
                                                            } elseif ($incorporator_id == 0 || is_null($incorporator_id)) {
                                                                echo '<span class="badge bg-warning text-dark shadow-none"><small>Incorporator Assignment Pending</small></span>';
                                                            } else {
                                                                echo '<span class="badge bg-success shadow-none"><small>Assigned</small></span>';
                                                            }

                                                            echo '</td>';
                                                            echo '<td><a href="' . $baseUrl . 'super_admin/new_companies/view_company_details.php?company_id=' . $row_company['id'] . '" class="btn btn-primary btn-sm shadow-none">View Details</a></td>';
                                                            echo '</tr>';
                                                        }

                                                        echo '</tbody></table></div>';
                                                    }


                                                } else {
                                                    echo '<div class="col-12"><div class="text-center"><h1>No New Company Register</h1></div></div>';
                                                }
                                            ?>
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