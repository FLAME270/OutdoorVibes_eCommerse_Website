<!----Milestone 2----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   2/16/2019
File:	ViewProductDetails.php
Layer:  Presentation 
Version: 1.2	 

This file is used as 
the front end to see 
the individual 
product details. 
______________________________________
              VERSIONS
4/3 V1.1 Added a connection field 
         to enable the use of the same
         connection for the entirely of 
         the class. 
_____________________________________
-->


<?php

// Requre statement for products class
require_once '../classes/AutoLoader.php';
//Require_once for session start
require_once 'Header.php';

// Error Checking
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>Products - eCommerce</title>
<!-- Accessing the bootstrap, jquery,  and javascript-->
<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
<link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
<link rel="stylesheet"
	href="../assets/css/Registration-Form-with-Photo.css">
<link rel="stylesheet" href="../styles/StyleForProducts.css">
</head>

<!--  BOdy of our website -->
<body id="page-top">
	<!-- Nav bar outputted! -->
	<?php include '../includes/NavBar.php';?>
	<!-- End of our nav bar  -->

	<!-- Start of the header of the website, which actually holds most of the content of the website. -->
	<header class="masthead bg-primary text-white text-center">

		<!-- Button to go back to products -->
		<div class="container">
			<button class="button" style="margin-bottom: 50px"
				onclick="location.href='ViewProducts.php'" type="button">Return to
				Products</button>
			<!-- End of Button to go back to products -->

			<!-- Section to used to display the products in a grid -->
			<div class="container box_color">
				<div class="row">
		<?php
//Create a database connection 
$dbConnect = new DbConnect();
$connection = $dbConnect->connect();

// Creating an instance of the products object
$product = new Products($connection);

// Call the getProductDetails method from the object
// We need to grab the product id from the URL parameter that we passed
$datas = $product->getProductDetails($_GET['product']);
$connection->close();

// Place the array valuye in $data so we can use it to extract the details
$data = $datas[0];
?>
		<!-- HTML code that actaully displays the product information -->
					<div class="col-sm-8 box_color">
						<h3><?php echo $data['product_name'];?></h3>
						<div class="thumbnail">
							<p>
								<img alt="" src="<?php echo $data['image_name']; ?>"
									width='450px' height='400px'>
							</p>
						</div>
					</div>
					<!-- Div/Section for the qty and add to cart button -->
					<div class="col-sm-4 box_color">

						<!-- Form for the add to cart -->
						<form action="AddToCart.php" method="post" target="_self">
							<br> <br> <br>
							 <p><?php echo "$" . $data['price'];?></p>
							<input type="hidden" type="number" step="any" name="price" value="<?php echo $data['price'];?>">
							Qty: <input type="number" step= 1 name="qty" value =1 size="3"><br> <br> <input
								class="inputButton" type="submit" value="Add to Cart"><br> <input type="hidden"
								name="product_id" value="<?php echo $data['id_products'];?>"><br>
							<br><br>
							<p><?php echo $data['long_description'];?></p>
						</form>
					</div>
				</div>
			</div>
		</div>
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
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
	<script src="../assets/js/freelancer.js"></script>

</body>

</html>