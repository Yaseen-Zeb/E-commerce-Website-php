<?php
include "../../Database/DB.inc.php";
$obj = new database();
$comming_data = file_get_contents("PHP://INPUT");
$decoded_data = json_decode($comming_data,true);
$color = $decoded_data["color"];


if ($color == "") {
    echo json_encode(["result" => "Please fill input feild" ]);
}else{
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $obj->select("color","*",null,"color = '$color'");
        $data = $obj->getResult()[0];
       if (count($data) > 0) {
        if ($data[0]["id"] != $id) {
            echo json_encode(["result" => "Color you entered already exist" ]);
        }else{
            $obj->update("color",["color" => "'$color'"],"id = $id");
        $obj->getResult();
        echo json_encode(["result" => "cat_success"]);
        }
       }else{
        $obj->update("color",["color" => "'$color'"],"id = $id");
        $obj->getResult();
        echo json_encode(["result" => "cat_success"]);
       }
        
    }else{
$obj->select("color","*",null,"color = '$color'");
if (count($obj->getResult()[0]) <= 0) {
    $obj->insert("color",["color" => "'$color'","status" => 1]);
    $obj->getResult();
    echo json_encode(["result" => "success" ]);
}else{
    echo json_encode(["result" => "Color you entered already exist" ]);
}
}
}

    

?>