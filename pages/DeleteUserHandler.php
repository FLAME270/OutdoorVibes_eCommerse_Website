<!----Milestone 3----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   2/29/2019
File:	DeleteUserHandler.php
Version: 1.0	 

This file is used to connect 
to the edit user product 
and then delets the user
that was passed through 
a URL parameter.
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

//Grab the useriD url parameter
$userID =$_GET['userID'];

//Create a connection to the database
$dbConnect = new DbConnect();
$connection = $dbConnect->connect();

//Make a new user product to call method to update user
$userAdmin = new User($connection);
//Call the method to update the user
$result = $userAdmin->delete_User($userID);
$connection->close();
//If delete worked direct back to page with all users
if($result){
    echo "<h1>Delete successful!</h1>";
    header('Location: '. 'UserAdmin.php');
    die();
}
else{
    echo "ERROR deleting user!";
}

?>
