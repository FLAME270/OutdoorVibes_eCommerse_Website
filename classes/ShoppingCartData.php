
<!-- Milestone 4
Script used to interact
with the database in terms
of the shopping cart for the
eCommerce site.

Since the script is in the
Data Access Layer we want
to keep the methods
protected.

Name:	Tyler Wiggins & Ana Sanchez
Date:	3/12/2020
Class:	CST- 236
Layer: Data Access Layer
File:	ShoppingCartData.php
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

class ShoppingCartData
{

    private $connect;

    // ManageProducts constructor, takes in a dbConnect
    public function __construct($connection)
    {
        $this->connect = $connection;
    }

    // Method used to create an order, returns the orderID that was created
    protected function createOrder($userID)
    {

        // Create the sql query that will create an order
        $sql = "INSERT INTO tbl_orders(tbl_users_id_user, order_status)
                    VALUES('$userID', 'CART')";

        // Run the query to create a new order
        $result = $this->connect->query($sql);
        // If order successfully inserted
        if ($result) {

            // Create the sql query that will create an order
            $sql = "SELECT LAST_INSERT_ID()";
            // Run the query on the already established connection
            $result = $this->connect->query($sql);

            // Return results only of the number of rows is greater than zero
            if ($result->num_rows > 0) {

                // Fetch the data into an associative array
                $resultArray = mysqli_fetch_assoc($result);
                return $resultArray;
            } else {
                // echo "Could not create order!";
            }
        }
    }

    // Method used to create an order for a user that hasn't logged in,
    // returns the orderID that was created
    protected function createOrderNoUser()
    {

        // Create the sql query that will create an order
        $sql = "INSERT INTO tbl_orders(tbl_users_id_user, order_status)
                    VALUES( NULL , 'CART')";

        // Run the query to create a new order
        $result = $this->connect->query($sql);
        // If order successfully inserted
        if ($result) {

            // Create the sql query that will create an order
            $sql = "SELECT LAST_INSERT_ID()";
            // Run the query on the already established connection
            $result = $this->connect->query($sql);

            // Return results only of the number of rows is greater than zero
            if ($result->num_rows > 0) {

                // Fetch the data into an associative array
                $resultArray = mysqli_fetch_assoc($result);
                return $resultArray;
            } else {
                // echo "Could not create order!";
            }
        }
    }

    // Method to add the product to the order
    protected function addProduct($orderID, $productID, $quantity, $price)
    {

        // Create the sql query
        $sql = "INSERT INTO tbl_product_ordered(tbl_orders_id_orders, tbl_products_id_products,
                    quantity,product_price, total_product_price) VALUES ('$orderID', '$productID', '$quantity',
                                                        '$price' , ('$quantity' * '$price'))";

        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Method to grab existing order from user
    protected function getOrderID($userID)
    {

        // Create a sql query that will be used to grab the active cart with the user id
        $sql = "SELECT id_orders FROM tbl_orders WHERE tbl_users_id_user = '" . $userID . "' AND order_status = 'CART'";
        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        // Return results only of the number of rows is greater than zero
        if ($result->num_rows > 0) {

            // Fetch the data into an associative array
            $resultArray = mysqli_fetch_assoc($result);
            // echo "Successfully grabed order";
            return $resultArray;
        } else {
            // echo "Could not grab order ID!";
        }
    }

    // Method to the get the products from an order
    protected function getOrderProducts($orderID)
    {

        // Create a sql query that will be used to grab the products from the order
        $sql = "SELECT id_product_ordered, tbl_products_id_products, quantity, product_price, total_product_price FROM tbl_product_ordered
                WHERE tbl_orders_id_orders= '" . $orderID . "'";
        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        // Return results only of the number of rows is greater than zero
        if ($result->num_rows > 0) {

            // echo "Successfully grabed products";
            return $result;
        } else {
            // echo "Could not grab products!";
        }
    }

