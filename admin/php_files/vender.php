<?php
include "../../Database/DB.inc.php";
$obj = new database();


$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $obj->select("admin","*",null,"id = $id");
  $condition = $obj->getResult()[0][0];
    if ($name == "" || $password=="" || $email=="" || $mobile =="") {
        echo json_encode(["result" =>  "Fill all feilds"]);  
    }else{
        if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $obj->select("admin","*",null,"admin_name = '$name'");
      if (count( $obj->getResult()[0]) > 0) {
        if ($condition["admin_name"] == $name) {
            if ($condition["email"] == $email) {
                echo json_encode(["result" =>  "up_success"]);
            }else{
                echo json_encode(["result" =>  "email vender already exists"]);
            }
        }else{
            echo json_encode(["result" =>  "name vender already exists"]);
        }
        
      }else{
            $sql = $obj->SQL("UPDATE `admin` SET `admin_name`='$name',`password`='$password',`email`='$email',`moblie`='$mobile' WHERE id = $id");
            $obj->getResult();
         echo json_encode(["result" =>  "up_success"]);
        }
      }else{
            echo json_encode(["result" =>  "please enter valid email"]); 
        }
    }
}else {

    if ($name == "" || $password=="" || $email=="" || $mobile =="") {
        echo json_encode(["result" =>  "Fill all feilds"]);  
    }else{
        if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $obj->select("admin","*",null,"admin_name = '$name'");
      if (count( $obj->getResult()[0]) > 0) {
        echo json_encode(["result" =>  "$name name vender already exists"]);  
        // echo json_encode(["result" =>  "$r"]);  
      }else{
        $obj->select("admin","*",null,"email = '$email'");
        if (count( $obj->getResult()[0]) > 0) {
            echo json_encode(["result" =>  "$email email already exists"]);
        }else{
            $sql = $obj->SQL("INSERT INTO `admin`(`admin_name`,`password`,`email`, `moblie`, `role`, `status`) VALUES ('$name','$password','$email','$mobile','0','1')");
            $obj->getResult();
         echo json_encode(["result" =>  "success"]);
        }
      }
        }else{
            echo json_encode(["result" =>  "please enter valid email"]); 
        }
      
           
    }
        
    

	
	
	
	
	

    }
// }

// echo json_encode(["result" =>  $_POST]); 

    

?>