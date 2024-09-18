<?php
require_once '../baseUrl.php';

// Get the current URL path
$current_url = $_SERVER['REQUEST_URI'];

// Define the expected full path
$expected_url = "$baseUrl" . '/incorporation/after-incorporation/incorporation-registers/';

// Check if the current URL does not contain the expected subdirectory
if (
    strpos($current_url, "incorporation-registers") === false &&
    strpos($current_url, "incorporation-documents") === false
) {

    // Redirect to the expected URL
    header("Location:" . $expected_url);
    exit();
}
