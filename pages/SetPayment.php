<!----Milestone 4----

Author:	Tyler Wiggins & Ana Sanchez  
Date:   3/15/2019
File:	SetPayment.php
Version: 1.1	 

This file is the script 
that is run when a user
selects a payment they 
have stored and wants to 
add it to their order.
_____________________________________
              VERSIONS
4/3 V1.1 Added a connection and closed
         it. 
_____________________________________

-->




<?php
// Used for error checking
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Require statement for all classes
require_once '../classes/AutoLoader.php';

// Start the session
require_once 'Header.php';

// Lets grab the posts from the form
$paymentID = $_POST['paymentID'];

//Create a database connection 
$dbConnect = new DbConnect();
$connection = $dbConnect->connect();

// Make a new shopping cart object
$shoppingCart = new Cart($connection);

$shoppingCart->set_Payment($_SESSION['orderID'], $paymentID);

$connection->close();
//Redirect the user back the payment info page
$url = "CheckoutPaymentInfo.php";
echo ("<script>location.href='$url'</script>");
