<?php
include "header.php";
?>

	<!--main area-->
	<main id="main" class="main-site">

<div class="container">
	<div class=" main-content-area">
			    <h2 class="box-title">Products in cart</h2>
				<?php
				if (isset($_SESSION['cart']) && count($_SESSION["cart"]) > 0) {
					?>
			
						<table class="table table-striped table-inverse table-responsive  d-md-table">
							<thead class="thead-inverse w-100">
								<tr style="w-100">
									<th>Image</th>
									<th>Title/Color/Size</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Sub total</th>
									<th>Delete</th>
								</tr>
								</thead>
								<tbody>
				<?php
				foreach ($_SESSION["cart"] as $key => $value) {
					foreach ($value as $k => $v) {
						$obj->select("products","*","product_attributes on products.P_id = product_attributes.product_id left join color on product_attributes.color_id = color.id left join size on product_attributes.size_id = size.id","P_id = $key AND p_att_id = $k");
						$all_related_rows_of_session[] = $obj->getresult();
						$qty[] = $v["qty"];
					}
				}

				
				$i = 0;
				$total_price = 0;
				foreach ($all_related_rows_of_session as  $row) {
					?>
					 <tr style="w-100">
					<td><img style="width: 65px;height: 70px;" src="<?php echo 'admin/upload/'.$row[0][0]['img'] ?>" alt=""></td>
					<td><?php echo $row[0][0]["P_name"] ?>
				<span >Color:<span style="color:<?php echo (isset($row[0][0]["color"])) ? $row[0][0]["color"] : ""; ?>"> <?php  echo (isset($row[0][0]["color"])) ? "<br>".$row[0][0]["color"] : "";
				echo (isset($row[0][0]["size"])) ? "<br>".$row[0][0]["size"] : "";?> </span></span>
				</td>
					<td><?php echo "$".$row[0][0]["product_price"]?></td>
					<td>
						<input value="<?php echo $qty[$i] ?>" id="<?php echo 'qty'.$row[0][0]['p_att_id']?>" style="outline: none; width: 46px;border: solid 1px;background: transparent;" class="p_qty counter_input" type="number">
						<i style="cursor:pointer;" class="badge badge-primary" onclick="manage_cart(<?php echo $row[0][0]['P_id']?>,'update','fromcartpage',<?php echo $row[0][0]['p_att_id']?>)">update</i>
					</td>
					<td><?php echo "$".$row[0][0]["product_price"] ?></td>
					<td><i style="cursor:pointer;" class="fa fa-trash"  onclick="manage_cart(<?php echo $row[0][0]['P_id']?>,'delete','fromcartpage',<?php echo $row[0][0]['p_att_id']?>)"></i></td>
					</tr>
					<?php
					$total_price += ($qty[$i]*$row[0][0]["product_price"]);
					$i++;
					}
		?>
				</tbody>
						</table>
						
		</div>
		<div>
			<span class="d-flex mx-auto p-2" style="width: 235px; justify-content:space-between;border:solid 2px grey">
					<h2>Tatal price</h2>
					<h2><?php echo $total_price ?></h2>
			</span>
		</div>
		<?php
				}else{
echo'<div class="alert alert-danger text-center" role="alert"><h2>NO products in cart</h2></div>';
				}			

 ?>
						
			<div class="checkout-info d-flex " style="justify-content:space-between">
				<a style="width:auto;font-size: 14px;font-weight: 500;background-color:#ff2832;border: none;outline: none;" class="btn btn-primary" href="index.php">Continue Shopping</a>
				<a style="width:auto;font-size: 14px;font-weight: 500;background-color:#ff2832;border: none;outline: none;" class="btn btn-primary" href="<?php echo $chk_path ?>">Check out</a>
			</div>
		

		<div class="wrap-show-advance-info-box style-1 box-in-site">
			<h3 class="title-box">Most Viewed Products</h3>
						
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >

                                <?php
                                $obj->SQL("SELECT * FROM products where P_status =1 order by P_id desc  limit 6");
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
											<div class="wrap-btn">
												<a href="#" class="function-link">quick view</a>
											</div>
										</div>
										<div class="product-info">
											<a href="<?php echo 'detail.php?id='.$row['P_id']?>" class="product-name"><span><?php echo $row["P_name"] ?></span></a>
											<div class="wrap-price"><span class="product-price"><?php echo "Rs.".$minPrice ?></span></div>
										</div>
									</div>
                                    <?php
                                    }
									?>
					</div>
		</div>

	</div><!--end main content area-->
</div><!--end container-->

</main>
	<!--main area-->

<?php
include "footer.php";
?>