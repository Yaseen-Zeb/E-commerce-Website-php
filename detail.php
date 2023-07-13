<?php
include "header.php";

						if (!isset($_GET["id"]) || $_GET["id"] == "") {
							?>
							<script>
						 window.location.href = "index.php"
						</script>
							<?php
						}else{
							$id = $_GET["id"];
							
						}
						 $obj->SQL("SELECT * from products 
						 join sub_categries on products.sub_cat_id = sub_categries.sub_id 
						 join categries on products.cat_id = categries.id 
						 where P_id = $id");
						 $row= $obj->getResult()[0];
						//  show_arr($row);
						$related_id = $row[0]["sub_id"];
						// echo $related_id;

						$obj->SQL("SELECT min(product_price) as P from product_attributes
						 join products on  product_attributes.product_id = products.P_id where P_id = $id");
						 $minPrice = $obj->getResult()[0][0]["P"];


						$obj->select("reviews","*","products on reviews.p_id = products.P_id join users on reviews.u_email = users.email","products.P_id = $id");
									$R_rows = $obj->getResult()[0];

$colors = [];
$sizes = [];
									$obj->SQL("SELECT * from product_attributes
									LEFT JOIN color on product_attributes.color_id = color.id AND color.status = 1
									LEFT JOIN size on product_attributes.size_id = size.id AND size.status = 1
									WHERE product_id = $id");
                                     $related_p_s_c_rows = $obj->getResult()[0];
                                    $cid;
									$C = [];
									$S = [];
									foreach ($related_p_s_c_rows as $value) {
										$colors[$value["color_id"]][]=$value["color"];
									    $sizes[$value["size_id"]]	=$value["size"];
										$C[]=$value["color"];
										$S[]=$value["size"];
									}

					
					$is_size = count(array_filter($S));
					$is_color = count(array_filter($C));
// echo $is_color;
// echo $is_size;
					// unset($_SESSION["cart"]);
					// show_arr($colors);
					// show_arr($related_p_s_c_rows);
						?>
	<!--main area-->
	
	<main id="main" class="main-site">

		<div class="container">
			<!--  -->
		<input type="hidden" name="" class="pid" value="<?php echo $_GET["id"] ?>">
			<!--  -->
			<div class="row">
				<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
					<div class="wrap-product-detail">
						<div class="detail-media">
						<div class="product-gallery text-center">
							  <ul class="slides">

							    <li data-thumb="<?php echo "admin/upload/".$row[0]["img"] ?>">
								<img id="product-img" style="width: 438px; height: 377px;" src='<?php echo "admin/upload/".$row[0]["img"] ?>' alt="product thumbnail"/>
							    </li>
								<?php
								$obj->select("product_imgs","*",null,"pid = $id");
							$pimgs=$obj->getResult()[0];
							foreach ($pimgs as $value) {
							?>
							<li  data-thumb="<?php echo "admin/product_images/".$value["p_img"] ?>">
								<img id="product-img"  style="width: 438px; height: 377px;" src="<?php echo "admin/product_images/".$value["p_img"] ?>" alt="product thumbnail"/>
							    </li>
							<?php
							}
								?>
							  </ul>
							  
							</div>
						</div>
						<div class="detail-info col-sm-6 detail_pro">
                            <h2 class="product-name text-sm-center"><?php echo $row[0]["P_name"] ?></h2>
                            
                            <div class="wrap-price"><span class="product-price"><?php echo 'Rs'.$minPrice ?></span></div>
                            <div class="stock-info in-stock">
							
                                <p class="availability">Availability: <b class="qty_in_stock">Choose Color/Size First</b></p>
								<p class="availability">Category: <a href="<?php echo 'category.php?id='.$row[0]["cat_id"] ?>"><b><?php echo $row[0]["name"] ?></b></a></p>
								<p class="availability">Sub Category: <a href="<?php echo 'sub_category.php?id='.$row[0]["cat_id"]."&sub_cat=".$row[0]["sub_cat_id"]?>"><b><?php echo $row[0]["title"] ?></b></a></p>
                            </div>
							<!--  -->
							<?php if ($is_color > 0) {
							?>
							<div class="mb-3 color_section">
							<p class="availability mb-1" style="font-size:12px;font-weight:600">Avalible Color :</p>
								<div class="color d-flex">
									<?php
									 foreach ($colors as $key => $val) {
										echo '<span class="mx-1" style="background:'.$val["0"].'; width:14px; height:22px;" onclick="get_size('.$id.','.$key.',1)"></span>';
									} 
									?>
							</div>
							</div>
							<input type="hidden" class="color_id">
							<?php } ?>
							
							<!--  -->
							<?php if ($is_size > 0) {
							?>
							<div class="" style="display:none"  id="size_selector_div">
							<p class="availability mb-1" style="font-size:12px;font-weight:600">Avalible Sizes :</p>
							<div class="form-check p-0" id="size_selector">
								<?php
								
								foreach ($sizes as $key => $value) {
								echo '<label class="form-check-label d-flex align-items-center">
								<input style="position:unset;" type="radio" class="form-check-input m-0 mr-1" name="size" id="size_'.$key.'" value="'.$key.'" onclick="get_size('.$id.',1,2,'.$key.')">
								'.$value.'
							  </label>';
								}
								?>
							</div>
							</div>
							<input type="hidden" class="size_id">
							<?php } ?>
							<!--  -->
							<input type="hidden" value="1" name="" id="avilable_qty">
                            <div class="quantity mt-3">
                            	<span>Quantity:</span>
								<div class="quantity-input">
									<input class="p_qty" type="text" name="product-quatity" value="1" data-max="10" pattern="[0-9]*" >
									<a class="btn btn-reduce" href="#"></a>
									<a class="btn btn-increase" href="#"></a>
								</div>
							</div>
							<div style="display:none" class="alert alert-danger mt-3 mb-0 catrt_alert"></div>
							<div class="wrap-butons mt-3">
								<button style="width:100%; border:none;outline:none" class="btn add-to-cart"  onclick="manage_cart(<?php echo $row[0]['P_id'] ?>,'add','notFromCartPage')">Add to Cart</button>
                                <div class="wrap-btn text-center">
                                    <i style="width:100%"  class="btn btn-wishlist" onclick="manage_wishlist(<?php echo $row[0]['P_id']?>)">Add Wishlist</i>
                                </div>
							</div>
							<div style="display:none" class="alert alert-primary wishlist_alert"></div>
							</div>

						<div class="advance-info">
							<div class="tab-control normal">
								<a href="#description" class="tab-control-item active">description</a>
								<a href="#add_infomation" class="tab-control-item">Addtional Infomation</a>
								<a href="#review" class="tab-control-item">Reviews</a>
							</div>
							<div class="tab-contents" style="font-size:13px">
								<div class="tab-content-item active" id="description">
								<?php echo $row[0]["description"] ?>
								</div>
								<div class="tab-content-item " id="add_infomation">
									<table class="shop_attributes">
										<tbody>
											<tr>
												<th>Weight</th><td class="product_weight">1 kg</td>
											</tr>
											<tr>
												<th>Dimensions</th><td class="product_dimensions">12 x 15 x 23 cm</td>
											</tr>
											<tr>
												<th>Color</th><td><p>Black, Blue, Grey, Violet, Yellow</p></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="tab-content-item " id="review">
									
									<div class="wrap-review-form">
										
									
										<div id="comments"><?php
									if (count($R_rows) > 0) {
									?>
											<h2 class="woocommerce-Reviews-title"><?php echo count($R_rows) ?> review for <span><?php echo $R_rows[0]["P_name"] ?></span></h2>
											<?php
									foreach ($R_rows as $row) {
									?>
											<ol class="commentlist">
												<li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="li-comment-20">
													<div id="comment-20" class="comment_container"> 
														<img alt="" src="assets/images/author-avata.jpg" height="80" width="80">
														<div class="comment-text">
															<div style="color:#a7a7a7;">
															<?php
															if ($row["rating"] == 1) {
																echo '
																<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
															</div>';
															}else if($row["rating"] == 2){
																echo '<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>';
															}else if($row["rating"] == 3){
																echo '<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>';
															}else if($row["rating"] == 4){
																echo '<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i class="fa fa-star" aria-hidden="true"></i>';
															}else if($row["rating"] == 5){
																echo '<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>
																<i style="color:#ffb733" class="fa fa-star" aria-hidden="true"></i>';
															}
															?>
															<p class="meta"> 
																<strong class="woocommerce-review__author"><?php echo $row["name"] ?></strong> 
																<span class="woocommerce-review__dash">–</span>
																<time class="woocommerce-review__published-date" datetime="2008-02-14 20:00" ><?php echo $row["date"] ?></time>
															</p>
															<div class="description">
																<p><?php echo $row["comment"] ?></p>
															</div>
														</div>
													</div>
												</li>
											</ol>
											<?php
										}
									}else{
															echo '<div class="alert alert-primary" role="alert">No Revew Yet</div>';
														}
										?>

											
										</div><!-- #comments -->

										

										<div id="review_form_wrapper">
											<div id="review_form">
												<div id="respond" class="comment-respond"> 
													<?php 
													if (isset( $_SESSION["user_email"])) {
														?>
												
														<form  id="commentform" class="comment-form form review_form" novalidate="">
														<div class="comment-form-rating">
															<span>Your rating</span>
															<p class="stars">
																
																<label for="rated-1"></label>
																<input type="radio" id="rated-1" name="rating" value="1">
																<label for="rated-2"></label>
																<input type="radio" id="rated-2" name="rating" value="2">
																<label for="rated-3"></label>
																<input type="radio" id="rated-3" name="rating" value="3">
																<label for="rated-4"></label>
																<input type="radio" id="rated-4" name="rating" value="4">
																<label for="rated-5"></label>
																<input type="radio" id="rated-5" name="rating" value="5" checked="checked">
															</p>
														</div>
														<div class="form-group">
														<label for="comment">Your review <span class="required">*</span></label>
														  <textarea class="form-control" name="comment" id="" rows="6"></textarea>
														</div>
<br>
														<input name="p_id" type="hidden" value="<?php echo $_GET["id"] ?>">
														
														<div style="display:none" class="alert alert-success review_success_div">dsf</div>
														<div style="display:none" class="alert alert-danger review_error_div">fds</div>
														<p class="form-submit">
														
															<input name="submit" type="submit" id="submit" class="review_form_submit_btn" value="Submit" onclick="manage_review()">
														</p>
														
													</form>
														<?php
													}else{
														echo '<div class="alert alert-primary" role="alert">
														Please <a style="color:#ff2832" href="login.php" class="alert-link"><strong>login</strong></a> to add review
														</div>';
													}
													?>
													

												</div><!--#comment-respond-->
											</div><!-- #review_form -->
										</div><!-- #review_form_wrapper -->

									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div><!--end main products area-->

				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">

					<div class="widget mercado-widget widget-product">
						<h2 class="widget-title">Popular Products</h2>
						<div class="widget-content">
							<ul class="products">
								<?php 
								$obj->SQL("SELECT * from products order by views desc limit 4");
								$sql1_rows= $obj->getResult()[0];
								foreach ($sql1_rows as $row) {
									$obj->SQL("SELECT min(product_price) as P from product_attributes
								join products on  product_attributes.product_id = products.P_id where P_id = ".$row['P_id']."");
					 $minPrice = $obj->getResult()[0][0]["P"];
								 ?>
								<li class="product-item">
									<div class="product product-widget-style" style="display: flex;center;">
										<div class="thumbnnail">
											<a href="<?php echo 'inc_views.php?id='.$row['P_id']?>" title="<?php echo $row['P_name']?>">
												<figure><img style="height:104px;width:83px" src="<?php echo "admin/upload/".$row['img']?>" alt=""></figure>
											</a>
										</div>
										<div class="product-info" >
											 <a href="#" class="product-name" style="display:flex;flex-direction:column"> 
											<div class="wrap-price" style="margin-bottom:-12px"><span><b><?php echo substr($row['P_name'],0,18)."..." ?></b></span></div>
											<span  class="product-price"><?php echo substr($row['description'],0,70)."..." ?></span>
											<div class="wrap-price" style="margin-top:-5px"><span class="product-price"><?php echo "Rs.".$minPrice?></span></div>
										</a>
										</div>
									</div>
								</li>
								<?php
							}
							?>
							</ul>
						</div>
					</div>

				</div><!--end sitebar-->

				<div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="wrap-show-advance-info-box style-1 box-in-site">
						<h3 class="title-box">Related Products</h3>
						<div class="wrap-products">
							<div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
								<?php
								$obj->SQL("SELECT * from products join sub_categries on  products.sub_cat_id = sub_categries.sub_id where sub_cat_id = $related_id");
								$sql2_rows= $obj->getResult()[0];
								foreach ($sql2_rows as $row) {
									$obj->SQL("SELECT min(product_price) as P from product_attributes
								join products on  product_attributes.product_id = products.P_id where P_id = ".$row['P_id']."");
					 $minPrice = $obj->getResult()[0][0]["P"];
								
								?>
								<div class="product product-style-2 equal-elem ">
									<div class="product-thumnail">
										<a href=" <?php echo'inc_views.php?id='.$row["P_id"] ?>" title="<?php echo $row["P_name"] ?>">
											<figure><img style="height:250px" src="<?php echo "admin/upload/".$row["img"] ?>" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
										</a>
										<div class="wrap-btn">
											<a href="" class="function-link">quick view</a>
										</div>
									</div>
									<div class="product-info">
										<a href="#" class="product-name"><span><?php echo $row["P_name"] ?></span></a>
										<div class="wrap-price"><span class="product-price"><?php echo "Rs.".$minPrice ?></span></div>
									</div>
								</div>
							<?php } ?>
							</div>
						</div><!--End wrap-products-->
					</div>
				</div>

			</div>
			<!--end row-->

		</div><!--end container-->

	</main>
	<!--main area-->
	<?php
include "footer.php";
?>
