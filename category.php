<?php
include "header.php";
if (!isset($_GET["id"]) || $_GET["id"] == "") {
	?>
	<script>
 window.location.href = "index.php"
</script>
	<?php
}else{
	$id =  $_GET["id"];
}

?>

	<!--main area-->
	<main id="main" class="main-site left-sidebar">
		<div class="container">
			<div class="row">

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-content-area">

					<div class="wrap-shop-control">
						<?php
						 $obj->SQL("SELECT * from categries where id = $id");
					             $row = $obj->getResult()[0];
						?>
						
						<h1 class="shop-title"><?php echo count($row) >0 ? $row[0]['name'].": Category Products" : "No category found"  ?></h1>

						<div class="wrap-right">
							<?php
							if (isset($_GET["sort"])) {
								if($_GET["sort"]=="views"){
									$obj->select("products","*","categries on products.cat_id = categries.id","cat_id = $id","views desc","15");
								}else if($_GET["sort"]=="new"){
									$obj->select("products","*","categries on products.cat_id = categries.id","cat_id = $id","P_id desc","15");
								}else if($_GET["sort"]=="old"){
									$obj->select("products","*","categries on products.cat_id = categries.id","cat_id = $id","P_id","15");
								}else{
								$obj->select("products","*","categries on products.cat_id = categries.id","cat_id = $id","null","15");
								}
							}else{
								$obj->select("products","*","categries on products.cat_id = categries.id","cat_id = $id","null","15");
							}
							?>

<div class="sort-item orderby ">
								<select style="font-size:13px" name="orderby" class="use-chosen cat_sort" onchange="cat_sort(<?php echo $id ?>)">
									<option value="menu_order" selected="selected">Default sorting</option>
									<option value="views">Sort by popularity</option>
									<option value="new">Sort by newness</option>
									<option value="old">Sort by oldness</option>
								</select>
							</div>

						</div>

					</div><!--end wrap shop control-->

					<div class="row">
						<ul class=" w-100 product-list grid-products equal-container w-100">
							<?php 
							$cat_rows = $obj->getResult()[0];
							if (count($cat_rows) > 0) {
							 foreach ($cat_rows as $row) {
								$obj->SQL("SELECT min(product_price) as P from product_attributes
								join products on  product_attributes.product_id = products.P_id where products.P_id = ".$row['P_id']."");
					            $minPrice = $obj->getResult()[0][0]["P"];
							?>
							<li class="col-lg-4  col-md-6 col-sm-6 col-xs-6 text-center" style="margin-bottom:-10px">
								<div class="product product-style-3 equal-elem">
									<div class="product-thumnail">
										<a href="<?php echo 'inc_views.php?id='.$row['P_id']?>" title="<?php echo $row["P_name"] ?>">
											<figure><img  class="w-100 h-50" src="<?php echo "admin/upload/".$row["img"] ?>" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
										</a>
									</div>
									<div class="product-info">
										<a href="detail.php?id=".<?php echo $row["P_id"]?> class="product-name"><span><?php echo substr($row["P_name"],0,21)."..."  ?></span></a>
										<div class="wrap-price"><span class="product-price"><?php echo "Rs.".$minPrice?></span></div>
										<a href="<?php echo 'inc_views.php?id='.$row['P_id']?>" class="btn add-to-cart">Add To Cart</a>
									</div>
								</div>
							</li>
							<?php
							 }
							}else{
								echo '<div style="font-size:22px" class="alert alert-danger w-50 mx-auto mt-3 text-center">No Data Found</div>';
							}
							?>
						</ul>

					</div>
<hr style="margin-top: 48px">
					<nav aria-label="Page navigation" class="text-center">
           <ul class="pagination justify-content-center text-center">
        <?php
        echo $obj->pagination("products",15);
       ?>
       </ul>
        </nav>
				</div><!--end main products area-->

			</div><!--end row-->

		</div><!--end container-->

	</main>
	<!--main area-->

<?php
include "footer.php";
?>
<script>
	N();
</script>
