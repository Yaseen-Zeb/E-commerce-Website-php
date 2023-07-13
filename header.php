<?php

include "cart_manage_class.inc.php";
$cart_obj = new cart();
include "Database/DB.inc.php";
$obj = new database();
$reg_path = "";
if (isset($_GET["sess"])) {
	$_SESSION["to_checkout"] = "ok";
	$reg_path = "register.php?sess=ok";
}else{
	$reg_path = "register.php";
}
$chk_path = "";
if (isset($_SESSION["login"])) {
	$chk_path ="checkout.php";
}else{
	$chk_path ="login.php?sess=ok";
}
$log_path = "";
if (isset($_GET["sess"])) {
	$log_path ="login.php?sess=ok";
}else{
	$log_path ="login.php";
}
// wishlist item delete logic start
if (isset($_GET["id"]) && isset($_GET["operation"])) {
    $id = $_GET["id"];
 if ($_GET["operation"] = "delete") {
   $obj->SQL("DELETE FROM wishlist WHERE w_id = $id");
   $obj->getResult();
  ?>
  <script>
 window.location.href = "wishlist.php";
  </script>
  <?php
}
}  


// wishlist item delete logic end
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>	
	
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open%20Sans:300,400,400italic,600,600italic,700,700italic&amp;subset=latin,latin-ext" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/chosen.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/color-01.css">
    <link rel="stylesheet" type="text/css" href="assets/css/flexslider.css">
	<link rel="stylesheet" href="assets/css/BOOSTRAP.css">
	<link rel="stylesheet" href="css/style.css">
	<style>
		td{
			font-size: medium;
		}

		.nav_active{
			background-color:red;
		}

		.detail-media .flex-control-nav .owl-nav button{
			display:none
		}
		.flex-control-thumbs img{
			height : 115px;
		}
		#comments .commentlist li{
			margin-bottom:30px;
		}
		
		
	</style>
</head>
<body class="home-page home-01 ">

	<!-- mobile menu -->
    <div class="mercado-clone-wrap">
        <div class="mercado-panels-actions-wrap">
            <a class="mercado-close-btn mercado-close-panels" href="#"></a>
        </div>
        <div class="mercado-panels"></div>
    </div>

	<!--header-->
	<header id="header" class="header header-style-1">
		<div class="container-fluid">
			<div class="row">
				

				<div class="container">
					<div class="mid-section main-info-area">

						<div class="wrap-logo-top left-section">
							<a href="index.php" class="link-to-home">
								<img src="assets/images/logo-top-1.png" alt="mercado"></a>
						</div>

						<div class="wrap-search center-section">
							<div class="wrap-search-form">
								<form action="shop.php" id="form-search-top" name="form-search-top" method="get">
									<input type="text" name="search" value="" placeholder="Search here...">
									<button form="form-search-top" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
								</form>
							</div>
						</div>

                        

                        <div class="wrap-icon right-section" style="display: flex;align-items: center;justify-content: space-evenly;height: 100%;width: auto;;">
							<div class="dropdown">
								<div style="width: 95px;" class="wrap-icon-section minicart dropdown-toggle"  id="triggerId" data-toggle="dropdown" aria-haspopup="true"
								aria-expanded="false">
								<a href="#" class="link-direction">
									<i class="fa fa-user"></i>
									<div class="left-info">
										<span class="index">Hi</span>
										<span class="title">
											<?php if(isset($_SESSION["login"]))
											echo $_SESSION["user_name"];
											else
											echo "User";
											?>
										</span>
									</div>
								</a>
							</div>
								<div class="dropdown-menu" style="min-width: 120px;" aria-labelledby="triggerId">
								<?php if(!isset($_SESSION["login"]))
											echo '<div style="min-width: 70px; padding-left: 5px;"><a style="color: black;" class="dropdown-item" href="'.$reg_path.'">Register</a></div>
											<div style="min-width: 70px; padding-left: 5px;"><a style="color: black;" class="dropdown-item" href="'.$log_path.'">login</a></div>';
											else 
											echo '<div style="min-width: 70px; padding-left: 5px;"><a style="color: black;" class="dropdown-item" href="php_files/logout.php">logout</a></div>
											<div style="min-width: 70px; padding-left: 5px;"><a style="color: black;" class="dropdown-item" href="order_user_detail.php">My orders</a></div>';
											?>
									
									
								</div>
							</div>

							<div style="width: 95px;" class="wrap-icon-section wishlist">
								<a href="wishlist.php" class="link-direction">
									<i class="fa fa-heart" aria-hidden="true"></i>
									<div class="left-info">
										<?php
										if (isset($_SESSION["user_email"])) {
											$user_email = $_SESSION["user_email"];
											$obj->select("wishlist","*",null,"user_email = '$user_email'");
										 $w_count = count($obj->getResult()[0]);
										}else{
											$w_count =0;
										}
										 
										?>
										<span class="index"><?php echo $w_count ?> item</span>
										<span class="title">Wishlist</span>
									</div>
								</a>
							</div>

						<div style="width: 95px;" class="wrap-icon-section minicart">
							<a href="cart.php" class="link-direction">
								<i class="fa fa-shopping-basket" aria-hidden="true"></i>
								<div class="left-info">
									<span class="index"><?php echo $cart_obj->countProduct()." items" ?> </span>
									<span class="title">CART</span>
								</div>
							</a>
						</div>
					</div> 


					</div>
				</div>

				<div class="primary-nav-section container-fluid">
						<div class="container">
							<!-- Nav tabs -->
							<ul class="nav" id="navId" >
								<li style="font-size: 15px; font-weight: 700;" class="active">
									<a style="color:white" href="index.php" class="">Home</a>
								</li>

								<!--  -->
								<?php

								$obj->select("categries","*",null,"status = 1");
								$cat_rows = $obj->getResult()[0];
								foreach ($cat_rows as $cat_row) {
									echo'<li style="font-size: 15px; font-weight: 700;" class="DROP">
									<a style="color:white" class="nav-link dropdown-toggle "  href="category.php?id='.$cat_row["id"].'" role="button" aria-haspopup="true" aria-expanded="false">'.$cat_row['name'].'</a>';
									$cat_id =  $cat_row['id'];
									$obj->select("sub_categries","*",null,"cat_id = $cat_id and sub_status = 1");
									$sub_cat_rows = $obj->getResult()[0];
									
									
									if (count($sub_cat_rows) > 0) {
										echo'<div class="dropdown-menu">';
										foreach ($sub_cat_rows as $sub_cat_row) {
									echo'<a style="font-size:larger" class="dropdown-item" href="sub_category.php?id='.$cat_row["id"].'&sub_cat='.$sub_cat_row["sub_id"].'">'.$sub_cat_row["title"].'</a>';

										}
										echo '</div>';
										
									}
									
								echo '</li>';
								}
							
								?>
								<!--  -->
								<li style="font-size: 15px; font-weight: 700;" class="active">
									<a style="color:white" href="contact.php" class="index.php">Contact</a>
								</li>
							</ul>
						</div>
				</div>
			</div>
		</div>
	</header>
					

	

	
	
	