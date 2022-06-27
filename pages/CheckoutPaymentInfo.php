<!----Milestone 4----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   3/9/2019
File:	CheckoutPaymentInfo.php
Layer:  Presentation 
Version: 1.2	 

This file is used as 
the front end to for
the payment section
of the checkout process.

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
<title>Payment Info - eCommerce</title>
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
	// Used for error checking
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include '../includes/ShoppingNavBar.html';
	      include_once "Header.php";
	      //Require statement for all classes
	      require_once '../classes/AutoLoader.php';
	      
	      //make a connection to database 
	      $dbConnect = new DbConnect();
	      $connection = $dbConnect->connect();
	      
	      //Make a new shopping cart object
	      $shoppingCart = new Cart($connection);
	      
	      //If the user is logegd in
	      if(isset($_SESSION['userID'])){
	          //Grab the payments that belong to them
	          $datas = $shoppingCart->get_Payments($_SESSION['userID']);
	          $datas1 = $shoppingCart->get_Billings($_SESSION['userID']);
	          
	      }
	     
	      
	      
	      
	?>
	<!-- End of our nav bar  -->

	<!-- Start of the header of the webiste that hold most of the information for the website -->
	<header class="masthead bg-primary text-white text-center"
		style="color: #18bc9c;">
		<!-- Div that holds the header title -->
		<div>
			<h1 class="display-1" style='margin-bottom: 30px'>Payment Info</h1>
		</div>

		<!-- Containter that all of the the payment info -->
		<div class="container">
			<div class="shopping-cart">
				<div class="px-4 px-lg-0">
					<div class="pb-5">
						<div class="container">
							<div class="row py-5 p-4 bg-white rounded shadow-sm">
							
								<!-- First column in container to grab existing payments -->
								<div class="col-lg-6">
									<div
										class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
										style="color: black">Existing Payments</div>
										
									<!-- Selector for the payments pulled from the database -->
									<label style="color: black" for="payments">Choose a Payment:</label><br>
									<form action="SetPayment.php" method="post"
											style="text-align: center">
									<select name="paymentID">
									<!-- If a user is logged in, loop their payments and display each one -->
									<?php if(isset($_SESSION['userID'])){
									    $data = $datas[0];
									    foreach($datas as $data){
									        
									        $cardNum = substr($data['card_number'], -4);
									        
									        ?>
									        
									        <option value="<?php echo $data['id_payment'];?>"><?php echo $data['name_on_card'];echo " " ; echo $cardNum;?></option>
									        
									        
									        <?php 
									    }
									}?>
										
									</select>
									
									<!-- Button to select the payment for the order -->
<!-- 										<form action="SetPayment.php" method="post" target="_self" 
											style="text-align: center">-->
												<br><button type="submit"
													class="btn btn-dark px-3 rounded-pill"
													style="text-align: center; top-margin: 100px">Use this Payment</button>
