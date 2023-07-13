<?php
include "header.php";
// if (!isset($_SESSION["login"])) {
//    header("Location:index.php");
// }else{
    // if (isset($_GET["id"])) {
        $order_id = $_GET["id"];
                $user_email = $_SESSION["user_email"];
                $obj->SQL("SELECT `order_products_details`.*, products.*,`order`.*,product_attributes.* FROM `order_products_details`,products,`order`,product_attributes WHERE order_products_details.o_id = $order_id and products.P_id=order_products_details.p_id and `order`.o_id=order_products_details.o_id and product_attributes.p_att_id = `order_products_details`.p_attr_id");
                $rows = $obj->getResult()[0];
                // show_arr($rows);
//     }else{
//         header("Location:.php");
//     }
// }
?>
	<main id="main" class="main-site">
<div class="container">
	<div class=" main-content-area">
<div class="container">
<table class="table table-striped table-inverse table-responsive  d-md-table border">
							<thead class="thead-inverse w-100">
								<tr style="w-100">
                <th>Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Product price</th>
            </tr>
            </thead>
            <tbody>
                <?php
                foreach ($rows as $row) {
                ?>
               <tr>
               <td><img style="width: 65px;height: 70px;" src="<?php echo 'admin/upload/'.$row['img'] ?>" alt=""></td>
               <td><?php echo $row["P_name"] ?></td>
               <td><?php echo $row["qtity"] ?></td>
			   <td><?php echo "Rs.".$row["product_price"] ?></td>
               </tr> 
            <?php
        }
        ?>
            </tbody>
    </table>
</div>
</div>
</div>
<?php
include "footer.php";
?>