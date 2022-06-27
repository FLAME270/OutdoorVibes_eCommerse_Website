<?php 
/*----Milestone 5----
 *
 * Author:  Tyler Wiggins & Ana Sanchez 
 * Date:    4/4/2019
 * File:    OrderCompleted.php
 * Version: 1.0
 *
 * Script that is used to display
 * the confirmed order and recipt. 
______________________________
         VERSIONS
  
______________________________
 */
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>Thank you!- eCommerce</title>
<!-- Accessing the bootstrap, jquery,  and javascript-->
<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
<link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
<link rel="stylesheet"
	href="../assets/css/Registration-Form-with-Photo.css">
<link rel="stylesheet"
	href="../styles/StyleForProducts.css">
</head>

<!--  BOdy of our website -->
<body id="page-top">
	<!-- Nav bar outputted! -->
	<?php include '../includes/NavBar.php';
	// Require statement for all classes
	require_once '../classes/AutoLoader.php';
	
	// Start the session
	require_once 'Header.php';?>
	<!-- End of our nav bar  -->

	<!-- Start of the header of the website, which actually holds most of the content of the website. -->
	<header class="masthead bg-primary text-white text-center">
	<h3>Order Completed</h3>
		<h5>Thank you, <?php echo $_SESSION['username2']?>!</h5>
		<?php 
		//Grab order details 
		//Connect to the database 
		$dbConnect = new DbConnect();
		$connection = $dbConnect->connect();
		
		//Make a shoppping cart class 
		$shoppingCart = new Cart($connection);
		//Call the get order detail 
		$datas = $shoppingCart->get_Order($_SESSION['orderID']);
		$data = $datas[0];
		
		//Call the get shipping address method from the order 
		$datas1 = $shoppingCart->get_Shipping_From_order($_SESSION['orderID']);
		$data1 = $datas1[0];
		?>
		<br>
		<br>
		<h5>Order Details</h5>
		<p>Order Number: <?php echo $data['id_orders'];?></p>
		<p>Order Date:   <?php echo $data['date_of_order'];?></p>
		<br>
		<br>
		<h5>Shipping</h5>
		<p><?php echo $data1['street']; echo " "; echo $data1['city']; echo " " ; echo $data1['state'];?></p>
		<p><?php echo $data1['country']; echo " "; echo $data1['zip_code'];?>
		<br>
		<br>
		<h5>Summary</h5>
		<p>Product Total: $<?php echo $data['order_total'];?></p>
		<p>Discount:      $<?php echo $data['coupon_discount'];?></p>
		<p>Tax:           $<?php echo $data['order_tax'];?></p>
		<p>Shippping:     $10.00</p>
		<p>Total:         $<?php echo (($data['order_total'] + $data['order_tax']) + 10.00);?></p>
		<?php 
		//unset the session variable for the orderID 
		unset($_SESSION['orderID']);
		//close the database 
		$connection->close();
		
		?>
	</header>
	<!-- End of the header of the website, which actually holds most of the content of the website. -->

	<!--  Start of the footer of the website -->
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
	<!--  End of the footer of the website -->

	<!-- Start of the copywrite footer of the webiste -->
	<div class="copyright py-4 text-center text-white">
		<div class="container">
			<small>Copyright ©&nbsp;eCommerce 2018</small>
		</div>
	</div>
	<!-- End of the copywrite footer of the webiste -->

	<!-- Start of div with Class for when the user scrolls to the bottom of the webiste, changes the view of the navbar -->
	<div class="d-lg-none scroll-to-top position-fixed rounded">
		<a class="d-block js-scroll-trigger text-center text-white rounded"
			href="#page-top"><i class="fa fa-chevron-up"></i></a>
	</div>
	<!-- End of div with Class for when the user scrolls to the bottom of the webiste, changes the view of the navbar -->
	<!-- Assets, javascrip and jquery for the website -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
	<script src="assets/js/freelancer.js"></script>
	
</body>

</html>