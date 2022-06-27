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
Version: V1.2
______________________________________
              VERSIONS
4/3 V1.1 Added a connection field 
         to enable the use of the same
         connection for the entirely of 
         the class. 
4/17 V1.2 Added methods for the coupon
          functionality. 
_____________________________________
-->



<?php
// Used for error checking
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Cart extends ShoppingCartData
{
    //Constructor that calls the base constructor to
    //initilize the class properties
    public function _construct($connection){
        parent:: _construct($connection);
    }

    // Method to create an order, returns the orderID as an int
    public function create_Order($userID)
    {

        // Call the method from the data access layer
        $resultArray = $this->createOrder($userID);

        // Grab the field value that belongs to id_order
        $orderID = $resultArray["LAST_INSERT_ID()"];

        return $orderID;
    }

    // Method to create an order, returns the orderID as an int
    public function create_Order_No_User()
    {

        // Call the method from the data access layer
        $resultArray = $this->createOrderNoUser();

        // Grab the field value that belongs to id_order
        $orderID = $resultArray['LAST_INSERT_ID()'];

        return $orderID;
    }

    // Method to add a product to an order
    public function add_Product($orderID, $productID, $quantity, $price)
    {

        // Call method from the data access layer
        $result = $this->addProduct($orderID, $productID, $quantity, $price);

        if ($result) {
            //echo "Successfully added product to cart";
            return true;
        } else {
            //echo "Failed to add product to cart";
            return false;
        }
    }
    
    //Method to grab the order returns order id
    public function get_OrderID($userID){
        //Call the method from the data access layer
        $resultArray = $this->getOrderID($userID);
        
        // Grab the field value that belongs to order_id
        $orderID = $resultArray["id_orders"];
        
        return $orderID;
        
    }
    
    //Method to return array for products in order
    public function get_Order_Products($orderID){
        //Call the det all product details method from the data access layer
        $all_data = $this->getOrderProducts($orderID);
        if(!$all_data == NULL){
        
        //Loop through an array to extract all data
        foreach($all_data as $row){
            
            $data[] = $row;
            
        }
        //Return the array
        return $data;
        }
    }
    
    //Method to update total price 
    public function update_Total($orderID, $totalPrice){
        // Call method from the data access layer
        $result = $this->updateTotal($orderID, $totalPrice);
        
        if ($result) {
            //echo "Successfully added product to cart";
            return true;
        } else {
            //echo "Failed to update total";
            return false;
        }
        
    }
    
    //Method to update tax
    public function update_Tax($orderID, $totalPrice){
        // Call method from the data access layer
        $result = $this->updateTax($orderID, $totalPrice);
        
        if ($result) {
            //echo "Successfully added product to cart";
            return true;
        } else {
            //echo "Failed to update tax";
            return false;
        }
        
    }
    
    //Method to return array for properties in order
    public function get_Order($orderID){
        //Call the det all product details method from the data access layer
        $all_data = $this->getOrder($orderID);
        
        //Loop through an array to extract all data
        foreach($all_data as $row){
            
            $data[] = $row;
            
        }
        //Return the array
        return $data;
    }
    
    //Method to delete product
    public function delete_Product($productOrderedID){
        // Call method from the data access layer
        $result = $this->deleteProduct($productOrderedID);
        
        if ($result) {
            //echo "Successfully added product to cart";
            return true;
        } else {
            //echo "Failed to update tax";
            return false;
        }
        
    }
    
    // Method to create an order, returns the orderID as an int
    public function add_Payment($userID, $paymentType, $cardNum, $seqCode, $expirationNum, $nameOnCard)
    {
        
        // Call the method from the data access layer
        $resultArray = $this->addPayment($userID, $paymentType, $cardNum, $seqCode, $expirationNum, $nameOnCard);
        
        // Grab the field value that belongs to id_order
        $paymentID = $resultArray["LAST_INSERT_ID()"];
        
        return $paymentID;
    }
    
    //Method to set payment to an order
    public function set_Payment($orderID, $paymentID){
        // Call method from the data access layer
        $result = $this->setPayment($orderID, $paymentID);
        
        if ($result) {
            //echo "Successfully added product to cart";
            return true;
        } else {
            //echo "Failed to update tax";
            return false;
        }
        
    }
    
    //Method to return array for all payments belonging to user
    public function get_Payments($userID){
        //Call the det all product details method from the data access layer
        $all_data = $this->getPayments($userID);
        
        //Loop through an array to extract all data
        foreach($all_data as $row){
            
            $data[] = $row;
            
        }
        //Return the array
        return $data;
    }
    
    //Method to return array for properties in order
    public function get_Payment_From_order($orderID){
        //Call the det all product details method from the data access layer
        $all_data = $this->getPaymentFromOrder($orderID);
        if(!$all_data == NULL){
        //Loop through an array to extract all data
        foreach($all_data as $row){
        
            
            $data[] = $row;
            
        }
        //Return the array
        return $data;
        }
    }
    
    // Method to create an shippinh, returns the shippinhID as an int
    public function add_Shipping($userID, $street, $city, $state, $country, $zipCode,
                                    $unitNumber, $firstName, $lastName)
    {
        
        // Call the method from the data access layer
        $resultArray = $this->addShipping($userID, $street, $city, $state, $country, $zipCode, $unitNumber, $firstName, $lastName);
        
        // Grab the field value that belongs to id_order
        $paymentID = $resultArray["LAST_INSERT_ID()"];
        
        return $paymentID;
    }
    
    //Method to set shipping to an order
    public function set_Shipping($orderID, $shippingID){
        // Call method from the data access layer
        $result = $this->setShipping($orderID, $shippingID);
        
        if ($result) {
            //echo "Successfully added product to cart";
            return true;
        } else {
            //echo "Failed to update tax";
            return false;
        }
        
    }
    
    //Method to return array for properties in order for shipping
    public function get_Shipping_From_order($orderID){
        //Call the det all product details method from the data access layer
        $all_data = $this->getShippingFromOrder($orderID);
        if(!$all_data == NULL){
        
        //Loop through an array to extract all data
        foreach($all_data as $row){
            
            $data[] = $row;
            
        }
        //Return the array
        return $data;
        }
    }
    
    //Method to return array for all shippings belonging to user
    public function get_Shippings($userID){
        //Call the det all product details method from the data access layer
        $all_data = $this->getShippings($userID);
        if(!$all_data == NULL){
        
        //Loop through an array to extract all data
        foreach($all_data as $row){
            
            $data[] = $row;
            
        }
        //Return the array
        return $data;
        }
    }
    
    // Method to create an billing, returns the billingID as an int
    public function add_Billing($userID, $street, $city, $state, $country, $zipCode,
    $unitNumber, $firstName, $lastName)
    {
        
        // Call the method from the data access layer
        $resultArray = $this->addBilling($userID, $street, $city, $state, $country, $zipCode, $unitNumber, $firstName, $lastName);
        
        // Grab the field value that belongs to id_order
        $paymentID = $resultArray["LAST_INSERT_ID()"];
        
        return $paymentID;
    }
    //Method to set billing to an order
    public function set_Billing($orderID, $billingID){
        // Call method from the data access layer
        $result = $this->setBilling($orderID, $billingID);
        
        if ($result) {
            //echo "Successfully added product to cart";
            return true;
        } else {
            //echo "Failed to update tax";
            return false;
        }
        
    }
    
    //Method to return array for properties in order for shipping
    public function get_Billing_From_order($orderID){
        //Call the det all product details method from the data access layer
        $all_data = $this->getBillingFromOrder($orderID);
        if(!$all_data == NULL){
        
        //Loop through an array to extract all data
        foreach($all_data as $row){
            
            $data[] = $row;
            
        }
        //Return the array
        return $data;
        }
    }
    
    //Method to return array for all billings belonging to user
    public function get_Billings($userID){
        //Call the det all product details method from the data access layer
        $all_data = $this->getBillings($userID);
        if(!$all_data == NULL){
        //Loop through an array to extract all data
        foreach($all_data as $row){
            
            $data[] = $row;
            
        }
        //Return the array
        return $data;
        }
    }
    
    //Method to confirm order
    public function confirm_Order($orderID, $couponDiscount){
        // Call method from the data access layer
        $result = $this->confirmOrder($orderID, $couponDiscount);
        
        if ($result) {
            //echo "Successfully confirmed order";
            return true;
        } else {
            //echo "Failed to confirm order";
            return false;
        }
        
    }
    
    //Method to return tje coupon found using coupon code
    public function get_Coupon_From_Code($couponCode){
        //Call the det all product details method from the data access layer
        $all_data = $this->getCouponFromCode($couponCode);
        
        //Loop through an array to extract all data
        foreach($all_data as $row){
            
            $data[] = $row;
            
        }
        //Return the array
        return $data;
    }
    
    //Method to check if user has used coupon
    public function check_If_Coupon_Used($userID, $couponID){
        // Call method from the data access layer
        $result = $this->checkIfCouponUsed($userID, $couponID);
        
        if ($result) {
            //echo "Coupon already used";
            return true;
        } else {
            //echo "Successfully using coupon";
            return false;
        }
        
    }
    
    //Method to check couponType
    public function check_Coupon_Type($couponID){
        // Call method from the data access layer
        $result = $this->checkCouponType($couponID);
        
        return $result;
        
    }
    
    //Method to check if coupon is applicable
    public function check_Applicable_Coupon($couponID, $orderID, $couopnCode){
        // Call method from the data access layer
        $result = $this->checkApplicableCoupon($couponID, $orderID, $couopnCode);
        
        if ($result) {
            //echo "Coupon can be used";
            return true;
        } else {
            //echo "No item for coupon";
            return false;
        }
        
    }
    
    //Method to set coupon to order
    public function set_Coupon($orderID, $couponID){
        // Call method from the data access layer
        $result = $this->setCoupon($orderID, $couponID);
        
        if ($result) {
            return true;
        } else {
            return false;
        }
        
    }
    
    //Method to grab the couopn id for the order 
    public function get_Coupon_From_Order($orderID)
    {
        
        // Call the method from the data access layer
        $resultArray = $this->getCoupnFromOrder($orderID);
        
        // Grab the field value that belongs to id_order
        $couponID = $resultArray["tbl_coupon_id_coupon"];
        
        return $couponID;
    }
    
    //Method to return tje coupon found using coupon id
    public function get_Coupon_Details($couponID){
        //Call the det all product details method from the data access layer
        $all_data = $this->getCouponDetails($couponID);
        
        //Loop through an array to extract all data
        foreach($all_data as $row){
            
            $data[] = $row;
            
        }
        //Return the array
        return $data;
    }
    
    //Method to remove coupon from the order
    public function remove_Coupon_From_Order($orderID){
        // Call method from the data access layer
        $result = $this->removeCouponFromOrder($orderID);
        
        if ($result) {           
            return true;
        } else {
            return false;
        }
    }
    
    
    
    
    
}

