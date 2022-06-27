


<?php
/**
Milestone 6
Script used to interact
with the database in terms
of the products and sales
for the eCommerce site.

Since the script is in the
Data Access Layer we want
to keep the methods
protected.

Name:	Tyler Wiggins & Ana Sanchez
Date:	4/12/2020
Class:	CST- 236
Layer: Data Access Layer
File:	SalesManagement.php
Version: V1.0
______________________________________
VERSIONS
_____________________________________

**/

// Used for error checking
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'Product.php';
require_once 'Sales.php';

class SalesManagement
{

    // Properties
    private $date1;
    private $date2;
    private $connect;
    
    // SalesManagement constructor, takes in a dbConnect
    public function __construct($connection)
    {
        $this->connect = $connection;
    }

    // Method to grab the products purchases
    public function getSales($date1, $date2)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
        
        $sql = "SELECT id_product_ordered, tbl_products_id_products, quantity, product_price, total_product_price
                From tbl_product_ordered
                INNER JOIN tbl_orders
                ON tbl_product_ordered.tbl_orders_id_orders = tbl_orders.id_orders
                WHERE (date_of_order >= '" . $date1 . "' AND
                date_of_order < '" . $date2 . "')
                ORDER BY quantity DESC";
        
        //Connect to the database to run the query 
        $result = $this->connect->query($sql);
        
        //Fheck if query to database passed 
        if($result){
            return $result;
        }
        else{
            echo "Failed to grab all sales";
        }
        
    }

//     public function getProductName($productID){
//         //Make a new Product object 
//         $products = new Product($this->connect);
//         $data = $products->get_Product($productID);
//         //Transform our data into an array so we can extract the data
//         $datas= $data[0];
//         $productName = $datas['product_name'];
//         return $productName;
        
//     } 
    
}

