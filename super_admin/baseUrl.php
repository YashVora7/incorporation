<?php
// Detect environment and set the URL accordingly for tianlong-services-pvt-ltd
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $baseUrl = 'http://localhost/incorporation/';
} elseif ($_SERVER['HTTP_HOST'] == 'teamtos.in') {
    $baseUrl = 'https://teamtos.in/Demo/in2/';
} else {
    $baseUrl = 'https://tianlongservicespvtltd.com';
}
    