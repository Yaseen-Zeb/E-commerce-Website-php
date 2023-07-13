<?php
include "../Database/DB.inc.php";
$obj = new database();
// foreach ( as  $pid) {
//    show_arr(array_keys($_SESSION["cart"]) );
   
// }

$address = $obj->escapeString($_POST["add"]);
$city = $obj->escapeString($_POST["city"]);
$country = $obj->escapeString($_POST["country"]);
$phone = $obj->escapeString($_POST["phone"]);
$pin_code = $obj->escapeString($_POST["pin_code"]);
$total_price = $obj->escapeString($_POST["total_price"]);
$user_email = $_SESSION["user_email"];
$payment_method = $obj->escapeString($_POST["payment-method"]);
$payment_status = "pinding";

if ($obj->escapeString($_POST["payment-method"]) == "COD") {
    $payment_status = "success";
} 

$order_status = "pinding";
$created_at = date('d-M-Y h:i:s');

    if ($address=="" || $city=="" || $country=="" || $phone=="" || $pin_code=="" || $payment_method=="" || !isset($_POST["payment-method"])) {
        echo json_encode(["result"=> " Please fill all input feilds!"]);
    }else{
            $obj->insert("`order`" ,["user_email"=> "'$user_email'","country"=>"'$country'", "city"=>"'$city'", "phone"=>"' $phone'","address"=>"'$address'","postal_code"=> "'$pin_code'","tatal_amount"=>"'$total_price'", "payment_type"=>"'$payment_method'", "payment_status"=>"' $payment_status'","order_status"=>"'$order_status'","date"=>"'$created_at'"]);
            $obj->getResult();
            $order_id = $obj->mysqli->insert_id;
            foreach ($_SESSION["cart"] as $key => $value) { 
                foreach ($value as $k => $v) { 
                    $qty = $v["qty"];
            $obj->insert("`order_products_details`",["o_id"=> "'$order_id'","p_id"=>"'$key'","qtity"=>"'$qty'","p_attr_id" => "'$k'"]);
            $obj->getResult();
             
                }
              
            }
             unset($_SESSION["cart"]);
           echo json_encode(["result"=> "success"]);

            
            
   }

    ?>