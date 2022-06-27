<!-- Milestone 3
Script that gets all 
users and creates
an array to store query.

Grabs the information 
from the DATA ACCESS LAYER
and transforms it into 
more accessible data
in the Business Layer.


Name:	Tyler Wiggins & Ana Sanchez
Date:	2/27/2020
Class:	CST- 236
Layer: Business Layer
File: User.php
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

class User extends ManageUsers 
{
    //Constructor that calls the base constructor to
    //initilize the class properties
    public function _construct($connection){
        parent:: _construct($connection);
    }
    
    //Method to get all users 
    public function get_All_Users(){
        
        //call the method from the data access layer 
        $all_data = $this->getAllUsers();
        
        //Create the array for the presentation layer 
        foreach ($all_data as $row){
            //Put the result row in array
            $data[] = $row;
        }
        
        return $data;
    }
    
    //Method to grab data for individual user 
    public function get_User($userID){
        
        //Call the method from the data access layer 
        $all_data = $this->getUser($userID);
        
        //Create the array for the presentation layer that will go in 
        //user form to display on delete user 
        foreach ($all_data as $row){
            $data[] = $row;
        }
        return $data;
    }
    
    //Method to get userID 
    public function get_UserID($userName){
        
        //Call the method from the data access layer
        $all_data = $this->getUserID($userName);
        
        //Create the array for the presentation layer that will go in
        //user form to display on delete user
        foreach ($all_data as $row){
            $data[] = $row;
        }
        return $data;
    }
    
    //Method to create a new user 
    public function new_User($firstName, $lastName, $userNameNet, $userPasswordNet, $email, $role){
        
        //Call the method to create a new user that will return boolean
        $result = $this->newUser($firstName, $lastName, $userNameNet, $userPasswordNet, $email, $role);
        
        if($result){
            echo "<br>Successfullly added a new user!<br>";
            return true;
        }else{
            echo "<br>Error adding a new user.<br>";
            return false;
        }
    }
    
    //Method to update a new user
    public function update_User($firstName, $lastName, $userNameNet, $phone, $email, $role, $userID){
        
        //Call the method to create a new user that will return boolean
        $result = $this->updateUser($firstName, $lastName, $userNameNet, $phone, $email, $role, $userID);
        
        if($result){
            echo "<br>Successfullly updates the user!<br>";
            return true;
        }else{
            echo "<br>Error updated the user.<br>";
            return false;
        }
    }
        
    
    //Method to delete a new user
    public function delete_User($userID){
        
        //Call the method to create a new user that will return boolean
        $result = $this->deleteUser($userID);
        
        if($result){
            echo "<br>Successfullly deleted the user!<br>";
            return true;
        }else{
            echo "<br>Error deleting the user.<br>";
            return false;
        }
    }
    
    //Method to get the role for the user given the user ID
    //Return as a string 
    public function get_Role($userID){
        //CALL the getRole method 
        $result = $this->getRole($userID);
        
       //Fetch the data into an array 
       $resultArray = mysqli_fetch_assoc($result);
       
       //grab the role_type field 
       $role = $resultArray["role_type"];
       
       return $role;
    }
    
    //Method to change the first name 
    public function set_First_Name($userID, $firstName){
        //Call the setName method 
        $result= $this->setFirstName($userID, $firstName);
        
        if($result){
            echo "<br>Successfull changed first name!<br>";
            return true;
        }else{
            echo "<br>Error chaning first name<br>";
            return false;
        }
    }
    
    //Method to change the last name
    public function set_Last_Name($userID, $lastName){
        //Call the setName method
        $result= $this->setLastName($userID, $lastName);
        
        if($result){
            echo "<br>Successfull changed last name!<br>";
            return true;
        }else{
            echo "<br>Error changing last name<br>";
            return false;
        }
    }
    
    //Method to change the username
    public function set_Username($userID, $username){
        //Call the setName method
        $result= $this->setUsername($userID, $username);
        
        if($result){
            echo "<br>Successfull changed username!<br>";
            return true;
        }else{
            echo "<br>Error changing username<br>";
            return false;
        }
    }
    
    //Method to change the password
    public function set_Password($userID, $password){
        //Call the setName method
        $result= $this->setPassword($userID, $password);
        
        if($result){
            echo "<br>Successfull changed password!<br>";
            return true;
        }else{
            echo "<br>Error changing password<br>";
            return false;
        }
    }
    
    //Method to change the email
    public function set_Email($userID, $email){
        //Call the setName method
        $result= $this->setEmail($userID, $email);
        
        if($result){
            echo "<br>Successfull changed email!<br>";
            return true;
        }else{
            echo "<br>Error changing email<br>";
            return false;
        }
    }
    
    //Method to change the phone
    public function set_Phone($userID, $phone){
        //Call the setName method
        $result= $this->setPhone($userID, $phone);
        
        if($result){
            echo "<br>Successfull changed phone!<br>";
            return true;
        }else{
            echo "<br>Error changing phone<br>";
            return false;
        }
    }
    
    //Method to change the gender
    public function set_Gender($userID, $gender){
        //Call the setName method
        $result= $this->setGender($userID, $gender);
        
        if($result){
            echo "<br>Successfull changed gender!<br>";
            return true;
        }else{
            echo "<br>Error changing gender<br>";
            return false;
        }
    }
    
    //Method to change the role
    public function set_Role($userID, $role){
        //Call the setName method
        $result= $this->setRole($userID, $role);
        
        if($result){
            echo "<br>Successfull changed role!<br>";
            return true;
        }else{
            echo "<br>Error changing role<br>";
            return false;
        }
    }
    
    
    
}

