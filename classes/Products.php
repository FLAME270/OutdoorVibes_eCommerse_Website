<!-- Milestone 2
Script that gets all 
products and creates
an array to store query.

Grabs the information 
from the DATA ACCESS LAYER
and transforms it into 
more accessible data
in the Business Layer.


Name:	Tyler Wiggins & Ana Sanchez
Date:	2/10/2020
Class:	CST- 236
Layer: Business Layer
File:	Product.php
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

//Used for error checking
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Include statement 
//require "FetchProducts.php";
class Products extends FetchProducts
{
    //Constructor that calls the base constructor to
    //initilize the class properties
    public function _construct($connection){
        parent:: _construct($connection);
    }
    
    //Method that runs the getAllProducts() and then transforms it into an array
    public function get_All_Products(){
        
        //Call the get all products method from the DAL 
        $all_data = $this->getAllProducts();
        
        //Loop through an array to extract all data 
        foreach($all_data as $row){
            
            $data[] = $row;
            
        }
            //Return the array
            return $data;
    }
    
    //Method to get all offset products and put into an aray
    public function get_All_Products_Offset($offset){
        //Call the get all products method from the DAL
        $all_data = $this->getAllProductsOffset($offset);
        if(!$all_data == NULL){

        //Loop through an array to extract all data
        foreach($all_data as $row){
            
            $data[] = $row;
            
        }
        //Return the array
        return $data;
        }
    }
    
    //Method to return array for product details 
    public function getProductDetails($productID){
        //Call the det all product details method from the data access layer
        $all_data = $this->getProductDetail($productID);
        
        //Loop through an array to extract all data
        foreach($all_data as $row){
            
            $data[] = $row;
            
        }
        //Return the array
        return $data;
    }
    
    //Method to return array for product search
    public function productSearch($productName){
        //Call the det all product details method from the data access layer
        $all_data = $this->productsSearch($productName);
        
        //Loop through an array to extract all data
        foreach($all_data as $row){
            
            $data[] = $row;
            
        }
        //Return the array
        return $data;
    }
}
    


