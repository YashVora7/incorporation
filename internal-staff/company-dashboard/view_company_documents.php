<?php
require_once '../session.php';
$logged_user_id = $_SESSION['user_id'];
$company_id = $_GET['company_id'];


require_once '../baseUrl.php';


require_once '../db.php';

$sql = 'SELECT * FROM register_company WHERE id = ' . $company_id . '';
$result = mysqli_query($link, $sql);
$row_company_data = mysqli_fetch_assoc($result);

if ($row_company_data['company_current_status'] !== 'Payment_and_data_verified') {
    header("Location: " . $baseUrl . "internal-staff/company-dashboard/view_company_details.php?company_id=" . urlencode($company_id));
    exit; // It's a good practice to call exit after a redirect to stop further script execution
}



$sql_officer = 'SELECT * FROM officer WHERE cr_id = ' . $company_id . '';
$result_total_officers = mysqli_query($link, $sql_officer);
$total_officers = mysqli_num_rows($result_total_officers);




$sql_total_directors  = 'SELECT * FROM officer WHERE cr_id = ' . $company_id . ' AND officer_designation = "director"';
$result_total_directors = mysqli_query($link, $sql_total_directors);
$total_directors = mysqli_num_rows($result_total_directors);


$sql_total_shareholders  = 'SELECT * FROM officer where cr_id = ' . $company_id . ' AND officer_designation = "shareholder"';
$result_total_shareholder = mysqli_query($link, $sql_total_shareholders);
$total_shareholder  = mysqli_num_rows($result_total_shareholder);



$sql_total_singapore_directors  = 'SELECT * FROM officer where cr_id = ' . $company_id . ' AND officer_designation = "director" AND is_singapore_citizen = "Yes" ';
$result_total_singapore_directors = mysqli_query($link, $sql_total_singapore_directors);
$total_singapore_directors = mysqli_num_rows($result_total_singapore_directors);
?>
<?php

$sql = "SELECT * FROM officer WHERE officer_designation = 'director' AND cr_id = " . $company_id . "  ORDER BY id DESC";
$excute = mysqli_query($link, $sql);
$excute_dr = mysqli_query($link, $sql);


$sql2 = "SELECT * FROM officer WHERE cr_id = " . $company_id . "  ORDER BY id DESC ";
$excute2 = mysqli_query($link, $sql2);
$excute_of = mysqli_query($link, $sql2);

$sql_secretary1 = "SELECT * 
                  FROM staff_assignments
                  JOIN user_roles ON staff_assignments.secretary_id = user_roles.id
                  WHERE staff_assignments.secretary_id = '$logged_user_id' AND staff_assignments.company_id = '$company_id'";

