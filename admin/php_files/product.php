<?php
include "../../Database/DB.inc.php";
$obj = new database();


$name = $_POST["product_title"];
$cat = $_POST["product_cat"];
$sub_cat_id = $_POST["product_sub_cat"];
$brand_id = $_POST["product_brand"];
$des = $_POST["product_desc"];
$price = $_POST["product_price"];
$qty = $_POST["product_qty"];
$status = $_POST["product_status"];
$color = $_POST["color"];
$size = $_POST["size"];
$product_price = $_POST["product_price"];
$product_qty = $_POST["product_qty"];
$des = trim($des);
$last_product_id;
$msg = "";

// echo json_encode(["result" =>  $_POST]);  
// die();

// die();

// show_arr() ;
// echo json_encode(["result" => $_POST["p_imgs_ids"][0]]);   
// echo json_encode(["result" => $_FILES["product_images"]]);   

// if (isset($_FILES["product_images"]) && $_FILES["product_images"]["name"][0] == "") {
//     echo json_encode(["result" =>  "Please fil all input feilds"]);  
//     die();
// }else if (isset($_FILES["product_images"]) && $_FILES["product_images"]["name"][0] != ""){
//     foreach ($_FILES["product_images"]["type"] as $key => $value) {
//         if ($_FILES["product_images"]["type"][$key] != "image/jpeg" && $_FILES["product_images"]["type"][$key] != "image/jpg" && $_FILES["product_images"]["type"][$key] != "image/png") {
//           echo json_encode(["result" =>  "Please select png, jpeg, jpg formate file"]);  
//           die();
//         }
//         } 
// }


// die();

if ($brand_id==0) {
    $brand_id="";
        }
