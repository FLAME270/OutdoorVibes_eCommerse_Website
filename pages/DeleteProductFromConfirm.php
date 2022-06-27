<!----Milestone 5----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   3/15/2019
File:	DeleteProductFromConfirm.php
Version: 1.2	 

This file is the 
script that is used
for when 
a product is deleted 
from an order from the 
confirm product page instead
of the shopping cart. 
_____________________________________
              VERSIONS
4/3 V1.1 Added a connection and closed
         it. 
4/17 V1.2 Added methods for the coupon
          functionality.
 _____________________________________  
-->



<?php
// Error reporting support
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

//Require statement for all classes
require_once '../classes/AutoLoader.php';

//Start the session
require_once 'Header.php';

//Make a database connection
$dbConnect = new DbConnect();
$connection = $dbConnect->connect();
//Make a new shopping cart object
$shoppingCart = new Cart($connection); 

//$removedProductID = $_GET['product'];

//Check if there is a coupon
$couponID = $shoppingCart->get_Coupon_From_Order($_SESSION['orderID']);

//IF the order has a coupon set up
if(!$couponID == NULL){
    echo "Found a couopn";
    //Check if the coupon is CART TYPE
    if($shoppingCart->check_Coupon_Type($couponID) == "PROD"){
        echo "Coupon is a product couopn";
        //Get the details of the coupon in order to get the product assocaited with the coupon
        $data = $shoppingCart->get_Coupon_Details($couponID);
        $couponDetails = $data[0];
        
        $couponProductID = $couponDetails['tbl_products_id_products'];
        
        //Get all the products from the order to find a match
        $datas = $shoppingCart->get_Order_Products($_SESSION['orderID']);
        $data = $datas[0];
        
        //Loop through every product to see match
        foreach($datas as $data){
            //if there is a match
            if($data['tbl_products_id_products'] == $couponProductID){
                echo "Found couopn for product";
                $shoppingCart->remove_Coupon_From_Order($_SESSION['orderID']);
                echo "Removed: " . $data['tbl_products_id_products'] . " Coupon: " . $couponProductID;
            }
        }
        
    }
}

//Call the method that will delete a product
$result = $shoppingCart->delete_Product($_GET['product']);



if($result){
    echo '<script type="text/javascript">';
    echo ' alert("Deleted product from cart")';
    echo '</script>';
}

else {
    echo '<script type="text/javascript">';
    echo ' alert("Could not delete product from cart!")';
    echo '</script>';
    
}

//Redirect the user back the shopping cart
$url = "CheckoutConfirm.php";
echo ("<script>location.href='$url'</script>");

