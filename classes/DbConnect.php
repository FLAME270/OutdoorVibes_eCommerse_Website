
<?php
/**
Milestone 2
Script used to coonnect to
the database.

Name:	Tyler Wiggins & Ana Sanchez
Date:	1/25/2020
Class:	CST- 236
File:	Utility.php
Version: V1.0
**/
// Error reporting mechanism
error_reporting(E_ALL);
ini_set('disply_errors', 1);
ini_set('display_startup_errors', '1');

class DbConnect
{

    // Declare and intilize private class variables
    private const HOSTNAME = "";
    private const USERNAME = "";
    private const PASSWORD = "";
    private $dbName = "";
    //private $tbName = "";
    
    function connect()
    {

        // Set all the properties
        $this->HOSTNAME = "localhost";
        $this->USERNAME = "root";
        $this->PASSWORD = "root";
        $this->dbName = "ecommerce";
        // $this->tbName = "tbl_users";

        $this->conn = new mysqli($this->HOSTNAME, $this->USERNAME, $this->PASSWORD, $this->dbName);

        if ($this->conn->connect_error) {
            echo "<p>Connection error: " . $this->conn->connect_error() . "</p>";
        } else {
            return $this->conn;
        }
    }  
}

