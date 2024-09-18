<?php
require_once '../baseUrl.php';

// Get the current URL path
$current_url = $_SERVER['REQUEST_URI'];

// Define the expected full path
$expected_url = "$baseUrl" . '/incorporation/before-incorporation/report-incorporation/';

// Check if the current URL does not contain the expected subdirectory
if (
    strpos($current_url, "report-incorporation") === false &&
    strpos($current_url, "form-45") === false &&
    strpos($current_url, "form-45b") === false &&
    strpos($current_url, "company-constitution") === false
) {

    // Redirect to the expected URL
    header("Location:" . $expected_url);
    exit();
}
