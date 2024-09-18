<?php
require_once 'baseUrl.php';
session_start();
// $_SESSION["user_id"] = 2;
if ($_SESSION["user_id"]) {
?>

<?php
} else 
header("Location: " . $baseUrl . "incorporation/auth-login");
// require_once 'db.php';
?> 