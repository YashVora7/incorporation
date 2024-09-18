<?php
require_once '../session.php';
require_once '../db.php';
require_once '../baseUrl.php';
 // Start session at the very beginning

if (isset($_GET['en_id'])) {
    $envelopeId = $_GET['en_id'];
    $directorId = $_GET['director_id'] ?? ''; // Use null coalescing to handle undefined index
    $company_id = $_GET['company_id'] ?? ''; // Use null coalescing to handle undefined index
    $user_id = $_SESSION['user_id'] ?? ''; // Use null coalescing to handle undefined index
    
    // Debugging purpose only; remove these in production
    echo $envelopeId;
    echo $directorId;
    echo $company_id;
    echo $user_id;

    $accountId = '07cfb3dc-2a26-43cf-8243-e1a7b835d336';
    $sql_token = "SELECT * FROM apis_access_tokens";

    $execute_token = mysqli_query($link, $sql_token);
    $result_token = mysqli_fetch_assoc($execute_token);

    $accessToken = $result_token['access_token'];
    $apiBase = 'https://demo.docusign.net/restapi';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "$apiBase/v2.1/accounts/$accountId/envelopes/$envelopeId/documents/1");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer $accessToken",
        "Content-Type: application/pdf"
    ));

    $response = curl_exec($ch);
    if ($response === false) {
        error_log('Curl error: ' . curl_error($ch)); // Log error instead of echoing
        echo 'Failed to download the document.';
    } else {
        $uploadDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'cddkyc_form_sign_by_compliance' . DIRECTORY_SEPARATOR;

        // Ensure the directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // 0755 is a common permission setting
        }

        // Define the full path to the file
        $filePath = $uploadDir . $envelopeId . '.pdf'; // Use envelopeId as filename
        // Use file_put_contents to save the document
        $result = file_put_contents($filePath, $response);

        // Check if the file was written successfully
        if ($result === false) {
            echo 'Failed to write document to the file.';
        } else {
            echo 'Document downloaded successfully.';
        }

        // Database update logic
        $pdfName = $envelopeId . '.pdf';
        $signFlag = 1;

        $query = "INSERT INTO superadmin_sign_cddkyc (company_id, officer_id, super_admin_id, super_admin_sign_cddkyc, super_admin_sign_cddkyc_doc)
                  VALUES ('$company_id', '$directorId', '$user_id', '$signFlag', '$pdfName')";

        if (mysqli_query($link, $query)) {
            $_SESSION['document_sign_successfully'] = "Document Sign Successfully";
            header("Location: " . $baseUrl . "super_admin/new_companies/cddkyc_verify.php");
            exit(); // Always use exit() after header redirection to stop script execution
        } else {
            error_log("MySQL Error: " . mysqli_error($link)); // Log the error message
            echo 'Failed to Sign Successfully.';
        }

    }

    curl_close($ch);
    mysqli_close($link); // Close the database connection
}
?>



