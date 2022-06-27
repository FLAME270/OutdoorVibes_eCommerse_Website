<!-- Milestone 1
Script used to encapsulate
for the securtiy service. Has
methods for login and 
register services.

Name:	Tyler Wiggins & Ana Sanchez
Date:	1/19/2020
Class:	CST- 236
Layer:  DATA ACCESS LAYER
File:	SecurityService.php
Version: 1.2

______________________________________
              VERSIONS
4/3 V1.1 Changed class
         to private to secure 
         information flow 
         and encapsulate the data.   

4/3 V1.2 Added a connection field 
         to enable the use of the same
         connection for the entirely of 
         the class. 
_____________________________________
-->

<?php

class SecurityService
{

    // Declare and intilize private class variables
    private $username = "";
    private $password = "";
    private $tbName = "";
    private $connect; 
   

    // Initializes an instance of
    // Security Service object.
    // SecurityService Constructor
    public function __construct($username, $password, $connection)
    {
        $this->username = $username;
        $this->password = $password;
        $this->tbName = "tbl_users";
        $this->connect = $connection;
    }

    // Authenticate a user
    //
    // @return bool True if authentication passes else returns false.
    protected function authenticate()
    {
        //Unset the orderID session so that we can have a new order for a new user 
        unset($_SESSION['orderID']);
        
        // SQL statement to check login, grabs ID, username, and password
        $sql = "SELECT id_user, username, password FROM $this->tbName
                    WHERE username ='" . $this->username . "'" . "AND password='" . $this->password . "'";

        // Performs a query on the database
        if ($result = $this->connect->query($sql)) {
            $nbrRows = $result->num_rows;

            if ($nbrRows == 1) {
                //Declare the session var for login
                $_SESSION['username2'] = $this->username;
                //echo "searching";
                return true;
            }
        } // Returns false if user credentials are not correct or empty
        
        else {
            echo "did not reach database";
            return false;
            
        }
    }
    
    // Functions that will be used to register user
    protected function registerUser($userNameNet, $userPasswordNet, $email, $firstName, $lastName)
    {
        
        /*
         * First- see if we already have a user registered with that
         * username and email
         */
        
        // SQl statement that selects username and email
        $sql = "SELECT username, email FROM $this->tbName
                WHERE username = '" . $userNameNet . "'" . "OR email='" . $email . "'";
        
        if ($result = $this->connect->query($sql)) {
            $nbrRows = $result->num_rows;
            
            // If there are one or more of the same user registered
            if ($nbrRows >= 1) {
                return false;
            } // If email and username are not used before to register, does not exist in database
            else {
                // Insert INTO statement to input the data from into database,
                // Constructing sql query
                $sql = "INSERT INTO $this->tbName(first_name, last_name, username, password, email, tbl_roles_id)
                        VALUES('$firstName', '$lastName', '$userNameNet' , '$userPasswordNet', '$email', '1')";
                
                // Insert statement successful
                if ($result = $this->connect->query($sql)) {
                    return true;
                }
            }
        }
    }
    
    //Method to grab the userID for sessionvar purposes
    protected function getUserID(){
        
        // SQL statement to grab the userID for the username and password 
        $sql = "SELECT id_user FROM $this->tbName
                    WHERE username ='" . $this->username . "'" . "AND password='" . $this->password . "'";
        
        // Performs a query on the database
        if ($result = $this->connect->query($sql)) {
            $nbrRows = $result->num_rows;
            
            if ($nbrRows > 0) {
                //echo "found user";
                //Fetch the data into an array
                $resultArray = mysqli_fetch_assoc($result);
                
                //grab the userID 
                $userID = $resultArray["id_user"];
                //Make the userID a session variable to be able to pass it later for shopping purposes
                $_SESSION['userID'] = $userID;
                
                return $userID;
                
            }
        } // Returns false if user credentials are not correct or empty
        
        else {
            echo "did not find user for role";
        }
    }
    
    //Method to log a user out, unsets all their session variables 
    protected function logOutUser(){
        echo "logged out " . $_SESSION['username2'];
        //Unset the username and userID session 
        unset($_SESSION['userID']);
        unset($_SESSION['username2']);
        unset($_SESSION['orderID']);
        unset($_SESSION['role']);
        
    }
}

