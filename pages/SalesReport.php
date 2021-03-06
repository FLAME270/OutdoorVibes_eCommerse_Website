<!----Milestone 6----

Authors: Ana Sanchez & Tyler Wiggins 
Date:   4/12/2019
File:   SalesReport.php
Layer:  Presentation 
Version: 1.0	 

This file is used as 
admin page for sales 
reports.
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
    <title>Sales Report- eCommerce</title>
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
			<?php 
		if($_SESSION['role'] != 'admin'){
        die("Invalid entry");
        }?>
	<h3>Sales Report</h3>
		<h5>Welcome, <?php echo $_SESSION['username2']?>!</h5>
		<!-- Code fo the form that will ask for a start and end date -->
			<div class="register-photo" style="background-color: #18bc9c">
		<div class="form-container" style="width: 422px; padding: 28px; margin-top:26px">
			<form action="SalesReportHandler.php" method="post"
				style="background-color: #2c3e50;">
				<h2 class="text-center text-white">
					<strong>Enter</strong> Dates
				</h2>
				<div class="form-group">
					<input class="form-control" type="text" name="startDate"
						placeholder="start date">
				</div>
				<div class="form-group">
					<input class="form-control" type="text" name="endDate"
						placeholder="end date">
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block" type="submit"
						name="submit" style="background-color: #18bc9c;">Complile Report</button>
				</div>
			</form>
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
			<small>Copyright ??&nbsp;eCommerce 2018</small>
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