$excute_secretary_sr = mysqli_query($link, $sql_secretary1);
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

        /* For the first table */
        .first_table th,
        .first_table td {
            width: 25%;
        }

        /* For the second table */
        .second_table th,
        .second_table td {
            width: 33.33%;
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
                        <li class="breadcrumb-item"><a href="../company-dashboard">Companies</a></li>
                        <li class="breadcrumb-item"><a href="../company-dashboard/view_company_details.php?company_id=<?php echo $company_id; ?>">View Company Details</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Company Document</li>
                    </ol>
                </nav>
                <section class="section">

                    <br>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-xl-10 col-md-4 col-sm-6">
                            <div class="card c2">
                                <div class="card-bg">
                                    <div class="col p-3">
                                        <div class="row">
                                            <input style="display: none;" type="text" name="" value="<?= $company_id ?>" id="company_id">
                                            <div style="display: flex; align-items: center; justify-content: space-between; padding: 15px; border: 1px solid #ddd; border-radius: 8px;">
                                                <div style="display: flex; align-items: center;">
                                                    <div style="display: flex; align-items: center; background-color: #dff0d8; color: #3c763d; padding: 5px 10px; border-radius: 20px; margin-right: 15px;">
                                                        <span style="margin-right: 5px;">&#10003;</span> <!-- Check icon -->
                                                        <span><?= $row_company_data['company_current_status']; ?></span>
                                                    </div>
                                                    <h1 style="margin: 0; font-size: 1.5em;"><?= $row_company_data['company_name'] . " " . $row_company_data['company_suffix']; ?></h1>
                                                </div>

                                                <?php

                                                if ($row_company_data['company_current_status'] == 'Payment_and_data_verified') {
                                                    // Function to check if all necessary sign flags are set to 1 in the given result set
                                                    function check_sign_flags($result, $flags)
                                                    {
                                                        while ($sign_check_row = mysqli_fetch_assoc($result)) {
                                                            foreach ($flags as $flag) {
                                                                if (!isset($sign_check_row[$flag]) || $sign_check_row[$flag] != 1) {
                                                                    return false;
                                                                }
                                                            }
                                                        }
                                                        return true;
                                                    }

                                                    // Define the flags to check
                                                    $flags_director = ['sign_flag_45'];
                                                    $flags_officer = ['sign_flag_company_constitution'];
                                                    $flags_secretary = ['sign_flag_45b'];

                                                    $all_directors_signed = check_sign_flags($excute_dr, $flags_director);
                                                    $all_officers_signed = check_sign_flags($excute_of, $flags_officer);
                                                    $all_secretaries_signed = check_sign_flags($excute_secretary_sr, $flags_secretary);

                                                    // Check if all documents are signed successfully
                                                    if ($all_directors_signed && $all_officers_signed && $all_secretaries_signed) {
                                                ?>
                                                        <button style="background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; font-size: 1em; cursor: pointer;">
                                                            All Document Sign Successfully
                                                        </button>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <?php
                    $sql_secretary = "SELECT * 
                                      FROM staff_assignments
                                      JOIN user_roles ON staff_assignments.secretary_id = user_roles.id
                                      WHERE staff_assignments.secretary_id = '$logged_user_id' AND staff_assignments.company_id = '$company_id'";

                    $excute_secretary = mysqli_query($link, $sql_secretary);

                    if ($excute_secretary && mysqli_num_rows($excute_secretary) > 0) :
                    ?>
                        <center>
                            <h3 style="margin-top: 0;">Form 45B (Secretary)</h3>
                        </center>
                        <section class="section border shadow-lg p-3 mb-3">
                            <p class="fw-bold mb-2 font-20 text-black">Form 45B for Secretary</p>
                            <br>
                            <table class="table table-bordered first_table datatable my-2">
                                <thead>
                                    <tr>
                                        <th>Form 45B</th>
                                        <th>Director</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row_secretary = $excute_secretary->fetch_assoc()) : ?>
                                        <tr>
                                            <td>Form 45B</td>
                                            <td><?php echo htmlspecialchars($row_secretary['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td>
                                                <?php if ($row_secretary['secretary_sign_form45b'] == 1) : ?>
                                                    <span class="badge btn-success shadow-none">Signed</span>
                                                <?php else : ?>
                                                    <span class="badge btn-warning shadow-none">Sign Pending</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($row_secretary['secretary_sign_form45b'] == 1) : ?>
                                                    <a href="<?php echo $baseUrl . "incorporation/before-incorporation/form-45b/upload_form_45b_verify/" . htmlspecialchars($row_secretary['secretary_sign_form45b_doc'], ENT_QUOTES, 'UTF-8'); ?>" style="padding: 10px; background-color: aliceblue; text-align: center;" target="_blank">
                                                        <i class="fas fa-file mb-0"></i> Download
                                                    </a>
                                                    <a href="#" class="btn btn-success mt-2">Already Signed</a>
                                                <?php else : ?>
                                                    <a href="<?php echo $baseUrl . "incorporation/before-incorporation/form-45b/form_45b?s_id=" . htmlspecialchars($row_secretary['id'], ENT_QUOTES, 'UTF-8') . "&c_id=" . htmlspecialchars($company_id, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-danger mt-2">Sign Now</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </section>
                    <?php endif; ?>
                    
                    <center>
                        <h3 style="margin-top: 0;">Form 45 (Directors)</h3>
                    </center>

                    <section class="section border shadow-lg p-3 mb-3">
                        <p class="fw-bold mb-2 font-20 text-black">Form 45 for Directors</p>
                        <br>
                        <table class="table table-bordered second_table datatable my-2">
                            <thead>
                                <tr>
                                    <th>Form 45</th>
                                    <th>Director</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $excute->fetch_assoc()) : ?>
                                    <tr>
                                        <td>Form 45</td>
                                        <td><?php echo htmlspecialchars($row['officer_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php if ($row['sign_flag_45'] == 1) : ?>
                                                <span class="badge btn-success shadow-none">Signed</span>
                                            <?php else : ?>
                                                <span class="badge btn-warning shadow-none">Sign Pending</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($row['sign_flag_45'] == 1) : ?>
                                                <a href="<?php echo $baseUrl . "incorporation/before-incorporation/form-45/upload_form_45_verify/" . htmlspecialchars($row['verify_sign_document_45_pdf'], ENT_QUOTES, 'UTF-8'); ?>" style="padding: 10px; background-color: aliceblue; text-align: center;" target="_blank">
                                                    <i class="fas fa-file mb-0"></i> Download
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </section>

                    <center>
                        <h3 style="margin-top: 0;">Company Constitution (All Members)</h3>
                    </center>

                    <section class="section border shadow-lg p-3 mb-3">
                        <p class="fw-bold mb-2 font-20 text-black">Company Constitution</p>
                        <br>
                        <table class="table table-bordered first_table datatable my-2">
                            <thead>
                                <tr>
                                    <th>Company Constitution</th>
                                    <th>Officer Designation</th>
                                    <th>Officer Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row2 = $excute2->fetch_assoc()) : ?>
                                    <tr>
                                        <td>Company Constitution Form</td>
                                        <td><?php echo htmlspecialchars($row2['officer_designation'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($row2['officer_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                     
                                        <td>
                                            <?php if ($row2['sign_flag_company_constitution'] == 1) : ?>
                                                <span class="badge btn-success shadow-none">Signed</span>
                                            <?php else : ?>
                                                <span class="badge btn-warning shadow-none">Signed Pending</span>
                                            <?php endif; ?>
                                        </td>


                                        <td>
                                            <?php if ($row2['sign_flag_company_constitution'] == 1) : ?>
                                                <a href="<?php echo $baseUrl . "incorporation/before-incorporation/company-constitution/upload_verify_company_constitution_form/" . htmlspecialchars($row2['verify_sign_document_company_constition_pdf'], ENT_QUOTES, 'UTF-8'); ?>" style="padding: 10px; background-color: aliceblue; text-align: center;" target="_blank">
                                                    <i class="fas fa-file mb-0"></i> Download
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </section>

                </section>
            </div>

            <!-- Footer -->
            <?php
            require_once "../footer.php";
            ?>

        </div>
    </div>
    <script>
        $('#verify_data').click(function() {

            swal.fire({
                title: 'Do you want to verify company details and payment details',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then(function(isConfirm) {
                let company_id = $('#company_id').val();
                if (isConfirm.value) {
                    $.ajax({
                        url: '../api/update_company_status.php',
                        type: 'POST',
                        data: {
                            company_id: company_id,
                            new_status: 'Payment_and_data_verified'

                        },
                        success: function(response) {
                            let result = JSON.parse(response);
                            if (result.error_flag == 0) {
                                swal.fire({
                                    title: 'Data verified & Company Documents generated',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Okay'
                                }).then(function(isConfirm) {
                                    let company_id = $('#company_id').val();
                                    if (isConfirm.value) {
                                        window.location = '<?php echo $baseUrl; ?>/internal-staff/company-dashboard/view_company_details.php?company_id=' + company_id;

                                    } else {

                                    }

                                });
                            }
                        }
                    });

                } else {

                }

            });
        })
    </script>

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