<?php

function sendEnvelope($accessToken, $accountId) {
    require_once '../../db.php';
    require_once '../../baseUrl.php';

    $url = "https://demo.docusign.net/restapi/v2.1/accounts/$accountId/envelopes";
    $apiBase = 'https://demo.docusign.net/restapi';
    //$documentBase64 = $baseUrl."/incorporation/before-incorporation/form-45/form 45 - empty form.pdf";
    $documentBase64 = base64_encode(file_get_contents("http://localhost/vimash_project/incorporation_new22/incorporation/before-incorporation/form-45/form-45.pdf"));


        // Prepare cURL
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "$apiBase/v2.1/accounts/$accountId/envelopes");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json"
        ));

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
                    'email' => 'vimashprajapati03@gmail.com',
                    'name' => 'vimash prajapati',
                    'recipientId' => '1'
                ]
            ]
        ],
        'status' => 'sent'
    ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

        $response = curl_exec($ch);
        if ($response === false) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            echo 'Response: ' . $response;
        }

        curl_close($ch);

    $responseData = json_decode($response, true);
    return $responseData['envelopeId'];

}
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




/*function refreshAccessToken($refreshToken) {
    $url = 'https://account-d.docusign.com/oauth/token'; // Use the appropriate URL for production or demo
    $client_id = '61edc3ac-b660-4365-afd8-f8eed3876335';
    $client_secret = '16a4657d-8f8c-4bc1-8483-d4c0f1a059ae';

    $postData = [
        'grant_type' => 'authorization_code',
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
        throw new Exception("Error refreshing access token: HTTP $httpCode - $response");
    }

    $responseData = json_decode($response, true);

    // Check if response contains expected fields
    if (!isset($responseData['access_token'])) {
        throw new Exception("Invalid response structure: " . print_r($responseData, true));
    }

    return $responseData;
}
*/
function getEnvelopeRecipients($accessToken, $accountId, $envelopeId) {
    $apiBase = 'https://demo.docusign.net/restapi';
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "$apiBase/v2.1/accounts/$accountId/envelopes/$envelopeId/recipients");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json"
    ]);
    
    $response = curl_exec($ch);
    if ($response === false) {
        echo 'Curl error: ' . curl_error($ch);
        curl_close($ch);
        return;
    }
    
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode != 200) {
        echo "Error fetching recipients: HTTP $httpCode - $response";
        return;
    }
    
    $responseJson = json_decode($response, true);
    // Print response to check recipient details
}

function envelopeView($accessToken, $accountId, $envelopeId) {
    $apiBase = 'https://demo.docusign.net/restapi';
    
    // Step 1: Get envelope recipients to verify recipientId
    getEnvelopeRecipients($accessToken, $accountId, $envelopeId);

    // Step 2: Fetch signing URL
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, "$apiBase/v2.1/accounts/$accountId/envelopes/$envelopeId/views/recipient");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json"
    ]);
    
    $data = [
        "returnUrl" => "http://localhost/vimash_project/incorporation_new22/incorporation/before-incorporation/form-45/download.php?en_id=" . $envelopeId,
        "authenticationMethod" => "email",
        "recipientId" => "1", // Ensure this is the correct recipient ID
        "userId" => "89f4dfd6-b22d-4952-9fe1-dacde27703ce",
        "userName" => "Vimash prajapati",
        "email" => "vimashprajapati03@gmail.com"
    ];
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    
    $response = curl_exec($ch);
    if ($response === false) {
        echo 'Curl error: ' . curl_error($ch);
        curl_close($ch);
        return;
    }
    
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    $responseJson = json_decode($response, true);
    
    $signingUrl = $responseJson['url'];
    echo "Signing URL: " . $signingUrl;
    header("Location: " . $signingUrl);

}



$accountId = '07cfb3dc-2a26-43cf-8243-e1a7b835d336';
// Example usage
$accessToken = "eyJ0eXAiOiJNVCIsImFsZyI6IlJTMjU2Iiwia2lkIjoiNjgxODVmZjEtNGU1MS00Y2U5LWFmMWMtNjg5ODEyMjAzMzE3In0.AQoAAAABAAUABwCAEHFEI7HcSAgAgFCUUmax3EgCANbf9IktslJJn-HazeJ3A84VAAEAAAAYAAEAAAAFAAAADQAkAAAANjFlZGMzYWMtYjY2MC00MzY1LWFmZDgtZjhlZWQzODc2MzM1IgAkAAAANjFlZGMzYWMtYjY2MC00MzY1LWFmZDgtZjhlZWQzODc2MzM1MAAAFjZXILHcSDcAX8I76IWYLkOp9mTqx22q0Q.eRWr4Iwv6JmquWXZdzzSaM4ey9zBa4Y6oD2FJj5lIUfdIRLHubMF5_N7SBpeT3oZdjDxNtds8hG0VddThPVy8NjsjWrJ-H9jS4JFBOyp5xlMdsGoc1Pe7aJzeqfu9Pa4kQ0zIJKMvXffAukPw2mHK63guNFlVa3pNfC_djLI5551yV0AImBWDdAsGfBl0xxmf2-YHyqkA5427Zvzqj2m-gOhdsOLVcrH2tssL_5e-zt9BvuFWP_38e0E92lPNLnmriVfqT_A0RuZ3AtnirdmuLCfjkCUl3NC5q3FVsTWLcGZZQ63YBAbjksymsGV5POfJJcEJLgaQ-24yiHv4OdsyA";
// echo $accessToken;
//$freshtoken =  refreshAccessToken($accessToken);
$envelopeId = sendEnvelope($accessToken, $accountId);
 // Replace with your account ID
$envlopeview = envelopeView($accessToken,$accountId,$envelopeId);

print_r($envlopeview);


// print_r($envelopeId);

?>