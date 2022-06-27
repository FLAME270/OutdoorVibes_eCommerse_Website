<!----Milestone 4----

Author:	Tyler Wiggins & Ana Sanchez  
Date:   3/9/2019
File:	CheckoutConfirm.php
Layer:  Presentation 
Version: 1.2	 

This file is used as 
the front end to for
the last confirmation
before order is placed.
_____________________________________
              VERSIONS
4/3 V1.1 Added a connection and closed
         it. 
4/21 V1.2 Added functionality for 
          coupon entry.
_____________________________________

-->


<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>Confirm Order - eCommerce</title>
<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
<link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
<link rel="stylesheet" href="../assets/css/Data-Table-1.css">
<link rel="stylesheet" href="../assets/css/Data-Table.css">
<link rel="stylesheet"
	href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
<link rel="stylesheet"
	href="../assets/css/Registration-Form-with-Photo.css">
</head>

<body id="page-top">
	<!-- Nav bar outputted! -->
	<?php include '../includes/ShoppingNavBar.html';
	//Include all the pages needed 
	//Require statement for all classes
	require_once '../classes/AutoLoader.php';
	//Start the session
	require_once "Header.php";
	//Create a database connection
	$dbConnect = new DbConnect();
    $connection = $dbConnect->connect();
    //Make a new shopping cart object 
    //Will be used to grab order details 
    $shoppingCart = new Cart($connection);
    //Make a new product object 
    //Will be used to grab product details 
    $product = new Products($connection);
    
	
    //Call the method to grab the products from order
    $datas = $shoppingCart->get_Order_Products($_SESSION['orderID']);
    $data = $datas[0];
    $totalPrice = 0;
    
    //Calculate the total price of the order
    foreach ($datas as $data){
        $totalPrice = $totalPrice + $data['total_product_price'];
    }
    
    //Calculate the total and tax before applying coupon 
    $shoppingCart->update_Total($_SESSION['orderID'], $totalPrice);
    $shoppingCart->update_Tax($_SESSION['orderID'], $totalPrice);
    
    //Check if there is a coupon 
    $couponID = $shoppingCart->get_Coupon_From_Order($_SESSION['orderID']);
    $couponDiscount = 0.00;
    //IF the order has a coupon set up we must use
    //a process of calculating the total
    if(!$couponID == NULL)
    {
        //Update the order and the tax, update with the coupon
        
        //Check what kind of coupon it is 
        $couponType = $shoppingCart->check_Coupon_Type($couponID);
        //If the couopn is a product coupon
        if($couponType == "PROD"){
            //Get the coupon amount off and the product id for the product used 
            $data = $shoppingCart->get_Coupon_Details($couponID);
            $couponDetails = $data[0];
            $discountAmount = $couponDetails['coupon_off'];
            $productID = $couponDetails['tbl_products_id_products'];
            
            //lets grab the price of the product 
            $data = $product->getProductDetails($productID);
            $productDetails = $data[0];
            $productPrice = $productDetails['price'];
            
            //Lets calculate the amount of the coupon using the product price 
            $couponDiscount = $productPrice * $discountAmount;
            
            //Subtract the amount of the coupon off the total price 
            $totalPrice = $totalPrice - $couponDiscount;
            
            
        }
        //if the coupon is for the whole cart 
        elseif($couponType == "CART"){
            //Lets get the amount off of the coupon
            $data = $shoppingCart->get_Coupon_Details($couponID);
            $couponDetails = $data[0];
            $discountAmount = $couponDetails['coupon_off'];
            
            //Calculate the amount of the coupon using the cart total
            $couponDiscount = $totalPrice * $discountAmount;
            $couponDiscount = round($couponDiscount, 2);
            
            //Now lets calc the total price 
            $totalPrice = $totalPrice - $couponDiscount;
        }
        
    }
    

    
    
    //Call the method to grab the product details such as total and tax
    $datas1 = $shoppingCart->get_Order($_SESSION['orderID']);
    $data1 = $datas1[0];
	
	//Call the method to grab the payment from order 
	$datas2 = $shoppingCart->get_Payment_From_order($_SESSION['orderID']);
	$data2 = $datas2[0];
	
	//Call the method to grab the billing from order 
	$datas3 = $shoppingCart->get_Billing_From_order($_SESSION['orderID']);
	$data3 = $datas3[0];
	
	//Call the method to grab the shippinh from order 
	$datas4 = $shoppingCart->get_Shipping_From_order($_SESSION['orderID']);
	$data4 = $datas4[0];

	?>
	<!-- End of our nav bar  -->
	
	<!-- Start of the header of the webiste that hold most of the information for the website -->
	<header class="masthead bg-primary text-white text-center"
		style="color: #18bc9c;">
		<!-- Div that holds the header title -->
		<div>
			<h1 class="display-1" style= 'margin-bottom: 30px'>Confirm Order</h1>
			<br>
			<br>
			<p class="display-3">Does everything look right?</p>
		</div>
		<!-- Container for the whole cart form/table -->
		<div class="container">
		<!-- Div just for the shopping cart -->
			<div class="shopping-cart">
				<div class="px-4 px-lg-0">

					<div class="pb-5">
						<div class="container">
						<!-- Class that contains the table -->
							<div class="row">
								<div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

									<!-- Shopping cart table -->
									<div class="table-responsive">
										<table class="table">
										<!-- The header of the table -->
											<thead>
												<tr>
													<th scope="col" class="border-0 bg-light">
														<div class="p-2 px-3 text-uppercase">Product</div>
													</th>
													<th scope="col" class="border-0 bg-light">
														<div class="py-2 text-uppercase">Price</div>
													</th>
													<th scope="col" class="border-0 bg-light">
														<div class="py-2 text-uppercase">Quantity</div>
													</th>
													<th scope="col" class="border-0 bg-light">
														<div class="py-2 text-uppercase">Remove</div>
													</th>
												</tr>
											</thead>
											<!-- Body of table starts -->
											<tbody>
											<!-- FOREACH PRODUCT WE ARE GOING TO CREATE A ROW  -->
											<?php foreach ($datas as $data){
											    $datas6 = $product->getProductDetails($data['tbl_products_id_products']);
											    $data6 = $datas6[0];
											    
											    
											    
											    
											?>
												<tr>
												<!-- First row of the table body -->
													<th scope="row" class="border-0">
													<!-- Div that holds picture and information under the picture -->
														<div class="p-2">
														<!-- Image of product -->
															<img
																src="<?php echo $data6['image_name'];?>"
																alt="" width="70" class="img-fluid rounded shadow-sm">
																<!-- Div for the Information for the product name and category -->
															<div class="ml-3 d-inline-block align-middle">
																<h5 class="mb-0">
																<!-- Link with the name of the product that directs us to the product detail page -->
																	<a href="ViewProductDetails.php?product=<?php echo $data['tbl_products_id_products'];?>"
																		class="text-dark d-inline-block align-middle"><?php 
																		      echo $data6['product_name'];?></a>
																</h5>
																	<!-- End of the div that hodls the product name and category -->
															</div>
															<!-- End of div that holds the picture and the information -->
														</div>
													</th>
													<!-- Table data for the price, quantity, and form button to delete -->
													<td class="border-0 align-middle"><strong><?php echo $data['product_price'];?></strong></td>
													<td class="border-0 align-middle"><strong><?php echo $data['quantity'];?></strong></td>
													<td class="border-0 align-middle"><a href="DeleteProductFromConfirm.php?product=<?php echo $data['id_product_ordered'];?>"
														class="text-dark"><i class="fa fa-trash"></i></a></td>
												</tr>
												<?php } 
												
												?>
											</tbody>
										</table>
									</div>
									<!-- End -->
								</div>
							</div>
                                    <!-- Start of the bottom portion of cart, cart total and checkout -->
							<div class="row py-5 p-4 bg-white rounded shadow-sm">
							<div class="col-lg-6">
							<div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold" style='color: black'>Order
										Details</div>
										<?php  
										//The payment info 
										$cardNum = substr($data2['card_number'], -4);
										?>
							<ul class="list-unstyled mb-4">
							<li class="d-flex justify-content-between py-3 border-bottom" style='color: black'><strong
								class="text-muted">Payment:</strong><br><strong><?php echo $data2['payment_type']; echo ": ";
								                            echo $data2['name_on_card']; echo " "; echo $cardNum;?></strong></li>
							<li class="d-flex justify-content-between py-3 border-bottom" style='color: black'><strong
								class="text-muted">Billing Address:</strong><br><strong><?php echo $data3['street'];
								                            echo " "; echo $data3['city']; echo " "; 
								                            echo $data3['country'];?></strong></li>
							<li class="d-flex justify-content-between py-3 border-bottom" style='color: black'><strong
								class="text-muted">Shipping Address</strong><strong><?php echo $data4['street'];
								                            echo " "; echo $data4['city']; echo " "; 
								                            echo $data4['country'];?></strong></li>
							<li class="d-flex justify-content-between py-3 border-bottom" style='color: black'><strong
								class="text-muted"><a href="CheckoutPaymentInfo.php">Edit Payment:</a></strong><br></li>
							<li class="d-flex justify-content-between py-3 border-bottom" style='color: black'><strong
								class="text-muted"><a href="CheckoutPaymentInfo.php">Edit Billing Address</a></strong><br></li>
							<li class="d-flex justify-content-between py-3 border-bottom" style='color: black'><strong
								class="text-muted"><a href="CheckoutShippingInfo.php">Edit Shipping Address</a></strong></li>
							</ul>
						
							</div>
								<div class="col-lg-6">
									<div
										class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold" style='color: black'>Order
										summary</div>
									<div class="p-4">
										<p class="font-italic mb-4"style='color: black'>Shipping and additional costs are
											calculated based on values you have entered.</p>
										<ul class="list-unstyled mb-4">
											<li class="d-flex justify-content-between py-3 border-bottom" style='color: black'><strong
												class="text-muted">Order Subtotal </strong><strong>$<?php echo $data1['order_total'];?></strong></li>
												<li class="d-flex justify-content-between py-3 border-bottom" style='color: red'><strong
												class="text-muted">Coupon</strong><strong><?php echo "- $" .  round($couponDiscount , 2);?></strong></li>
											<li class="d-flex justify-content-between py-3 border-bottom" style='color: black'><strong
												class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li>
												<?php 
												$shoppingCart->update_Total($_SESSION['orderID'], $totalPrice);
												$shoppingCart->update_Tax($_SESSION['orderID'], $totalPrice);
												
												//Update the total again 
												$datas7 = $shoppingCart->get_Order($_SESSION['orderID']);
												$data7 = $datas7[0];
												
												
												//Close the connection
												$connection->close();
												?>
												    
											<li class="d-flex justify-content-between py-3 border-bottom" style='color: black'><strong
												class="text-muted">Tax</strong><strong>$<?php echo $data7['order_tax'];?></strong></li>
											<li class="d-flex justify-content-between py-3 border-bottom"style='color: black'><strong
												class="text-muted">Total</strong>
												<h5 class="font-weight-bold" style='color: black'>$<?php echo ($data7['order_total'] + $data7['order_tax'] + 10.00);?></h5></li>
										</ul>
										<a href="ConfirmOrder.php?couponDiscount=<?php echo $couponDiscount;?>" 
											class="btn btn-dark rounded-pill py-2 btn-block">CHECKOUT</a>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!--  End of the header -->
	</header>
	<!-- Start of footer of website -->
	<footer class="footer text-center">
		<div class="container">
			<div class="row">
				<div class="col-md-4 mb-5 mb-lg-0">
					<h4 class="text-uppercase mb-4">Location</h4>
					<p>TBD</p>
				</div>
				<div class="col-md-4 mb-5 mb-lg-0">
					<h4 class="text-uppercase">Around the Web</h4>
					<ul class="list-inline">
						<li class="list-inline-item"><a
							class="btn btn-outline-light btn-social text-center rounded-circle"
							role="button" href="#"><i class="fa fa-facebook fa-fw"></i></a></li>
						<li class="list-inline-item"><a
							class="btn btn-outline-light btn-social text-center rounded-circle"
							role="button" href="#"><i class="fa fa-google-plus fa-fw"></i></a></li>
						<li class="list-inline-item"><a
							class="btn btn-outline-light btn-social text-center rounded-circle"
							role="button" href="#"><i class="fa fa-twitter fa-fw"></i></a></li>
						<li class="list-inline-item"><a
							class="btn btn-outline-light btn-social text-center rounded-circle"
							role="button" href="#"><i class="fa fa-dribbble fa-fw"></i></a></li>
					</ul>
				</div>
				<div class="col-md-4">
					<h4 class="text-uppercase mb-4">About US</h4>
					<p class="lead mb-0">
						<span>We love adventure and we want to help you love it too.&nbsp;</span>
					</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- End of footer of website -->
	<div class="copyright py-4 text-center text-white">
		<div class="container">
			<small>Copyright ©&nbsp;eCommerce 2018</small>
		</div>
	</div>
	
	<!-- Scripts for javascript, used for animating the flow of site as user scrolls down -->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
	<script
		src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script
		src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
	<script src="../assets/js/freelancer.js"></script>
</body>

</html>

