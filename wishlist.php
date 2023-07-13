<?php
include "header.php";
?>

	<!--main area-->
	<main id="main" class="main-site">

<div class="container">

	<div class="wrap-breadcrumb">
		<ul>
			<li class="item-link"><a href="#" class="link">home</a></li>
			<li class="item-link"><span>login</span></li>
		</ul>
	</div>
	<div class=" main-content-area">
			    <h2 class="box-title">My Wishlist</h2>
				<?php
                $email = $_SESSION['user_email'];
				$obj->select("wishlist","*","products on wishlist.P_id = products.P_id join users on wishlist.user_email = users.email","user_email = '$email'");
                $rows=$obj->getResult();
                if (count($rows[0]) > 0) {
                    # code...
                
					?>
			
						<table class="table table-striped table-inverse table-responsive  d-md-table">
							<thead class="thead-inverse w-100">
								<tr style="w-100">
									<th>Image</th>
									<th>Title</th>
									<th>Price</th>
									<th>Action</th>
									<th>Delete</th>
								</tr>
								</thead>
								<tbody>
                                    <input type="hidden" name="qty" value="1" class="p_qty">
				<?php
			    foreach ($rows[0] as $row) {
					?>
					 <tr style="w-100">
					<td><img style="width: 65px;height: 70px;" src="<?php echo 'admin/upload/'.$row['img'] ?>" alt=""></td>
					<td><?php echo $row["P_name"] ?></td>
					<td><?php echo "$".$row["price"] ?></td>
					<td>
				<i style="width:auto;font-size: 14px;font-weight: 500;background-color:#ff2832;border: none;outline: none;" class="btn btn-primary" onclick="manage_cart(<?php echo $row['P_id'] ?>,'add')">Add to cart</i>
        </td>
					<td><a href="<?php echo "?id=".$row['w_id']."&operation=delete" ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>

					</tr>
				<?php
				 }
				?>
				</tbody>
						</table>
						
		</div>
		<div>
            <?php
                }else{
                    echo '<div class="alert alert-danger text-center" role="alert"><h2>Your Wishlist is Empty</h2></div>';
                }
						

				?>		
	
		

		<div class="wrap-show-advance-info-box style-1 box-in-site">
			<h3 class="title-box">Most Viewed Products</h3>
							
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >

                                <?php
                                $obj->SQL("SELECT * FROM products where P_status =1 order by P_id desc  limit 6");
                                foreach ($obj->getResult()[0] as $row) {
                                    
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
											<div class="wrap-price"><span class="product-price"><?php echo "$".$row["price"] ?></span></div>
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