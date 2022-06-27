<!-- Milestone 3
Script used to interact 
with the database in terms 
of the users for the 
eCommerce site. 

Since the script is in the 
Data Access Layer we want
to keep the methods 
protected. 

Name:	Tyler Wiggins & Ana Sanchez
Date:	2/26/2020
Class:	CST- 236
Layer: Data Access Layer
File:	ManageUsers.php
Version: V1.1
______________________________________
              VERSIONS
4/3 V1.1 Added a connection field 
         to enable the use of the same
         connection for the entirely of 
         the class. 
_____________________________________
-->

<?php

// Used for error checking
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ManageUsers 
{
    private $connect;
    
    //ManageProducts constructor, takes in a dbConnect
    public function __construct($connection)
    {
        $this->connect = $connection;
    }
    

    // Method to fetch all the users
    protected function getAllUsers()
    {

        // Enter tje query into the Data Access Layer
        $sql = "SELECT * from tbl_users";

        // Make a connection anjd run the query on the SQL statement
        $results = $this->connect->query($sql);

        // Get the number of rows that were returned
        $numRows = $results->num_rows;

        // Return results only of the number of rows is greater than zero
        if ($numRows > 0) {
            // Pass the results of the query to the next class
            return $results;
        } else {
            echo "Could not find users";
        }
    }

    // Method to get the details of a user
    protected function getUser($userID)
    {
        // Enter the query into the Data Access Layer
        $sql = "SELECT * FROM tbl_users WHERE id_user = '" . $userID . "'";

        // Make a connection anjd run the query on the SQL statement
        $results = $this->connect->query($sql);

        // Get the number of rows that were returned
        $numRows = $results->num_rows;
        
        // Return results only of the number of rows is greater than zero
        if ($numRows > 0) {
            // Pass the results of the query to the next class
            return $results;
        } else {
            echo "Could not find the user!";
        }
    }
    
    //Method to get the userID of a user 
    protected function getUserID($userName){
        // Enter the query into the Data Access Layer
        $sql = "SELECT * FROM tbl_users WHERE username = '" . $userName . "'";
        
        // Make a connection anjd run the query on the SQL statement
        $results = $this->connect->query($sql);
        
        // Get the number of rows that were returned
        $numRows = $results->num_rows;
        
        // Return results only of the number of rows is greater than zero
        if ($numRows > 0) {
            // Pass the results of the query to the next class
            return $results;
        } else {
            echo "Could not find the user id!";
        }
        
    }

    // Method to create a new user
    protected function newUser($firstName, $lastName, $userNameNet, $userPasswordNet, $email, $role)
    {
        $sql = "INSERT INTO tbl_users(first_name, last_name, username, password, email, tbl_roles_id)
                        VALUES('$firstName', '$lastName', '$userNameNet' , '$userPasswordNet', '$email', '$role')";

        // Connect to database and run sql query
        $result = $this->connect->query($sql);

        // Check if query passed and registerd
        if ($result) {
            return true;
        } else {
            return true;
        }
    }
    
    //Method to update the user
    protected function updateUser($firstName, $lastName, $userNameNet, $phone, $email, $role, $userID)
    {
        $sql = "UPDATE tbl_users
               SET first_name = '$firstName', last_name = '$lastName', username = '$userNameNet',
                    phone = '$phone', email = '$email', tbl_roles_id = '$role'
                        WHERE id_user = '$userID'" ;
        
        // Connect to database and run sql query
        $result = $this->connect->query($sql);
        
        // Check if query passed and registerd
        if ($result) {
            return true;
        } else {
            return true;
        }
    }

    // Method to delete user
    protected function deleteUser($userID)
    {

        // SQL query for deleting user
        $sql = "DELETE FROM tbl_users WHERE id_user ='" . $userID . "'";

        // Connect to database and run SQL query
        $result = $this->connect->query($sql);

        // Check if query passed and registerd
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Method to get the role of the user when provided a user id
    protected function getRole($userID)
    {
        // SQL query
        $sql = "SELECT role_type FROM tbl_roles 
                    JOIN tbl_users ON tbl_roles.id = tbl_users.tbl_roles_id
                        WHERE tbl_users.id_user ='" . $userID . "'";

        // connect to database and run query
        $result = $this->connect->query($sql);

        // Get the number or rows that were returned
        $numRows = $result->num_rows;

        // If successful query
        if ($numRows > 0) {
            // Return the data from query to the BAL
            return $result;
        } else {
            echo "Failure to grab role!";
        }
    }

    // Method to set firstName
    protected function setFirstName($userID, $firstName)
    {

        // SQL query
        $sql = "UPDATE tbl_users SET first_name= '" . $firstName . "'WHERE id_user= '" . $userID . "'";

        // Connect to database and run query
        $result = $this->connect->query($sql);

        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set lastName
    protected function setLastName($userID, $lastName)
    {
        
        // SQL query
        $sql = "UPDATE tbl_users SET last_name= '" . $lastName . "'WHERE id_user= '" . $userID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set username
    protected function setUsername($userID, $userNameNet)
    {
        
        // SQL query
        $sql = "UPDATE tbl_users SET username= '" . $userNameNet . "'WHERE id_user= '" . $userID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set password
    protected function setPassword($userID, $password)
    {
        
        // SQL query
        $sql = "UPDATE tbl_users SET password= '" . $password . "'WHERE id_user= '" . $userID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set email
    protected function setEmail($userID, $email)
    {
        
        // SQL query
        $sql = "UPDATE tbl_users SET email= '" . $email . "'WHERE id_user= '" . $userID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set phone
    protected function setPhone($userID, $phone)
    {
        
        // SQL query
        $sql = "UPDATE tbl_users SET phone= '" . $phone . "'WHERE id_user= '" . $userID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set gender
    protected function setGender($userID, $gender)
    {
        
        // SQL query
        $sql = "UPDATE tbl_users SET gender= '" . $gender . "'WHERE id_user= '" . $userID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set role
    protected function setRole($userID, $role)
    {
        
        // SQL query
        $sql = "UPDATE tbl_users SET tbl_roles_id= '" . $role . "'WHERE id_user= '" . $userID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    
    
    
    
}

