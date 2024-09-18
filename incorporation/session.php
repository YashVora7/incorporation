<?php
require_once 'baseUrl.php';
session_start();
if ($_SESSION["user_id"]) {
?>

<?php
} else 
header("Location: " . $baseUrl . "incorporation/auth-login");
// require_once 'db.php';
?> 