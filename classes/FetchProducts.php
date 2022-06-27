<!-- Milestone 2
Script used to interact 
with the database in terms 
of the products for the 
eCommerce site. 

Since the script is in the 
Data Access Layer we want
to keep the methods 
protected. 

Name:	Tyler Wiggins & Ana Sanchez
Date:	2/10/2020
Class:	CST- 236
Layer: Data Access Layer
File:	FetchProduct.php
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

// Require statement
// require 'DbConnect.php';
class FetchProducts 
{
    
    private $connect;
    
    //ManageProducts constructor, takes in a dbConnect
    public function __construct($connection)
    {
        $this->connect = $connection;
    }

    // Method to fetch all the products
    protected function getAllProducts()
    {

        // Enter tje query into the Data Access Layer
        $sql = "SELECT * from tbl_products";

        // Make a connection anjd run the query on the SQL statement
        $results = $this->connect->query($sql);

        // Get the number of rows that were returned
        $numRows = $results->num_rows;

        // Return results only of the number of rows is greater than zero
        if ($numRows > 0) {
            // Pass the results of the query to the next class
            return $results;
        } else {
            echo "Could not find products";
        }
    }

    // Method to get a range of products
    protected function getAllProductsOffset($offset)
    {
        // Enter tje query into the Data Access Layer
        $sql = "SELECT * from tbl_products ORDER BY id_products
                    LIMIT 20 OFFSET " . $offset;

        // Make a connection anjd run the query on the SQL statement
        $results = $this->connect->query($sql);

        // Get the number of rows that were returned
        $numRows = $results->num_rows;

        // Return results only of the number of rows is greater than zero
        if ($numRows > 0) {
            // Pass the results of the query to the next class
            return $results;
        } else {
            //echo "Could not find products!";
            //return $results;
        }
    }

     // Method to get the details of a product
    protected function getProductDetail($productID)
    {
        // Enter the query into the Data Access Layer
        $sql = "SELECT * FROM tbl_products WHERE id_products = '" . $productID . "'";

        // Make a connection anjd run the query on the SQL statement
        $results = $this->connect->query($sql);

        // Get the number of rows that were returned
        $numRows = $results->num_rows;

        // Return results only of the number of rows is greater than zero
        if ($numRows > 0) {
            // Pass the results of the query to the next class
            return $results;
        } else {
            echo "Could not find product details!";
        }
    }
    
    //Method to search for a product by name 
    protected function productsSearch($productName)
    {
        // Enter tje query into the Data Access Layer
        $sql = "SELECT * from tbl_products WHERE product_name 
                    LIKE '%" . $productName . "%'";
        
        // Make a connection anjd run the query on the SQL statement
        $results = $this->connect->query($sql);
        
        // Get the number of rows that were returned
        $numRows = $results->num_rows;
        
        // Return results only of the number of rows is greater than zero
        if ($numRows > 0) {
            // Pass the results of the query to the next class
            return $results;
        } else {
            echo "Could not find product with that name!";
        }
    }
    
    
}

