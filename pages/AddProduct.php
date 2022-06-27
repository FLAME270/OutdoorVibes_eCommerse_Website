<!----Milestone 3----

Author:	Tyler Wiggins & Ana Sanchez  
Date:   2/29/2019
File:	AddProduct.php
Version: 1.0	 

This file is used to connect 
for the front end for 
the script that adds
a new product.
_____________________
    VERSIONS
_____________________

 
-->


<!DOCTYPE html>
<html>
<!-- Head of the website wih the information with the links to bootstrp -->
<head>
<meta charset="utf-8">
<meta name="viewport"
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Add Product - Admin</title>
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
        <?php include '../includes/NavBar.php';?>
	<!-- End of the the nava bar -->
	
	<?php
	//Start the session
	session_start();
    
?>
			
	
	<!-- Div for the register form and container  -->
	<div class="register-photo" style="background-color: #18bc9c;">
	
	<div style="text-align: center; margin-top: 50px; margin-bottom:30px">
	<!-- Paragraph to display the admin name -->
	<p style="color: #2c3e50;">Admin: <?php echo $_SESSION['username2']?>.&nbsp;</p>
				<!-- Button to take back to admin home  -->
				<button onclick="location.href='AdminHome.php'"
				class="btn btn-primary text-uppercase text-justify text-secondary border rounded"
				type="button"
				style="margin: 4px; padding: -2px; width: 94px; height: -2px; color: rgb(234, 233, 233); font-size: 11px;">Admin Home
				</button>
				</div>
				<!-- Start of div to hold form -->
		<div class="form-container" style="width: 422px; padding: 28px;">
			<!-- Start of form -->
			<form action="AddProductHandler.php" method="post"
				style="background-color: #2c3e50;">
				<h2 class="text-center text-white">
					<strong>Create </strong>a Product
				</h2>
				<div class="form-group">
					<label style='color: white'>Product Name:</label> 
					<input class="form-control" type="text" name="productname"
						placeholder="Product Name" value= "">
				</div>
				<div class="form-group">
					<label style='color: white'>Price:</label> 
					<input class="form-control" type="number" step="any" name="price"
						placeholder="Price" value= "">
				</div>
				<div class="form-group">
					<label style='color: white'>Image File:</label> 
					<input class="form-control" type="text" name="imagename"
						placeholder="Image File" value= "">
				</div>
				<div class="form-group">
					<label style='color: white'>Short Description:</label> 
					<textarea name="shortdescription" rows="10" 
					cols="30"></textarea>
				</div>
				<div class="form-group">
					<label style='color: white'>Long Description:</label> 
					<textarea name="longdescription" rows="10" 
					cols="30"></textarea>
				</div>
				<div class="form-group">
					<label style='color: white'>Category:</label> 
					<input class="form-control" type="text" name="category"
						placeholder="Category" value= "">
				</div>
				<div class="form-group">
					<label style='color: white'>Sub-category:</label> 
					<input class="form-control" type="text" name="subcategory"
						placeholder="Sub-category" value= "">
				</div>
				<div class="form-group">
					<label style='color: white'>Inventory:</label> 
					<input class="form-control" type="number" name="inventory"
						placeholder="Inventory" value= ">">
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-block" type="submit"
						name="submit" style="background-color: #18bc9c;">Add User</button>
				</div>
			</form>
		</div>
	</div>
	<!--  start of the footer -->
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
	<!-- end of the footer -->

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

	<!-- Reference and links to javascriot and jquery-->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<script
		src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
	<script src="../assets/js/freelancer.js"></script>
</body>

</html>



