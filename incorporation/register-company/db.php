<?php

$servername = "sql917.main-hosting.eu";
$username = "u820220146_tlp";
$password = "Yashna@2705";
$dbname = "u820220146_tlp";

// Create connection
$link = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}
