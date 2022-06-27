<!----Milestone 4----

Author:	Tyler Wiggins & Ana Sanchez  
Date:   3/14/2019
File:	AddToCart.php
Version: 1.1	 

This file is the script 
that is run when a user 
adds a product to their cart
will either add a product 
to already established order
or create a new order.
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

//Require statement for all classes
require_once '../classes/AutoLoader.php';

//Start the session
require_once 'Header.php';

//Create a database connection 
$dbConnect = new DbConnect();
$connection = $dbConnect->connect();

//Make a new shopping cart object 
$shoppingCart = new Cart($connection);

//if there is not a order already in process
//we have to create an order 
if (!isset($_SESSION['orderID'])){


//Depening if there is a user logged in or not, make a order with or without orderID
if(isset($_SESSION['userID'])){
    $userID = $_SESSION['userID'];
    //echo "Using userID<br>";
    $orderID = $shoppingCart->create_Order($userID);
    //echo "User: " . $userID;
}
else{
    $orderID = $shoppingCart->create_Order_No_User();
    //echo "Using non user<br>";
    
}

//Make an orderID session variable 
$_SESSION['orderID'] = $orderID; 
    
//echo "<br>";
//echo "Order: " . $orderID;
}

//Order created

//Now let's put the product into the order
//We need to grab the posted information we need from the form 
$productID = $_POST['product_id'];
$quantity = $_POST['qty'];
$price = $_POST['price'];
$orderID = $_SESSION['orderID'];

//Call the add to shopping cart method
$result = $shoppingCart->add_Product($orderID, $productID, $quantity, $price);

$connection->close();
//Display different messages depending if product added to cart
if($result){
    echo '<script type="text/javascript">';
    echo ' alert("Added product to cart!")';
    echo '</script>';
}
    
else {
    echo '<script type="text/javascript">';
    echo ' alert("Could not add product to cart!")';
    echo '</script>';
    
}

//Redirect the user back the view product details page
$url = "ViewProductDetails.php?product=" . $productID;
echo ("<script>location.href='$url'</script>");
    


?>


