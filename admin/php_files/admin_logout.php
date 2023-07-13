<?php
       session_start();
       unset($_SESSION["admin_login"]);
       unset($_SESSION["admin_name"]);
       unset($_SESSION["id"]);
       header("Location:../");
    //    die();
echo "dd";
?>