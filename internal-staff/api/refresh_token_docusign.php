<?php
require_once '../db.php';

// Replace these values with your DocuSign credentials (consider using environment variables for security)
$clientId = '61edc3ac-b660-4365-afd8-f8eed3876335';
$clientSecret = '16a4657d-8f8c-4bc1-8483-d4c0f1a059ae';

// Query to get the refresh token from the database
$sql_token = "SELECT * FROM apis_access_tokens"; // Adjust condition as necessary
$execute_token = mysqli_query($link, $sql_token);

if (!$execute_token) {
    die("Error fetching token: " . mysqli_error($link));
}

$result_token = mysqli_fetch_assoc($execute_token);

if (!$result_token) {
    die("No token found in the database.");
}

$refreshToken = $result_token['refresh_token'];
$last_api_id = $result_token['id'];

// Base64 encode the client ID and client secret
$authorization = base64_encode("$clientId:$clientSecret");

// Define the token endpoint URL
$url = 'https://account-d.docusign.com/oauth/token';

// Define the request headers
$headers = [
    "Authorization: Basic $authorization",
    "Content-Type: application/x-www-form-urlencoded"
];

// Define the request body
$data = http_build_query([
    'grant_type' => 'refresh_token',
    'refresh_token' => $refreshToken
]);

// Initialize a cURL session
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request and get the response
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    die("cURL error: $error");
}

// Close the cURL session
curl_close($ch);

// Decode the JSON response
$responseData = json_decode($response, true);

// Check for errors in the response
if (isset($responseData['error'])) {
    die("Error refreshing token: " . $responseData['error_description']);
}

// Extract the new access token and refresh token from the response
$newAccessToken = $responseData['access_token'];
$newRefreshToken = $responseData['refresh_token'];

// Update the database with the new tokens
$insertQuery = "UPDATE apis_access_tokens SET access_token = ?, refresh_token = ? WHERE id = ?";
$stmt = mysqli_prepare($link, $insertQuery);
mysqli_stmt_bind_param($stmt, 'ssi', $newAccessToken, $newRefreshToken, $last_api_id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Access token saved successfully.');</script>";
} else {
    echo "<script>alert('Failed to save access token.');</script>";
}

// Output the new access token and refresh token
echo "New access token: $newAccessToken\n";
echo "New refresh token: $newRefreshToken\n";
?>
