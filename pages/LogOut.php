<!----Milestone 4----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   3/14/2019
File:	LogOut.php
Version: 1.1	 

This file is the 
script that is used
for when a user is logged out.
_____________________
    VERSIONS
_____________________

-->



<?php
// Error reporting support
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Requires and includes
require_once '../classes/AutoLoader.php';
//Require the session start page
require_once 'Header.php';
$userName = $_SESSION['username2'];
//Make a new dbConnection object
$dbConnect = new DbConnect();
//Crreat a connection 
$connection = $dbConnect->connect();
$utility= new Utility($userName, "", $dbConnect, $connection);

$utility->log_OutUser();

//Close the database connection 
$connection->close();
//Redirect the user back to home page
$url = "../index.php";
echo ("<script>location.href='$url'</script>");
    