    // Method to calculate the total for the products in each other
    protected function updateTotal($orderID, $totalPrice)
    {
        // Create a sql query that will add the total
        $sql = "UPDATE tbl_orders SET order_total = '" . $totalPrice . "' WHERE id_orders= '" . $orderID . "'";

        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Method to calculate the tax
    protected function updateTax($orderID, $totalPrice)
    {

        // Create a sql query that will add the total
        $sql = "UPDATE tbl_orders SET order_tax = '" . ($totalPrice * .025) . "' WHERE id_orders= '" . $orderID . "'";

        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Method to grab all the properties of an order
    protected function getOrder($orderID)
    {

        // Create a sql query that will be used to grab the products from the order
        $sql = "SELECT * FROM tbl_orders
                WHERE id_orders= '" . $orderID . "'";
        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        // Return results only of the number of rows is greater than zero
        if ($result->num_rows > 0) {

            // echo "Successfully grabed order";
            return $result;
        } else {
            // echo "Could not grab order!";
        }
    }

    // Method to delete a product from an order
    protected function deleteProduct($productOrderID)
    {

        // Create a sql query that delete the product from the order
        $sql = "DELETE FROM tbl_product_ordered WHERE id_product_ordered = '" . $productOrderID . "'";

        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Method to add a payment in the database and store it, selects the id so we can use that to set it to the order
    protected function addPayment($userID, $paymentType, $cardNum, $seqCode, $expirationNum, $nameOnCard)
    {
        if (empty($userID)) {

            // Create the sql query
            $sql = "INSERT INTO tbl_payment(tbl_users_id_user, payment_type,
                    card_number, security_code, expiration_number,
                        name_on_card)VALUES( NULL, '$paymentType', '$cardNum',
                                               '$seqCode' , '$expirationNum', '$nameOnCard')";

            // Run the query to create a new order
            $result = $this->connect->query($sql);
        } else {

            // Create the sql query
            $sql = "INSERT INTO tbl_payment(tbl_users_id_user, payment_type,
                    card_number, security_code, expiration_number,
                        name_on_card)VALUES('$userID', '$paymentType', '$cardNum',
                                               '$seqCode' , '$expirationNum', '$nameOnCard')";

            // Run the query to create a new order
            $result = $this->connect->query($sql);
        }

        // If order successfully inserted
        if ($result) {

            // Create the sql query that will create an order
            $sql = "SELECT LAST_INSERT_ID()";
            // Run the query to create a new order
            $result = $this->connect->query($sql);

            // Return results only of the number of rows is greater than zero
            if ($result->num_rows > 0) {

                // Fetch the data into an associative array
                $resultArray = mysqli_fetch_assoc($result);
                return $resultArray;
            } else {
                //echo "Could not insert payment";
            }
        } else {
           // echo "ERROR adding payment";
        }
    }

    // Method to set a payment to an order
    protected function setPayment($orderID, $paymentID)
    {

        // Create a sql query that add the payment to the order
        $sql = "UPDATE tbl_orders SET tbl_payment_id_payment = '" . $paymentID . "' WHERE id_orders= '" . $orderID . "'";

        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Method to grab all the payments for the user
    protected function getPayments($userID)
    {

        // Create a sql query that will be used to grab the products from the order
        $sql = "SELECT * FROM tbl_payment
                WHERE tbl_users_id_user= '" . $userID . "'";
        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        // Return results only of the number of rows is greater than zero
        if ($result->num_rows > 0) {

            // echo "Successfully grabed order";
            return $result;
        } else {
            // echo "Could not grab order!";
        }
    }

    // Method to grab the payment for order
    protected function getPaymentFromOrder($orderID)
    {
        $sql = "SELECT tbl_payment_id_payment 
                FROM tbl_orders
                WHERE id_orders= '" . $orderID . "'";

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        // Fetch the data into an associative array
        $resultArray = mysqli_fetch_assoc($result);

        // Grab the field value that belongs to payment_id
        $paymentID = $resultArray["tbl_payment_id_payment"];

        // Create a sql query that will be used to grab the products from the order
        $sql = "SELECT card_number, name_on_card, payment_type
                    FROM tbl_payment
                    INNER JOIN tbl_orders
                    ON tbl_orders.tbl_payment_id_payment = tbl_payment.id_payment
                    WHERE tbl_orders.tbl_payment_id_payment = '" . $paymentID . "'";
        // echo $sql;

        // Run the query that will grab the orderID
        $result = $this->connect->query($sql);

        // Return results only of the number of rows is greater than zero
        if ($result->num_rows > 0) {
            return $result;
            // echo "Successfully grabed order";
            // return $result;
        } else {
           // echo "Could not grab payment!";
        }
    }

    // Method to add a billing in the database and store it, selects the id so we can use that to set it to the order
    protected function addShipping($userID, $street, $city, $state, $country, $zipCode, $unitNumber, $firstName, $lastName)
    {
        if (empty($userID)) {

            // Create the sql query
            $sql = "INSERT INTO tbl_shipping(tbl_users_id_user, street,
                    country, state, city, zip_code, unit_number, first_name,
                        last_name)VALUES( NULL, '$street', '$country','$state','$city',
                                               '$zipCode' , '$unitNumber', '$firstName', '$lastName')";
            // Run the query to create a new order
            $result = $this->connect->query($sql);
        } else {

            // Create the sql query
            $sql = "INSERT INTO tbl_shipping(tbl_users_id_user, street,
                    country, state, city, zip_code, unit_number, first_name,
                        last_name)VALUES( '$userID', '$street', '$country','$state','$city',
                                               '$zipCode' , '$unitNumber', '$firstName', '$lastName')";

            // Run the query to create a new order
            $result = $this->connect->query($sql);
        }

        // If order successfully inserted
        if ($result) {

            // Create the sql query that will create an order
            $sql = "SELECT LAST_INSERT_ID()";
            // Run the query to create a new order
            $result = $this->connect->query($sql);

            // Return results only of the number of rows is greater than zero
            if ($result->num_rows > 0) {

                // Fetch the data into an associative array
                $resultArray = mysqli_fetch_assoc($result);
                return $resultArray;
            } else {
                //echo "Could not insert shipping";
            }
        } else {
           // echo "ERROR adding shipping";
        }
    }

