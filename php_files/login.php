<?php
include "../Database/DB.inc.php";
$obj = new database();

$email = $obj->escapeString($_POST["login_email"]);
$pass = $obj->escapeString($_POST["login_pass"]);
if (isset($_SESSION["to_checkout"])) {
    if ($email=="" || $pass=="") {
        echo json_encode(["result"=> " Please fill all input feilds!"]);
    }else{
        if (filter_var($email,FILTER_VALIDATE_EMAIL)){
            $obj->select("users","*",null,"email = '$email' AND password='$pass'");
           $row = $obj->getResult()[0];
            if (count($row) > 0){
                $_SESSION["login"] = "yes";
                $_SESSION["user_name"] = $row[0]["name"];
            $_SESSION["user_email"] = $email;
            echo json_encode(["result"=> "checkout"]);
            }else{
                echo json_encode(["result"=> "Incorrect Email Or Password!"]);
            }
        }else{
            echo json_encode(["result"=> "Please enter valid Email i.e abc45@gmail.com"]);
        }
            
    }
   
} else {

if ($email=="" || $pass=="") {
    echo json_encode(["result"=> " Please fill all input feilds!"]);
}else{
    if (filter_var($email,FILTER_VALIDATE_EMAIL)){
        $obj->select("users","*",null,"email = '$email' AND password='$pass'");
       $row = $obj->getResult()[0];
        if (count($row) > 0){
            $_SESSION["login"] = "yes";
            $_SESSION["user_name"] = $row[0]["name"];
        $_SESSION["user_email"] = $email;
        echo json_encode(["result"=> "success"]);
        }else{
            echo json_encode(["result"=> "Incorrect Email Or Password!"]);
        }
    }else{
        echo json_encode(["result"=> "Please enter valid Email i.e abc45@gmail.com"]);
    }
        
}
}
?>