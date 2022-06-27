<?php
/*
 * ---Milestone 1----
 *
 * Author: Tyler Wiggins & Ana Sanchez 
 * Date: 1/23/2019
 * File: LoginHandler.php
 * Version: 1.0
 *
 * This is a PHP program that sends a login form
 * to a mySQL database users table.
_____________________
    VERSIONS
    
_____________________

 */

// Error reporting support
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Requires and includes
require_once '../classes/AutoLoader.php';
//Require the session start page
require_once 'Header.php';

// Declaring constants
define('EMPTY_STRING', "");


// Make sure that that the data is POSTED through the submit button and not empty
if (! isset($_POST['submit'])) {
    die("Submission failed, no data");
} // Success, got data from the form
else {
    // Trim to make sure that the data us being posted
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    
}



//Making a new insance of the SecuruityService, user, cart, and dbConnection object 
$dbConnect = new DbConnect();
//establishing a connection
$connection = $dbConnect->connect();

$utility = new utility($username, $password, $connection);
$adminUser = new User($connection);
$shoppingCart = new Cart($connection);



// Success-Failture logic to check if there is an error with database connection
if ($connection) {
   

    // If statement that validates the data to make sure username is not empty
    if ($username === NULL || $username === EMPTY_STRING) {
        echo "<p> The username is a <b><em>requied </em></b>field and cannot be blank</p>";
    } // Another if statement to validate the data to make sure password is not empty
    else if ($password === NULL || $password === EMPTY_STRING) {
        echo "<p> The password is  <b><em>requied </em></b>field and cannot be blank</p>";
    }
    else{
        
        
        //Calling rhe authencate method to login 
        $login = $utility->authenticate_user();
        
        //Calling the authenticalAdmin method to grab te userID
        $userID = $utility->get_UserID();
        
        //calling the get role method that uses te userID passed to check if admin
        $adminCheck = $adminUser->get_Role($userID);
        
        //Set a session var for the admin role
        $_SESSION['role'] = $adminCheck;
        
        
        
        
        //If authenticate returns true logged in
        if($login){
            //If login is sucessful we can grab the users cart through the order id 
            $orderID = $shoppingCart->get_OrderID($userID);
            //Set the orderID session to establish the users cart 
            $_SESSION['orderID'] = $orderID;
            //echo "<p align= 'center'> OrderID, " . $_SESSION['orderID'] . " ! </p>";
            
            
            if($adminCheck === "admin")
            {
                include("AdminHome.php");
                //echo "<p>Welcome admin, " . $_SESSION['username2'] . "!";
            }
            else{
                include('LoginSuccessful.php');
                //echo "<h1 align= 'center'> Welcome, " . $_SESSION['username2'] . " !";
                //echo "<p>" . $_SESSION['userID'] . " - userID<p>";
            }
        }
        else{
            include('LoginFailed.php');
            
        }
        
        
    }
    
} 
else {
    echo "<p>Error: " . $connection->error() . "</p>";
}
echo "<br>";
// Closing Database
mysqli_close($connection);





