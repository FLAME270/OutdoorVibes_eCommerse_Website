<?php

/*
 * Milestone 1
 * Author: Tyler Wiggins & Ana Sanchez 
 * Date: 1/22/2019
 * File: RegisterHandler.php
 * Version: 1.0
 *
 * This is a PHP program that sends a form registration
 * to a mySQL database users table.
 */

// Reports an errors in file and where
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// AutoLoading all the class files 
require_once '../classes/AutoLoader.php';
//require_once 'AutoLoader.php';

// Declaring constants
define('EMPTY_STRING', "");

//Make a DbConnect obj and create a connection 
$dbConnect = new DbConnect();
$connection = $dbConnect->connect();

//Making an instance of the utility object
$utility = new Utility("", "", $connection);


// Failure got data
if (! isset($_POST['submit'])) {  
    die("Submission failed, no data");
} // Success got data
else {
    // Trim method to remove white spaces from form
    $firstName = trim($_POST['firstname']);
    $lastName = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $userNameNet = trim($_POST['username']);
    $userPasswordNet = trim($_POST['password']);
    $userPasswordNet2 = trim($_POST['password2']);
    //$phone = 0;
    //$gender = "0";
}

// Function with parameters to connect with database

// Failure, could not connect with database
if ($connection->connect_error) {
    echo "<p>Connection error: " . $connection->connect_error . "</p>";
} // Successfully connected to database
else {
    
    $exceptionsInRegistration = 0;
    // Validating data to make sure each field is not empty
    if ($firstName === NULL || $firstName === EMPTY_STRING) {
        $exceptionsInRegistration = $exceptionsInRegistration + 1;
        echo "<p>The firstname is a <b><em>required</em></b> field and cannot be blank</p>";
    }
    if ($lastName === NULL || $lastName === EMPTY_STRING) {
        $exceptionsInRegistration = $exceptionsInRegistration + 1;
        echo "<p>The lastname is a <b><em>required</em></b> field and cannot be blank</p>";
    }
    if ($email === NULL || $email === EMPTY_STRING) {
        $exceptionsInRegistration = $exceptionsInRegistration + 1;
        echo "<p>The email is a <b><em>required</em></b> field and cannot be blank</p>";
    }
    if ($userNameNet === NULL || $userNameNet === EMPTY_STRING) {
        $exceptionsInRegistration = $exceptionsInRegistration + 1;
        echo "<p>The username is a <b><em>required</em></b> field and cannot be blank</p>";
    }
    if ($userPasswordNet === NULL || $userPasswordNet === EMPTY_STRING) {
        $exceptionsInRegistration = $exceptionsInRegistration + 1;
        echo "<p>The password is a <b><em>required</em></b> field and cannot be blank</p>";
    }
    if ($userPasswordNet2 === NULL || $userPasswordNet2 === EMPTY_STRING) {
        $exceptionsInRegistration = $exceptionsInRegistration + 1;
        echo "<p>The re-entry password is a <b><em>required</em></b> field and cannot be blank</p>";
    }
    if ($userPasswordNet !== $userPasswordNet2 || $exceptionsInRegistration > 0) {
        $exceptionsInRegistration = $exceptionsInRegistration + 1;
        include('RegistrationFailed.php');
        echo "<p>The passwords<b><em> must match</em></b></p>";
       
    } else if ($exceptionsInRegistration <= 0) {
        //Calling the registerUser method 
        $register = $utility->register_user($userNameNet, $userPasswordNet, $email, $firstName, $lastName);
        
        //If register returns true//successful register
        if($register){
            include("RegistrationSuccessful.php");
        }
 
    }
    //failed registration
    else{
        include("RegistrationFailed.php");
    }
    
    // Close connection to database
    $connection->close();
}
?>

