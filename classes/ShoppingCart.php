<!-- Milestone 4

Script/ class used to
manage the shopping cart
for eCommerce site.

Grabs the information 
from the DATA ACCESS LAYER
and transforms it into 
more accessible data
in the Business Layer.


Name:	Tyler Wiggins & Ana Sanchez
Date:	3/12/2020
Class:	CST- 236
Layer: Business Layer
File: ShoppingCart.php
Version: V1.0
-->



<?php

class ShoppingCart extends ShoppingCartData
{
    //Method to create an order, returns the orderID as an int
    public function create_Order($userID){
       
        //Call the method from the data access layer 
        $result = $this->createOrder($userID);
        
        //Create the array for the presenation layer that 
        //will take the orderID returned by the 
        //method
        
        //Fetch the data into an associative array
        $resultArray = mysqli_fetch_assoc($result);
        
        //Grab the field value that belongs to id_order
        $orderID = $resultArray['id_orders'];
        
        return $orderID;
        
        
        
    }
}

