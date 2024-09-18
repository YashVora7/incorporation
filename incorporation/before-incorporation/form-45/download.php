<?php
require_once '../../db.php';
require_once '../../baseUrl.php';

if (isset($_GET['en_id'])) {
    $envelopeId = $_GET['en_id'];
    $directorId = $_GET['director_id']; // It seems you have this variable, but it's not used

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
        echo 'Curl error: ' . curl_error($ch);
    } else {
        $uploadDir = __DIR__ . '/upload_form_45_verify/';

        // Ensure the directory exists
        if (!is_dir($uploadDir)) {
            // Create the directory if it does not exist
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

        $stmt = $link->prepare("UPDATE officer SET verify_sign_document_45_pdf = ?, sign_flag_45 = ? WHERE id = ?");
        $stmt->bind_param('sis', $pdfName, $signFlag, $directorId);

        if ($stmt->execute()) {
            echo 'Database updated successfully.';
            session_start();
            $_SESSION['document_sign_successfully'] = "Document Sign Successfully";
            header("Location: " . $baseUrl . "/incorporation/before-incorporation/form-45/");
        } else {
            echo 'Failed to update database.';
        }

    }

    curl_close($ch);
}
?>


