<!----Milestone 4----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   3/14/2019
File:	AddPayment.php
Version: 1.0	 

This file is the script 
that is run when a user 
adds a payment. It saves the 
payment that will later
be used in an order.
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
$paymentType = $_POST['paymentType'];
$cardNum = $_POST['cardNumber'];
$seqCode = $_POST['securityCode'];
$expirationNum = $_POST['expirationDate'];
$nameOnCard = $_POST['nameOnCard'];

//Creta a new database connection 
$dbConnect = new DbConnect();
$connection = $dbConnect->connect();

// Make a new shopping cart object
$shoppingCart = new Cart($connection);


// If the userID is set run the method with the session variable userID
if (isset($_SESSION['userID'])) {
   $paymentID =  $shoppingCart->add_Payment($_SESSION['userID'], $paymentType, $cardNum, $seqCode, $expirationNum, $nameOnCard);
   //echo $paymentID;
   $shoppingCart->set_Payment($_SESSION['orderID'], $paymentID);
   
} else {
    $userID = null;
    $paymentID = $shoppingCart->add_Payment($userID, $paymentType, $cardNum, $seqCode, $expirationNum, $nameOnCard);
    //echo $paymentID;
    $shoppingCart->set_Payment($_SESSION['orderID'], $paymentID);
}
$connection->close();

//Redirect the user back the payment info page
$url = "CheckoutPaymentInfo.php";
echo ("<script>location.href='$url'</script>");



