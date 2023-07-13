<?php
include "../Database/DB.inc.php";
$obj = new database();

$name = $obj->escapeString($_POST["reg_name"]);
$email = $obj->escapeString($_POST["reg_email"]);
$pass = $obj->escapeString($_POST["reg_pass"]);
$cpass = $obj->escapeString($_POST["reg_cpass"]);
$created_at = date('d-M-Y h:i:s');
$updated_at = date('d-M-Y h:i:s');
if (isset($_SESSION["to_checkout"])) {
    if ($name=="" || $email=="" || $pass=="" || $cpass=="") {
        echo json_encode(["result"=> " Please fill all input feilds!"]);
    }else{
        if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
            if ($pass != $cpass) {
                echo json_encode(["result"=> "Password feilds should be mached!"]);
            }else{
            $obj->select("users","*",null,"email = '$email'");
            if (count($obj->getResult()[0]) > 0) {
                echo json_encode(["result"=> "Email you entered alredy exists, Please try another another one OR try to login"]);
            }else{
            $obj->insert("users" ,["name"=> "'$name'","password"=>"'$pass'", "email"=>"'$email'", "created_at"=>"' $created_at'","updated_at"=>"'$updated_at'"]);
            $obj->getResult();
           
            $_SESSION["user_name"] = $name;
            $_SESSION["user_id"] = $name;
            $_SESSION["login"] = "yes";
            $_SESSION["user_email"] = $email;
            echo json_encode(["result"=> "checkout"]);
        }
    }
    }else{
            echo json_encode(["result"=> "Please enter valid Email i.e abc45@gmail.com"]);
        }
    
    }
} else {

if ($name=="" || $email=="" || $pass=="" || $cpass=="") {
    echo json_encode(["result"=> " Please fill all input feilds!"]);
}else{
    if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
        if ($pass != $cpass) {
            echo json_encode(["result"=> "Password feilds should be mached!"]);
        }else{
        $obj->select("users","*",null,"email = '$email'");
        if (count($obj->getResult()[0]) > 0) {
            echo json_encode(["result"=> "Email you entered alredy exists, Please try another another one OR try to login"]);
        }else{
        $obj->insert("users" ,["name"=> "'$name'","password"=>"'$pass'", "email"=>"'$email'", "created_at"=>"' $created_at'","updated_at"=>"'$updated_at'"]);
        $obj->getResult();
        $obj->select("users","*",null,"name = '$email' and password = '$pass'");
        $row = $obj->getResult();
        $_SESSION["user_name"] = $name;
        $_SESSION["login"] = "yes";
        $_SESSION["user_email"] = $email;
        echo json_encode(["result"=> "seccess"]);
    }
}
}else{
        echo json_encode(["result"=> "Please enter valid Email i.e abc45@gmail.com"]);
    }

}
}
?>
