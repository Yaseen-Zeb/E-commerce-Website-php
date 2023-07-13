<?php
$total = 0;

include "header.php";
if (!isset($_SESSION["cart"]) || count($_SESSION["cart"])<=0) {
	?>
	<script>
		 window.location.href="cart.php";
	</script>
	<?php
}
if (isset($_SESSION["to_checkout"])) {
    unset($_SESSION["to_checkout"]);
}
if (isset($_SESSION["login"])) {
    unset($_SESSION["to_checkout"]);
}else{
	?>
	<script>
		 window.location.href="login.php";
	</script>
	<?php
}
$total_price = 0;
?>
	<!--main area-->
	<main id="main" class="main-site">
		<div class="container">
			<div class=" main-content-area">
			<div class="summary summary-checkout ">
				<div class="wrap-address-billing" style="display: flex;
    flex-direction: column;">
					<h3 class="box-title">Billing Address</h3>
                    <form action="#" name="frm-billing" class="checkout_form form">
						<p class="row-in-form">
							<label for="phone">Phone number<span>*</span></label>
							<input required id="phone" type="number" name="phone" value="" placeholder="10 digits format">
						</p>
						<br>
						<p class="row-in-form">
							<label for="country">Country<span>*</span></label>
							<input required id="country" type="text" name="country" value="" placeholder="United States">
						</p>
						<br>
						<p class="row-in-form">
							<label for="zip-code">Postcode / ZIP:</label>
							<input required id="zip-code" type="number" name="pin_code" value="" placeholder="Your postal code">
						</p>
						<br>
						<p class="row-in-form">
							<label for="city">Town / City<span>*</span></label>
							<input required id="city" type="text" name="city" value="" placeholder="City name">
						</p>
						<br>
						<p class="row-in-form">
							<label for="add">Address:</label>
							<input required id="add" type="text" name="add" value="" placeholder="Street at apartment number">
						</p>
						
					
				</div>
				
					<div class="summary-item payment-method">
						<h4 class="title-box">Payment Method</h4>
						<p class="summary-info"><span class="title">Check / Money order</span></p>
						<p class="summary-info"><span class="title">Credit Cart (saved)</span></p>
						<div class="choose-payment-methods">
							<label class="payment-method">
								<input required name="payment-method" id="payment-method-bank" value="bank" type="radio">
								<span>Direct Bank Transder</span>
								<span class="payment-desc">But the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</span>
							</label>
							<label class="payment-method">
								<input required name="payment-method" id="payment-method-visa" value="COD" type="radio">
								<span>COD</span>
								<span class="payment-desc">There are many variations of passages of Lorem Ipsum available</span>
							</label>
							<label class="payment-method">
								<input required name="payment-method" id="payment-method-paypal" value="paypal" type="radio">
								<span>Paypal</span>
								<span class="payment-desc">You can pay with your credit</span>
								<span class="payment-desc">card if you don't have a paypal account</span>
							</label>
						</div>
						
						<input required  class="btn btn-medium" type="submit" onclick="manage_order()"  value="Place order now">
						<div class="alert alert-danger checkout_error d-none"></div>
					</div>
					
					
					<div class="summary-item shipping-method">
					<div class="wrap-iten-in-cart" style="margin-top:-520px">
					<h3 class="box-title">Your Order</h3>
					<ul class="products-cart">
					<?php
					// show_arr($_SESSION["cart"]);
				if (isset($_SESSION["cart"])) {
					foreach ($_SESSION["cart"] as $key => $value) {
						foreach ($value as $k => $v) {
							$obj->select("products","*","product_attributes on products.P_id = product_attributes.product_id","P_id = $key AND p_att_id = $k");
							$all_related_rows_of_session[] = $obj->getresult();
							$qty[] = $v["qty"];
						}
					}
					$i = 0;
					foreach ($all_related_rows_of_session as  $row) {
					?>
						<li class="pr-cart-item">
							<div class="product-image">
								<figure><img src="<?php echo "admin/upload/".$row[0][0]["img"]; ?>" alt=""></figure>
							</div>
							<div class="product-name">
								<a class="link-to-product" href="#"><?php echo $row[0][0]["P_name"]; ?></a>
							</div>
							<div class="price-field produtc-price"><p class="price"><?php echo "Rs.".$row[0][0]["product_price"]; ?></p></div>
							<div class="delete">
								<input required type="hidden" value="<?php echo $qty[0] ?>" id="qty<?php echo $row[0][0]['p_att_id'] ?>">
									<i style="font-size:22px;color:red;cursor:pointer" class="fa fa-trash" onclick="manage_cart(<?php echo $row[0][0]['P_id']?>,'delete','FromCheckoutPage',<?php echo $row[0][0]['p_att_id'] ?>)"></i>
							</div>
						</li>
						<?php
						$total_price += ($qty[$i] * $row[0][0]["product_price"]);
						$i++;
						}}
						?>
						<input required type="hidden" name="total_price" value="<?php echo $total_price ?>"></form>
						<li class="pr-cart-item">
							<div class="product-name">
							<h2 style="cursor:pointer">Total Price</h2>
							</div>
							<div class="delete">
									<h2>Rs <?php echo $total_price ?></h2>
									
							</div>
						</li>
																	
					</ul>
				</div>
				
					</div>
					
				</div>

				<div class="wrap-show-advance-info-box style-1 box-in-site">
					<h3 class="title-box">Most Viewed Products</h3>
					<div class="wrap-products">
						<div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label">new</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_17.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item sale-label">sale</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_15.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label">new</span>
										<span class="flash-item sale-label">sale</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_01.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item bestseller-label">Bestseller</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_21.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_03.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item sale-label">sale</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><ins><p class="product-price">$168.00</p></ins> <del><p class="product-price">$250.00</p></del></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_04.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item new-label">new</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>

							<div class="product product-style-2 equal-elem ">
								<div class="product-thumnail">
									<a href="#" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
										<figure><img src="assets/images/products/digital_05.jpg" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
									</a>
									<div class="group-flash">
										<span class="flash-item bestseller-label">Bestseller</span>
									</div>
									<div class="wrap-btn">
										<a href="#" class="function-link">quick view</a>
									</div>
								</div>
								<div class="product-info">
									<a href="#" class="product-name"><span>Radiant-360 R6 Wireless Omnidirectional Speaker [White]</span></a>
									<div class="wrap-price"><span class="product-price">$250.00</span></div>
								</div>
							</div>
						</div>
					</div><!--End wrap-products-->
				</div>

			</div><!--end main content area-->
		</div><!--end container-->

	</main>
	<!--main area-->

	<?php
include "footer.php";
?>