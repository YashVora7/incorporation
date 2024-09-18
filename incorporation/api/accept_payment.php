<?php
require_once '../db.php'; // Ensure this file initializes $link as a mysqli connection
header("Content-Type: application/json");

// Retrieve POST data
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(["success" => false, "error" => "Invalid input"]);
    exit;
}

$company_id = $data['company_id'];
$user_id = $data['user_id'];
$amount = $data['amount'];
$currency = $data['currency'];
$description = $data['description'];
$stripe_payment_intent_id = $data['stripe_payment_intent_id'];
$status = $data['status'];

$default_staff_query = "SELECT id,secretary_id, compliance_id, incorporator_id FROM set_default_staff";
$default_stmt = $link->prepare($default_staff_query);
$default_stmt->execute();
$default_result = $default_stmt->get_result()->fetch_assoc();

$secretary_id=$default_result['secretary_id'];
$compliance_id=$default_result['compliance_id'];          
$incorporator_id=$default_result['incorporator_id'];                
                // Insert data into the database
$stmt1 = $link->prepare("INSERT INTO staff_assignments (company_id, secretary_id, compliance_id, incorporator_id) VALUES (?, ?, ?, ?)");
$stmt1->bind_param("iiii", $company_id, $secretary_id, $compliance_id, $incorporator_id);


// Validate input
if (!is_numeric($company_id) || !is_numeric($user_id) || !is_numeric($amount) || empty($currency) || empty($description) || empty($stripe_payment_intent_id) || empty($status)) {
    echo json_encode(["success" => false, "error" => "Invalid input data"]);
    exit;
}

// Prepare and execute the SQL statement
$sql = "INSERT INTO payments (company_id, user_id, amount, currency, description, stripe_payment_intent_id, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $link->prepare($sql);

if (!$stmt) {
    echo json_encode(["success" => false, "error" => "Prepare statement failed: " . $link->error]);
    exit;
}

$stmt->bind_param("iidsiss", $company_id, $user_id, $amount, $currency, $description, $stripe_payment_intent_id, $status);

    if ($stmt->execute() && $stmt1->execute()) {
        echo json_encode(["success" => true]);
    } else {
        $error = $stmt->error ?: $stmt1->error; // Capture the error from either statement
        echo json_encode(["success" => false, "error" => "Execute statement failed: " . $error]);
    }
?>
