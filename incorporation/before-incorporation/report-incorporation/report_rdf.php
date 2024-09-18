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
    require_once '../../session.php';
    require_once '../../db.php';
    require_once '../../baseUrl.php';
    ?>
    <?php
    $get_officer_id = isset($_GET['officer_id']) ? $_GET['officer_id'] : ' ';

    $sql = "SELECT o.*, c.*
        FROM officer o
        JOIN register_company c ON o.cr_id = c.id
        WHERE o.id = '$get_officer_id'
        ORDER BY o.id DESC";

    $excute = mysqli_query($link, $sql);
    $result = mysqli_fetch_assoc($excute);

    function getValue($value) {
        // If the value is null or 'N/A', return the styled placeholder text
        if (is_null($value) || strtoupper($value) === 'NA') {
            return '<span style="color: black;"></span>';
        }
        // Otherwise, return the sanitized value
        return htmlspecialchars($value);
    }

    $sql_company = "SELECT company_name, company_suffix, number_of_shares FROM register_company";
    $resultcompany = $link->query($sql_company);
    //print_r($result);
    ?>

    <?php
    require_once '../vendor/autoload.php'; // Adjust path if needed


    $sql_token = "SELECT * FROM apis_access_tokens";

    $execute_token = mysqli_query($link, $sql_token);
    $result_token = mysqli_fetch_assoc($execute_token);

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
                        <html>
                        <head>
                            <meta charset="utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <title>Company Details</title>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    background-color: #f4f4f4;
                                    margin: 0;
                                    padding: 20px;
                                }

                                table {
                                    width: 100%;
                                    border-collapse: collapse;
                                    margin-bottom: 20px;
                                    background-color: #fff;
                                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                }

                                th, td {
                                    padding: 12px;
                                    text-align: left;
                                    border: 1px solid #ddd;
                                }

                                th {
                                    background-color: #4CAF50;
                                    color: white;
                                    font-weight: bold;
                                }

                                tr:nth-child(even) {
                                    background-color: #f2f2f2;
                                }

                                tr:hover {
                                    background-color: #ddd;
                                }

                                h1 {
                                    color: #333;
                                    text-align: center;
                                    margin-top: 20px;
                                }

                                img {
                                    max-width: 100%;
                                    height: auto;
                                    display: block;
                                    margin: 0 auto;
                                }

                                .section {
                                    margin-bottom: 40px;
                                }
                            </style>
                        </head>
                        <body>
                            <table style="margin:auto;">
                                <thead>
                                    <tr>
                                        <th colspan="2" style="text-align: center;">Company Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Name of company</td>
                                        <td>'.getValue($result['company_name']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Suffix</td>
                                        <td>'.getValue($result['company_name']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Company type</td>
                                        <td>'. getValue($result['company_type']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Registered address</td>
                                        <td>'. getValue($result['registered_address']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Principal place of business address</td>
                                        <td>'. getValue($result['business_description']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Principal SSIC</td>
                                        <td>'. getValue($result['primary_company_activity']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Description of the principal activity of the company</td>
                                        <td>'. getValue($result['describe_company_activity']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Secondary SSIC</td>
                                        <td>'. getValue($result['secondary_company_activity']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Description of the secondary activity of the company</td>
                                        <td>'. getValue($result['secondary_company_activity']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Share capital currency</td>
                                        <td>'.getValue($result['share_capital_currency']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Shares payable</td>
                                        <td>'.getValue($result['share_payable']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Issued share capital</td>
                                        <td>'.getValue($result['issued_share_capital']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Number of shares</td>
                                        <td>'.getValue($result['number_of_shares']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Paid up</td>
                                        <td>'.getValue($result['paid_up']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Financial year end</td>
                                        <td>'.getValue($result['financial_year_end']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Required nominee director?</td>
                                        <td>N/A</td>
                                    </tr>
                                    <thead>
                                    <tr>
                                        <th colspan="2" style="text-align: center;">Officer 1</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>'.getValue($result['officer_name']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Officer type</td>
                                        <td>'.getValue($result['officer_type']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Entity number</td>
                                        <td>'.getValue($result['entity_number']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Entity country of incorporation</td>
                                        <td>'.getValue($result['entity_country_of_incorporation']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Entity address</td>
                                        <td>'.getValue($result['corporate_entity_address']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Singapore citizen/PR?</td>
                                        <td>'.getValue($result['is_singapore_citizen']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Officer designation</td>
                                        <td>'.getValue($result['officer_designation']).'</td>
                                    </tr>
                                    <tr>
                                        <td>If shareholder, how many % shares?</td>
                                        <td>'.getValue($result['percentage_of_shares']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Issued share capital allocation</td>
                                        <td>'.getValue($result['issued_share_capital_allocation']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Number of shares allocation</td>
                                        <td>'.getValue($result['number_of_shares_allocation']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>'.getValue($result['officer_gender']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Residential address</td>
                                        <td>'.getValue($result['officer_residential_address']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Residential address country</td>
                                        <td>'.getValue($result['residential_address_country']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Residential postal code</td>
                                        <td>'.getValue($result['residential_address_postal_code']).'</td>
                                    </tr>
                                    <tr>
                                        <td>NRIC / ID number</td>
                                        <td>'.getValue($result['nric_or_id_number']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Passport number (For foreigners only)</td>
                                        <td>'.getValue($result['officer_passport_number']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Passport expiration (For foreigners only)</td>
                                        <td>'.getValue($result['officer_passport_expiration']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Nationality</td>
                                        <td>'.getValue($result['officer_passport_nationality']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Country of birth</td>
                                        <td>'.getValue($result['officer_country_of_birth']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Date of birth</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Phone contact number with country code</td>
                                        <td>'.getValue($result['officer_contact']).'</td>
                                    </tr>
                                    <tr>
                                        <td>Email address</td>
                                        <td>'.getValue($result['officer_email_address']).'</td>
                                    </tr>
                                </tbody>
                            </table>';
                             $pdf->writeHTML($html, true, false, true, false, '');
                             $pdf->AddPage();
                              // Add a page for the next section
                            if ($result['business_registration_certificate_of_entity'] != 'NA'){  
                            $html1 = '<div class="section">
                                <h1>Uploaded business registration certificate of entity</h1>
                                    <img src="../../uploads/'.htmlspecialchars($result['business_registration_certificate_of_entity']).'" alt="Business Registration Certificate">
                            </div>';
                            $pdf->writeHTML($html1, true, false, true, false, '');
                            $pdf->AddPage();
                            }
                             
                           if ($result['officer_nric_id_image'] != 'NA'){
                            $html2 ='<div class="section">
                                <h1>Uploaded NRIC / ID card, front and back</h1>
                                    <img src="../../uploads/'. htmlspecialchars($result['officer_nric_id_image']).'" alt="NRIC/ID Card">
                            </div>';
                            $pdf->writeHTML($html2, true, false, true, false, '');
                            $pdf->AddPage();
                           }
                            
                        if ($result['passport_image'] != 'NA'){
                            $html3 =' <div class="section">
                                <h1>Uploaded Passport</h1>
                                    <img src="../../uploads/'. htmlspecialchars($result['passport_image']).'" alt="Passport">
                            </div>';
                           $pdf->writeHTML($html3, true, false, true, false, '');
                           $pdf->AddPage();
                          }
                           
                         if ($result['proof_of_address_image'] != 'NA'){
                           $html4 =' <div class="section">
                                <h1>Uploaded Proof of address</h1>
                                    <img src="../../uploads/'. htmlspecialchars($result['proof_of_address_image']).'" alt="Proof of Address">
                            </div></body>
                        </html>';   
                         $pdf->writeHTML($html4, true, false, true, false, '');
                         }
                // Output the HTML content to PDF
            
                $pdf->lastPage();
                // Define the path to save the PDF file
                $uploadDir = __DIR__ . '/upload_form_report_ipdf/'; // Ensure this directory exists and is writable
                $pdfFilePath = $uploadDir . 'report_incorporation.pdf';

                // Save the file locally
                $pdf->Output($pdfFilePath, 'F');
          

    // Get data from the database

    // Create new PDF document
    

    // Read the PDF file and encode it to Base64
    $documentBase64 = base64_encode(file_get_contents($pdfFilePath));

    $accountId = '07cfb3dc-2a26-43cf-8243-e1a7b835d336';
    // Example usage
    $accessToken = $result_token['access_token'];

    //$accessToken = getAccessToken();
    //$freshtoken =  refreshAccessToken($accessToken);

    // Replace with your account ID

    $baseUrl_1 = $baseUrl;

    // Usage example
    $brandId = '11ebcdcd-9f59-4414-98ca-35404d6e6d53';
    $envelopeId = sendEnvelope($accessToken, $accountId, $documentBase64, $result, $brandId);


    function sendEnvelope($accessToken, $accountId, $documentBase64, $result, $brandId)
    {
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
                        'email' => $result['officer_email_address'],
                        'name' => $result['officer_name'],
                        'recipientId' => $result['id'], // Consistent ID for first recipient
                        'routingOrder' => '1',
                        'tabs' => [
                            'signHereTabs' => [
                                [
                                    'documentId' => '1',
                                    'pageNumber' => '1',
                                    'xPosition' => '40',
                                    'yPosition' => '700'
                                ]
                            ]
                        ],
                        
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
                        'value' => 'company_con'
                    ]
                ]
            ],
            'status' => 'sent',
            'brandId' => $brandId
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
                    window.location = '../index.php';
                }
            });
        </script>

    <?php
        // Return the envelope ID
        return $responseData['envelopeId'] ?? null;
    }

    function getEnvelopeRecipients($accessToken, $accountId, $envelopeId)
    {
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

    function envelopeView($accessToken, $accountId, $envelopeId, $baseUrl, $officer_id, $result)
    {
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
            "returnUrl" => $baseUrl . "/incorporation/before-incorporation/company-constitution/download_cc.php?en_id=" . $envelopeId . "&director_id=" . $officer_id,
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