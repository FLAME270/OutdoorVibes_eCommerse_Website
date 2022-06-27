<?php
/**
 Milestone 6
 Script used to interact
 with the database in terms
 of tracking all the products and sales
 for the eCommerce site.
 
 Since the script is in the
 Data Access Layer we want
 to keep the methods
 protected.
 
 Name:	Tyler Wiggins & Ana Sanchez
 Date:	4/12/2020
 Class:	CST- 236
 Layer: Data Access Layer
 File:	Sales.php
 Version: V1.0
 ______________________________________
 VERSIONS
 _____________________________________
 
 **/
require_once 'Product.php';

class Sales implements JsonSerializable 
{
    // Properties
    private $productName;
    private $idProductOrdered;
    private $idProduct;
    private $quantity;
    private $productPrice;
    private $totalProductPrice;
    
    
    // SalesManagement constructor, takes in a dbConnect
    public function __construct($idProductOrdered,$idProduct,
     $quantity, $productPrice, $totalProductPrice, $productName)
    {
        $this->idProductOrdered = $idProductOrdered;
        $this->idProduct = $idProduct;
        $this->quantity = $quantity;
        $this->productPrice = $productPrice;
        $this->totalProductPrice = $totalProductPrice;
        $this->productName = $productName;
    }
    //Methid implemented from the JsonSerializable interface to translate our object into JSON
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
    
    //Method to grab the product name 
    public function getProductName($productID){
        
    }
    
}

