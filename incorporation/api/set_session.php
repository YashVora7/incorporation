<?php
session_start();
require_once '../db.php';
$session_name = $_POST['session_name'];
$session_value = $_POST['session_value'];
$return['error_flag'] =  0;
if($_SESSION[$session_name] = $session_value)
{
    $return['error_flag'] = 0;
    $_SESSION['user_id'] = $session_value;
    $sql_user = mysqli_query($link, "SELECT * FROM user_roles WHERE id = '$session_value'");
    $result = mysqli_fetch_assoc($sql_user);
    $_SESSION['user_data'] = $result;
}
else
{
    $return['error_flag'] = 1;
}
echo json_encode($return);
?>