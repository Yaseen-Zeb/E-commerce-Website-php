<?php
include "../../Database/DB.inc.php";
$obj = new database();
$comming_data = file_get_contents("PHP://INPUT");
$decoded_data = json_decode($comming_data,true);
$size_name = $decoded_data["size_name"];


if ($size_name == "") {
    echo json_encode(["result" => "Please fill input feild" ]);
}else{
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $obj->select("size","*",null,"size = '$size_name'");
        $data = $obj->getResult()[0];
       if (count($data) > 0) {
        if ($data[0]["id"] != $id) {
            echo json_encode(["result" => "Size you entered already exist" ]);
        }else{
            $obj->update("size",["size" => "'$size_name'"],"id = $id");
        $obj->getResult();
        echo json_encode(["result" => "cat_success"]);
        }
       }else{
        $obj->update("size",["size" => "'$size_name'"],"id = $id");
        $obj->getResult();
        echo json_encode(["result" => "cat_success"]);
       }
        
    }else{
$obj->select("size","*",null,"size = '$size_name'");
if (count($obj->getResult()[0]) <= 0) {
    $obj->insert("size",["size" => "'$size_name'","status" => 1]);
    $obj->getResult();
    echo json_encode(["result" => "success" ]);
}else{
    echo json_encode(["result" => "Size you entered already exist" ]);
}
}
}

    

?>