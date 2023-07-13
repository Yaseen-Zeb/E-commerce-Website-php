<?php
include "header.php";
?>
	<!--main area-->
	<main id="main" class="main-site">

		<div class="container">

			<div class="wrap-breadcrumb">
				<ul>
					<li class="item-link"><a href="#" class="link">home</a></li>
					<li class="item-link"><span>Thank You</span></li>
				</ul>
			</div>
		</div>
		
		<div class="container pb-60">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2>Thank you for your order</h2>
                    <p>A confirmation email was sent.</p>
                    <a href="index.php" class="btn btn-submit btn-submitx">Continue Shopping</a>
					<?php
					if (isset($_GET["con"])) {
						echo '<a href="order_user_detail.php" class="btn btn-submit btn-submitx">My Orders</a>';
					}
					?>
					
				</div>
			</div>
		</div><!--end container-->

	</main>
	<!--main area-->
	<?php
include "footer.php";
?>