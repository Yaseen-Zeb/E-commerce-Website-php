<?php include "header.php";
if (isset($_GET["search"]) && $_GET["search"] != "") {
	$S = $_GET['search'];
	$search = "%".$_GET['search']."%";
	
	if (isset($_GET["sort"])) {
	if($_GET["sort"]=="views"){
		$obj->select("products","*",null,"P_name like '$search'","views desc","4");
	}else if($_GET["sort"]=="new"){
		$obj->select("products","*",null,"P_name like '$search'","P_id desc","4");
	}else if($_GET["sort"]=="old"){
		$obj->select("products","*",null,"P_name like '$search'","P_id","4");
	}else if($_GET["sort"]=="price-to-heigh"){
		$obj->select("products","*",null,"P_name like '$search'","price","4");
	}else if($_GET["sort"]=="price-to-low"){
		$obj->select("products","*",null,"P_name like '$search'","price desc","4");
	}
}else{
		$obj->select("products","*",null,"P_name like '$search'",null,"4");
	}
}else{
	?>
<script>
	window.location.href = "index.php";
</script>
	<?php
}

if (!isset($_GET["search"])) {
	
	if (isset($_GET["sort"])) {
	if($_GET["sort"]=="views"){
		$obj->select("products","*",null,null,"views desc","4");
	}else if($_GET["sort"]=="new"){
		$obj->select("products","*",null,null,"P_id desc","4");
	}else if($_GET["sort"]=="old"){
		$obj->select("products","*",null,null,"P_id","4");
	}else if($_GET["sort"]=="price-to-heigh"){
		$obj->select("products","*",null,null,"price","4");
	}else if($_GET["sort"]=="price-to-low"){
		$obj->select("products","*",null,null,"price desc","4");
	}
}
}

if (!isset($_GET["sort"]) && !isset($_GET["search"])) {
	$obj->select("products","*",null,null,null,"4");
}
?>
	<!--main area-->
	<main id="main" class="main-site left-sidebar">
		<div class="container">
			<div class="row">

				<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
					<div class="wrap-shop-control">

						<h1 class="shop-title">Digital & Electronics</h1>

						<div class="wrap-right">

							<div class="sort-item orderby ">
								<select style="font-size:13px" name="orderby" class="use-chosen sort" onchange="sort('<?php echo $S ?>')">
									<option value="menu_order" selected="selected">Default sorting</option>
									<option value="views">Sort by popularity</option>
									<option value="new">Sort by newness</option>
									<option value="old">Sort by oldness</option>
									<option value="price-to-heigh">Sort by price: low to high</option>
									<option value="price-to-low">Sort by price: high to low</option>
								</select>
							</div>

						</div>

					</div><!--end wrap shop control-->

					<div class="row">

						<ul class="product-list grid-products equal-container">
							<?php
							$rows = $obj->getResult()[0];
							foreach ($rows as $row) {
								$obj->SQL("SELECT min(product_price) as P from product_attributes
								join products on  product_attributes.product_id = products.P_id where P_id = ".$row['P_id']."");
								$minPrice = $obj->getResult()[0][0]["P"];
							echo '<li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
							<div class="product product-style-3 equal-elem ">
								<div class="product-thumnail"> 
									<a href="detail.php?id='.$row["P_id"].'" title="'.$row["P_name"].'">
										<figure><img style="    height: 270px;width: 694px;" src="admin/upload/'.$row["img"].'" alt="'.$row["P_name"].'"></figure>
									</a>
								</div>
								<div class="product-info">
									<a style="text-decoration: none;color: black;font-size: 15px;" href="detail.php?id='.$row["P_id"].'" class="product-P_name"><span>'. substr($row["P_name"],0,28) .'...</span></a>
									<div class="wrap-price"><span class="product-price">RS'.$minPrice.'</span></div>
									<button style="width:100%; border:none;outline:none;padding: 6px;font-size: 12px;" class="btn add-to-cart"  onclick="C('.$row["P_id"].')">Add to Cart</button>
								</div>
							</div>
						</li>';
							}
							?>
						</ul>

					</div>
					<nav aria-label="Page navigation" class="text-center">
           <ul class="pagination justify-content-center">
        <?php
        echo  $obj->pagination("products",4);
       ?>
       </ul>
        </nav>
				</div><!--end main products area-->

				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 mt-3 sitebar">
					<div class="widget mercado-widget categories-widget">
						<h2 class="widget-title">All Categories</h2>
						<div class="widget-content">
							<ul class="list-category">
								<?php
								$obj->select("categries","*",null,"status = 1");
								$cat_rows = $obj->getResult()[0];
								foreach ($cat_rows as $cat_row) {
									echo '<li class="category-item has-child-cate">
									<a href="#" class="cate-link">'.$cat_row['name'].'</a>
									<span class="toggle-control">+</span>';
									$cat_id =  $cat_row['id'];
									$obj->select("sub_categries","*",null,"cat_id = $cat_id and sub_status = 1");
									$sub_cat_rows = $obj->getResult()[0];
									if (count($sub_cat_rows) > 0) {
									echo'<ul class="sub-cate">';
										foreach ($sub_cat_rows as $sub_cat_row) {
									echo '<li class="category-item"><a href="sub_category.php?id='.$cat_row["id"].'&sub_cat='.$sub_cat_row["sub_id"].'" class="cate-link">'.$sub_cat_row["title"].'</a></li>';
								}
								echo'</ul>';
										}
								echo '</li>';
									}
								?>
								
							</ul>
						</div>
					</div><!-- Categories widget-->

				</div><!--end sitebar-->

			</div><!--end row-->

		</div><!--end container-->

	</main>
	<!--main area-->

	<?php include "footer.php"; ?>