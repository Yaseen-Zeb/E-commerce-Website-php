<?php
include "header.php";
if (!isset($_SESSION["id"])) {
  header("Location:index.php");
}else{
 $admin_id = $_SESSION["id"];
  $obj->select("admin","*",null,"id = $admin_id");
  if ($obj->getResult()[0][0]["role"] == 0) {
      // header("Location:products.php");
  }
} 
if (isset($_GET["id"])) {
$order_id = $_GET["id"];
if (isset($_GET["operation"])) {
   if ($_GET["operation"] == "pinding_active") {
    $status = 0;
   }else if($_GET["operation"] == "proactive"){
    $status = 1;
   }else{
    $status = 2;
   }
   
   $obj->update("`order`",["order_status" => $status],"o_id = $order_id");
   $obj->getResult();
  header("Location:order_details.php?id=$order_id");
}
}
$obj->select("`order`","*",null,"o_id = $order_id");
$chk = $obj->getResult()[0][0]["order_status"];

?>
<div class="admin-content-container">
   <table class="table table-striped table-inverse table-responsive  d-md-table border">
							<thead class="thead-inverse w-100">
                            <tr style="w-100">
               <td><h3>Divelery Status</h3> </td>
               <td><a style='
                <?php if ($chk == 0) {
               echo ' background:green';
               }else{
                echo ' background:red';
               } ?>
              ' href='<?php echo "?operation=pinding_active&id=".$order_id ?>'  class='badge'
              >Pinding</a> 
               <?php if ($chk == 0) {
               echo '<span>is active</span>';
               }else{
                echo '<span>is not active</span>';
               } ?>
               </td>
               <td><a  style='
                <?php if ($chk == 1) {
               echo ' background:green';
               }else{
                echo ' background:red';
               } ?>
              ' href='<?php echo "?operation=proactive&id=".$order_id ?>' class='badge bg-primary'>processing</a> <?php if ($chk == 1) {
               echo '<span>is active</span>';
               }else{
                echo '<span>is not active</span>';
               } ?>
               </td>
               <td><a  style='
                <?php if ($chk == 2) {
               echo ' background:green';
               }else{
                echo ' background:red';
               } ?>
              ' href='<?php echo "?operation=compactive&id=".$order_id ?>' class='badge bg-primary'>Complete</a> <?php if ($chk == 2) {
               echo '<span>is active</span>';
               }else{
                echo '<span>is not active</span>';
               } ?>
               </td>
            </tr>
								<tr style="w-100">
                <th>Image</th>
                <th>Product Name</th>
                <th>Color</th>
                <th>Size</th>
                <th>Quantity</th>
                <th>Product price</th>
            </tr>
            </thead>
            <tbody>
                <?php
                  // $obj->SQL("SELECT `order_products_details`.qty as Q,products.*,`order`.*,product_attributes.*,color.*,size.* FROM `order_products_details`,products,`order`,product_attributes,color,size WHERE order_products_details.o_id = $order_id and order_products_details.p_id = products.P_id and `order`.o_id=order_products_details.o_id and  product_attributes.p_att_id = order_products_details.p_attr_id and color.id = product_attributes.color_id and size.id = product_attributes.size_id");
                  $obj->SQL("SELECT * from order_products_details 
                  join `order` on  `order`.o_id=order_products_details.o_id 
                  join products on order_products_details.p_id = products.P_id
                  join product_attributes on  product_attributes.p_att_id = order_products_details.p_attr_id
                  left join color on product_attributes.color_id = color.id
                  left join size on product_attributes.size_id = size.id where order_products_details.o_id = $order_id");
                  $rows = $obj->getResult()[0];
                  // show_arr($rows);
                foreach ($rows as $row) {
                ?>
               <tr>
               <td><img style="width: 65px;height: 70px;" src="<?php echo 'upload/'.$row['img'] ?>" alt=""></td>
               <td><?php echo $row["P_name"] ?></td>
               <td><?php echo $row["color"] ?></td>
               <td><?php echo $row["size"] ?></td>
               <td><?php echo $row["qtity"] ?></td>
			   <td><?php echo "Rs.".$row["product_price"] ?></td>
               </tr> 
            <?php
        }
        ?>
            </tbody>
    </table>
</div>

<?php
include "footer.php"
?>