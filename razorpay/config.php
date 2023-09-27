<?php

$keyId = '';
$keySecret = '';
$displayCurrency = 'INR';

//These should be commented out in production
// This is for error reporting
// Add it to config.php to report any errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Database connection details
$host = "localhost";
$username = "root";
$password = "";
$dbname = "razorpay";

//Db connection
$con = mysqli_connect($host, $username, $password, $dbname);