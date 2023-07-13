<?php
include "header.php";

?>
<div class="admin-content-container">
   
<table class="table table-striped table-inverse table-responsive  d-md-table border">
							<thead class="thead-inverse w-100">
				<tr style="w-100">
                <th>Product:Name/Qty</th>
                <th>Image</th>
                <th>Address</th>
                <th>Payment type</th>
                <th>Payment status</th>
                <th>Order status</th>
                <th>Order date</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $obj->select("`order`","*","order_status on `order`.order_status = order_status.id join order_products_details on `order`.o_id = order_products_details.o_id join products on order_products_details.p_id = products.P_id","products.admin_id = '".$_SESSION["id"]."'");
                $rows = $obj->getResult()[0];
                // show_arr($rows);
                foreach ($rows as $row) {
                ?>
                <tr>
                <td><?php echo substr($row["P_name"],0,16)."... "."/".$row["qty"]?></td>
                <td><img style="width: 65px;height: 70px;" src="<?php echo 'upload/'.$row['img'] ?>" alt=""></td>
                    <td>
                        <?php echo "Address <b>:</b> ". $row["address"] ."<br>" ?>
                        <?php echo "City <b>:</b> ". $row["city"] ."<br>" ?>
                        <?php echo "Phone <b>:</b> ". $row["phone"] ."<br>" ?>
                </td>
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