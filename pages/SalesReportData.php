<?php

// Used for error checking
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Require statement for all classes
require_once '../classes/AutoLoader.php';

//Grab the posts from the form
$date1 = $_POST['startDate'];
$date2 = $_POST['endDate'];

//Create a connection to the database
$dbConnect = new DbConnect();
$connection = $dbConnect->connect();

//Make a sales management obj
$sales = new SalesManagement($connection);
$product = new Product($connection);

//call the method from the data access layer
$datas = $sales->getSales($date1, $date2);
$saleArray = array();
foreach($datas as $data){
    $idProductOrdered = $data['id_product_ordered'];
    $idProduct = $data['tbl_products_id_products'];
    $quantity = $data['quantity'];
    $productPrice = $data['product_price'];
    $totalProductPrice = $data['total_product_price'];
    $datas = $product->get_Product($idProduct);
    $data = $datas[0];
    $oneSale = new Sales($idProductOrdered, $idProduct, 
           $quantity, $productPrice, $totalProductPrice, $data['product_name']);
    
    array_push($saleArray, $oneSale);
}

//Seralize the object into JSON with the pretty print format
$result = json_encode($saleArray,JSON_PRETTY_PRINT);

header('Content-Type: application/json');
echo $result;