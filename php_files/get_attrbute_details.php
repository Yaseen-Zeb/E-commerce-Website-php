<?php
include "../Database/DB.inc.php";
$obj = new database();
$input = file_get_contents("PHP://INPUT");
$decoded_data = json_decode($input,true);

$pid =$decoded_data["PID"];
$color_id =$decoded_data["CID"];
$size_id =$decoded_data["SID"];

// for getting attr id
$obj->select("product_attributes","*",null,"product_id = $pid AND color_id = $color_id AND size_id = $size_id");
$attr_row = $obj->getResult()[0][0];


// for getting calculated quantuty of product 
$obj->SQL("SELECT sum(order_products_details.qtity) as qty from order_products_details 
          join `order` on order_products_details.o_id = `order`.o_id
          where order_products_details.p_id = $pid 
          AND ((`order`.payment_type = 'payu' AND `order`.payment_status = 'success') OR (`order`.payment_type = 'COD'))
          ");
$qtyFromOrders = $obj->getResult()[0][0]["qty"];

// finally
$calculated_qty = ($attr_row["qty"]-$qtyFromOrders);
$related_price = $attr_row["product_price"];
echo json_encode(["qty"=>$calculated_qty,"price"=>$related_price]);




//  p_att_id	
// product_id	
// color_id	
// size_id	
// product_price	
// qty 
    ?>
    
