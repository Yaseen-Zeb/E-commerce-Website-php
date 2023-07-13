<?php
include "header.php";
?>
	<main id="main" class="main-site">
<div class="container">
	<div class=" main-content-area">
<div class="container">
<h2 class="box-title">Your Orders</h2>
<table class="table table-striped table-inverse table-responsive  d-md-table">
							<thead class="thead-inverse w-100">
								<tr style="w-100">        
                                <th>Products</th>
                                <th>Address details</th>
                                <th>Total amount</th>
                                <th>Payment type</th>
                                <th>Payment status</th>
                                <th>Order status</th>
                                <th>Order date</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $user_email = $_SESSION['user_email'];
                $obj->select("`order`","*",null,"user_email = '$user_email'");
                $rows = $obj->getResult()[0];
                foreach ($rows as $row) {
                ?>
                <tr>
                    <td scope="row"><a href="<?php echo 'order_product_detail.php?id='.$row['o_id'] ?>" class="btn btn-primary">Details</a></td>
                    <td>
                        <?php echo "Address <b>:</b> ". $row["address"] ."<br>" ?>
                        <?php echo "City <b>:</b> ". $row["city"] ."<br>" ?>
                        <?php echo "Phone <b>:</b> ". $row["phone"] ."<br>" ?>
                </td>
                    <td><?php echo "Rs.".$row["tatal_amount"] ?></td>
                    <td><?php echo $row["payment_type"] ?></td>
                    <td><?php echo $row["payment_status"] ?></td>
                    <td><?php if ($row["order_status"] == 0) {
                       echo "pinding";
                    } else if($row["order_status"] == 1){
                        echo "processing";
                    }else{
                        echo "complete";
                    }
                       ?></td>
                    <td><?php echo $row["date"] ?></td>
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