    // Method to set a shipping to an order
    protected function setShipping($orderID, $shippingID)
    {

        // Create a sql query that add the payment to the order
        $sql = "UPDATE tbl_orders SET tbl_shipping_id_shipping = '" . $shippingID . "' WHERE id_orders= '" . $orderID . "'";

        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Method to grab the shippinh for order
    protected function getShippingFromOrder($orderID)
    {
        $sql = "SELECT tbl_shipping_id_shipping
                FROM tbl_orders
                WHERE id_orders= '" . $orderID . "'";

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        // Fetch the data into an associative array
        $resultArray = mysqli_fetch_assoc($result);

        // Grab the field value that belongs to payment_id
        $shippingID = $resultArray["tbl_shipping_id_shipping"];

        // Create a sql query that will be used to grab the products from the order
        $sql = "SELECT *
                    FROM tbl_shipping
                    INNER JOIN tbl_orders
                    ON tbl_orders.tbl_shipping_id_shipping = tbl_shipping.id_shipping
                    WHERE tbl_orders.tbl_shipping_id_shipping = '" . $shippingID . "'";
        // echo $sql;

        // Run the query that will grab the orderID
        $result = $this->connect->query($sql);

        // Return results only of the number of rows is greater than zero
        if ($result->num_rows > 0) {
            return $result;
            // echo "Successfully grabed order";
            // return $result;
        } else {
            //echo "Could not grab shipping!";
        }
    }

    // Method to grab all the shippings for the user
    protected function getShippings($userID)
    {

        // Create a sql query that will be used to grab the products from the order
        $sql = "SELECT * FROM tbl_shipping
                WHERE tbl_users_id_user= '" . $userID . "'";
        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        // Return results only of the number of rows is greater than zero
        if ($result->num_rows > 0) {

            // echo "Successfully grabed order";
            return $result;
        } else {
            // echo "Could not grab order!";
        }
    }

    // Method to add a billing in the database and store it, selects the id so we can use that to set it to the order
    protected function addBilling($userID, $street, $city, $state, $country, $zipCode, $unitNumber, $firstName, $lastName)
    {
        if (empty($userID)) {

            // Create the sql query
            $sql = "INSERT INTO tbl_billing(street, country, state, city, zip_code, unit_number, first_name,
                        last_name, tbl_users_id_user)VALUES('$street', '$country','$state','$city',
                                               '$zipCode' , '$unitNumber', '$firstName', '$lastName', NULL)";
            // Run the query to create a new order
            $result = $this->connect->query($sql);
        } else {

            // Create the sql query
            $sql = "INSERT INTO tbl_billing(street, country, state, city, zip_code, unit_number, first_name,
                        last_name, tbl_users_id_user)VALUES('$street', '$country','$state','$city',
                                               '$zipCode' , '$unitNumber', '$firstName', '$lastName', '$userID')";

            // Run the query to create a new order
            $result = $this->connect->query($sql);
        }

