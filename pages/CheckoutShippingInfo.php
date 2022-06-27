<!----Milestone 4----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   3/9/2019
File:	CheckoutShippingInfo.php
Layer:  Presentation 
Version: 1.0	 

This file is used as 
the front end to for
the shipping section
of the checkout process.

_____________________
    VERSIONS
_____________________

-->

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>Shipping Info - eCommerce</title>
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
	<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	     include '../includes/ShoppingNavBar.html';
	      include_once "Header.php";
	      //Require statement for all classes
	      require_once '../classes/AutoLoader.php';
	      
	      //Make a database connection
	      $dbConnect = new DbConnect();
	      $connection = $dbConnect->connect();
	      
	      //Make a new shopping cart object 
	      $shoppingCart = new Cart($connection);
	      
	      //If the user is logegd in
	      if(isset($_SESSION['userID'])){
	          //Grab the payments that belong to them
	          $datas = $shoppingCart->get_Shippings($_SESSION['userID']);
	          
	      }
	      //Now lets grab the payments belonging to user 
	?>
	<!-- End of our nav bar  -->

	<!-- Start of the header of the webiste that hold most of the information for the website -->
	<header class="masthead bg-primary text-white text-center"
		style="color: #18bc9c;">
		<!-- Div that holds the header title -->
		<div>
			<h1 class="display-1" style='margin-bottom: 30px'>Shipping Info</h1>
		</div>

<!-- Containter that all of the the shipping info -->
		<div class="container">
			<div class="shopping-cart">
				<div class="px-4 px-lg-0">
					<div class="pb-5">
						<div class="container">
							<div class="row py-5 p-4 bg-white rounded shadow-sm">
							
								<!-- First column in container to grab existing shipping addresses -->
								<div class="col-lg-6">
									<div
										class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
										style="color: black">Existing Shipping Addresses</div>
										
									<!-- Selector for the shipping pulled from the database -->
									<label style="color: black" for="billing">Choose a Shipping Address:</label><br>
									<form action="SetShipping.php" method="post" target="_self"
											style="text-align: center">
									<select name="shippingID">
									<!-- If a user is logged in, loop their shipping and display each one -->
									<?php if(isset($_SESSION['userID'])){
									    $data = $datas[0];
									    foreach($datas as $data){
									        ?>
									        
									        <option value="<?php echo $data['id_shipping'];?>"><?php echo $data['street'];
									           echo ", " ; echo $data['unit_number'];?></option>
									        
									        
									        <?php 
									    }
									}?>
									</select><br>
										
									<!-- Button to select the address for the order -->
												<br><button id="shippingSelected" type="submit"
													class="btn btn-dark px-3 rounded-pill"
													style="text-align: center; top-margin: 100px">Use this Shipping Address</button>
                                                    <!--<input type="hidden" name="shippingID" -->
                                                    <!--value="SHIPPING ID FROM ARRAY####"> -->
										</form>
										<br>
										<!-- Section for already selected billing -->
										<div
										class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
										style="color: black">Utilized Shipping</div>
										<br>
										<?php 
										$datas = $shoppingCart->get_Shipping_From_order($_SESSION['orderID']);
										$connection->close();
										//If we actaully have a shipping on the order already
										if(!$datas == NULL)
										{
										$data = $datas[0];
										
										?>
										<p style="color: black"><?php echo $data['street']; echo " ";?></p>
										<p style="color: black">Unit Number: <?php echo $data['unit_number']?>
										<br>
										<p style="color: black"><?php echo $data['city']; echo " ";
										                          echo $data['state']; echo " ";
										                          echo $data['zip_code'];?></p>
										<p style="color: black"><?php echo $data['country'];
										}
										else{?>
										 <p style="color: black">No Shipping Added to Order</p>
										 <?php 	}?>
									
								</div>
								
								<!-- Second column to add new shipping address -->
								<div class="col-lg-6">
									<div
										class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
										style="color: black">Add a New Shipping Address</div>
									<form action="AddShipping.php" method="post" target="_self">
										<label style='color: black'>Street:</label><br> 
										<input type="text" name="street" placeholder="" value=""><br>
										<label style='color: black'>Unit Number:</label><br> 
										<input type="text" name="unitNumber" placeholder="" value=""><br>
										<label style='color: black'>City:</label><br>
									    <input type="text" name="city" placeholder="" value=""><br>
									    <label style='color: black'>State:</label><br> 
										<input type="text" name="state" placeholder="" value=""><br>
									    <label style='color: black'>Country:</label><br>
										<input type="text" name="country" placeholder="" value=""><br>
										<label style='color: black'>Zip Code:</label><br>
										<input type="text" name="zipCode" placeholder="" value=""><br>
										<label style='color: black'>First Name:</label><br> 
										<input type="text" name="firstName" placeholder="" value=""><br>
										<label style='color: black'>Last Name:</label><br> 
										<input type="text" name="lastName" placeholder="" value=""><br>
										<br><button name="addAddress" type="submit"class="btn btn-dark px-3 rounded-pill" 
											style="text-align: center">Add new Shipping Address and Use</button>
									</form>
									<br>
									<a href="CheckoutPaymentInfo.php" class="btn btn-dark rounded-pill py-2 btn-block">Procceed
											to checkout</a>
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

