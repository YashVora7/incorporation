<?php
require_once 'session.php';
require_once 'baseUrl.php';
require_once 'db.php';
$logged_user_id = $_SESSION['user_id'];

$sql = "SELECT count(id) as total_companies FROM staff_assignments WHERE secretary_id = '$logged_user_id'  OR compliance_id ='$logged_user_id' OR incorporator_id ='$logged_user_id'";

$result = mysqli_query($link, $sql);
$row_total_companies = mysqli_fetch_assoc($result);
$total_companies  = $row_total_companies['total_companies'];

?>
<?php
$sql_secretary = "
    SELECT register_company.company_name, 
           IF(secretary_sign_form45.secretary_id IS NOT NULL, 'signed', 'unsigned') AS sign_status
    FROM staff_assignments
    LEFT JOIN secretary_sign_form45 
        ON staff_assignments.secretary_id = secretary_sign_form45.secretary_id
    JOIN register_company 
        ON staff_assignments.company_id = register_company.id
    WHERE staff_assignments.secretary_id = '$logged_user_id'";
$result_secretary = mysqli_query($link, $sql_secretary);


$sql_compliance = "
    SELECT register_company.company_name,officer.officer_name, 
           IF(compliance_sign_cddkyc.compliance_id IS NOT NULL, 'signed', 'unsigned') AS sign_status
    FROM staff_assignments
    LEFT JOIN compliance_sign_cddkyc 
        ON staff_assignments.compliance_id = compliance_sign_cddkyc.compliance_id
    JOIN officer ON officer.id = compliance_sign_cddkyc.officer_id
    JOIN register_company 
        ON staff_assignments.company_id = register_company.id
    WHERE staff_assignments.compliance_id = '$logged_user_id'";
$result_compliance = mysqli_query($link, $sql_compliance);


$sql_incorporator_completed = "SELECT register_company.*, incorporate.id AS i_id,incorporate.incorporation_status AS i_status
    FROM staff_assignments
    JOIN register_company ON staff_assignments.company_id = register_company.id
    JOIN incorporate ON incorporate.company_id = register_company.id  AND incorporation_status = 'completed'
     WHERE staff_assignments.incorporator_id = '$logged_user_id' AND all_cddkyc_sign_done = 1 ";

$result_incorporator_completed = mysqli_query($link, $sql_incorporator_completed);

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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </nav>
        <section class="section">
          <h5 id="welcome_msg">Welcome: Mr Kay (CDDKYC Expert Staff)</h5>
          <br>
          <div class="row">

            <div class="col-xl-3 col-md-4 col-sm-6">
              <div class="card c2">
                <div class="col p-3">
                  <div class="d-flex justify-content-between">
                    <span class="mb-0 text-uppercase text-black-50 fw-bold text-sm">Total Companies Assigned</span>
                    <i class="fas fa-building card-ic on col-dark font-30 p-r-30"></i>
                  </div>
                  <h4 class="fw-bold mt-2 mb-2 font-25 text-black-50"><?= $total_companies; ?> </h4>
                  <a href="<?php echo $baseUrl; ?>/internal-staff/company-dashboard">
                    <span class="mb-0 text-nowrap text-primary-50">View details</span>
                  </a>
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
                                        <div class="d-md-flex gap-3">
                                            <p class="fw-bold mb-2 font-20 text-black">Task Status</p>
                                        </div>
                                        <hr style="margin: .7rem 0;">
                                        <div class="row pt-3">
                                            <br>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <!-- Secretary Section -->
                                                        <?php if (mysqli_num_rows($result_secretary) > 0): ?>
                                                        <div class="table-responsive border shadow-lg p-3 mb-3">
                                                            <p class="fw-bold font-20 text-black">Secretary Tasks</p>
                                                            <table class="table table-bordered table-striped table-sm datatable mb-2">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th><h4 class="small">Company Name</h4></th>
                                                                        <th><h4 class="small">Task Status</h4></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php while ($row_company = mysqli_fetch_assoc($result_secretary)): ?>
                                                                        <tr>
                                                                            <td><?= $row_company['company_name'] ?></td>
                                                                           <td>
                                                                              <?php if ($row_company['sign_status'] == 'signed'): ?>
                                                                                  <span class="badge bg-success">Form 45B <?= $row_company['sign_status'] ?></span> <!-- Green text for signed -->
                                                                              <?php else: ?>
                                                                                  <span class="badge bg-danger">Form 45B <?= $row_company['sign_status'] ?></span> <!-- Red text for unsigned -->
                                                                              <?php endif; ?>
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
                                                            <p class="fw-bold font-20 text-black">Compliance Person Tasks </p>
                                                            <table class="table table-bordered table-striped table-sm datatable mb-2">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th><h4 class="small">Company Name</h4></th>
                                                                        <th><h4 class="small">Officer Name</h4></th>
                                                                        <th><h4 class="small">Task Status</h4></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php while ($row_company = mysqli_fetch_assoc($result_compliance)): ?>
                                                                        <tr>
                                                                            <td><?= $row_company['company_name'] ?></td>
                                                                            <td><?= $row_company['officer_name'] ?></td>
                                                                            <td>
                                                                              <?php if ($row_company['sign_status'] == 'signed'): ?>
                                                                                  <span class="badge bg-success"> CDDKYC Form <?= $row_company['sign_status'] ?></span> <!-- Green text for signed -->
                                                                              <?php else: ?>
                                                                                  <span class="badge bg-danger"> CDDKYC Form <?= $row_company['sign_status'] ?></span> <!-- Red text for unsigned -->
                                                                              <?php endif; ?>
                                                                          </td>
                                                                        </tr>
                                                                    <?php endwhile; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <?php endif; ?>

                                                        <!-- Yet To Incorporators Section -->
                                                         <!-- Completed Incorporators Section -->
                                                        <?php if (mysqli_num_rows($result_incorporator_completed) > 0): ?>
                                                        <div class="table-responsive border shadow-lg p-3 mb-3">
                                                            <p class="fw-bold font-20 text-black">Incorporator Tasks </p>
                                                            <table class="table table-striped table-bordered table-sm datatable mb-2">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th><h4 class="small">Company Name</h4></th>
                                                                        <th><h4 class="small">Task Status</h4></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php while ($row_company = mysqli_fetch_assoc($result_incorporator_completed)): ?>
                                                                        <tr>
                                                                            <td><h5 class="small"><?= $row_company['company_name'] ?></h5></td>
                                                                            <td>
                                                                              <?php if ($row_company['i_status'] == 'completed'): ?>
                                                                                  <span class="badge bg-success">Company Incorporator <?= $row_company['i_status'] ?></span> <!-- Green text for signed -->
                                                                              <?php else: ?>
                                                                                  <span class="badge bg-danger">Company Incorporator <?= $row_company['i_status'] ?></span> <!-- Red text for unsigned -->
                                                                              <?php endif; ?>
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

