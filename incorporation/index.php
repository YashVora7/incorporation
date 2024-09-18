<?php
require_once 'session.php';
require_once 'db.php';
require_once 'baseUrl.php';

// require_once 'session.php';
$data_found = false;
$logged_user_id = $_SESSION['user_id'];
// die();



$sql = 'SELECT * FROM register_company WHERE user_id = ' . $logged_user_id . '';
$result = mysqli_query($link, $sql);
$numrows = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if ($numrows > 0) {
  $data_found = true;
  $_SESSION['company_id'] =$row['id'];
  $company_id = $_SESSION['company_id'];
} else {
  $data_found = false;
}
// echo $company_id;
// die();
if (isset($_SESSION['user_id'])) {

    $sql_company_data = mysqli_query($link, 'SELECT * FROM register_company WHERE user_id = ' . $logged_user_id . '');
    
    $row_companys = array();
    while ($row_company_data = mysqli_fetch_assoc($sql_company_data)) {
        $row_companys[] = $row_company_data;
    }
    
    
}
$user_data = $_SESSION['user_data'];
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
      require_once 'header.php';
      require_once 'sidebar.php';
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

          <h5 id="welcome_msg">Welcome to Tianlong Services Pte Ltd. Incorporation Software</h5>
          <?php
          if ($data_found == false) {
          ?>
            <a href="register-company/"> <span class="badge btn-success shadow-none">Incorporate your company</span></a>
          <?php
          }

          ?>

          <?php
          $sql = 'SELECT * FROM register_company WHERE user_id = '.$logged_user_id.'';
          $excute = mysqli_query($link, $sql);
          $result = mysqli_fetch_assoc($excute);

          ?>
          <br><br>
          <?php
          if ($data_found == true) {
          ?>


            <div class="row">
              <h6>Company Details</h6>

              <!-- Company info -->
              <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="card c2">
                  <div class="card-bg">
                    <div class="col p-3">
                      <input style="display: none;" type="text" name="" value="<?= $logged_user_id ?>" id="logged_in_user_id">
                      <div class="d-flex justify-content-between">
                        <span class="mb-0 text-uppercase text-black fw-bold text-sm">Company Info</span>
                      </div>
                      <hr style="margin: .7rem 0;">
                      <div class="row">
                        <div class="col-5">
                          <p class="fw-bold mb-2 font-15 text-black">Company Name</p>
                        </div>
                        <div class="col-7">
                          <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?php echo $result['company_name'] . " " . $result['company_suffix']; ?></p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-5">
                          <p class="fw-bold mb-2 font-15 text-black">Address</p>
                        </div>
                        <div class="col-7">
                          <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?php echo $result['registered_address']; ?></p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-5">
                          <p class="fw-bold mb-2 font-15 text-black">Phone</p>
                        </div>
                        <div class="col-7">
                          <p class="fw-normal mb-2 font-15 text-black-50 text_limit1" id="registered_contact"><?php echo $user_data['contact']; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              if ($result['company_current_status'] == 'only_company_registered' || $result['company_current_status'] == 'Payment_and_data_verified') {
              ?>
                <!-- offcers info here -->
                <?php
                $sql_director = 'SELECT * FROM officer WHERE cr_id = ' . $company_id . ' AND officer_designation = "director" LIMIT 1  ';
                $result_director =  mysqli_query($link, $sql_director);
                $numrows_director = mysqli_num_rows($result_director);
                if ($numrows_director > 0) {
                  $row_director = mysqli_fetch_assoc($result_director);
                ?>

                  <div class="col-xl-3 col-md-4 col-sm-6">
                    <div class="card c2">
                      <div class="card-bg">
                        <div class="col p-3">
                          <div class="d-flex justify-content-between">
                            <span class="mb-0 text-uppercase text-black fw-bold text-sm">Directors Info</span>
                          </div>
                          <hr style="margin: .7rem 0;">
                          <div class="row">
                            <div class="col-5">
                              <p class="fw-bold mb-2 font-15 text-black">Name</p>
                            </div>
                            <div class="col-7">
                              <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?php echo $row_director['officer_name']; ?></p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-5">
                              <p class="fw-bold mb-2 font-15 text-black">Email</p>
                            </div>
                            <div class="col-7">
                              <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?php echo $row_director['officer_email_address']; ?></p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-5">
                              <p class="fw-bold mb-2 font-15 text-black">Phone</p>
                            </div>
                            <div class="col-7">
                              <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?php echo $row_director['officer_contact']; ?></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                }

                ?>

                <?php
                $sql_shareholder = 'SELECT * FROM officer WHERE cr_id = ' . $company_id . ' AND officer_designation = "shareholder" LIMIT 1  ';
                $result_shareholder =  mysqli_query($link, $sql_shareholder);
                $numrows_shareholder = mysqli_num_rows($result_shareholder);
                if ($numrows_shareholder > 0) {
                  $row_shareholder = mysqli_fetch_assoc($result_shareholder);
                  // print_r($row_shareholder);
                ?>

                  <!-- Shareholders info -->
                  <div class="col-xl-3 col-md-4 col-sm-6">
                    <div class="card c2">
                      <div class="card-bg">
                        <div class="col p-3">
                          <div class="d-flex justify-content-between">
                            <span class="mb-0 text-uppercase text-black fw-bold text-sm">Shareholders Info</span>
                          </div>
                          <hr style="margin: .7rem 0;">
                          <div class="row">
                            <div class="col-5">
                              <p class="fw-bold mb-2 font-15 text-black">Name</p>
                            </div>
                            <div class="col-7">
                              <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?php echo $row_shareholder['officer_name']; ?></p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-5">
                              <p class="fw-bold mb-2 font-15 text-black">Email</p>
                            </div>
                            <div class="col-7">
                              <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?php echo $row_shareholder['officer_email_address']; ?></p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-5">
                              <p class="fw-bold mb-2 font-15 text-black">Phone</p>
                            </div>
                            <div class="col-7">
                              <p class="fw-normal mb-2 font-15 text-black-50 text_limit1"><?php echo $row_shareholder['officer_contact']; ?></p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                } ?>
                <!-- Secretary info -->

                <div class="text-end">
                  <a href="<?php echo $baseUrl; ?>incorporation/register-company/full_company_details.php?company_id=<?= $row['id'] ?>" class="btn btn-primary">View More</a>
                </div>
            </div>
          <?php
              }
          ?>
          <!-- Directors info -->

          <hr>
          <?php

            if ($result['company_current_status'] == 'only_company_registered' || $result['company_current_status'] == 'Payment_and_data_verified') {
          ?>
        <div class="row">
            <div class="col-12">
                <h6 class="mb-4">Company Details</h6>
                <!-- Company details card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <?php foreach ($row_companys as $row_company): ?>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="fw-bold mb-0 font-20 text-black">
                                    Company: <span class="fw-normal text-black-50"><?= htmlspecialchars($row_company['company_name']); ?></span>
                                </p>
                                <h5 class="badge bg-warning text-dark shadow-none font-15 mb-0"><?= htmlspecialchars($row_company['company_current_status']); ?></h5>
                            </div>

                            <hr class="my-3">

                            <div class="mb-3">
                                <h6 class="fw-bold font-16 text-black">Document Sign</h6>
                            </div>

                            <div class="row">
                                <?php
                                $company_id = $row_company['id'];
                                $sql_officers = mysqli_query($link, 'SELECT * FROM officer WHERE cr_id = ' .  $company_id);

                                if (mysqli_num_rows($sql_officers) > 0) {
                                    while ($row_officer = mysqli_fetch_assoc($sql_officers)) :
                                ?>
                                    <div class="col-md-4">
                                        <div class="card border-0 mb-4">
                                            <div class="card-body p-3">
                                                <div class="text-center mb-3">
                                                    <h6 class="text-uppercase text-black fw-bold mb-1"><?= htmlspecialchars($row_officer['officer_name']); ?></h6>
                                                    <span class="text-uppercase text-muted"><?= htmlspecialchars($row_officer['officer_designation']); ?></span>
                                                </div>
                                                <hr class="my-3">

                                                <!-- Document Status -->
                                                <?php if ($row_officer['officer_designation'] != 'shareholder'): ?>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="fw-bold mb-2 font-15 text-black">Form 45</p>
                                                        <?php if ($row_officer['sign_flag_45'] == 1): ?>
                                                            <span class="badge bg-success">Signed</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-warning">Sign Pending</span>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="fw-bold mb-2 font-15 text-black">Company Constitution</p>
                                                    <?php if ($row_officer['sign_flag_company_constitution'] == 1): ?>
                                                        <span class="badge bg-success">Signed</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning">Sign Pending</span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="fw-bold mb-2 font-15 text-black">Report Incorporation</p>
                                                    <?php if ($row_officer['verify_sign_flag_report_incorporation_pdf'] == 1): ?>
                                                        <span class="badge bg-success">Signed</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning">Sign Pending</span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="fw-bold mb-2 font-15 text-black">CDD KYC</p>
                                                    <?php if ($row_officer['cddkyc_form'] == 1): ?>
                                                        <span class="badge bg-success">Submitted</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-warning">Form Not Submitted</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    endwhile;
                                }
                                ?>
                            </div>

                            <hr class="my-4">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
          <?php
            }
          ?>

        <?php
          }
        ?>


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
        url: 'http://localhost:3000/client/' + logged_in_user_id,
        type: 'GET',

        success: function(response) {
          $('#registered_name').html(response.Data.firstName + ' ' + response.Data.lastName);
          $('#registered_contact').html(response.Data.phone);
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
</body>

</html>