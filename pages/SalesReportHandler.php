<!----Milestone 6----

Authors: Ana Sanchez & Tyler Wiggins 
Date:   4/12/2019
File:   SalesReportHandler.php
Layer:  Presentation 
Version: 1.0	 

This file is used as 
the handler to generate 
a sales report.
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
    <title>Admin - Sales Report</title>
    <!-- Accessing the bootstrap, jquery,  and javascript-->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic">
        <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet"
        href="assets/css/Registration-Form-with-Photo.css">
        <link rel="stylesheet" href="../assets/css/Data-Table-1.css">
        <link rel="stylesheet" href="../assets/css/Data-Table.css">
        <link rel="stylesheet"
            href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
            </head>
            
            <!--  BOdy of our website -->
            <body id="page-top">
            <!-- Nav bar outputted! -->
            <?php
            include '../includes/NavBar.html';
           
            // Used for error checking
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            
            //Require statement for all classes
            require_once '../classes/AutoLoader.php';
            
            //Grab the posts from the form
            $date1 = $_POST['startDate'];
            $date2 = $_POST['endDate'];
            
            //Create a connection to the database
            $dbConnect = new DbConnect();
            $connection = $dbConnect->connect();
            
            //Make a sales management obj
            $sales = new SalesManagement($connection);
            $product = new Product($connection);
            
            //Grab the array  that has all the sales between the two objects
            $datas = $sales->getSales($date1, $date2);
            ?>
	<!-- End of our nav bar  -->

	<!-- Make a container for the title for UserAdministration -->
	<header class="masthead bg-primary text-white text-center"
		style="color: #18bc9c;">
		<div>
			<h3 class="display-3">Sales Report Generated</h3>
			<p style="text-align: center">Sales between <?php echo $date1;?> - <?php echo $date2;?></p>
			<form method= "post" action = "SalesReportData.php">
			<input type="hidden" name="startDate"
				value="<?php echo $date1;?>">
			<input type="hidden" name="endDate"
				value="<?php echo $date2;?>">
			<input type= "submit" value="Generate Data">
			</form>
		</div>

		<!-- Start of the table and its container -->
		<div class="container">
			<table id="example" class="table table-striped table-bordered"
				cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Product Ordered ID</th>
						<th>Product ID</th>
						<th>Quantity</th>
						<th>Product Price</th>
						<th>Total Product Price</th>
					<!--<th>Delete</th> -->
					</tr>
				</thead>
				<tbody>
            <?php
            
            //for each loop to display each user as row and each item as a table item
            foreach ($datas as $data) {
                $data2 = $product->get_Product($data['tbl_products_id_products']);
                $datas2 = $data2[0];
                $productName = $datas2['product_name'];
                echo "<tr>";
                echo "<td style='text-align: left'>" . $productName . "</td>";
                echo "<td style='text-align: left'>" . $data['id_product_ordered'] . "</td>";
                echo "<td style='text-align: left'>" . $data['tbl_products_id_products'] . "</td>";
                echo "<td style='text-align: left'>" . $data['quantity'] . "</td>";
                echo "<td style='text-align: left'>" . "$" . $data['product_price'] . "</td>";
                echo "<td style='text-align: left'>" . "$" . $data['total_product_price']  . "</td>";
                echo "</tr>";
                
                
            }
            
            //Close the database
            $connection->close();
            ?>
        </tbody>
			</table>
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
	<!-- Start of the copywrite footer of the webiste -->

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
	<script
		src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script
		src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
	<script src="../assets/js/freelancer.js"></script>
</body>

</html>