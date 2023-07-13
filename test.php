<?php 
session_start();
echo "<pre>";
print_r($_SESSION["cart"]);

foreach ($_SESSION["cart"] as $key => $value) { 
    foreach ($value as $k => $v) { 
        echo "pro".$key."<br>";
        echo "attr".$k."<br>";
        echo "qty".$v["qty"]."<br>";
    }
  
}
?>