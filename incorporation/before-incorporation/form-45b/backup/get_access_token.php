<?php

function getAccessToken() {
    $url = 'https://account-d.docusign.com/oauth/token';
    $client_id = '61edc3ac-b660-4365-afd8-f8eed3876335';
    $client_secret = '16a4657d-8f8c-4bc1-8483-d4c0f1a059ae';

    $postData = [
        'grant_type' => 'client_credentials',
        'client_id' => $client_id,
        'client_secret' => $client_secret
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response, true);
    return $responseData['access_token'];
}


function sendEnvelope($accessToken, $accountId) {
    require_once '../../db.php';
    require_once '../../baseUrl.php';

    $url = "https://demo.docusign.net/restapi/v2.1/accounts/$accountId/envelopes";

    //$documentBase64 = $baseUrl."/incorporation/before-incorporation/form-45/form 45 - empty form.pdf";
     $documentBase64 = base64_encode(file_get_contents($baseUrl."/incorporation/before-incorporation/form-45/form-45.pdf"));

    $postData = [
        'emailSubject' => 'Please sign this document',
        'documents' => [
            [
                'documentBase64' => $documentBase64,
                'name' => 'Document.pdf',
                'fileExtension' => 'pdf',
                'documentId' => '1'
            ]
        ],
        'recipients' => [
            'signers' => [
                [
                    'email' => 'dhruvdaruwala@theoceanstudios.in',
                    'name' => 'vimash prajapati',
                    'recipientId' => '1'
                ]
            ]
        ],
        'status' => 'sent'
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

function refreshAccessToken($refreshToken) {
    $url = 'https://account-d.docusign.com/oauth/token'; // Use the appropriate URL for production or demo
    $client_id = 'YOUR_INTEGRATION_KEY';
    $client_secret = 'YOUR_SECRET';

    $postData = [
        'grant_type' => 'refresh_token',
        'refresh_token' => $refreshToken,
        'client_id' => $client_id,
        'client_secret' => $client_secret
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode != 200) {
        throw new Exception("Error refreshing access token: " . $response);
    }

    $responseData = json_decode($response, true);
    return $responseData;
}

try {
    $refreshToken = 'YOUR_REFRESH_TOKEN'; // Replace with your refresh token
    $newTokens = refreshAccessToken($refreshToken);
    print_r($newTokens);
} catch (Exception $e) {
    echo $e->getMessage();
}


// Example usage
$accessToken = "eyJ0eXAiOiJNVCIsImFsZyI6IlJTMjU2Iiwia2lkIjoiNjgxODVmZjEtNGU1MS00Y2U5LWFmMWMtNjg5ODEyMjAzMzE3In0.AQoAAAABAAUABwCAEHFEI7HcSAgAgFCUUmax3EgCANbf9IktslJJn-HazeJ3A84VAAEAAAAYAAEAAAAFAAAADQAkAAAANjFlZGMzYWMtYjY2MC00MzY1LWFmZDgtZjhlZWQzODc2MzM1IgAkAAAANjFlZGMzYWMtYjY2MC00MzY1LWFmZDgtZjhlZWQzODc2MzM1MAAAFjZXILHcSDcAX8I76IWYLkOp9mTqx22q0Q.eRWr4Iwv6JmquWXZdzzSaM4ey9zBa4Y6oD2FJj5lIUfdIRLHubMF5_N7SBpeT3oZdjDxNtds8hG0VddThPVy8NjsjWrJ-H9jS4JFBOyp5xlMdsGoc1Pe7aJzeqfu9Pa4kQ0zIJKMvXffAukPw2mHK63guNFlVa3pNfC_djLI5551yV0AImBWDdAsGfBl0xxmf2-YHyqkA5427Zvzqj2m-gOhdsOLVcrH2tssL_5e-zt9BvuFWP_38e0E92lPNLnmriVfqT_A0RuZ3AtnirdmuLCfjkCUl3NC5q3FVsTWLcGZZQ63YBAbjksymsGV5POfJJcEJLgaQ-24yiHv4OdsyA";

$accountId = '07cfb3dc-2a26-43cf-8243-e1a7b835d336'; // Replace with your account ID

$response = sendEnvelope($accessToken, $accountId);
echo $accessToken;
print_r($response);

?>


<?php
include('config.php'); // Include your configuration file with DocuSign credentials

// Collect form data
$name = $_POST['name'];
$email = $_POST['email'];
$amount = $_POST['amount'];

// DocuSign API credentials
$accessToken = 'YOUR_ACCESS_TOKEN'; // Obtain and provide access token here
$accountId = '07cfb3dc-2a26-43cf-8243-e1a7b835d336'; // Your DocuSign account ID
$formId = 'YOUR_FORM_ID'; // The ID of the form you want to use

// Prepare the request
$url = "https://demo.docusign.net/restapi/v1.1/accounts/{$accountId}/forms/{$formId}/instances";

$headers = [
    'Authorization: Bearer ' . $accessToken,
    'Content-Type: application/json',
    'Accept: application/json'
];

$data = [
    "signers" => [
        [
            "email" => $email,
            "name" => $name,
            "recipientId" => "1",
            "tabs" => [
                "signHereTabs" => [
                    [
                        "documentId" => "1",
                        "pageNumber" => "1",
                        "recipientId" => "1",
                        "xPosition" => "100",
                        "yPosition" => "100"
                    ]
                ]
            ]
        ]
    ],
    "formFields" => [
        [
            "name" => "loanAmount",
            "value" => $amount,
            "recipientId" => "1",
            "documentId" => "1",
            "pageNumber" => "1"
        ]
    ]
];

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    echo 'Response:' . $response;
}

curl_close($ch);

header('Location: thanks.php');
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application</title>
</head>
<body>
    <h1>Loan Application</h1>
    <form action="apply.php" method="POST">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="amount">Loan Amount:</label>
        <input type="number" id="amount" name="amount" required>
        <br>
        <button type="submit">Apply Now</button>
    </form>
</body>
</html>
