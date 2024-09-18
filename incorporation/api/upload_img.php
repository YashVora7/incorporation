<?php
$return['message'] = '';

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $tempFile = $file['tmp_name'];

        // Generate a unique filename using a timestamp and random number
        $uniqueFilename = time() . '_' . mt_rand(1000, 9999);
        $targetPath = '../uploads/';
        $targetFile = $targetPath . $uniqueFilename . '_' . basename($file['name']);

        if (move_uploaded_file($tempFile, $targetFile)) {
            $return['message'] = 'File uploaded successfully';
            $return['error_flag'] = 0;
            $return['file_name'] = $uniqueFilename . '_' . basename($file['name']);
        } else {
            $return['message'] = 'Error moving file';
            $return['error_flag'] = 1;
        }
    } else {
        $return['message'] = 'Error uploading file';
        $return['error_flag'] = 1;
    }
} else {
    $return['message'] = 'No file uploaded';
    $return['error_flag'] = 1;
}

echo json_encode($return);
?>
