<?php
require_once 'session.php';
require_once 'baseUrl.php';
require_once 'db.php';

$logged_user_id = 2;
$sql = "SELECT COUNT(rc.id) as total_companies 
        FROM register_company rc 
        LEFT JOIN staff_assignments sa 
        ON rc.id = sa.company_id";
$result = mysqli_query($link, $sql);

if ($result) {
    $row_total_companies = mysqli_fetch_assoc($result);
    $total_companies = $row_total_companies['total_companies'];
} else {
    echo "Error: " . mysqli_error($link);
}

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

$rows = array();

// Fetch the data
while ($result = mysqli_fetch_assoc($excute2)) {
    $rows[] = $result;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Admin - Tianlong Services Pte Ltd</title>
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="assets/bundles/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="assets/bundles/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="assets/bundles/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel="icon" type="image/png" href="assets/img/logo.webp">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="assets/bundles/footable-bootstrap/css/footable.bootstrap.min.css">
  <link rel="stylesheet" href="assets/bundles/footable-bootstrap/css/footable.standalone.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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

  <div id="app">
    <div class="main-wrapper main-wrapper-1">

      <!-- Header + sidebar  -->
      <?php
      require_once 'header.php';
      require_once 'sidebar.php';
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <input style="display: none;" type="text" name="" value="<?= $logged_user_id ?>" id="logged_in_user_id">
        <section class="section">

          <h5 id="welcome_msg">Welcome: Mr Kay (CDDKYC Expert Staff)</h5>
          <br>
          <div class="row">
            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="card c2">
                <div class="col p-3">
                  <div class="d-flex justify-content-between">
                    <span class="mb-0 text-uppercase text-black-50 fw-bold text-sm">Total New Registered Companies</span>
                    <i class="fas fa-building card-ic on col-dark font-30 p-r-30"></i>
                  </div>
                  <h4 class="fw-bold mt-2 mb-2 font-25 text-black-50"><?= $total_companies; ?> </h4>
                  <a href="<?php echo $baseUrl; ?>/super_admin/new_companies">
                    <span class="mb-0 text-nowrap text-primary-50">View details</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <?php
          $last_month = date('Y-m-d H:i:s', strtotime('-1 month'));

          // Query to get all companies with or without staff assignments from the last month
          $sql = "SELECT rc.*, sa.secretary_id, sa.compliance_id, sa.incorporator_id
                  FROM register_company rc
                  LEFT JOIN staff_assignments sa ON rc.id = sa.company_id
                  WHERE rc.created_at >= '$last_month'";

            $result_company = mysqli_query($link, $sql);

            $total_row_company = mysqli_num_rows($result_company);
            if($total_row_company > 0) {
                // Separate companies based on their stat
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
                echo "<p class='fw-bold font-20 text-black'>Last Month Registered Company</p>
                      <br>";
                echo '<table class="table table-striped datatable mb-2 text-center ">';
                echo '<thead ">';
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


              } else {
                  echo '<div class="col-12"><div class="text-center"><h1>No New Company Register</h1></div></div>';
              }
          ?>
                <br>
                <br>
                <section class="section border shadow-lg p-3">
                    <p class="fw-bold font-20 text-black">Pending Tasks</p>
                    <div class="table-responsive">
                        <table class="table table-striped datatable mb-2">
                            <thead>
                                <tr>
                                    <th>Designation</th>
                                    <th>Name</th>
                                    <th>Company Name</th> <!-- New column for Company Name -->
                                    <th>CDDKYC Approval Sign Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $row2): ?>
                                    <?php 
                                    // Skip the row if signed
                                    if (($row2['officer_designation'] == 'shareholder' && $row2['percentage_of_shares'] >= 25) || $row2['officer_designation'] == 'director') {
                                        if ($row2['super_admin_sign_cddkyc'] != 1): ?>
                                            <tr>
                                                <td><?php echo ucfirst($row2['officer_designation']); ?></td>
                                                <td><?php echo $row2['officer_name']; ?></td>
                                                <td><?php echo $row2['company_name']." ".$row2['company_suffix']; ?></td> <!-- Display Company Name -->
                                                <td>
                                                    <span class="badge bg-danger">CDDKYC Approval Form Unsigned</span>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
        </section>
      </div>

      <!-- Footer -->
      <?php
      require_once "footer.php";
      ?>

    </div>
  </div>

  <script>
    $(document).ready(function() {
      let logged_in_user_id = $('#logged_in_user_id').val();

      $.ajax({
        url: 'http://localhost:3000/user/' + logged_in_user_id,
        type: 'GET',

        success: function(response) {

          $('#welcome_msg').html("Welcome " + response.Data.firstName + ' ' + response.Data.lastName);
        }
      });
      $.ajax({
          url: 'api/refresh_token_docusign.php',
          type: 'GET', // or 'POST' depending on your API
          success: function(tokenResponse) {
              let tokenResult = JSON.parse(tokenResponse);
              if (tokenResult.success) { // Assuming your API returns a 'success' flag
                  alert('Token refreshed successfully!');
                                        } else {
                  alert('Failed to refresh token: ' + tokenResult.message); // Assuming the API returns a 'message'
              }
          },
          error: function(jqXHR, textStatus, errorThrown) {
              alert('Failed to call refresh token API: ' + textStatus);
          }
      });

    })
  </script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/bundles/echart/echarts.js"></script>
  <script src="assets/bundles/chartjs/chart.min.js"></script>
  <script src="assets/js/page/index.js"></script>
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/page/footable-data.js"></script>
  <script src="assets/bundles/footable-bootstrap/js/footable.js"></script>
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