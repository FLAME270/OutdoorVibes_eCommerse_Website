

<?php
/**
Milestone 3
Script used to interact
with the database in terms
of the products for the
eCommerce site.

Since the script is in the
Data Access Layer we want
to keep the methods
protected.

Name:	Tyler Wiggins & Ana Sanchez
Date:	2/26/2020
Class:	CST- 236
Layer: Data Access Layer
File:	ManageProducts.php
Version: V1.1
______________________________________
VERSIONS
4/3 V1.1 Added a connection field
to enable the use of the same
connection for the entirely of
the class.
_____________________________________
**/

// Used for error checking
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ManageProducts
{
    private $connect;
    
    //ManageProducts constructor, takes in a dbConnect
    public function __construct($connection)
    {
        $this->connect = $connection;
    }
    
    //Method to get all te products 
    protected function getAllProducts()
    {
        
        // Enter the query into the Data Access Layer
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
    
    //Method to get one product and all its details 
    protected function getProduct($productID)
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
            echo "Could not find the product!";
        }
    }
    
    //Method to add a new product 
    protected function newProduct($productName, $price, $imageFile, $shortDesc, $longDesc,
                                    $category, $subCategory, $inventory)
    {
        $sql = "INSERT INTO tbl_products(product_name, price, image_name, short_description, 
                                 long_description, categories, sub_categories, inventory)
                        VALUES('$productName', '$price', '$imageFile' , '$shortDesc', 
                                '$longDesc', '$category', '$subCategory', '$inventory')";
        
        // Connect to database and run sql query
        $result = $this->connect->query($sql);
        
        // Check if query passed and registerd
        if ($result) {
            return true;
        } else {
            return true;
        }
    }
    
    //Method to update the product
    protected function updateProduct($productName, $price, $imageFile, $shortDesc, $longDesc,
                                         $category, $subCategory, $inventory,$productID)
    {
        $sql = "UPDATE tbl_products
               SET product_name = '$productName', price = '$price', image_name = '$imageFile',
                    short_description = '$shortDesc', long_description = '$longDesc', 
                       categories = '$category', sub_categories = '$subCategory', inventory = '$inventory'
                        WHERE id_products = '$productID'" ;
        
        // Connect to database and run sql query
        $result = $this->connect->query($sql);
        
        // Check if query passed and registerd
        if ($result) {
            return true;
        } else {
            return true;
        }
    }
    
    // Method to delete product
    protected function deleteProduct($productID)
    {
        
        // SQL query for deleting user
        $sql = "DELETE FROM tbl_products WHERE id_products ='" . $productID . "'";
        
        // Connect to database and run SQL query
        $result = $this->connect->query($sql);
        
        // Check if query passed and registerd
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set productName
    protected function setProductName($productID, $productName)
    {
        
        // SQL query
        $sql = "UPDATE tbl_products SET product_name= '" . $productName . "'WHERE id_products= '" . $productID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set price
    protected function setPrice($productID, $price)
    {
        
        // SQL query
        $sql = "UPDATE tbl_products SET price= '" . $price . "'WHERE id_products= '" . $productID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set image
    protected function setImage($productID, $imageFile)
    {
        
        // SQL query
        $sql = "UPDATE tbl_products SET image_name= '" . $imageFile . "'WHERE id_products= '" . $productID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set short description
    protected function setShortDesc($productID, $shortDesc)
    {
        
        // SQL query
        $sql = "UPDATE tbl_products SET short_description= '" . $shortDesc . "'WHERE id_products= '" . $productID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set long description
    protected function setLongDesc($productID, $longDesc)
    {
        
        // SQL query
        $sql = "UPDATE tbl_products SET long_description= '" . $longDesc . "'WHERE id_products= '" . $productID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set category
    protected function setCategory($productID, $category)
    {
        
        // SQL query
        $sql = "UPDATE tbl_products SET categories= '" . $category . "'WHERE id_products= '" . $productID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set sub category
    protected function setSubCategory($productID, $subCategory)
    {
        
        // SQL query
        $sql = "UPDATE tbl_products SET sub_categories= '" . $subCategory . "'WHERE id_products= '" . $productID . "'";
        
        // Connect to database and run query
        $result = $this->connect->query($sql);
        
        // Check to see if query passed and registered
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    // Method to set inventory
    protected function setInventory($productID, $inventory)
    {
        
        // SQL query
        $sql = "UPDATE tbl_products SET inventory= '" . $inventory . "'WHERE id_products= '" . $productID . "'";
        
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