        // If order successfully inserted
        if ($result) {

            // Create the sql query that will create an order
            $sql = "SELECT LAST_INSERT_ID()";
            // Run the query to create a new order
            $result = $this->connect->query($sql);

            // Return results only of the number of rows is greater than zero
            if ($result->num_rows > 0) {

                // Fetch the data into an associative array
                $resultArray = mysqli_fetch_assoc($result);
                return $resultArray;
            } else {
                //echo "Could not insert billing";
            }
        } else {
            //echo "ERROR adding billing";
        }
    }

    // Method to set a billing address to an order
    protected function setBilling($orderID, $billingID)
    {

        // Create a sql query that add the payment to the order
        $sql = "UPDATE tbl_orders SET tbl_billing_id_billing = '" . $billingID . "' WHERE id_orders= '" . $orderID . "'";

        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Method to grab the billing from order
    protected function getBillingFromOrder($orderID)
    {
        $sql = "SELECT tbl_billing_id_billing
                FROM tbl_orders
                WHERE id_orders= '" . $orderID . "'";

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        // Fetch the data into an associative array
        $resultArray = mysqli_fetch_assoc($result);

        // Grab the field value that belongs to payment_id
        $billingID = $resultArray["tbl_billing_id_billing"];

        // Create a sql query that will be used to grab the products from the order
        $sql = "SELECT *
                    FROM tbl_billing
                    INNER JOIN tbl_orders
                    ON tbl_orders.tbl_billing_id_billing = tbl_billing.id_billing
                    WHERE tbl_orders.tbl_billing_id_billing = '" . $billingID . "'";
        // echo $sql;

        // Run the query that will grab the orderID
        $result = $this->connect->query($sql);

        // Return results only of the number of rows is greater than zero
        if ($result->num_rows > 0) {
            return $result;
            // echo "Successfully grabed order";
            // return $result;
        } else {
            //echo "Could not grab billing!";
        }
    }

    // Method to grab all the billings for the user
    protected function getBillings($userID)
    {

        // Create a sql query that will be used to grab the products from the order
        $sql = "SELECT * FROM tbl_billing
                WHERE tbl_users_id_user= '" . $userID . "'";
        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        // Return results only of the number of rows is greater than zero
        if ($result->num_rows > 0) {

            // echo "Successfully grabed order";
            return $result;
        } else {
            // echo "Could not grab order!";
        }
    }

    // Method that wll confirm the order and finalize the shopping process
    protected function confirmOrder($orderID, $couponDiscount)
    {
        // turn autocommit off
        $this->connect->autocommit(FALSE);

        // Beging a transaction
        $this->connect->begin_transaction();

        // grab the date
        $date = date('Y-m-d H:i:s');
        // sql query
        $sql = "UPDATE tbl_orders SET order_status = 'CONFIRMED', date_of_order = '" . $date . "' 
                 ,coupon_discount = '" . $couponDiscount . "'WHERE id_orders= '" . $orderID . "'";

        // Run the query to create a confirm order
        $result = $this->connect->query($sql);

        // sql to check that the billing, shipping, and payment have been set up
        $sql = "SELECT * FROM tbl_orders WHERE id_orders ='" . $orderID . "'
                    AND(tbl_payment_id_payment IS NULL OR tbl_shipping_id_shipping IS NULL 
                    OR tbl_billing_id_billing IS NULL)";

        // run the second sql statement
        $result2 = $this->connect->query($sql);

        $numOfRows = $result2->num_rows;
        // echo $_SESSION['orderID'];
        // echo $numOfRows;

        if ($result && ($numOfRows == 0)) {
            $this->connect->commit();
            return true;
        } else {
            $this->connect->rollback();
            return false;
        }
    }

    // Method to get the coupon from the coupon table given a coupon code
    protected function getCouponFromCode($couponCode)
    {
        // Create a sql query that will be used to grab the coupon
        $sql = "SELECT * FROM tbl_coupon
                WHERE coupon_code= '" . $couponCode . "'";

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        // Return results only of the number of rows is greater than zero
        if ($result->num_rows > 0) {

            // echo "Successfully grabed order";
            return $result;
        } else {
            // echo "Could not grab coupon!";
        }
    }

    // Method to check if the coupon has been used by the user
    protected function checkIfCouponUsed($userID, $couponID)
    {
        // Create a sql query
        $sql = "SELECT * FROM tbl_orders
                WHERE tbl_coupon_id_coupon= '" . $couponID . "'AND 
                tbl_users_id_user='" . $userID . "'";

        // Run the query
        $result = $this->connect->query($sql);

        // check to see if the user has already used the coupon
        // if they have, then a row will be returned with the order
        // coupon used
        $numOfRows = $result->num_rows;

        if ($numOfRows > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Method to check if the coupon is for cart or product
    protected function checkCouponType($couponID)
    {
        // Create a sql query that will be used to grab the coupon
        $sql = "SELECT tbl_products_id_products FROM tbl_coupon
                WHERE id_coupon= '" . $couponID . "'";

        // Run the query
        $result = $this->connect->query($sql);

        // Fetch the data into an associative array
        $resultArray = mysqli_fetch_assoc($result);

        $couponType = $resultArray["tbl_products_id_products"];
        // check is the array is empty
        if (! empty($couponType)) {
            $couponType = "PROD";
            return $couponType;
        } else {
            $couponType = "CART";
            return $couponType;
        }
    }

    // Method to check if the coupon is applicable to order
    protected function checkApplicableCoupon($couponID, $orderID, $couponCode)
    {
        // First we have to check if the coupon is a CART or PROD coupon
        $couponType = $this->checkCouponType($couponID);
        // If coupon is CART applicable since its for whole cart discount
        if ($couponType == "CART") {
            return true;
        }
        if ($couponType == "PROD") {
            // iF product coupon we have to make sure the item is actually in our cart

            // Create a sql query that will return row results if there is a match
            // between a ordered product and a coupon
            $sql = "SELECT * FROM tbl_product_ordered
                    INNER JOIN tbl_coupon 
                    ON tbl_product_ordered.tbl_products_id_products = tbl_coupon.tbl_products_id_products
                    WHERE tbl_product_ordered.tbl_orders_id_orders ='" . $orderID . "' AND tbl_coupon.coupon_code =  '" . $couponCode . "'";

            // Run the query
            $result = $this->connect->query($sql);

            $numOfRows = $result->num_rows;

            // if there was more than one result there is an item that can use coupon
            if ($numOfRows > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    // Method to set the coupon for order
    protected function setCoupon($orderID, $couponID)
    {
        // Create a sql query that add the payment to the order
        $sql = "UPDATE tbl_orders SET tbl_coupon_id_coupon = '" . $couponID . "' WHERE id_orders= '" . $orderID . "'";

        // Run the query
        $result = $this->connect->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Method to grab the couopn id for the order
    protected function getCoupnFromOrder($orderID)
    {
        // Create a sql query that adds the payment to the order
        $sql = "SELECT tbl_coupon_id_coupon FROM tbl_orders 
                WHERE id_orders= '" . $orderID . "'";

        // Run the query
        $result = $this->connect->query($sql);

        $numOfRows = $result->num_rows;

        // if there was more than one result
        if ($numOfRows > 0) {
            // Fetch the data into an associative array
            $resultArray = mysqli_fetch_assoc($result);
            return $resultArray;
            ;
        } else {
            //echo "No coupon found for order";
        }
    }

    // Method to grab the coupon details
    protected function getCouponDetails($couponID)
    {
        // Create a sql query that will be used to grab the coupon
        $sql = "SELECT * FROM tbl_coupon
                WHERE id_coupon= '" . $couponID . "'";

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        // Return results only of the number of rows is greater than zero
        if ($result->num_rows > 0) {

            // echo "Successfully grabed order";
            return $result;
        } else {
            // echo "Could not grab coupon!";
        }
    }

    // Method to remove the couopn from the order
    protected function removeCouponFromOrder($orderID)
    {

        // Create a sql query that add the payment to the order
        $sql = "UPDATE tbl_orders SET tbl_coupon_id_coupon = NULL WHERE id_orders= '" . $orderID . "'";

        // echo $sql;

        // Run the query to create a new order
        $result = $this->connect->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

