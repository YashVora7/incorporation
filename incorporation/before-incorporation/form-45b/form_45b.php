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
require_once '../../db.php';
require_once '../../baseUrl.php';
require_once '../vendor/autoload.php'; // Adjust path if needed


$sql_token = "SELECT * FROM apis_access_tokens";

$execute_token = mysqli_query($link, $sql_token);
$result_token = mysqli_fetch_assoc($execute_token); 

// Get data from the database
$get_secretary_id = isset($_GET['s_id']) ? $_GET['s_id'] : ' ';
$get_company_id = isset($_GET['c_id']) ? $_GET['c_id'] : ' ';

echo $get_secretary_id." ".$get_company_id;
$sql = "SELECT * ,staff_assignments.id AS sa_id
FROM staff_assignments
JOIN user_roles ON staff_assignments.secretary_id = user_roles.id
JOIN register_company ON staff_assignments.company_id = register_company.id
WHERE staff_assignments.secretary_id = '$get_secretary_id' AND staff_assignments.company_id = '$get_company_id';
";

$execute = mysqli_query($link, $sql);
$result = mysqli_fetch_assoc($execute);

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Consent to Act as Director');
$pdf->SetSubject('Form 45B');

// Add a page
$pdf->AddPage();

// Set font
// Set font
$pdf->SetFont('helvetica', '', 12);

// Define HTML content with inline CSS
$html = '
<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Microsoft Word - Form 45B - Consent to act as secretary</title>
        <meta name="author" content="RCBAAB"/>
        <style type="text/css">
            * {
                margin: 0;
                padding: 0;
                text-indent: 0;
            }

            .s1 {
                color: black;
                font-family: "Times New Roman", serif;
                font-style: normal;
                font-weight: normal;
                text-decoration: none;
                font-size: 10pt;
            }

            p {
                color: black;
                font-family: "Times New Roman", serif;
                font-style: normal;
                font-weight: normal;
                text-decoration: none;
                font-size: 9pt;
                margin: 0pt;
            }

            .s2 {
                color: black;
                font-family: "Times New Roman", serif;
                font-style: normal;
                font-weight: normal;
                text-decoration: none;
                font-size: 7.5pt;
            }
        </style>
    </head>
    <body>
        <div style="  text-indent: 0pt; text-align: center;">
            <p style="margin:auto; width: 150px; border: solid 2px black;">
            <span style=" color: black; font-family:&quot;Times New Roman&quot;, serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 9pt;">THE COMPANIES ACT (CHAPTER 50) SECTION 173C(b) CONSENT TO ACT AS SECRETARY</span>
        </p>
        </div>
        <div style="text-indent: 0pt; ">
            <p style=" margin-right: 100px; width: fit-content; border: solid 2px black; float:right;">
            <span style=" color: black; font-family:&quot;Times New Roman&quot;, serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 9pt;">FORM 45B</span>
        </p>
        </div>
        
        <p class="s1" style="padding-left: 154pt;text-indent: 0pt;text-align: left;"></p>
        <p style="text-indent: 0pt;text-align: left;">
            <br/>
        </p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">Name of company:</p><span class="data-field">'.$result['company_name'].' '.$result['company_suffix'].'</span>
        <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;">
            <br/>
        </p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">Company No:</p><span class="data-field">'.$result['company_id'].'</span>
        <p style="text-indent: 0pt;text-align: left;">
            <br/>
        </p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">1. I, the undermentioned person, hereby consent to act as a secretary of the abovenamed company with effect from<span class="fw-bold">'.date('Y-m-d', strtotime($result['created_at'])).'</span>date)</p>
        <p style="text-indent: 0pt;text-align: left;">
            <br/>
        </p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">†2. I am a qualified person under section 171 (1AA) of the Companies Act by virtue of my being —</p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">*(i) a secretary of a company for at least 3 years of the 5 years immediately preceding the abovementioned date of my appointment as secretary of the abovenamed company.</p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">*(ii) a qualified person under the Legal Profession Act (Cap. 161).</p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">*(iii) a public accountant.</p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">*(iiia) a member of the Institute of Singapore Chartered Accountants (formerly known as the Institute of Certified Public Accountants of Singapore).</p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">*(iv) a member of the Chartered Secretaries Institute of Singapore.</p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">*(v) a member of the Association of International Accountants (Singapore Branch).</p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">*(vi) a member of The Institute of Company Accountants, Singapore.</p>
        <p style="text-indent: 0pt;text-align: left;">
            <br/>
        </p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">Name 
        </p><span class="data-field">'.$result['name'].'</span>
        <p style="text-indent: 0pt;text-align: left;">
            <br/>
        </p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">Address <span class="data-field">'.$result['address'].'</span></p>
        <p style="padding-left: 278pt;text-indent: -270pt;line-height: 30pt;text-align: left;">*NRIC/Passport No: <span class="data-field">'.(!empty($result['secretary_passport_number']) ? $result['secretary_passport_number'] : 'NA').'</span>   Nationality <span class="data-field">'.(!empty($result['secretary_passport_nationality']) ? $result['secretary_passport_nationality'] : 'NA').'</span> Signature .................................</p>
        <p style="text-indent: 0pt;text-align: left;">
            <br/>        </div>
        </p>
        <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">Dated this<span class="data-field">'.$result['created_at'].'</span>day of <span class="data-field">'.$result['created_at'].'</span></p>
        <p class="s2" style="padding-top: 8pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">† To be completed by secretaries of public companies only or by secretaries of private companies appointed under section 171(1AB) of the Act.</p>
        <p style="text-indent: 0pt;text-align: left;">
            <br/>
        </p>
        <p class="s2" style="padding-left: 7pt;text-indent: 0pt;text-align: left;">* Delete where inapplicable.</p>
    </body>
