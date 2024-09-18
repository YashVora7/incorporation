<?php
require_once '../../session.php';
require_once '../../db.php';
require_once '../../baseUrl.php';
?>
<?php
if (isset($_SESSION['company_id'])) {
$company_id = $_SESSION['company_id'];
    $sql = "SELECT * FROM officer WHERE cr_id = ".$company_id."  ORDER BY id DESC ";
    $excute = mysqli_query($link, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Company Constitution - Tianlong Services Pte Ltd</title>
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
            require_once '../../header.php';
            require_once '../../sidebar.php';
            ?>

            <!-- Main Content -->
            <div class="main-content">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">Before Incorporation</li>
                    <li class="breadcrumb-item">Report & Documents</li>
                    <li class="breadcrumb-item active" aria-current="page">Company Constitution</li>
                  </ol>
                </nav>
                <section class="section">
                    <p class="fw-bold mb-2 font-20 text-black">Company Constitution</p>
                    <br>
                    <div class="table-responsive border shadow-lg p-3">
                        <table class="table table-striped datatable mb-2">
                            <thead>
                                <tr>
                                    <th>Designation</th>
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
                                            <td><?php echo $row['officer_designation']; ?></td>
                                            <td><?php echo $row['officer_name']; ?></td>
                                            <td>
                                                <?php if($row['sign_flag_company_constitution'] == 1): ?>
                                                    <span class="badge bg-success">Signed</span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning">Sign Pending</span>
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <?php if($row['sign_flag_company_constitution'] == 1): ?>
                                                    <a href="<?php echo $baseUrl . "incorporation/before-incorporation/company-constitution/upload_verify_company_constitution_form/" . $row['verify_sign_document_company_constition_pdf']; ?>" target="_blank">
                                                        <i class="fas fa-file"></i> Download
                                                    </a>
                                                <?php else: ?>
                                                    <!-- No download link if not signed -->
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <?php if($row['sign_flag_company_constitution'] == 1): ?>
                                                    <a href="#" class="btn btn-success">Already Signed</a>
                                                <?php else: ?>
                                                    <a href="company_cpdf/<?php echo $row['id']; ?>" class="btn btn-danger">Sign Now</a>
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