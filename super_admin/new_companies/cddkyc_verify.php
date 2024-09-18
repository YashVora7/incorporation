<?php
require_once '../session.php';
$logged_user_id = $_SESSION['user_id'];
require_once '../baseUrl.php';
require_once '../db.php';

?>

<?php
$sql2 = "
    SELECT o.*, c.*, s.*, o.id AS o_id, co.company_name AS company_name,co.company_suffix AS company_suffix
    FROM officer o
    LEFT JOIN compliance_sign_cddkyc c ON o.id = c.officer_id AND c.compliance_sign_cddkyc = 1
    LEFT JOIN superadmin_sign_cddkyc s ON o.id = s.officer_id
    LEFT JOIN register_company co ON o.cr_id = co.id  -- Assuming `company_id` links `officer` to `company`
    WHERE c.compliance_sign_cddkyc = 1 
    AND (o.officer_designation = 'director' OR o.officer_designation = 'shareholder')
";



$excute2 = mysqli_query($link, $sql2);
$excute_of = mysqli_query($link, $sql2);

$rows = array();

// Fetch the data
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">


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
                    <li class="breadcrumb-item"><a href="../">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">CDDKYC Approval</li>
                  </ol>
            </nav>
            <section class="section">

                    <br> 
                    <center>
                        <h3 style="margin-top: 0;">CDDKYC FORM (All Members)</h3>
                    </center>
                <section class="section">
                    <p class="fw-bold mb-2 font-20 text-black">CDDKYC FORM</p>
                    <br>

                    <div class="table-responsive">
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th>Designation</th>
                                    <th>Name</th>
                                    <th>Company Name</th> <!-- New column for Company Name -->
                                    <th>Status</th>
                                    <th>Customer Report PDF</th>
                                    <th>CDDKYC Form By Compliance</th>
                                    <th>CDDKYC Form</th>
                                    <th>CDDKYC Sign</th>
                                    <th hidden>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $row2): ?>
                                    <?php if (($row2['officer_designation'] == 'shareholder' && $row2['percentage_of_shares'] >= 25) || $row2['officer_designation'] == 'director'): ?>
                                        <tr>
                                            <td><?php echo ucfirst($row2['officer_designation']); ?></td>
                                            <td><?php echo $row2['officer_name']; ?></td>
                                            <td><?php echo $row2['company_name']." ".$row2['company_suffix']; ?></td> <!-- Display Company Name -->
                                            <td>
                                                <?php if ($row2['cddkyc_form'] == 1) : ?>
                                                    <span class="badge bg-success">Submitted</span>
                                                <?php else : ?>
                                                    <span class="badge bg-warning">Form Not Submitted</span>
                                                <?php endif ;?>
                                            </td>
                                            <td>
                                                <?php if ($row2['cddkyc_customer_pdf'] != ''): ?>
                                                    <a href="<?php echo $baseUrl . "internal-staff/uploads/customer_acceptance_form/" . $row2['cddkyc_customer_pdf']; ?>" target="_blank">
                                                        <i class="fas fa-file"></i> Download
                                                    </a>
                                                <?php else: ?>
                                                    <p>NO PDF</p>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($row2['compliance_sign_cddkyc_doc'] != ''): ?>
                                                    <a href="<?php echo $baseUrl . "internal-staff/uploads/cddkyc_form_sign_by_compliance/" . $row2['compliance_sign_cddkyc_doc']; ?>" target="_blank">
                                                        <i class="fas fa-file"></i> Download
                                                    </a>
                                                <?php else: ?>
                                                    <p>NO PDF</p>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($row2['super_admin_sign_cddkyc_doc'] != ''): ?>
                                                    <a href="<?php echo $baseUrl . "super_admin/uploads/cddkyc_form_sign_by_super_admin/" . $row2['super_admin_sign_cddkyc_doc']; ?>" target="_blank">
                                                        <i class="fas fa-file"></i> Download
                                                    </a>
                                                <?php else: ?>
                                                    <p>NO PDF</p>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($row2['super_admin_sign_cddkyc'] == 1): ?>
                                                    <a href="#" class="btn btn-success">Approved</a>
                                                <?php else: ?>
                                                    <a href="<?php echo $baseUrl; ?>super_admin/docsign_api/staff_cddkyc.php?officer_id=<?php echo urlencode($row2['o_id']); ?>&compliance_id=<?php echo urlencode($row2['compliance_id']); ?>" class="btn btn-danger">Sign Now</a>
                                                <?php endif; ?>
                                            </td>
                                            <td hidden>
                                                <?php if ($row2['cddkyc_form'] == 1): ?>
                                                    <a href="#" class="btn btn-success">Already Submitted</a>
                                                <?php else: ?>
                                                    <a href="<?php echo $baseUrl; ?>internal-staff/company-dashboard/customer_acceptance_form.php?officer_id=<?php echo urlencode($row2['id']); ?>&company_id=<?php echo urlencode($company_id); ?>" class="btn btn-danger">Submit Now</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif;?>
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