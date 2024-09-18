<?php
require_once '../db.php';
$company_id = $_POST['company_id'];
$new_status = $_POST['new_status'];
$return['message'] = '';


$sql = 'UPDATE register_company SET company_current_status = "' . $new_status . '" WHERE id = ' . $company_id . '';

if (mysqli_query($link, $sql)) {
    $return['message'] = 'Status updated successfully';
    $return['error_flag'] = 0;
} else {
    $return['message'] = 'There is an eror while updating the new status of the company';
    $return['error_flag'] = 1;
    $return['error'] = $link->error;
}
echo json_encode($return); 
