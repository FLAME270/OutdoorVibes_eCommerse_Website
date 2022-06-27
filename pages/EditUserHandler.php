<!----Milestone 3----

Author:	Tyler Wiggins & Ana Sanchez  
Date:   2/29/2019
File:	EditUserHandler.php
Version: 1.0	 

This file is used to connect 
to the edit user product 
takes the post method
and then edits the user.
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
$userID = $_POST['userID'];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$userNameNet = $_POST['username'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$role = $_POST['role'];

//Create a connection to the database 
$dbConnect = new DbConnect();
$connection = $dbConnect->connect();

//Make a new user product to call method to update user 
$userAdmin = new User($connection);
//Call the method to update the user 
$result = $userAdmin->update_User($firstName, $lastName, $userNameNet, $phone, $email, $role, $userID);

//Close the connection 
$connection->close();
//If edit worked direct back to page with all users
if($result){
    echo "<h1>Update successful!</h1>";
    header('Location: '. 'UserAdmin.php');
    die();
}
else{
   echo "ERROR updating user!";
}

?>

