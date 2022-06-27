<!----Milestone 7----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   4/22/2019
File:	SetCoupon.php
Version: 1.0	 

This file is the script 
that is run when a user 
adds a coupon to their 
order.
_____________________________________
              VERSIONS
_____________________________________

-->


<?php
// Used for error checking
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Require statement for all classes
require_once '../classes/AutoLoader.php';

//Start the session
require_once 'Header.php';

//Create a database connection
$dbConnect = new DbConnect();
$connection = $dbConnect->connect();

//Make a new shopping cart object
$shoppingCart = new Cart($connection);

//Make an orderID session variable
$orderID = $_SESSION['orderID'];
//We need to grab the posted information we need from the form
$couponCode = $_POST['couponCode'];

//Lets check if coupon code provided has a coupon, and grab the couponID 
$datas =  $shoppingCart->get_Coupon_From_Code($couponCode);
//echo $datas . "HERE";d
$data = $datas[0];
$couponID = $data['id_coupon'];

//Check if a coupon id has been returned
if(!$couponID == NULL){
    echo "Found coupon Code: " . $couponID;
    //Lets check if the coupn has been used by user before 
    $couponUsed = $shoppingCart->check_If_Coupon_Used($_SESSION['userID'], $couponID);
    //If not used 
    if(!$couponUsed){
        echo "Coupon not used yet";
        //Check if the coupon is applicable to order
        $couponApplicable = $shoppingCart->check_Applicable_Coupon($couponID, $_SESSION['orderID'], $couponCode);
        
        //If coupon applicable 
        if($couponApplicable){
            echo "Coupon applicable";
            //Set the coupon to the order 
            if($shoppingCart->set_Coupon($_SESSION['orderID'], $couponID)){
                echo "Success set coupon to order!";
                //echo $shoppingCart->get_Coupon_From_Order($_SESSION['orderID']);
                
            }else{
                echo "Could not set coupon";
            }
            
        }
        //Not applicable
        else{
            echo "Coupon not applicable";
        }
            

    }
    //If used 
    else{
        echo "Already used coupon";
    }
    
}
//Cound not find coupon 
else{
    echo "Could not find coupon with: " . $couponCode;
}

$connection->close();

//Redirect the user back the payment info page
$url = "CheckoutPaymentInfo.php";
echo ("<script>location.href='$url'</script>");

