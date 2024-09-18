<?php
$return['message'] = '';
// Request URL
$url = 'https://api.bizfile.gov.sg/authorizeServer/oauth/token?grant_type=client_credentials';

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/x-www-form-urlencoded',
));
curl_setopt($ch, CURLOPT_USERPWD, 'XQSTGP73F561T9P6K600LWBCLJ9J8USHGE3SLDTPCP42TOE0DT5GNKXWL0JIMKBY:YjAMjWqT');

// Execute cURL request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    $return['message'] = 'Error: ' . curl_error($ch);
} else {
    // Decode JSON response
    $decodedResponse = json_decode($response, true);

    // Check if decoding was successful
    if (json_last_error() === JSON_ERROR_NONE) {
        if (isset($decodedResponse['error'])) {
            // Handle specific API error messages
            $return['message'] = 'API Error: ' . $decodedResponse['error_description'];
        } else {
            $return['message'] = 'success';
            // Format JSON response without escaping special characters
            $return['data'] = $decodedResponse;
        }
    } else {
        $return['message'] = 'Failed to decode JSON.';
        $return['data'] = '';
    }
}

// Close cURL session
curl_close($ch);

// Output the result
header('Content-Type: application/json');
echo json_encode($return);
?>
