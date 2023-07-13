<?php
include "../cart_manage_class.inc.php";
$obj = new cart();
include "../Database/DB.inc.php";
$obj_db = new database();
$input = file_get_contents("PHP://INPUT");
$decoded_data = json_decode($input,true);

$pid =$decoded_data["PID"];
$qty =$decoded_data["QTY"];
$action =$decoded_data["ACTION"];
$color_id =$decoded_data["CID"];
$size_id =$decoded_data["SID"];


$conn="";
if ($color_id != "null" && $color_id == "") {
   echo json_encode(["result"=>"Select Color First"]);
   die();
}else if ($size_id != "null" && $size_id == "") {
   echo json_encode(["result"=>"Select Size"]);
   die();
}else if ($color_id == "null" && $size_id != "null"){
   $conn .= " size_id = $size_id AND product_id = $pid ";
}else if ($size_id == "null" && $color_id != "null"){
   $conn .= " color_id = $color_id AND product_id = $pid ";
}else if (($color_id != "null" && $color_id != "") && ($size_id != "null" && $size_id != "")){
   $conn .= " color_id = $color_id AND size_id = $size_id AND product_id = $pid ";
}else if ($color_id == "null" && $size_id == "null"){
   $conn .= " product_id = $pid ";
}
// echo $conn;
   $obj_db->select("product_attributes","*",null,"".$conn."");
   $product_attribue_id = $obj_db->getResult()[0][0]["p_att_id"]; // attribute id related to $pid
// die();
if ($action == "add") {
      $new_qty = $qty;
   $obj->addProduct($pid,$new_qty,$product_attribue_id);
   echo json_encode(["result"=>"add_success"]);
   }

if ($action == "update") {
   $att_id =$decoded_data["ATT_ID"];
   $obj->updateProduct($pid,$qty,$att_id);
   echo json_encode(["result"=>"update_success"]);
}
if ($action == "delete") {
   $att_id =$decoded_data["ATT_ID"];
   $obj->removeProduct($pid,$att_id);
   echo json_encode(["result"=>"delete_success"]);
}

?>