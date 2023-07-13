<?php
include "../Database/DB.inc.php";
$obj = new database();
$input = file_get_contents("PHP://INPUT");
$decode = json_decode($input,true);
if (isset($_SESSION["login"])) {
    $pid = $decode["PID"];
    $u_id = $_SESSION['user_email'];
    $date = date("d-M-Y h:i:s");
    $obj->select("wishlist","*",null,"P_id = $pid");
   if (count($obj->getResult()[0]) > 0) {
    echo json_encode(["result"=> "success"]);
   }else{
    $obj->insert("wishlist",["user_email"=>"'$u_id'","P_id"=>"'$pid'","date"=>"'$date'"]);
    $obj->getResult();
        echo json_encode(["result"=> "success"]);
   }
    
    
}else{
    echo json_encode(["result"=> "Please first login or register than you will be allow to add wishlist"]);
}



?>