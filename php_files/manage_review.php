<?php
include "../Database/DB.inc.php";
$obj = new database();


$comment = $obj->escapeString($_POST["comment"]);
$p_id = $obj->escapeString($_POST["p_id"]);
$rating = $obj->escapeString($_POST["rating"]);
$u_email =$_SESSION["user_email"];
$date = date("d-M-Y h:m:s");

// echo json_encode(["result"=> $_POST]);
if ($rating == 0 || $rating == "") {
    echo json_encode(["result"=> "Please select rating"]);
}else if($comment == ""){
    echo json_encode(["result"=> "Please Fill Review Feild"]);
}else{
    $obj->insert("reviews",["p_id"=>$p_id,"u_email"=>"'$u_email'","rating"=>"'$rating'","comment"=>"'$comment'","status"=>0,"date"=>"'$date'"]);
    $obj->getResult();
    echo json_encode(["result"=> "success"]);
}
?>	