<!-- 											<input type="hidden" name="addressID" -->
<!-- 												value=""> -->
										</form>
										<br>
										<!-- Section for coupon entry -->
										<div>
											<label style="color: black" for="payments">Enter a Coupon:</label><br>
											<form action="SetCoupon.php" method="POST">
  												<input type="text" name="couponCode" ><br>
  												<button type="submit"
													class="btn btn-dark px-3 rounded-pill"
													style="text-align: center; top-margin: 100px">Use this Coupon</button>
											</form>
										</div>
										<!-- Section for already selected payment -->
										<div
										class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
										style="color: black">Utilized Payment</div>
										<br>
										<?php 
										$datas = $shoppingCart->get_Payment_From_order($_SESSION['orderID']);
										if(!$datas == NULL){
										
										$data = $datas[0];
										
										$cardNum = substr($data['card_number'], -4);
										
										//GET COUPON FROM ORDER 
										
										
										?>
										<p style="color: black"><?php echo "Name on Card: "; echo $data['name_on_card'];?></p>
										<br>
										<p style="color: black"><?php echo "last four of Card: "; echo $cardNum;?></p>
										<?php }
										else{?>
										    <p style="color: black">No payment found for order</p>
										<?php }?>
										
										<div
										class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
										style="color: black">Utilized Coupon</div>
										<br>
										<?php 
										//Check if there is a coupon
										$couponID = $shoppingCart->get_Coupon_From_Order($_SESSION['orderID']);
										
										//IF the order has a coupon set up
										if(!$couponID == NULL)
										{
										    $datas2 = $shoppingCart->get_Coupon_Details($couponID);
										    $data2 = $datas2[0];
										    $couponCode = $data2['coupon_code'];
										    $amountOff = $data2['coupon_off'] * 100;
										    $message = $couponCode . ": " . $amountOff . "% OFF <br>" . $data2['coupon_description'];
										}
										else{
										    $message = "No coupon applied";
										}
										
                                         
										?>
										<p style="color: black"><?php echo $message;?></p>
								</div>
								<!-- Second column to add new payment -->
								<div class="col-lg-6">
									<div
										class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
										style="color: black">Add a New Payment</div>
									<form action="AddPayment.php" method="post" target="_self">
										<label style='color: black'>Payment Type:</label><br>
										<input type="text" name="paymentType" placeholder="Debit/Credit"value=""><br>
										<label style='color: black'>Card Number:</label><br> 
										<input type="text" name="cardNumber" placeholder="#######" value=""><br>
										<label style='color: black'>Security Code:</label><br>
									    <input type="text" name="securityCode" placeholder="ex: CVV/CCV" value=""><br>
									    <label style='color: black'>Expiration Date:</label><br>
										<input type="text" name="expirationDate" placeholder="00/00" value=""><br>
										<label style='color: black'>Name on Card:</label><br>
										<input type="text" name="nameOnCard" placeholder="First Last" value=""><br>
										<br><button name="addPayment" type="submit"class="btn btn-dark px-3 rounded-pill" 
											style="text-align: center">Add new Payment and Use</button>>
									</form>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>


<!-- Containter that all of the the billing info -->
		<div class="container">
			<div class="shopping-cart">
				<div class="px-4 px-lg-0">
					<div class="pb-5">
						<div class="container">
							<div class="row py-5 p-4 bg-white rounded shadow-sm">
							
								<!-- First column in container to grab existing billing addresses -->
								<div class="col-lg-6">
									<div
										class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
										style="color: black">Existing Billing Addresses</div>
										
									<!-- Selector for the payments pulled from the database -->
									<label style="color: black" for="billing">Choose a Billing Address:</label><br>
									<form action="SetBilling.php" method="post" target="_self"
											style="text-align: center">
									<select name="billingID">
									<!-- If a user is logged in, loop their billings and display each one -->
									<?php if(isset($_SESSION['userID'])){
									    $data2 = $datas1[0];
									    foreach($datas1 as $data2){
									        ?>
									        
									        <option value="<?php echo $data2['id_billing'];?>"><?php echo $data2['street'];
									           echo ", " ; echo $data2['unit_number'];?></option>
									        
									        
									        <?php 
									    }
									}?>
									</select><br>
										
									<!-- Button to select the payment for the order -->
												<br><button id="billingSelected" type="submit"
													class="btn btn-dark px-3 rounded-pill"
													style="text-align: center; top-margin: 100px">Use this Billing Address</button>
												<!--<input type="hidden" name="billingID"  -->
												<!--value="BILLING ID FROM ARRAY####">  -->
										</form>
										<br>
										<!-- Section for already selected billing -->
										<div
										class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
										style="color: black">Utilized Billing</div>
										<br>
										<?php 
										$datas2 = $shoppingCart->get_Billing_From_order($_SESSION['orderID']);
										$connection->close();
										if(!$datas2 == NULL){
										$data3 = $datas2[0];
										
										?>
										<p style="color: black"><?php echo $data3['street']; echo " ";?></p>
										<p style="color: black">Unit Number: <?php echo $data3['unit_number']?>
										<br>
										<p style="color: black"><?php echo $data3['city']; echo " ";
										                          echo $data3['state']; echo " ";
										                          echo $data3['zip_code'];?></p>
										<p style="color: black"><?php echo $data3['country'];
										}else{ ?>
										    <p style="color: black">No billing found for order</p>
										<?php } ?>
								</div>
								
								<!-- Second column to add new billing address -->
								<div class="col-lg-6">
									<div
										class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold"
										style="color: black">Add a New Billing Address</div>
									<form action="AddBilling.php" method="post" target="_self">
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
										<br><button name="addBilling" type="submit"class="btn btn-dark px-3 rounded-pill" 
											style="text-align: center">Add new Billing Address and Use</button>
									</form>
									<br>
									<br>
									<a href="CheckoutConfirm.php" class="btn btn-dark rounded-pill py-2 btn-block">Procceed
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
