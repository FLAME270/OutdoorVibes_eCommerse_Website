<!----Milestone 2----

Author:	Tyler Wiggins & Ana Sanchez 
Date:   2/10/2019
File:	NavBar.php
Version: 1.0	 

This file is used for
the nav bar for the 
pages of the website.
_____________________
    VERSIONS
_____________________
-->
<nav
	class="navbar navbar-light navbar-expand-lg fixed-top bg-secondary text-uppercase"
	id="mainNav" style="margin-bottom: 50px">
	<div class="container">
		<a class="navbar-brand js-scroll-trigger" href="#page-top">OutDoorVibez</a>
		<button data-toggle="collapse" data-target="#navbarResponsive"
			class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded"
			aria-controls="navbarResponsive" aria-expanded="false"
			aria-label="Toggle navigation">
			<i class="fa fa-bars"></i>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="nav navbar-nav ml-auto">
				<li class="nav-item mx-0 mx-lg-1" role="presentation"><a
					class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
					href="../index.php">Home</a></li>
				<li class="nav-item mx-0 mx-lg-1" role="presentation"><a
					class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
					href="ViewProducts.php">Products</a></li>
					<?php 
					//Start the session
					include_once 'Header.php';
					//If there is a user login in we display log out istead of login 
					if(!isset($_SESSION['username2'])){
					    ?>
					<li class="nav-item mx-0 mx-lg-1" role="presentation"><a
					class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
					href="Login.php">Login</a></li>
					<li class="nav-item mx-0 mx-lg-1" role="presentation"><a
					class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
					href="Register.php">Register</a></li>
					<?php 
					}
					else{
					    ?>
					  <li class="nav-item mx-0 mx-lg-1" role="presentation"><a
					   class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                       href="../pages/LogOut.php">Logout</a></li>
                       
                       <?php if(($_SESSION['role']) === "admin"){?>
                       <li class="nav-item mx-0 mx-lg-1" role="presentation"><a
					   class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                       href="../pages/AdminHome.php">User</a></li>
                       <?php }else{ 
                       ?>
					<li class="nav-item mx-0 mx-lg-1" role="presentation"><a
					   class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                       href="../pages/LoginSuccessful.php">User</a></li>
                       <?php 
					}
					}
					?> 
				<li class="nav-item mx-0 mx-lg-1" role="presentation">
					<a href="ShoppingCart.php"><img src="../assets/img/cart.png"class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
					style="height: 80px; weight:80px"></a></li>
			</ul>
		</div>
	</div>
</nav>