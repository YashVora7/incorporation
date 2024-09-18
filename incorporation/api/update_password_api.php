<?php
require_once '../db.php';
$new_password = $_POST['new_pass'];
$user_id = $_POST['user_id'];
$return['message'] = '';

$sql = 'UPDATE user_roles SET password = "' . $new_password . '" WHERE id = ' . $user_id . '';

if (mysqli_query($link, $sql)) {
    $return['message'] = 'Password updated successfully';
    $return['error_flag'] = 0;
} else {
    $return['message'] = 'There is an eror while updating the new status of the company';
    $return['error_flag'] = 1;
    $return['error'] = $link->error;
}
echo json_encode($return); 
