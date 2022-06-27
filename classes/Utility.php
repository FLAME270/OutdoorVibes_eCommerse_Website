

<?php
/**
Milestone 5
Script used to access
and run all the functions
that will be used to manager
user login and registration.

Name:	Tyler Wiggins & Ana Sanchez
Date:	4/3/2020
Class:	CST- 236
Layer:  BUSINESS LAYER
File:	Utility.php
Version: 1.1
______________________________________
VERSIONS
4/3 V1.1 Added a connection field
to enable the use of the same
connection for the entirely of
the class.
_____________________________________
**/


class Utility extends SecurityService
{
    //Constructor that calls the base constructor to 
    //initilize the class properties 
    public function _construct($username, $password, $connection){
        parent:: _construct($username, $password, $connection);
    }
    
    //Method to authenicate a user, log them in 
    public function authenticate_user(){
        return $this->authenticate();      
    }
    
    //Method to register a user
    public function register_user($userNameNet, $userPasswordNet, 
    $email, $firstName, $lastName){
        return $this->registerUser($userNameNet, $userPasswordNet, $email, $firstName, $lastName);
    }
    
    //Method to get userID for user 
    public function get_UserID(){
        return $this->getUserID();
    }
    
    //Method to log user out
    public function log_OutUser(){
        $this->logOutUser();
    }
}

