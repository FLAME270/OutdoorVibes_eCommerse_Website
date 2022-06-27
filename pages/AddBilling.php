<!----Milestone 4----

Author:	Tyler Wiggins & Ana Sanchez
Date:   4/3/2019
File:	AddBilling.php
Version: 1.0	 

This file is the script 
that is run when a user 
adds a billing address. 
It saves the shipping that 
will later be used in an order.
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
$street = $_POST['street'];
$unitNum = $_POST['unitNumber'];
$city = $_POST['city'];
$zipCode = $_POST['zipCode'];
$state = $_POST['state'];
$country = $_POST['country'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];

//Creta a new database connection
$dbConnect = new DbConnect();
$connection = $dbConnect->connect();

// Make a new shopping cart object
$shoppingCart = new Cart($connection);


// If the userID is set run the method with the session variable userID
if (isset($_SESSION['userID'])) {
    $billingID =  $shoppingCart->add_Billing($_SESSION['userID'], $street, $city, $state, $country,
        $zipCode, $unitNum, $firstName, $lastName);
    //echo $paymentID;
    $shoppingCart->set_Billing($_SESSION['orderID'], $billingID);
    
} else {
    $userID = null;
    $billingID = $shoppingCart->add_Billing($userID, $street, $city, $state, $country,
                                $zipCode, $unitNum, $firstName, $lastName);
    //echo $paymentID;
    $shoppingCart->set_Billing($_SESSION['orderID'], $billingID);
}
$connection->close();

//Redirect the user back the payment info page
$url = "CheckoutPaymentInfo.php";
echo ("<script>location.href='$url'</script>");
