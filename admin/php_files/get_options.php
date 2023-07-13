<?php
include "../../Database/DB.inc.php";
$obj = new database();
$comming_data = file_get_contents("PHP://INPUT");
$decoded_data = json_decode($comming_data,true);
$cat_id= $decoded_data["cat_id"];
$sub_cat_id= $decoded_data["sub_cat_id"];
$brand_id= $decoded_data["brand_id"];
$result = [];
$sub_cat_options = "";
$brand_options = "";


$obj->select("sub_categries","*",null,"cat_id = $cat_id");
$sub_cat_raws = $obj->getResult()[0];

if ($sub_cat_id=="") {
    if (count($sub_cat_raws) > 0) {
        $sub_cat_options .= '<option  value="0">Select Sub category</option>';
        foreach ($sub_cat_raws as $sub_cat_raw) {
        $sub_cat_options .= '<option  value="'.$sub_cat_raw["sub_id"].'">'.$sub_cat_raw["title"].'</option>';
    }
    }else{
        $sub_cat_options .= '<option  value="0">No sub category</option>';
    }
    
    $obj->select("brands","*",null,"cat_id = $cat_id");
    $brand_raws = $obj->getResult()[0];
    if (count($brand_raws) > 0) {
        $brand_options .= '<option  value="0">Select Brand</option>';
        foreach ($brand_raws as $brand_raw) {
        $brand_options .= '<option  value="'.$brand_raw["brand_id"].'">'.$brand_raw["brand_title"].'</option>';
    }
    }else{
        $brand_options .= '<option  value="0">No Brand</option>';
    }
    array_push($result,$sub_cat_options);
    array_push($result,$brand_options);
    echo json_encode($result);
    

}else{
    
    if (count($sub_cat_raws) > 0) {
        $sub_cat_options .= '<option  value="0">Select Sub category</option>';
        foreach ($sub_cat_raws as $sub_cat_raw) {
            if ($sub_cat_raw["sub_id"] == $sub_cat_id) {
               $selected = "selected";
            }else{
                $selected = "";
            }
        $sub_cat_options .= '<option '.$selected.' value="'.$sub_cat_raw["sub_id"].'">'.$sub_cat_raw["title"].'</option>';
    }
    }else{
        $sub_cat_options .= '<option  value="0">No sub category</option>';
    }
    
    $obj->select("brands","*",null,"cat_id = $cat_id");
    $brand_raws = $obj->getResult()[0];
    if (count($brand_raws) > 0) {
        $brand_options .= '<option  value="0">Select Brand</option>';
        foreach ($brand_raws as $brand_raw) {
            if ($brand_raw["brand_id"] == $brand_id) {
                $selected = "selected";
             }else{
                 $selected = "";
             }
        $brand_options .= '<option '.$selected.'  value="'.$brand_raw["brand_id"].'">'.$brand_raw["brand_title"].'</option>';
    }
    }else{
        $brand_options .= '<option  value="0">No Brand</option>';
    }
    array_push($result,$sub_cat_options);
    array_push($result,$brand_options);
    echo json_encode($result);
}


?>
