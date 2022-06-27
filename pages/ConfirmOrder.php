<!----Milestone 5----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   4/4/2019
File:	ConfirmOrder.php
Version: 1.0	 

This file is the script 
that is run when a user 
confirms an order. 
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
//grab the coupon discount from GEt 
$couponDiscount = $_GET['couponDiscount'];
//Creta a new database connection
$dbConnect = new DbConnect();
$connection = $dbConnect->connect();

// Make a new shopping cart object
$shoppingCart = new Cart($connection);

//Call the method to confirm the order 
$attempt = $shoppingCart->confirm_Order($_SESSION['orderID'], $couponDiscount);

//Close the connection
$connection->close();

if($attempt){
//Redirect the user back the payment info page
$url = "OrderCompleted.php";
echo ("<script>location.href='$url'</script>");
}
else{
$url = "OrderFailed.php";
echo ("<script>location.href='$url'</script>");
}

