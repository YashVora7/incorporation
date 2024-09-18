<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../plugins/vendor/autoload.php';

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email_id = $_POST['email_id'];
$contact_number = $_POST['contact_number'];
$client_password = $_POST['client_password'];

// Securely hash the password before storing it
$return = ['message' => '', 'error_flag' => 0, 'user_id' => null];

require_once '../db.php';

$full_name = $first_name . ' ' . $last_name;
$date = date('Y');

// Check if email already exists
$check_email = $link->prepare('SELECT id FROM user_roles WHERE email = ?');
$check_email->bind_param('s', $email_id);
$check_email->execute();
$check_email->store_result();

if ($check_email->num_rows > 0) {
    // If email exists, return an error message
    $return['message'] = 'Email already exists';
    $return['error_flag'] = 1;
} else {
    // Check if contact number already exists
    $check_contact = $link->prepare('SELECT id FROM user_roles WHERE contact = ?');
    $check_contact->bind_param('s', $contact_number);
    $check_contact->execute();
    $check_contact->store_result();

    if ($check_contact->num_rows > 0) {
        // If contact number exists, return an error message
        $return['message'] = 'Contact number already exists';
        $return['error_flag'] = 1;
    } else {
        // Insert user data
        $stmt = $link->prepare('INSERT INTO user_roles (name, email, password, contact, isAdmin) VALUES (?, ?, ?, ?, ?)');
        $isAdmin = 2;
        $stmt->bind_param('ssssi', $full_name, $email_id, $client_password, $contact_number, $isAdmin);

        if ($stmt->execute()) {
            $user_id = $link->insert_id;
            $return['message'] = 'User registration completed successfully';
            $return['user_id'] = $user_id;
             $message = '
            <!DOCTYPE html>
            <html>
            <head>
                <title>Welcome to Tianlong Services Pte Ltd</title>
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
                        border-bottom: 1px solid #eaeaea;
                        padding-bottom: 10px;
                        margin-bottom: 20px;
                        text-align: center;
                    }
                    .header h1 {
                        font-size: 28px;
                        margin: 0;
                        color: #0073e6;
                    }
                    .welcome-message {
                        font-size: 16px;
                        color: #555;
                        text-align: center;
                    }
                    .button {
                        display: inline-block;
                        margin-top: 20px;
                        padding: 10px 20px;
                        background-color: #0073e6;
                        color: #fff;
                        text-decoration: none;
                        border-radius: 5px;
                        text-align: center;
                    }
                    .button:hover {
                        background-color: #005bb5;
                    }
                    .footer {
                        border-top: 1px solid #eaeaea;
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
                        <h1>Welcome to Tianlong Services Pte Ltd</h1>
                    </div>
                    <div class="welcome-message">
                        <p>Dear User,</p>
                        <p>We are thrilled to have you as a new member of our community! At Tianlong Services Pte Ltd, we strive to provide the best services to meet your needs.</p>
                        <p>To get started, please explore our website and discover the range of services we offer. We are here to support you every step of the way.</p>
                        <a href="https://www.tianlongservices.com" class="button">Explore Now</a>
                    </div>
                    <div class="footer">
                        <p>&copy;' . $date . ' Tianlong Services Pte Ltd. All rights reserved.</p>
                    </div>
                </div>
            </body>
            </html>
            ';

            // Send email using PHPMailer
            $mail = new PHPMailer(true);

            try {
                $mail->SMTPDebug = 0;                                // Disable debug output
                $mail->isSMTP();                                     // Use SMTP
                $mail->Host       = 'smtp.gmail.com';                // Specify SMTP server
                $mail->SMTPAuth   = true;                            // Enable SMTP authentication
                $mail->Username   = 'vimashprajapati03@gmail.com';   // SMTP username
                $mail->Password   = 'nlpo fzvg ydsb rjus';           // SMTP password (use Gmail App Password)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
                $mail->Port       = 587;                             // TCP port

                // Email details
                $mail->setFrom('vimashprajapati03@gmail.com', 'Tianlong Services Pte Ltd');
                $mail->addAddress($email_id);                        // Add recipient

                // Email content
                $mail->isHTML(true);                                 // Set email format to HTML
                $mail->Subject = 'Tianlong Services Pte Ltd: Your Registration Details';
                $mail->Body    =  $message;

                // Send the email
                $mail->send();
            } catch (Exception $e) {
                $return['message'] = 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                $return['error_flag'] = 1;
            }

            $stmt->close();
        } else {
            $return['message'] = 'User registration failed: ' . $link->error;
            $return['error_flag'] = 1;
        }
    }
}

// Return the response as JSON
echo json_encode($return);
?>
