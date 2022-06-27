<!----Milestone 5----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   4/3/2019
File:	SetBilling.php
Version: 1.0	 

This file is the script 
that is run when a user
selects a billing address
they have stored and wants to 
add it to their order.
_____________________________________
              VERSIONS

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
$billingID = $_POST['billingID'];

//Create a database connection 
$dbConnect = new DbConnect();
$connection = $dbConnect->connect();

// Make a new shopping cart object
$shoppingCart = new Cart($connection);

$shoppingCart->set_Billing($_SESSION['orderID'], $billingID);
$connection->close();
//Redirect the user back the payment info page
$url = "CheckoutPaymentInfo.php";
echo ("<script>location.href='$url'</script>");

