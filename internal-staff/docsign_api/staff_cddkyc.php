<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>

<body>
<?php
require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';
?>
<?php
 $get_officer_id = isset($_GET['officer_id'])? $_GET['officer_id']:' ';
 $user_id = $_SESSION['user_id'];

    $sql_user_role = "SELECT * FROM user_roles WHERE id ='$user_id' ";
    $excute_user_role = mysqli_query($link,$sql_user_role);
    $result_user_role = mysqli_fetch_assoc($excute_user_role);

    $sql = "SELECT o.*, c.company_name,c.company_suffix,c.created_at
        FROM officer o
        JOIN register_company c ON o.cr_id = c.id
        WHERE o.id = '$get_officer_id'
        ORDER BY o.id DESC";
    $excute = mysqli_query($link,$sql);
    $result = mysqli_fetch_assoc($excute);
   
    $sql_company = "SELECT company_name, company_suffix, number_of_shares FROM register_company";
    $resultcompany = $link->query($sql_company);
    //print_r($result);
?>

<?php
$sql_token = "SELECT * FROM apis_access_tokens";

$execute_token = mysqli_query($link, $sql_token);
$result_token = mysqli_fetch_assoc($execute_token);

// Get data from the database
$uploadDir = '../uploads/customer_acceptance_form/'.$result['cddkyc_customer_pdf'];
// Read the PDF file and encode it to Base64
$documentBase64 = base64_encode(file_get_contents($uploadDir));

$accountId = '07cfb3dc-2a26-43cf-8243-e1a7b835d336';
// Example usage
$accessToken = $result_token['access_token'];

//$accessToken = getAccessToken();
//$freshtoken =  refreshAccessToken($accessToken);

 // Replace with your account ID

$baseUrl_1 = $baseUrl; 

// Usage example
$brandId = '11ebcdcd-9f59-4414-98ca-35404d6e6d53';
$envelopeId = sendEnvelope($accessToken, $accountId, $documentBase64, $result_user_role, $brandId, $result);


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
    return $responseJson;
    // Print response to check recipient details
}
 function sendEnvelope($accessToken, $accountId, $documentBase64, $result_user_role, $brandId, $result) {
    $apiBase = 'https://demo.docusign.net/restapi';

    // Prepare the API request URL
    $url = "$apiBase/v2.1/accounts/$accountId/envelopes";

    // Prepare the envelope data
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
                    'email' => $result_user_role['email'],
                    'name' => $result_user_role['name'],
                    'recipientId' => '1', // Consistent ID for first recipient
                    'routingOrder' => '1'
                ]
            ]
        ],
         'customFields' => [
                'textCustomFields' => [
                    [
                        'name' => 'user_id',
                        'value' => $result_user_role['id']
                    ],
                    [
                        'name' => 'officer',
                        'value' => ''
                    ]
                ]
            ],
        'status' => 'sent', // Change to 'created' if you don't want to send immediately
        'brandId' => $brandId // Add the brand ID here
    ];

    // Initialize cURL
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json"
    ]);

    // Set the post fields
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    // Execute the cURL request
    $response = curl_exec($ch);

    if ($response === false) {
        // Output cURL error if any
        echo 'Curl error: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    // Get the HTTP status code
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode != 201) {
        // Handle non-201 responses (201 is the expected code for a successful envelope creation)
        echo "Error: HTTP $httpCode - $response";
        return null;
    }

    // Decode the response
    $responseData = json_decode($response, true);
     ?>
     <script>
            swal.fire({
                title: '<?php echo $result['officer_email_address']; ?>',
                text: 'Please check your registered email ID sign the document.',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Okay'
            }).then(function(isConfirm) {

                if (isConfirm.value) {
                   window.location = '../company-dashboard/cddkyc.php?company_id=<?= $result['cr_id']; ?>';
                }
            });
        </script>

        <?php
    // Return the envelope ID
    return $responseData['envelopeId'] ?? null;
}

function envelopeView($accessToken, $accountId, $envelopeId, $baseUrl, $officer_id, $result) {
    $apiBase = 'https://demo.docusign.net/restapi';
    $recipientData = getEnvelopeRecipients($accessToken, $accountId, $envelopeId);

    // Extract recipient details from the provided recipient data
    $recipientId = $recipientData['signers'][0]['recipientId']; // Ensure this matches '1'
    $officerName = $recipientData['signers'][0]['name'];
    $officerEmail = $recipientData['signers'][0]['email'];

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
        "returnUrl" => $baseUrl . "internal-staff/docsign_api/cddkyc_save.php?en_id=" . $envelopeId."&director_id=" . $officer_id."&company_id=" . $result['cr_id'],
        "authenticationMethod" => "PaperDocuments",
        "recipientId" => $recipientId, // Ensure this is the correct recipient ID
        "userName" => "Tialong Services Pte. Ltd.",
        "email" => "dhruvdaruwala03@gmail.com"
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

    if (isset($responseJson['url'])) {
        $signingUrl = $responseJson['url'];
        echo "Signing URL: " . $signingUrl;
        header("Location: " . $signingUrl);
    } else {
        echo 'Error: Unable to retrieve signing URL. Response: ' . print_r($responseJson, true);
    }
}
?>
</body>

</html>
</body>

</html>