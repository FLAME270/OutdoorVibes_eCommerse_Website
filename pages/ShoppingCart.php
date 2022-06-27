<!----Milestone 4----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   3/9/2019
File:	ShoppingCart.php
Layer:  Presentation 
Version: 1.1	 

This file is used as 
the front end to for
the cart. 
_____________________________________
              VERSIONS
4/3 V1.1 Added a connection and closed
         it. 
_____________________________________

-->


<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>Shopping Cart - eCommerce</title>
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
	<?php include '../includes/NavBar.php';?>
	<!-- End of our nav bar  -->
	<?php 
	//Lets include all pages needed 
	
	//Require statement for all classes
	require_once '../classes/AutoLoader.php';
	
	//Start the session
	require_once 'Header.php';

	?>
	
	<!-- Start of the header of the webiste that hold most of the information for the website -->
	<header class="masthead bg-primary text-white text-center"
		style="color: #18bc9c;">
		<!-- Div that holds the header title -->
		<div>
			<h1 class="display-1" style= 'margin-bottom: 30px'>Shopping Cart</h1>
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
								<!-- If there is a orderID session varibale then we can display the order 
								    and send request to grab it otherwise do not request -->
								<?php  if(isset($_SESSION['orderID']))
								{
								    //Create a database connection
								    $dbConnect = new DbConnect();
								    $connection =  $dbConnect->connect();
								    //Make a new shopping cart object
								    $shoppingCart = new Cart($connection);
								    //Make a new products object
								    $product = new Products($connection);
								    
								    //Call the method to grab the products from order
								    $datas = $shoppingCart->get_Order_Products($_SESSION['orderID']);
								    $data="";
								   
								    //If there are products in the cart
								    if(!$datas == NULL){
								    $data = $datas[0];
								    $totalPrice = 0;
								    
								    
								    
								    //Calculate the total price of the order
								    foreach ($datas as $data){
								        $totalPrice = $totalPrice + $data['total_product_price'];
								    }
								    
								    //Update the order and the tax
								    $shoppingCart->update_Total($_SESSION['orderID'], $totalPrice);
								    $shoppingCart->update_Tax($_SESSION['orderID'], $totalPrice);
								    
								    //Get the order with the new updated values
								    $datas3 = $shoppingCart->get_Order($_SESSION['orderID']);
								    $data3 = $datas3[0];
								    ?>

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
											
											<?php 
											    foreach ($datas as $data){
											    $datas2 = $product->getProductDetails($data['tbl_products_id_products']);
											    $data2 = $datas2[0];
											    
											    
											?>
												<tr>
												<!-- First row of the table body -->
													<th scope="row" class="border-0">
													<!-- Div that holds picture and information under the picture -->
														<div class="p-2">
														<!-- Image of product -->
															<img
																src="<?php echo $data2['image_name'];?>"
																alt="" width="70" class="img-fluid rounded shadow-sm">
																<!-- Div for the Information for the product name and category -->
															<div class="ml-3 d-inline-block align-middle">
																<h5 class="mb-0">
																<!-- Link with the name of the product that directs us to the product detail page -->
																	<a href="ViewProductDetails.php?product=<?php echo $data['tbl_products_id_products'];?>"
																		class="text-dark d-inline-block align-middle"><?php 
																		      echo $data2['product_name'];?></a>
																</h5>
																	<!-- End of the div that hodls the product name and category -->
															</div>
															<!-- End of div that holds the picture and the information -->
														</div>
													</th>
													<!-- Table data for the price, quantity, and form button to delete -->
													<td class="border-0 align-middle"><strong><?php echo $data['product_price'];?></strong></td>
													<td class="border-0 align-middle"><strong><?php echo $data['quantity'];?></strong></td>
													<td class="border-0 align-middle"><a href="DeleteProductFromCart.php?product=<?php echo $data['id_product_ordered'];?>"
														class="text-dark"><i class="fa fa-trash"></i></a></td>
												</tr>
												<?php  
											    }
												//Close the connection 
												$connection->close();
												?>
											</tbody>
										</table>
									</div>
									<?php }  
									//If there are no products in the cart
									else{
								?>
								 <h5 style="padding-top: 50px; color: black; padding-bottom: 50px">No Products in the cart</h5>
									<?php }?>
									<!-- End -->
								</div>
							</div>
							<?php if(!$data == NULL){?>
                            <!-- Start of the bottom portion of cart, cart total and checkout -->
							<div class="row py-5 p-4 bg-white rounded shadow-sm">
								<div class="col-lg-6" style="text-align: center">
									<div
										class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold" style='color: black'>Order
										summary</div>
									<div class="p-4">
										<p class="font-italic mb-4"style='color: black'>Shipping and additional costs are
											calculated based on values you have entered.</p>
										<ul class="list-unstyled mb-4">
											<li class="d-flex justify-content-between py-3 border-bottom" style='color: black'><strong
												class="text-muted">Order Subtotal </strong><strong>$<?php echo $data3['order_total'];?></strong></li>
											<li class="d-flex justify-content-between py-3 border-bottom" style='color: black'><strong
												class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li>
											<li class="d-flex justify-content-between py-3 border-bottom" style='color: black'><strong
												class="text-muted">Tax</strong><strong>$<?php echo $data3['order_tax'];?></strong></li>
											<li class="d-flex justify-content-between py-3 border-bottom"style='color: black'><strong
												class="text-muted">Total</strong>
												<h5 class="font-weight-bold" style='color: black'>$<?php echo ($data3['order_total'] + $data3['order_tax'] + 10.00);?></h5></li>
										</ul>
										<a href="CheckoutShippingInfo.php" class="btn btn-dark rounded-pill py-2 btn-block">Procceed
											to checkout</a>
									</div>
								</div>
							</div>
							<?php }?>
							

						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
								}
							else {?>
								<h5 align= 'center' style="color: black; padding-top: 50px">Your adventure hasn't started yet...</h5>
								<p style="padding-top: 50px"><a href = "ViewProducts.php">Get started</a></p>
							<?php 
							}
							?>
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
