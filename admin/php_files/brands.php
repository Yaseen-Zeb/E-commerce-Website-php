<?php
include "../../Database/DB.inc.php";
$obj = new database();




$brand_name = $_POST["brand_name"];
$category_id = $_POST["selected_category"];

if ($brand_name == "" || $category_id == 0) {
    echo json_encode(["result" => "Please fill input feild" ]);
}else{
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $obj->select("brands","*",null,"brand_title = '$brand_name' and cat_id = '$category_id'");
        $data = $obj->getResult()[0];
       if (count($data) > 0) {
        if ($data[0]["brand_id"] != $id) { // if we not change the sub_cat and submit than error will come that "brand already exists" therefore we check its id too
            echo json_encode(["result" => "Category you entered already exist" ]);
        }else{
            $obj->update("brands",["brand_title" => "'$brand_name'","cat_id" => "'$category_id'"],"brand_id = $id");
        $obj->getResult();
        echo json_encode(["result" => "brand_success"]);
        }
       }else{
        $obj->update("brands",["brand_title" => "'$brand_name'","cat_id" => "'$category_id'"],"brand_id = $id");
        $obj->getResult();
        echo json_encode(["result" => "brand_success"]);
       }
        
    }else{
$obj->select("brands","*",null,"brand_title = '$brand_name' and cat_id = '$category_id'");
if (count($obj->getResult()[0]) <= 0) {
    $obj->insert("brands",["brand_title" => "'$brand_name'","cat_id" => "'$category_id'","brand_status" => 1]);
    $obj->getResult();
    echo json_encode(["result" => "success" ]);
}else{
    echo json_encode(["result" => "Brand name you entered already exist" ]);
}
}
}
?>