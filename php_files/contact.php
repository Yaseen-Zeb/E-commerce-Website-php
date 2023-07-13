<?php
include "../Database/DB.inc.php";
$obj = new database();

$name = $obj->escapeString($_POST["name"]);
$email = $obj->escapeString($_POST["email"]);
$phone = $obj->escapeString($_POST["phone"]);
$comment = $obj->escapeString($_POST["comment"]);
$at = date('d-M-Y h:i:s');

if ($name=="" || $email=="" || $phone=="" || $comment=="") {
    echo json_encode(["result"=> " Please fill all input feilds!"]);
}else{
    if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $obj->insert("contact" ,["user_name" => "'$name'", "email"=>"'$email'", "mob_number"=>"'$phone'", "msg"=>"'$comment'", "at"=>"' $at'"]);
    $obj->getResult();
    echo json_encode(["result"=> "success"]);
    }else{
        echo json_encode(["result"=> "Please enter valid Email i.e abc45@gmail.com"]);
    }
}
?>

