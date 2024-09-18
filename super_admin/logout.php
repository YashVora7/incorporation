<?php
session_start();
require_once 'baseUrl.php';
unset($_SESSION["adminid"]);
session_destroy();
header("Location: " . $baseUrl . "incorporation/auth-login");
exit(); // It's good practice to call exit() after header redirection
?>
