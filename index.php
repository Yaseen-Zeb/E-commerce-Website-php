<?php
 include "header.php";
?>

<main id="main">
		<div class="container">

			<!--MAIN SLIDE-->
			<div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
					<div class="item-slide">
						<img src="assets/images/main-slider-1-1.jpg" alt="" class="img-slide">
						<div class="slide-info slide-1">
							<h2 class="f-title">Kid Smart <b>Watches</b></h2>
							<span class="subtitle">Compra todos tus productos Smart por internet.</span>
							<p class="sale-info">Only price: <span class="price">$59.99</span></p>
							<a href="#" class="btn-link">Shop Now</a>
						</div>
					</div>
					<div class="item-slide">
						<img src="assets/images/main-slider-1-2.jpg" alt="" class="img-slide">
						<div class="slide-info slide-2">
							<h2 class="f-title">Extra 25% Off</h2>
							<span class="f-subtitle">On online payments</span>
							<p class="discount-code">Use Code: #FA6868</p>
							<h4 class="s-title">Get Free</h4>
							<p class="s-subtitle">TRansparent Bra Straps</p>
						</div>
					</div>
					<div class="item-slide">
						<img src="assets/images/main-slider-1-3.jpg" alt="" class="img-slide">
						<div class="slide-info slide-3">
							<h2 class="f-title">Great Range of <b>Exclusive Furniture Packages</b></h2>
							<span class="f-subtitle">Exclusive Furniture Packages to Suit every need.</span>
							<p class="sale-info">Stating at: <b class="price">$225.00</b></p>
							<a href="#" class="btn-link">Shop Now</a>
						</div>
					</div>
				</div>
			</div>

			<!--BANNER-->

	
			<!--Latest Products-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Latest Products</h3>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">						
						<div class="tab-contents">
							<div class="tab-content-item active" id="digital_1a">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >

                                <?php
                                $obj->SQL("SELECT *FROM products where products.P_status =1 order by products.P_id desc  limit 6");
                                foreach ($obj->getResult()[0] as $row) {
                                    $obj->SQL("SELECT min(product_price) as P from product_attributes
						            join products on  product_attributes.product_id = products.P_id where P_id = ".$row['P_id']."");
						            $minPrice = $obj->getResult()[0][0]["P"];
                                ?>
									<div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="detail.php?id=<?php echo $row["P_id"] ?>" title="<?php echo $row["P_name"] ?>">
												<figure><img style="height:250px" src='admin/upload/<?php echo $row["img"] ?>' width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
											</a>
											<div class="group-flash">
												<span class="flash-item new-label">new</span>
											</div>
										</div>
										<div class="product-info">
											<a href="<?php echo 'detail.php?id='.$row['P_id']?>" class="product-name"><span><?php echo $row["P_name"] ?></span></a>
											<div class="wrap-price"><span class="product-price"><?php echo "Rs".$minPrice ?></span></div>
										</div>
									</div>
                                    <?php
                                    }
									?>

								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>

			<!--Product Categories-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Product Categories</h3>
				
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-control">
							<?php
						$obj->select("categries","*",null,"status = 1");
								$cat_rows = $obj->getResult()[0];
								if (count($cat_rows) > 0) {
									$i = 0;
								foreach ($cat_rows as $cat_row) {
									$active = $i === 0 ? "active" :	"";
							?>
							<a href="#fashion_<?php echo $i ?>" class="tab-control-item <?php echo $active ?>"><?php echo $cat_row["name"] ?></a>
							<?php
							$i++;
								}
							?>
						</div>
						<div class="tab-contents">

						<?php
						$j = 0;
					
						foreach ($cat_rows as $cat_row) {
							$active = $j === 0 ? "active" :	"";
						?>
							<div class="tab-content-item <?php echo $active ?>" id="fashion_<?php echo $j ?>">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >
								<?php
                                $obj->SQL("SELECT * FROM products where products.cat_id = ".$cat_row['id']." AND  products.P_status = 1");
                                foreach ($obj->getResult()[0] as $row) {
                                    $obj->SQL("SELECT min(product_price) as P from product_attributes
						            join products on  product_attributes.product_id = products.P_id where P_id = ".$row['P_id']."");
						            $minPrice = $obj->getResult()[0][0]["P"];
                                ?>
									<div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="detail.php?id=<?php echo $row["P_id"] ?>" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
												<figure><img src="admin/upload/<?php echo $row["img"] ?>" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
											</a>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span><?php echo $row["P_name"]  ?></span></a>
											<div class="wrap-price"><span class="product-price">$<?php echo $minPrice ?></span></div>
										</div>
									</div>

									<?php
								}
									?>

								</div>
							</div>
                                <?php
								$j++;
						}
								}
                               ?>
						</div>
					</div>
				</div>
			</div>			

		</div>

	</main>
<?php
    include "footer.php";
    ?>