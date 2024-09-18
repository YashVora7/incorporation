<?php
require_once '../db.php'; // Ensure this file correctly connects to your database

$return = [
    'message' => '',
    'error_flag' => 0,
    'data' => null
];

// Check if company_id is set and not empty
if (isset($_POST['company_id']) && !empty($_POST['company_id'])) {
    $company_id = $_POST['company_id'];

    // Use a prepared statement to prevent SQL injection
    $stmt = $link->prepare("SELECT * FROM register_company WHERE id = ?");
    $stmt->bind_param("i", $company_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        // Check if the company is found
        if ($result->num_rows > 0) {
            $return['data'] = $result->fetch_assoc(); // Fetch the company data
            $return['message'] = 'Data retrieved successfully';
        } else {
            $return['message'] = 'No company found with the given ID';
            $return['error_flag'] = 1;
        }
    } else {
        $return['message'] = 'Error executing query';
        $return['error_flag'] = 1;
        $return['error'] = $stmt->error;
    }

    $stmt->close(); // Close the statement
} else {
    $return['message'] = 'Invalid company ID';
    $return['error_flag'] = 1;
}

echo json_encode($return); // Return the response as JSON
?>
