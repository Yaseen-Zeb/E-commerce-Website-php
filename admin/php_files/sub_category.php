<?php
include "../../Database/DB.inc.php";
$obj = new database();

$sub_cat_name = $_POST["sub_cat_name"];
$category_id = $_POST["selected_category"];

if ($sub_cat_name == "" || $category_id == 0) {
    echo json_encode(["result" => "Please fill input feild" ]);
}else{
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $obj->select("sub_categries","*",null,"title = '$sub_cat_name' and cat_id = '$category_id'");
        $data = $obj->getResult()[0];
       if (count($data) > 0) {
        if ($data[0]["sub_id"] != $id) { // if we not change the sub_cat and submit than error will come that "cat_already exists" therefore we check its id too
            echo json_encode(["result" => "Category you entered already exist" ]);
        }else{
            $obj->update("sub_categries",["title" => "'$sub_cat_name'"],"sub_id = $id");
        $obj->getResult();
        echo json_encode(["result" => "sub_cat_success"]);
        }
       }else{
        $obj->update("categries",["title" => "'$sub_cat_name'"],"sub_id = $id");
        $obj->getResult();
        echo json_encode(["result" => "sub_cat_success"]);
       }
        
    }else{
$obj->select("sub_categries","*",null,"title = '$sub_cat_name' and cat_id = '$category_id'");
if (count($obj->getResult()[0]) <= 0) {
    $obj->insert("sub_categries",["cat_id" => "'$category_id'","title" => "'$sub_cat_name'","sub_status" => 1]);
    $obj->getResult();
    echo json_encode(["result" => "success" ]);
}else{
    echo json_encode(["result" => "Sub Category you entered already exist" ]);
}
}
}
?>