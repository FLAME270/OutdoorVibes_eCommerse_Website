<!----Milestone 2----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   2/10/2019
File:	ViewProducts.php
Layer:  Presentation 
Version: 1.2 

This file is used as 
the front end to see 
the products stored
in the database. 
______________________________
          VERSIONS
    
4/3 V1.1 Fixed formatting 
         issue and spacing.

4/3 V1.2 Added a connection field 
         to enable the use of the same
         connection for the entirely of 
         the class. 
______________________________

-->
<?php 

//Requre statement for products class
require_once '../classes/AutoLoader.php';
require_once 'Header.php';

//Error Checking 
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
		<!-- Make a container for the buttons and search section -->
		<div class="container">
			<h3 style="margin-bottom: 30px">Products</h3>
			<br>
			<br>
			<!-- Starting a row for buttons and search -->
			<div align = "center" class="row">
			
				<!-- Div for next button -->
				<div id="show_next" class="col-sm-6">
				

					<!-- Outputting buttons for flipping through pages of products -->
					<button class="button"
						onclick="window.location.href = 'ViewProducts.php?offset=20';">Next
						20 Products</button>
				</div>
				<!-- Div for previous button -->
				<div id="show_previous" class="col-sm-6">
					<button class="button"
						onclick="window.location.href = 'ViewProducts.php?offset=0';">Previous
						20 Products</button>
				</div>
				<!-- Form to search for products -->
				<form action="productSearch.php" method="post">
					<p style='color: white'>
						Product Search: <input type="text" name="product" size="20"
							style='color: black'>
							<input type="submit" value="Search" class="inputButton"></p>
				
				</form>
			</div>
			<!-- End of a row for buttons and search -->
		</div>
		<!-- End of the container for the buttons and search section -->
		
		<!-- Container and row for product grid  -->
		<div  style="text-align: center" class="container box_color">
			<div class="row">
			<?php 
			$offset = "";
			//Get the offset results 
			if(!isset($_GET['offset']) || ($_GET['offset'] === '0')){
			    //Offset var was not set to set to 0
			    $offset = 0;
			    ?>
			    
			    <!-- Hide the previous button -->
				<style type="text/css">#show_next {display: block;}</style>
				<style type="text/css">#show_previous {display: none;}</style>
			    <?php 
			}
			else if ($_GET['offset'] === '20'){
			    $offset = 20;
			    ?>
			    
			    <!-- Hide the Next button -->
				<style type="text/css">#show_next {display: none;}</style>
				<style type="text/css">#show_previous {display: block;}</style>
			    <?php 
			}
			//make a database connection 
			$dbConnect = new DbConnect();
			$connection = $dbConnect->connect();
			//Make a new instance of the products class
			$product_view = new Products($connection);
			
			//Call the get all products from the fetchProducts class that was inhertited in Products
			$datas = $product_view->get_All_Products_Offset($offset);
			
			$connection->close();
			
			//For each loop to pring each product in a grid like style
			if(!$datas == NULL){
			foreach ($datas as $data) {
    ?>
				<!-- Div for each product grid -->
				<div class="col-sm-3 box_color" style="margin-top: 70px; 
				             margin-left: 70px; marrgin-right: 70px; display: inline-block">
					<!-- Container to hold the name and price and make them even -->
					<div class="container box_color">
						<div class="row" style="height: 120px">
							<div class="divForProducts">
								<h3><?php echo $data['product_name'];?></h3>
								<p><?php echo $data['price'];?></p>
							</div>
						</div>
					</div>
					<!-- Container ends -->
					<div class="thumbnail">

						<div class="row" style="height: 120px">
							<div class="divForProducts">

								<a
									href="ViewProductDetails.php?product=<?php echo $data['id_products'];?>">
									<img class="productImg" alt=""
									src="<?php echo $data['image_name'];?>">
								</a>

							</div>
						</div>

					</div>
					<div class="container box_color">
						<div class="row" style="height: 250px">
							<div class="divForProducts" style="margin-top: 250px">
								<p class="textForImage"><?php echo $data['short_description'];?></p>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
}
else{
    ?>
    <h3 align= 'center' style="color: white; padding-top: 50px">No Products Found</h3>
    <?php 
}
?>
				
				
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
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
	<script src="assets/js/freelancer.js"></script>
	
</body>

</html>