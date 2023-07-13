<?php
include "../../Database/DB.inc.php";
$obj = new database();
$input = file_get_contents("PHP://INPUT"); 
$decoded = json_decode($input,true);
// $name = $obj->escapeString($decoded['admin_name']);
// $pass = $obj->escapeString($decoded['admin_pass']) ;
$name = $decoded['admin_name'];
$pass = $decoded['admin_pass'] ;


$sql = $obj->select("admin","*",null,"admin_name = '$name' and status = 1");
$user_row = $obj->getResult()[0];
if (count($user_row) > 0) {
    if (count($user_row) > 0) {
        $_SESSION["admin_login"] = "yes";
        $_SESSION["admin_name"] = $name;
        $_SESSION["id"] = $user_row[0]["id"];
        echo json_encode(["result" => "success"]);
    } else {
        echo json_encode(["result" => "Incorrect password"]);
    }   
}else{
    echo json_encode(["result" => "Incorrect adminName"]);
}
?>

