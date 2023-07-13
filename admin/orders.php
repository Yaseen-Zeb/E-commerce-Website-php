<?php
include "header.php";
if (isset($_SESSION["id"])) {
    $condition = null;
    $admin_id = $_SESSION["id"];
    $obj->select("admin","*",null,"id = $admin_id");
    if ($obj->getResult()[0][0]["role"] == 0) {
      $condition .= "products.admin_id = $admin_id";
    }else{
        $condition = null;
    }
   
}
// if (isset($_GET["operation"]) && isset($_GET["id"])) {
//    if ($_GET["operation"] == "deactive") {
//     $status = 0;
//    }else{
//     $status = 1;
//    }
//    $id = $_GET["id"];
//    $obj->update("products",["P_status" => $status],"P_id = $id");
//    $obj->getResult();
//    header("Location:".$_SERVER['PHP_SELF']."");

//    if ($_GET["operation"] == "delete"){
//     $obj->delete("products","P_id = $id");
//     $obj->getResult();
//     header("Location:".$_SERVER['PHP_SELF']."");
//    }
// }
?>
<div class="admin-content-container">
   
<table class="table table-striped table-inverse table-responsive  d-md-table border">
							<thead class="thead-inverse w-100">
				<tr style="w-100">
                <th>order</th>
                <th>Address</th>
                <th>Total amount</th>
                <th>Payment type</th>
                <th>Payment status</th>
                <th>Order status</th>
                <th>Order date</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $obj->select("`order`","*","order_status on `order`.order_status = order_status.id ");
                $rows = $obj->getResult()[0];
                // show_arr($rows);
                foreach ($rows as $row) {
                ?>
                <tr>
                    <td scope="row"><a href="<?php echo 'order_details.php?id='.$row['o_id'] ?>" class="btn btn-primary">Details</a></td>
                    <td>
                        <?php echo "Address <b>:</b> ". $row["address"] ."<br>" ?>
                        <?php echo "City <b>:</b> ". $row["city"] ."<br>" ?>
                        <?php echo "Phone <b>:</b> ". $row["phone"] ."<br>" ?>
                </td>
                    <td><?php echo "Rs.".$row["tatal_amount"] ?></td>
                    <td><?php echo $row["payment_type"] ?></td>
                    <td><?php echo $row["payment_status"] ?></td>
                    <td><?php echo $row["name"] ?></td>
                    <td><?php echo $row["date"] ?></td>
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