$P =[];
$Q = [];
$S = [];
$C =[];
        foreach ($color as $key => $value) {
         array_push($P,$product_price[$key]);
         array_push($Q,$qty[$key]);
        }

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    if ($name == "" || $cat=="0" || $sub_cat_id==0 || $des == '' || $status =="" || in_array("",$P) || in_array("",$Q)) {
        echo json_encode(["result" =>  "Fill all feilds"]); 
        die(); 
    }else{
        if (!isset($_POST["update_attr_ids"]) ) {
            $obj->insert("product_attributes",["product_id"=>$id,"color_id"=>"'$color[$key]'","size_id"=>$size[$key],"product_price"=>"'$price[$key]'","qty"=>"'$qty[$key]'"]);
            $obj->getResult();
            $msg = "";
            $msg = "pro_success";
       
        }else{
            $update_attr_ids = $_POST["update_attr_ids"];
        }
        
        if (isset($_FILES["featured_img"]) && $_FILES["featured_img"]["name"] != "") {
            $file_name = $_FILES["featured_img"]["name"];
            $file_type = $_FILES["featured_img"]["type"];
            $file_tmp_name = $_FILES["featured_img"]["tmp_name"];
            $ext = explode("." , $file_name);
            $ext = end($ext);
            $exts = ["jpg","jpeg","png"];
            if ($c = in_array($ext,$exts)) {
             $uni_img_name = rand(1111111,9999999);
             $uni_img_name= $uni_img_name.'-'.$file_name;
             $obj->select("products","*",null,"P_id = $id");
          if (unlink("../upload/".$obj->getResult()[0][0]["img"])) {
            $obj->SQL("UPDATE `products` SET `cat_id`='$cat',`sub_cat_id`='$sub_cat_id',`brand_id`='$brand_id',`P_name`='$name',`description`='$des',`img`='$uni_img_name',`P_status`='$status' WHERE P_id = $id");
    $obj->getResult();
             move_uploaded_file($file_tmp_name,"../upload/".$uni_img_name);
             }
             if (isset($_FILES["product_images"])) {
                foreach ($_FILES["product_images"]["name"] as $key => $value) {
                    if ($_FILES["product_images"]["name"] != "") {
                        # code...
                    
                    if (isset($_POST["p_imgs_ids"][$key])) {
                      if ($_FILES["product_images"]["name"][$key] != "") {
                       $img_name = rand(111111,999999)."-".$_FILES["product_images"]["name"][$key];
                       $obj->select("product_imgs","*",null,"id = ".$_POST['p_imgs_ids'][$key]."");
                       unlink("../product_images/".$obj->getResult()[0][0]["p_img"]);
                       $obj->update("product_imgs",["p_img"=>"'$img_name'"],"id = '".$_POST["p_imgs_ids"][$key]."'");
                       $obj->getResult();
                       move_uploaded_file($_FILES["product_images"]["tmp_name"][$key],"../product_images/".$img_name);
                       
                    }
                    }else{
                        $img_name = rand(1111,9999);
                        $img_name = $img_name."-".$_FILES["product_images"]["name"][$key];
                        move_uploaded_file($_FILES["product_images"]["tmp_name"][$key],"../product_images/".$img_name);
                        $obj->SQL("INSERT INTO `product_imgs`(`pid`, `p_img`) VALUES ('$last_product_id','$img_name')");
                        $obj->getResult(); 
                }
                    }else{
                        $obj->SQL("UPDATE `products` SET `cat_id`='$cat',`sub_cat_id`='$sub_cat_id',`brand_id`='$brand_id',`P_name`='$name',`price`='$price',`quantity`='$qty',`description`='$des',`img`='$uni_img_name',`P_status`='$status' WHERE P_id = $id");
                        $obj->getResult();
                    }
                    
                }
            }
                
             
          }else{
                echo json_encode(["result" =>  "Select png, jpeg, jpg format file"]);
            }
    }else{ 
  $obj->SQL("UPDATE `products` SET `cat_id`='$cat',`sub_cat_id`='$sub_cat_id',`brand_id`='$brand_id',`P_name`='$name',`description`='$des',`P_status`='$status' WHERE P_id = $id");
        $obj->getResult();
        if (isset($_FILES["product_images"])) {
            foreach ($_FILES["product_images"]["name"] as $key => $value) {
                if ($_FILES["product_images"]["name"][$key] != "") {
                if (isset($_POST["p_imgs_ids"][$key])) {
                   $img_name = rand(111111,999999)."-".$_FILES["product_images"]["name"][$key];
                   $obj->select("product_imgs","*",null,"id = ".$_POST['p_imgs_ids'][$key]."");
                   unlink("../product_images/".$obj->getresult()[0][0]["p_img"]);
                   $obj->update("product_imgs",["p_img"=>"'$img_name'"],"id = '".$_POST["p_imgs_ids"][$key]."'");
                   $obj->getResult();
                   move_uploaded_file($_FILES["product_images"]["tmp_name"][$key],"../product_images/".$img_name);
                }else{
                    $img_name = rand(1111,9999);
                    $img_name = $img_name."-".$_FILES["product_images"]["name"][$key];
                    move_uploaded_file($_FILES["product_images"]["tmp_name"][$key],"../product_images/".$img_name);
                    $obj->SQL("INSERT INTO `product_imgs`(`pid`, `p_img`) VALUES ('$id','$img_name')");
                     $obj->getResult();
            }
            
        }else{
            $obj->SQL("UPDATE `products` SET `cat_id`='$cat',`sub_cat_id`='$sub_cat_id',`brand_id`='$brand_id',`P_name`='$name',`description`='$des',`P_status`='$status' WHERE P_id = $id");
        $obj->getResult();
        }
                }

           
            }

        
    }
    }
}else {
    if ($name == "" || $cat=="0" || $sub_cat_id==0 || $des == '' || $price=="" || $qty=="" || $status =="" || in_array("",$P) || in_array("",$Q)) {
        echo json_encode(["result" =>  "Fill all feilds"]);  
        die();
    }else{
        if (isset($_FILES["featured_img"]) && $_FILES["featured_img"]["name"] != "") {
            $file_name = $_FILES["featured_img"]["name"];
            $file_type = $_FILES["featured_img"]["type"];
            $file_tmp_name = $_FILES["featured_img"]["tmp_name"];
            $ext = explode("." , $file_name);
            $ext = end($ext);
            $exts = ["jpg","jpeg","png"];
            if ($c = in_array($ext,$exts)) {
             $uni_img_name = rand(111111111,999999999);
             $uni_img_name= $uni_img_name.'-'.$file_name;
             $admin_id = $_SESSION["id"];
           $sql = $obj->SQL("INSERT INTO `products`(`cat_id`,sub_cat_id,`brand_id`, `P_name`,`description`, `img`, `P_status`,`admin_id`) VALUES ('$cat','$sub_cat_id','$brand_id','$name','$des','$uni_img_name','$status','$admin_id')");
             move_uploaded_file($file_tmp_name,"../upload/".$uni_img_name);
            $obj->getResult();
            $last_product_id = $obj->mysqli->insert_id;

            if (isset($_FILES["product_images"]) && $_FILES["product_images"]["name"][0] != "") {
                foreach ($_FILES["product_images"]["name"] as $key => $value) { 
                  $img_name = rand(1111,9999);
                  $img_name = $img_name."-".$_FILES["product_images"]["name"][$key];
                  move_uploaded_file($_FILES["product_images"]["tmp_name"][$key],"../product_images/".$img_name);
                                $obj->SQL("INSERT INTO `product_imgs`(`pid`, `p_img`) VALUES ('$last_product_id','$img_name')");
                                $obj->getResult(); 
                }
            // echo json_encode(["result" =>  "success"]);
        }else if(!isset($_FILES["product_images"])){
                // echo json_encode(["result" => "success"]);
            }else if(isset($_FILES["product_images"]) && $_FILES["product_images"]["name"][0] == ""){
                echo json_encode(["result" => "Please select all input feilds"]);
            }

        
           }else{
             echo json_encode(["result" =>  "Select png, jpeg, jpg format file"]);
            }
         }else{
             echo json_encode(["result" =>  "Select an image"]);
         }
    
    }
}


if (in_array("",$P) || in_array("",$Q)) {
    
}else{
    foreach ($product_price as $key => $value) {
        if (isset($_GET["id"])) {
      if (isset($update_attr_ids[$key])) {
       $obj->update("product_attributes",["color_id"=>"'$color[$key]'","size_id"=>$size[$key],"product_price"=>"'$price[$key]'","qty"=>"'$qty[$key]'"],"p_att_id = $update_attr_ids[$key]");
       $obj->getResult();
       $msg = "";
       $msg = "pro_success";
      }else{
        $obj->insert("product_attributes",["product_id"=>$id,"color_id"=>"'$color[$key]'","size_id"=>$size[$key],"product_price"=>"'$price[$key]'","qty"=>"'$qty[$key]'"]);
        $obj->getResult();
        $msg = "";
        $msg = "pro_success";
      }
       }else{					
        $obj->insert("product_attributes",["product_id"=>$last_product_id,"color_id"=>"'$color[$key]'","size_id"=>$size[$key],"product_price"=>"'$price[$key]'","qty"=>"'$qty[$key]'"]);
        $obj->getResult();
        $msg = "success";
       }
        }
       echo json_encode(["result" =>  $msg]);
    }
    



















    

?>