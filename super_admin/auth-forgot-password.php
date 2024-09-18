<?php
session_start();
// require_once 'db.php';

$error = "";

if (isset($_POST['submit'])) {

  $emailId = $_POST['email_id'];
  $email_id = strval($emailId);
  $sql = mysqli_query($link, "SELECT admin_id FROM admin WHERE email_id = '$email_id' ");
  $numrows = mysqli_num_rows($sql);

  if ($numrows > 0) {
    $result = mysqli_fetch_assoc($sql);
    $admin_id = $result['admin_id'];

    $otp = strval(rand(1000, 9999));

    $from = "info@bluesitsecurities.com";
    $to = $email_id;

    $subject = "Tianlong Services Pte Ltd: Your One-Time Password (OTP)";

    $headers = "From: Tianlong Services Pte Ltd <info@bluesitsecurities.com>\r\n";
    $headers .= "Reply-To: info@bluesitsecurities.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $message = '
    <html>
        <head>
            <title>Tianlong Services Pte Ltd: Your One-Time Password (OTP)</title>
            <style>
              body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                color: #333;
                line-height: 1.6;
              }
              .container {
                  width: 80%;
                  max-width: 600px;
                  margin: 0 auto;
                  padding: 20px;
                  background: #fff;
                  border-radius: 8px;
                  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
              } 
              .header {
                  border-bottom: 1px solid #f4f4f4;
                  padding-bottom: 10px;
                  margin-bottom: 20px;
              }
              .header h1 {
                  font-size: 24px;
                  margin: 0;
              }
              p {
                  font-size: 16px;
                  color: #555;
              }
              .footer {
                  border-top: 1px solid #f4f4f4;
                  padding-top: 10px;
                  margin-top: 20px;
                  text-align: center;
                  font-size: 12px;
                  color: #aaa;
              }
            </style>
        </head>
        <body>
          <div class="container">
            <div class="header">
                <h1>Tianlong Services Pte Ltd</h1>
            </div>
            <p>Dear User,</p>
            <p>Your OTP for verification is: <strong>' . $otp . '</strong>.</p>
            <p>Please use this code to complete your verification process.</p>
            <p>If you did not request this OTP, please ignore this email.</p>
            <div class="footer">
                <p>&copy; ' . date('Y') . ' Tianlong Services Pte Ltd. All rights reserved.</p>
            </div>
        </div>
        </body>
    </html>';

    if (mail($to, $subject, $message, $headers)) {
      $_SESSION["OTP"] = $otp;
      // header("Location: otp.php?id=$admin_id");
      header("Location: otp/$admin_id");
    } else {
      echo 'Error: Unable to send the email. Please try again later.';
    }
  } else {
    $error = 'Invalid Email ID';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Admin - Tianlong Services Pte Ltd</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/bundles/izitoast/css/iziToast.min.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/logo.webp' />
  <style>
    body {
      /* background-image: url("assets/img/image-gallery/study_background.jpg"); */
      background-position: 0% 40%;
      background-color: #f1f5ff;
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>

<body>
  <div class="loader"></div>
  <div class="center"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Forgot Password</h4>
              </div>
              <div class="card-body">
                <form name="" action="" method="POST">
                  <div class="form-group">
                    <label for="email_id">Email</label>
                    <input id="email_id" type="text" class="form-control" name="email_id" tabindex="1" required autofocus>
                  </div>
                  <input name="submit" id="submit" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" value=" Get Your Password">
                  <a href="auth-login" name="" id="" type="" class="btn btn-info btn-lg btn-block" tabindex="4" value="">Back</a>
                  <div class="row sm-gutters">
                    <div class="mt-5 text-muted text-center">
                      <h6 style="color:red;"><?php echo $error; ?></h6>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>

</html>