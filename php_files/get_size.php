<?php
include "../Database/DB.inc.php";
$obj = new database();
$input = file_get_contents("PHP://INPUT");
$decoded_data = json_decode($input,true);

$pid =$decoded_data["PID"];
$cid =$decoded_data["COLOR_ID"];

$obj->select("product_attributes","*","size on product_attributes.size_id = size.id ","product_id = $pid AND color_id = $cid");
$str = "";
foreach ($obj->getResult()[0] as $key => $value) {
  $A[$value["size_id"]][] = $value["size"];
}
foreach ($A as $key => $value) {
    $str .= '<label class="form-check-label d-flex align-items-center">
    <input style="position:unset;" type="radio" class="form-check-input m-0 mr-1" name="size" id="size_'.$key.'" value="'.$key.'" onclick="get_size('.$pid.',1,2,'.$key.')">
    '.$value[0].'
  </label>';
}
echo json_encode(["result" => $str]);

?>