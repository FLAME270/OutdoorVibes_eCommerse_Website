
<?php
/**
Milestone 3
Script that gets all
products and creates
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
File: Product.php
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

class Product extends ManageProducts
{
    //Constructor that calls the base constructor to
    //initilize the class properties
    public function _construct($connection){
        parent:: _construct($connection);
    }
    
    //Method to get all products
    public function get_All_Products(){
        
        //call the method from the data access layer
        $all_data = $this->getAllProducts();
        
        //Create the array for the presentation layer
        foreach ($all_data as $row){
            //Put the result row in array
            $data[] = $row;
        }
        
        return $data;
    }
    
    //Method to grab data for individual product
    public function get_Product($productID){
        
        //Call the method from the data access layer
        $all_data = $this->getProduct($productID);
        
        //Create the array for the presentation layer that will go in
        //user form to display on delete user
        foreach ($all_data as $row){
            $data[] = $row;
        }
        return $data;
    }
    
    //Method to create a new product
    public function new_Product($productName, $price, $imageFile, $shortDesc, $longDesc,
                                    $category, $subCategory, $inventory){
        
        //Call the method to create a new user that will return boolean
        $result = $this->newProduct($productName, $price, $imageFile, $shortDesc, $longDesc, 
                                            $category, $subCategory, $inventory);
        
        if($result){
            echo "<br>Successfullly added a new product!<br>";
            return true;
        }else{
            echo "<br>Error adding a new product.<br>";
            return false;
        }
    }
    
    //Method to update a product
    public function update_Product($productName, $price, $imageFile, $shortDesc, $longDesc, 
                                $category, $subCategory, $inventory, $productID){
        
        //Call the method to create a new user that will return boolean
        $result = $this->updateProduct($productName, $price, $imageFile, $shortDesc, $longDesc, $category,
                                $subCategory, $inventory, $productID);
        
        if($result){
            echo "<br>Successfullly updated product!<br>";
            return true;
        }else{
            echo "<br>Error updating a product.<br>";
            return false;
        }
    }
    
    //Method to delete a product
    public function delete_Product($productID){
        
        //Call the method to create a new user that will return boolean
        $result = $this->deleteProduct($productID);
        
        if($result){
            echo "<br>Successfullly deleted the product!<br>";
            return true;
        }else{
            echo "<br>Error deleting the product.<br>";
            return false;
        }
    }
    
    //Method to change the product name
    public function set_Product_Name($productID, $productName){
        //Call the setName method
        $result= $this->setProductName($productID, $productName);
        
        if($result){
            echo "<br>Successfull changed product name!<br>";
            return true;
        }else{
            echo "<br>Error changing product name<br>";
            return false;
        }
    }
    
    //Method to change the product price
    public function set_Price($productID, $price){
        //Call the setProductName method
        $result= $this->set_Price($productID, $price);
        
        if($result){
            echo "<br>Successfull changed product price!<br>";
            return true;
        }else{
            echo "<br>Error changing product price<br>";
            return false;
        }
    }
    
    //Method to change the image
    public function set_Image($productID, $imageFile){
        //Call the setImage method
        $result= $this->setImage($productID, $imageFile);
        
        if($result){
            echo "<br>Successfull changed product image!<br>";
            return true;
        }else{
            echo "<br>Error changing product image<br>";
            return false;
        }
    }
    
    //Method to change the product short desc
    public function set_Short_Desc($productID, $shortDesc){
        //Call the setShortDesc method
        $result= $this->setShortDesc($productID, $shortDesc);
        
        if($result){
            echo "<br>Successfull changed short description!<br>";
            return true;
        }else{
            echo "<br>Error changing short description<br>";
            return false;
        }
    }
    
    //Method to change the product long desc
    public function set_Long_Desc($productID, $longDesc){
        //Call the setShortDesc method
        $result= $this->setLongDesc($productID, $longDesc);
        
        if($result){
            echo "<br>Successfull changed long description!<br>";
            return true;
        }else{
            echo "<br>Error changing long description<br>";
            return false;
        }
    }
    
    //Method to change the product category
    public function set_Category($productID, $category){
        //Call the setCategory method
        $result= $this->setCategory($productID, $category);
        
        if($result){
            echo "<br>Successfull changed product category!<br>";
            return true;
        }else{
            echo "<br>Error changing product category<br>";
            return false;
        }
    }
    
    //Method to change the product sub category
    public function set_Sub_Category($productID, $subCategory){
        //Call the setCategory method
        $result= $this->setSubCategory($productID, $subCategory);
        
        if($result){
            echo "<br>Successfull changed product sub category!<br>";
            return true;
        }else{
            echo "<br>Error changing product sub category<br>";
            return false;
        }
    }
    
    //Method to change the product inventory
    public function set_Inventory($productID, $inventory){
        //Call the setCategory method
        $result= $this->setInventory($productID, $inventory);
        
        if($result){
            echo "<br>Successfull changed product inentory!<br>";
            return true;
        }else{
            echo "<br>Error changing product inventory<br>";
            return false;
        }
    }
    
    
    
    
    
    
    
    
    
}

