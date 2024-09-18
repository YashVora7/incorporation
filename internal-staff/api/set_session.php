<?php
session_start();

$session_name = $_POST['session_name'];
$session_value = $_POST['session_value'];
$return['error_flag'] =  0;
if($_SESSION[$session_name] = $session_value)
{
    $return['error_flag'] = 0;

}
else
{
    $return['error_flag'] = 1;
}
echo json_encode($return);
?>