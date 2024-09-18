<?php
$return['message'] = '';
$company_name = $_POST['company_name'];
$auth_token = $_POST['auth_token'];
// API URL and parameters
$apiUrl = "https://api.bizfile.gov.sg/api/acra/entityQuery/entitySearch";
$queryParams = [
    'name' => $company_name
];

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $apiUrl . '?' . http_build_query($queryParams));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'token: '.$auth_token.''
]);

// Execute the cURL request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    $return['message'] = 'There is an error while searching the entity name';
    $return['error_flag'] = 1;
    $return['error'] = curl_error($ch);
} else {
    // Print the response
    $return['message'] = 'Success';
    $return['error_flag'] = 0;
    $return['error'] = $response;
}

// Close cURL session
curl_close($ch);
echo json_encode($return);
?>
