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
$get_director_id = isset($_GET['director_id']) ? $_GET['director_id'] : ' ';

$sql = "SELECT o.*, c.company_name, c.company_suffix, c.created_at
        FROM officer o
        JOIN register_company c ON o.cr_id = c.id
        WHERE o.id = '$get_director_id'
        ORDER BY o.id DESC";

$execute = mysqli_query($link, $sql);
$result = mysqli_fetch_assoc($execute);

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Consent to Act as Director');
$pdf->SetSubject('Form 45');

// Add a page
$pdf->AddPage();

// Set font
// Set font
$pdf->SetFont('helvetica', '', 12);

// Define HTML content with inline CSS
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consent to Act as Director</title>
    <style type="text/css">
        body {
            font-family: Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container-sm {
            width: 100%;
            max-width: 640px;
            margin: 0 auto;
        }
        .p-5 {
            padding: 3rem;
        }
        .text-center {
            text-align: center;
        }
        .mb-3 {
            margin-bottom: 1rem;
        }
        .fw-bold {
            font-weight: bold;
        }
        .border {
            border: 1px solid black;
        }
        .border-dark {
            border-color: #000;
        }
        .border-bottom-dot {
            border-bottom: 2px dotted black;
        }
        .data-field {
            border-bottom: 2px dotted black;
            display: inline-block;
            min-width: 150px;
            padding: 2px;
        }
        .d-flex {
            display: flex;
        }
        .justify-content-center {
            justify-content: center;
        }
        .form-label {
            display: inline-block;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
<section id="pdf_create">
    <div class="container-sm p-5">
        <div class="row"> 
            <div class="col-12 text-center mb-3">
                <div class="border border-dark">
                    <h4 class="mb-0">Form 45</h4>
                </div>
            </div>
            <div class="col-12 text-center mb-3">
                <div class="border border-dark p-3 mb-3">
                    <h4 class="mb-0 fw-bold">
                        THE COMPANIES ACT (CHAPTER 50)<br>
                        SECTION 173C(a)<br>
                        CONSENT TO ACT AS DIRECTOR<br>
                        AND STATEMENT OF NON<br>
                        DISQUALIFICATION TO ACT AS DIRECTOR
                    </h4>
                </div>
            </div>
           
        </div>
    
        <div class="mb-3 d-flex justify-content-center">
            <label for="companyName" class="form-label">Name of Company:</label>
            <span class="data-field">'.$result['company_name'].' '.$result['company_suffix'].'</span>
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <label for="companyNo" class="form-label">Company No:</label>
            <span class="data-field">'.$result['cr_id'].'</span>
        </div>
        <p class="text-center">
            I, the under mentioned person, hereby consent to act as a director of the above named
            company with effect from <span class="fw-bold">'.date('Y-m-d', strtotime($result['created_at'])).'</span> (date) and declare that:
        </p>
        <p>(a) I am not disqualified from acting as a director, in that:</p>
        <ul>
            <li>(i) I am not below 18 years of age and that I am otherwise of full legal capacity.</li>
            <li>(ii) Within a period of 3 years preceding the date of this statement I have not had any disqualification order made by the High Court of Singapore against me under section 149A(1) of the Companies Act (“the Act”).</li>
            <li>(iii) Within a period of 5 years preceding the date of this statement I have not had any disqualification order made by the High Court of Singapore against me under section 149(1) or 154(2) of the Act.</li>
            <li>(iv) That within a period of 5 years preceding 12th November 1993 I have not been convicted whether within or without Singapore, of any offence —
                <ul>
                    <li>(A) in connection with the promotion, formation or management of a corporation;</li>
                    <li>(B) involving fraud or dishonesty punishable on conviction with imprisonment for 3 months or more; or</li>
                    <li>(C) under section 157 (failure to act honestly and diligently as a director or making improper use of company information for gain) or under section 339 (failure to keep proper company accounts books) of the Act.</li>
                </ul>
            </li>
            <li>(v) That within a period of 5 years preceding the date of this statement I have not been convicted, in Singapore or elsewhere, of any offence involving fraud or dishonesty punishable on conviction with imprisonment for 3 months or more.</li> 
            <li>(vi) That —
                <ul>
                    <li>(A) I have not been convicted of 3 or more offences under the Act in relation to the requirements on the filing of returns, accounts or other documents with the Registrar of Companies and have not had 3 or more orders of the High Court of Singapore made against me under section 13 or 399 of the Act in relation to such requirements;</li>
                    <li>(B) the last of any such conviction did not take place or the last of any such order was not made during the period of 5 years preceding the date of this statement; and</li>
                    <li>(C) I am not an undischarged bankrupt under section 148(1) of the Act.</li>
                </ul>
            </li>
            <li>(vii) By virtue of the foregoing I am not disqualified from acting as a director of the abovenamed company.</li>
        </ul>
        <p>(b) I am aware of and undertake to abide by my duties, responsibilities and liabilities specified in the Act as well as under the common law where applicable, including the following key administrative and substantive duties, that is, to:</p>
        <ul>
            <li>(i) discharge my responsibilities in the company;</li>
            <li>(ii) ensure that I have a reasonable degree of skill and knowledge to handle the affairs of the company;</li>
            <li>(iii) act honestly and be reasonably diligent in discharging my duties and act in the interest of the company without putting myself in a position of conflict of interest;</li>
            <li>(iv) employ the powers and assets that I am entrusted with for the proper purposes of the company and not for any collateral purpose;</li>
            <li>(v) ensure that the company and I comply with all the requirements and obligations under the Act including those in respect of meetings, requisitions, resolutions, accounts, reports, statements, records and other documents on the company, filing and notices and any other prerequisites; and</li>
            <li>(vi) account to the shareholders for my conduct of the affairs of the company and make such disclosures that are incumbent upon me under the Act.</li>
        </ul>
        <p>(c) That —</p>
        <ul>
            <li>(i) I have read and understood the above statements; or</li>
            <li>(ii) the above statements were interpreted to me in
                <br>    
                <span class="data-field">NA</span> (state language/dialect)<br>
                by<br>
                <span class="data-field">'.$result['officer_country_of_birth'].'</span><br>
                NRIC NO:<br>
                <span class="data-field">'.$result['nric_or_id_number'].'</span><br>
                before I executed this form and I confirm that the statements are true. I am also aware that I can be prosecuted in Court if I willfully give any information on this form which is false.
            </li>
        </ul>
        <div class="mb-3 d-flex justify-content-center">
            <label for="companyName" class="form-label">Name :</label>
            <span class="data-field">'.$result['officer_name'].'</span>
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <label for="address" class="form-label">Address:</label>
            <span class="data-field">'.$result['officer_residential_address'].'</span>
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <label for="nricPassportNo" class="form-label">*NRIC/Passport No:</label>
            <span class="data-field">'.(!empty($result['officer_passport_number']) ? $result['officer_passport_number'] : 'NA').'</span>
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <label for="nationality" class="form-label">Nationality:</label>
            <span class="data-field">'.(!empty($result['officer_passport_nationality']) ? $result['officer_passport_nationality'] : 'NA').'</span>
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <label for="signature" class="form-label">Signature:</label>
            <span class="data-field"></span>
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <label for="date" class="form-label">Dated this <span class="data-field">'.date('Y-m-d', strtotime($result['created_at'])).'</span> day of <span class="data-field">'.date('Y-m-d', strtotime($result['created_at'])).'</span></label>
        </div>
        <p class="text-center">* Delete where inapplicable.</p>
    </div>
</section>    
</body>
</html>
';



// Output the HTML content to PDF
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
// Define the path to save the PDF file
$uploadDir = __DIR__ . '/upload_form_45/'; // Ensure this directory exists and is writable
$pdfFilePath = $uploadDir . 'form_45.pdf';

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
$brandId = '53a464c8-3601-49ad-87cf-4f28131231c3';
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
                    'email' => ''.$result['officer_email_address'].'',
                    'name' => ''.$result['officer_name'].'',
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
         'brandId' => $brandId // Add the brand ID here
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
    return $responseData['envelopeId'] ?? null;

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
        return $responseJson;
    // Print response to check recipient details
}

function envelopeView($accessToken, $accountId, $envelopeId,$get_director_id,$baseUrl,$result) {
    
    $apiBase = 'https://demo.docusign.net/restapi';
    
    // Step 1: Get envelope recipients to verify recipientId
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
        "returnUrl" => $baseUrl . "/incorporation/before-incorporation/form-45/download.php?en_id=" . $envelopeId . "&director_id=" . $get_director_id,
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
    
    $signingUrl = $responseJson['url'];
    echo "Signing URL: " . $signingUrl;
    header("Location: " . $signingUrl);

}

?>
</body>

</html>
</body>

</html>