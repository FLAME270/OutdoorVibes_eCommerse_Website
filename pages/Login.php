<!----Milestone 2----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   2/10/2019
File:	Login.php
Version: 1.1	 

This file is used to connect 
for the front end of the 
login form, contains 
a POST method to 
LoginHandler.php.
_____________________
    VERSIONS
_____________________
2/10 V1.1: Refactored and included the 
           the NavBar with an include 
           statement. 
 
-->



<!DOCTYPE html>
<html>
<!-- Head of the website wih the information with the links to bootstrp -->
<head>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>Login - eCommerce</title>
<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
<link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
<link rel="stylesheet"
	href="../assets/css/Registration-Form-with-Photo.css">
</head>
<!-- Start of the body of the webiste -->
<body id="page-top">
	<!-- Outputting the nav bar  -->
	<?php include '../includes/NavBar.php';
          include 'Header.php';
          
          ?>
	<!-- End of the the nava bar -->

	<!-- Div for the login form and container  -->
	<div class="register-photo" style="background-color: #18bc9c;">
		<!-- Login form container starts -->
		<div class="form-container" style="width: 422px; padding: 28px; margin-top:100px">
			<!-- Login for starts -->
			<form action="LoginHandler.php" method="POST"
				style="background-color: #2c3e50;">
				<h2 class="text-center text-white">Login</h2>
				<!--  form group for the username label and input -->
				<div class="form-group">
					<input class="form-control" type="text" name="username"
						placeholder="Username">
				</div>
				<!--  form group for the password label and input -->
				<div class="form-group">
					<input class="form-control" type="password" name="password"
						placeholder="Password">
				</div>
				<!--  form group for the login button-->
				<div class="form-group">
					<button class="btn btn-primary btn-block" type="submit"
						name="submit" style="background-color: #18bc9c;">Login&nbsp;</button>
				</div>
				<a class="already" style="color: white;"
				         href="Register.php">Need an account? Sign
					up!</a>
			</form>
			<!-- End of form  -->
		</div>
		<!-- End of login form container  -->
	</div>
	<!-- End of the container for the login form and container -->

	<!-- Start of the footer -->
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
						<span>We love adventure and we want to help you love it
							too.&nbsp;</span>
					</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- End of the footer -->

	<!-- Div for the copywrite at the bottom of the website -->
	<div class="copyright py-4 text-center text-white">
		<div class="container">
			<small>Copyright ©&nbsp;eCommerce 2018</small>
		</div>
	</div>
	
	<!--  Class for when the user scrools to bottom of the website and nav bar closes -->
	<div class="d-lg-none scroll-to-top position-fixed rounded">
		<a class="d-block js-scroll-trigger text-center text-white rounded"
			href="#page-top"><i class="fa fa-chevron-up"></i></a>
	</div>

<!-- assets and javascript, jquery -->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
	<script src="../assets/js/freelancer.js"></script>
</body>

</html>