<?php
include "header.php";
if (!isset($_GET["sub_cat"]) || $_GET["sub_cat"] == "") {
	?>
	<!-- <script>
 window.location.href = "index.php"
</script> -->
	<?php
}else{
	$cat_id =  $_GET["id"];
	$id = $_GET["sub_cat"];
}

?>

	<!--main area-->
	<main id="main" class="main-site left-sidebar">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-content-area">

					<div class="wrap-shop-control">
						<?php
						
						 $obj->SQL("SELECT * from sub_categries where sub_id = $id");
					             $row = $obj->getResult()[0];
						?>
						
						<h1 class="shop-title"><?php echo count($row) >0 ? strtoupper($row[0]['title']).": Sub Category Products" : "No category found"  ?></h1>

						<div class="wrap-right">
							<?php
							if (isset($_GET["sort"])) {
								if($_GET["sort"]=="views"){
									$obj->select("products","*","sub_categries on products.sub_cat_id = sub_categries.sub_id","sub_cat_id = $id","views desc","15");
								}else if($_GET["sort"]=="new"){
									$obj->select("products","*","sub_categries on products.sub_cat_id = sub_categries.sub_id","sub_cat_id = $id","P_id desc","15");
								}else if($_GET["sort"]=="old"){
									$obj->select("products","*","sub_categries on products.sub_cat_id = sub_categries.sub_id","sub_cat_id = $id","P_id","15");
								}else if($_GET["sort"]=="price-to-heigh"){
									$obj->select("products","*","sub_categries on products.sub_cat_id = sub_categries.sub_id","sub_cat_id = $id","price","15");
								}else if($_GET["sort"]=="price-to-low"){
									$obj->select("products","*","sub_categries on products.sub_cat_id = sub_categries.sub_id","sub_cat_id = $id","price desc","15");
								}
							}else{
								$obj->select("products","*","sub_categries on products.sub_cat_id = sub_categries.sub_id","sub_cat_id = $id","null","15");
								}
							?>

<div class="sort-item orderby ">
								<select style="font-size:13px" name="orderby" class="use-chosen cat_sort" onchange="sub_cat_sort(<?php echo $cat_id ?>,<?php echo $id ?>)">
									<option value="menu_order" selected="selected">Default sorting</option>
									<option value="views">Sort by popularity</option>
									<option value="new">Sort by newness</option>
									<option value="old">Sort by oldness</option>
								</select>
							</div>

						</div>

					</div><!--end wrap shop control-->

					<div class="row">
						<ul style="width: 100%;" class="product-list grid-products equal-container">
							<?php 

							
							if (!isset($_GET["sub_cat"]) || $_GET["sub_cat"] == "") {
								header("Location:index.php");
							}else{
								$id = $_GET["sub_cat"];
							}
							
							$cat_rows = $obj->getResult()[0];
							if (count($cat_rows) <= 0) {
							echo "<div  style='font-size:22px' class='alert alert-danger w-50 mx-auto mt-3 text-center'>No Data Found</div>";
							}else{

							 foreach ($cat_rows as $row) {
								$obj->SQL("SELECT min(product_price) as P from product_attributes
								join products on  product_attributes.product_id = products.P_id where P_id = ".$row['P_id']."");
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
										<div class="wrap-price"><span class="product-price"><?php echo "RS.".$minPrice ?></span></div>
										<a href="<?php echo 'inc_views.php?id='.$row['P_id']?>" class="btn add-to-cart">Add To Cart</a>
									</div>
								</div>
							</li>
							<?php
							 }}
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
