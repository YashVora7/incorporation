<?php
session_start();
require_once '../db.php';
require_once '../baseUrl.php';

$response = array('error_flag' => 1, 'error_message' => '','user_data'=>'');

// Check if email and password are provided
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Prepare and execute the SQL query
        $sql = "SELECT id, isAdmin, name, password FROM user_roles WHERE email = ? AND password = ?"; // Corrected SQL syntax
        $stmt = $link->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $isAdmin, $name, $hashed_password);
            $stmt->fetch();

            // Verify the password
 
            if ($password == $hashed_password) {
                $response['error_flag'] = 0;
                $response['error_message'] = 'Login successful';
               

                // Optionally, add user ID or other session data
                if ($isAdmin == 1) {
                    $response['user_role'] = 'super_admin';
                } elseif ($isAdmin == 3) {
                    $response['user_role'] = 'staff';
                } else {
                    $response['user_role'] = 'client';
                }
                $_SESSION['user_id'] = $user_id;
                $sql_user = mysqli_query($link, "SELECT * FROM user_roles WHERE email = '$email' AND password = '$password'");
                $result = mysqli_fetch_assoc($sql_user);
                $_SESSION['user_data'] = $result;
                $response['user_data'] = $result;

                $sql_user_company = mysqli_query($link, "SELECT * FROM register_company WHERE user_id = '$user_id'");

                // Check if the query was successful
                if ($sql_user_company) {
                    if (mysqli_num_rows($sql_user_company) > 0) {
                        // Fetch all rows as an associative array
                        $result_company = mysqli_fetch_all($sql_user_company, MYSQLI_ASSOC);

                        // Store all company data in the session
                        $_SESSION['login_user_company_data'] = $result_company;
                    }
                    else
                    {
                        $_SESSION['login_user_company_data'] = 'Not Found';
                        
                    }
                } else {
                    // Handle query error
                    $_SESSION['login_user_company_data'] = array(); // or some other default value
                }
            } else {
                $response['error_message'] = 'Incorrect password';
            }
        } else {
            $response['error_message'] = 'Email and Password are incorrect';
        }

        $stmt->close();
    } else {
        $response['error_message'] = 'Email and Password are required';
    }
} else {
    $response['error_message'] = 'Invalid request';
}

// Send the response back to the client
echo json_encode($response);

$link->close();