</html>

';



// Output the HTML content to PDF
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
// Define the path to save the PDF file
$uploadDir = __DIR__ . '/upload_form_45b/'; // Ensure this directory exists and is writable
$pdfFilePath = $uploadDir . 'form_45b.pdf';

// Save the file locally
$pdf->Output($pdfFilePath, 'F');

// Read the PDF file and encode it to Base64
$documentBase64 = base64_encode(file_get_contents($pdfFilePath));

$accountId = '07cfb3dc-2a26-43cf-8243-e1a7b835d336';
// Example usage
$accessToken = $result_token['access_token'];

//$accessToken = getAccessToken();
//$freshtoken =  refreshAccessToken($accessToken);

 // Replace with your account ID

$baseUrl_1 = $baseUrl; 
// For demonstration purposes, echo the Base64 string
$envelopeId = sendEnvelope($accessToken, $accountId, $documentBase64,$result);
$brandId ='70e4090b-afa5-4aa3-84cd-ba67d502aec1';


function sendEnvelope($accessToken, $accountId, $documentBase64,$result,$brandId) {
    require_once '../../db.php';
    require_once '../../baseUrl.php';

    $url = "https://demo.docusign.net/restapi/v2.1/accounts/$accountId/envelopes";
    $apiBase = 'https://demo.docusign.net/restapi';
    //$documentBase64 = $baseUrl."/incorporation/before-incorporation/form-45/form 45 - empty form.pdf";
   


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
                    'email' => ''.$result['email'].'',
                    'name' => ''.$result['name'].'',
                    'recipientId' => ''.$result['id'].''
                ]
            ]
        ],
        'customFields' => [
                'textCustomFields' => [
                    [
                        'name' => 'RecipientCustomField1',
                        'value' => $result['id']
                    ],
                    [
                        'name' => 'RecipientCustomField2',
                        'value' => 'coompany_con'
                    ]
                ]
            ],
        'status' => 'sent',
        'brandId' => $brandId
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
                    window.location = '../index.php';
                }
            });
        </script>

        <?php
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
function getRecipientInfo($accessToken, $accountId, $envelopeId, $email) {
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
        return null;
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode != 200) {
        echo "Error: Unable to fetch recipients. HTTP Code: " . $httpCode;
        return null;
    }

    $responseJson = json_decode($response, true);
   

    foreach ($responseJson['signers'] as $signer) {
        if ($signer['email'] == $email) {
            return [
                'recipientId' => $signer['recipientId'],
                'userId' => $signer['userId']
            ];
        }
    }

    return null;
}


function envelopeView($accessToken, $accountId, $envelopeId,$get_director_id,$baseUrl,$result) {
    
    $apiBase = 'https://demo.docusign.net/restapi';

     $recipientInfo = getRecipientInfo($accessToken, $accountId, $envelopeId, $result['email']);
     echo $recipientInfo['recipientId']." ".$recipientInfo['userId'];

    if (!$recipientInfo) {
        echo 'Error: Recipient not found.';
        return;
    }

    
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
        "returnUrl" => $baseUrl . "/incorporation/before-incorporation/form-45b/download.php?en_id=" . $envelopeId . "&director_id=" . $result['sa_id'],
         "authenticationMethod" => "PaperDocuments",
         "recipientId" => $recipientInfo['recipientId'], // Ensure this is the correct recipient ID
         "userId" => $recipientInfo['userId'],
         "userName" => $result['secretary_name'],
         "email" => $result['secretary_email_address']
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

?>
</body>

</html>
</body>

</html>