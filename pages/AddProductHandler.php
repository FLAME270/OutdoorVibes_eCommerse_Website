<!----Milestone 3----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   2/29/2019
File:	AddProductHandler.php
Version: 1.0	 

This file is used to connect 
to the add product page,
takes the post method
and then adds a user.
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
//Grab the posts
$productName = $_POST['productname'];
$price = $_POST['price'];
$imageFile = $_POST['imagename'];;
$shortDesc = $_POST['shortdescription'];
$longDesc = $_POST['longdescription'];
$category = $_POST['category'];
$subCategory = $_POST['subcategory'];
$inventory = $_POST['inventory'];
//Make a connection to the database 
$dbConnect = new DbConnect();
$connection =$dbConnect->connect();

//Make a new user product to call method to update user
$productAdmin = new Product($connection);
//Call the method to add a user
$result = $productAdmin->new_Product($productName, $price, $imageFile, $shortDesc, 
                    $longDesc, $category, $subCategory, $inventory);

//Close the connection 
$connection->close();
//If edit worked direct back to page with all users
if($result){
    echo "<h1>Add product successful!</h1>";
    header('Location: '. 'ProductAdmin.php');
    die();
}
else{
    echo "ERROR adding product!";
}
?>