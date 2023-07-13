<?php
include "header.php";
if (isset($_GET["id"]) && $_GET["id"]!="" || isset($_GET["cat_id"]) && $_GET["cat_id"]!="" || isset($_GET["sub_cat_id"]) && $_GET["sub_cat_id"]!="") {
    $pid = $_GET["id"];
    $cat_id = $_GET["cat_id"];
    $sub_cat_id = $_GET["sub_cat_id"];

   $obj->select("products","*",null,"P_id=$pid");
   $row = $obj->getResult()[0][0];
  //  show_arr($row);

   $obj->select("product_attributes","*",null,"product_id=$pid");
   $p_attr_row = $obj->getResult()[0];
  //  show_arr($p_attr_row);


$obj->select("product_imgs","*","products on `product_imgs`.pid = products.P_id","pid = $pid");
$p_img_rows = $obj->getResult()[0];


if (isset($_GET["pi"])) {
  $obj->select("product_imgs","*",null,"id = ".$_GET['pi']."");
  unlink("product_images/". $obj->getResult()[0][0]["p_img"]);
  $obj->SQL("DELETE from `product_imgs` where id = ".$_GET['pi']."");
  $obj->getResult();

  header('Location: '.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'&cat_id='.$_GET["cat_id"].'&sub_cat_id='.$_GET["sub_cat_id"].'&brand_id='.$_GET["brand_id"].'');
}

if (isset($_GET["attr_id"])) {
  $obj->SQL("DELETE from `product_attributes` where p_att_id = ".$_GET['attr_id']."");
  $obj->getResult();
  header('Location: '.$_SERVER["PHP_SELF"].'?id='.$_GET["id"].'&cat_id='.$_GET["cat_id"].'&sub_cat_id='.$_GET["sub_cat_id"].'&brand_id='.$_GET["brand_id"].'');
}
} 

?>
                    <!-- Content Start -->
      
    <div class="admin-content-container">
        <h2 class="admin-heading">Add New Product</h2>
        <div class="alert alert-danger error" style="padding: 4px;margin-top: 8px; display:none ">dd</div>
   <div class="alert alert-success success" style="padding: 4px;margin-top: 8px; display:none ">dd</div>
        <form action="" class="add-post-form row form pro_form" method="post" enctype="multipart/form-data">
            <div class="col-md-8">
                <div class="form-group col-md-12">
                 <?php if (isset($_GET["id"])) {
                  echo '<input type="hidden" class="hidden" name="hidden" value="'.$pid.'">';
                 } 
                   ?>
                  
                    <label for="">Product Title</label>
                    <input required type="text" class="form-control product_title" name="product_title" placeholder="Product Title"  value="<?php
                if (isset($_GET["id"])) {
                  echo $row["P_name"];
                } else {
                  echo'';
                }
                ?>">
                </div>
                <!--  -->
                <div class="form-group  col-md-4"  id="cat_id">
                    <label for="">Product Category</label> 
                    <?php
                    if (isset($_GET["id"])) {?>
                     <select class="form-control product_category" name="product_cat">
                      <?php
                                          $obj->select("categries","*");
                                          $selected;
                                          foreach ($obj->getResult()[0] as $val) {
                                            if ($row["cat_id"] == $val["id"]) {
                                             $selected = "selected";
                                            }else{
                                              $selected = "";
                                            }
                      echo  '<option '.$selected.'  value="'.$val["id"].'">'.$val["name"].'</option>';
                    
                      }
                        echo  '</select>';
                    }
                     else {
                     echo '<select class="form-control product_category" name="product_cat">';
                                      echo    '<option value="0" >Select Category</option>';
                                          $obj->select("categries","*",null,"status = 1");
                                          foreach ($obj->getResult()[0] as $value) {
                      echo  '<option  value="'.$value["id"].'">'.$value["name"].'</option>';
                      }
                        echo  '</select>';
                    }
                     
                    ?>
                </div>
                <!--  -->
                <div class="form-group  col-md-4 sub_cat_selector">
                    <label for="">Product Sub Category</label> 
                    <?php
                    if (isset($_GET["id"])) {
                      echo '<select class="form-control product_category" name="product_sub_cat">';
                                          $obj->select("sub_categries","*",null,"cat_id = $cat_id");
                                          $selected;
                                          foreach ($obj->getResult()[0] as $val) {
                                            if ($row["sub_cat_id"] == $val["sub_id"]) {
                                             $selected = "selected";
                                            }else{
                                              $selected = "";
                                            }
                      echo  '<option  '.$selected.'  value="'.$val["sub_id"].'">'.$val["title"].'</option>';
                    
                      }
                        echo  '</select>';
                      
                    }
                     else {
                     echo '<select class="form-control product_category" name="product_sub_cat">';
                                      echo    '<option value="0" >Select Sub Category</option>';
                                          $obj->select("sub_categries","*",null,"sub_status = 1");
                                          foreach ($obj->getResult()[0] as $value) {
                      echo  '<option  value="'.$value["sub_id"].'">'.$value["title"].'</option>';
                      }
                        echo  '</select>';
                    }
                     
                    ?>
                </div>
                <!--  -->
                <div class="form-group  col-md-4 brand_selector">
                    <label for="">Product Brand</label> 
                    <?php
                    if (isset($_GET["id"])) {
                      echo '<select class="form-control product_category" name="product_brand">';
                    echo '<option value="0">Select Brand</option>';
                                          $obj->select("brands","*",null,"cat_id = $cat_id");
                                          $selected;
                                          foreach ($obj->getResult()[0] as $val) {
                                            if ($row["brand_id"] == $val["brand_id"]) {
                                             $selected = "selected";
                                            }else{
                                              $selected = "";
                                            }
                      echo  '<option  '.$selected.'  value="'.$val["brand_id"].'">'.$val["brand_title"].'</option>';
                    
                      }
                        echo  '</select>';
                      
                    }
                     else {
                     echo '<select class="form-control product_category" name="product_brand">';
                                      echo    '<option value="0" >Select Brand</option>';
                                          $obj->select("brands","*",null,"brand_status = 1");
                                          foreach ($obj->getResult()[0] as $value) {
                      echo  '<option  value="'.$value["brand_id"].'">'.$value["brand_title"].'</option>';
                      }
                        echo  '</select>';
                    }
                     
                    ?>
                </div>

                <!--  -->
              <?php 
              if (isset($_GET["id"])) {
                if (count($p_attr_row) <= 0) {
?>
                  <div class="attr">
                  <div class="form-group col-md-3">
                  <label for="">Price</label>
                  <input placeholder="Price" required type="text" class="form-control product_price" name="product_price[]" requried="">
              </div>
              <div class="form-group col-md-2">
                  <label for="">Qty</label>
                  <input placeholder="Qty" required type="number" class="form-control product_qty" name="product_qty[]" requried="">
              </div>
              <div class="form-group col-md-2" >
              <label for="">Size</label> 
                   <select id="size_selector"  class="form-control product_category" name="size[]">
                                    <option value="0" >Size</option>
                                    <?php
                                        $obj->select("size","*",null,"status = 1");
                                        foreach ($obj->getResult()[0] as $value) {
                                          ?>
                    <option  value="<?php echo $value["id"]?>"><?php echo $value["size"] ?></option>
                    <?php
                    }
                    ?>
                    </select>
              </div>
              <div class="form-group col-md-3">
              <label for="">Color</label> 
                  
                   <select id="color_selector" class="form-control product_category" name="color[]">';
                                    <option value="0" >Color</option>
                                    <?php
                                        $obj->select("color","*",null,"status = 1");
                                        foreach ($obj->getResult()[0] as $value) {
                                          ?>
                    <option  value="<?php echo $value["id"]?>"><?php echo $value["color"] ?></option>
                    <?php
                    }
                    ?>
                    </select>
                  
              </div>
              <div class="form-group col-md-2">
                
              <input onclick="add_attr()" style="margin-top: 22px;" type="button" class="btn btn-info" value="Add attr">
              </div>
              </div>
              <?php
                }else{ 
                   $attr_con_btn = 1;
                  foreach ($p_attr_row as $att_row) {
                  ($attr_con_btn == 1)?$attr = "attr": $attr = "";
                   ?>
  <div class="<?php echo $attr ?> attr_<?php echo $attr_con_btn ?>">
                      <div class="form-group col-md-3">
                      <label for="">Price</label>
                      <input placeholder="Price" required type="text" class="form-control product_price" name="product_price[]" requried="" value="<?php echo $att_row["product_price"]?>">
                  </div>
                  <div class="form-group col-md-2">
                      <label for="">Qty</label>
                      <input placeholder="Qty" required type="number" class="form-control product_qty" name="product_qty[]" requried="" value="<?php echo $att_row["qty"]?>">
                  </div>
                  <div class="form-group col-md-2" >
                  <label for="">Size</label> 
                       <select id="size_selector"  class="form-control product_category" name="size[]">
                       
                                        <option value="0" >Size</option>
                                        <?php
                                            $obj->select("size","*",null,"status = 1");
                                            foreach ($obj->getResult()[0] as $value) {
                                             ($value["id"] == $att_row["size_id"]) ? $selected = "selected" : $selected = "";
                                              ?>
                        <option <?php echo $selected ?>  value="<?php echo $value["id"]?>"><?php echo $value["size"] ?></option>
                        <?php
                        }
                        ?>
                        </select>
                  </div>
                  <div class="form-group col-md-3">
                  <label for="">Color</label> 
                      
                       <select id="color_selector" class="form-control product_category" name="color[]">';
                                        <option value="0" >Color</option>
                                        <?php
                                            $obj->select("color","*",null,"status = 1");
                                            foreach ($obj->getResult()[0] as $value) {
                                              ($value["id"] == $att_row["color_id"]) ? $selected = "selected" : $selected = "";
                                              ?>
                        <option <?php echo $selected ?>  value="<?php echo $value["id"]?>"><?php echo $value["color"] ?></option>
                        <?php
                        }
                        ?>
                        </select>
                      
                  </div>
                  <input type="hidden" name="update_attr_ids[]" value="<?php echo $att_row["p_att_id"] ?>">
                  <div class="form-group col-md-2">
                    <?php if ($attr_con_btn == 1) {
                   echo '<input onclick="add_attr()" style="margin-top: 22px;" type="button" class="btn btn-info" value="Add attr">';
                    }else{
                      echo '<a href="?id='.$_GET["id"].'&cat_id='.$_GET["cat_id"].'&sub_cat_id='.$_GET["sub_cat_id"].'&brand_id='.$_GET["brand_id"].'&attr_id='.$att_row["p_att_id"].'&operation=delete"><input onclick="remove_attr('.$attr_con_btn.')" style="margin-top: 22px;" type="button" class="btn btn-danger" value="remove"></a>';
                    } ?>
                
                  </div>
                  </div>
                   <?php
                   $attr_con_btn++;
                  }}
              
              }else{
              ?>      
                <div class="attr">
                    <div class="form-group col-md-3">
                    <label for="">Price</label>
                    <input placeholder="Price" required type="text" class="form-control product_price" name="product_price[]" requried="">
                </div>
                <div class="form-group col-md-2">
                    <label for="">Qty</label>
                    <input placeholder="Qty" required type="number" class="form-control product_qty" name="product_qty[]" requried="">
                </div>
                <div class="form-group col-md-2" >
                <label for="">Size</label> 
                     <select id="size_selector"  class="form-control product_category" name="size[]">
                                      <option value="0" >Size</option>
                                      <?php
                                          $obj->select("size","*",null,"status = 1");
                                          foreach ($obj->getResult()[0] as $value) {
                                            ?>
                      <option  value="<?php echo $value["id"]?>"><?php echo $value["size"] ?></option>
                      <?php
                      }
                      ?>
                      </select>
                </div>
                <div class="form-group col-md-3">
                <label for="">Color</label> 
                    
                     <select id="color_selector" class="form-control product_category" name="color[]">';
                                      <option value="0" >Color</option>
                                      <?php
                                          $obj->select("color","*",null,"status = 1");
                                          foreach ($obj->getResult()[0] as $value) {
                                            ?>
                      <option  value="<?php echo $value["id"]?>"><?php echo $value["color"] ?></option>
                      <?php
                      }
                      ?>
                      </select>
                    
                </div>
                <div class="form-group col-md-2">
                  
                <input onclick="add_attr()" style="margin-top: 22px;" type="button" class="btn btn-info" value="Add attr">
                </div>
                </div>
                <?php
                
                }
                ?>
                <!--  -->
                <div class="form-group col-md-12">
                    <label for="">Product Description</label>
                    
                    
                    <textarea class="form-control des up_des" rows="9" name="product_desc" placeholder="Enter product description">
                   <?php if (isset($_GET["id"])){
echo $row["description"];
                    }else{
                      echo "";
                    }?>
                    </textarea>';
                    </textarea>
                    <!-- <textarea name="" id="" cols="30" rows="10"></textarea> -->
                </div>
                <div class="form-group col-md-12 text-center" style="display: flex;justify-content: center;">
                <?php
                if (isset($_GET["id"])) {
                  echo '<button type="submit" class="btn btn-info col-md-6 pro_btn" onclick="manage_pro()">Update</button>';
                } else {
                  echo' <button type="submit" class="btn btn-info col-md-6 pro_btn" onclick="manage_pro()">ADD</button>';
                }
                ?>
                 
                </div>
                
            </div>
            <div class="col-md-4">
                <div class="form-group col-md-12 images_div" >
                <div class="form-group col-md-12" >
                  <div class="col-md-8">
                    <label for="">Featured Image</label>
                    <?php 
                    // $feature_img = '<img style="width: 91px;height: 89px;" id="image" src="upload/.'.$row["img"].'">';
                    $required;
                     isset($_GET['id']) ? $required="" : $required = "required"; ?>
                    <input  type="file" class="product_image"  <?php echo $required; ?>  value="<?php echo isset($_GET['id']) ? $row["img"] : ""; ?>" name="featured_img">
                    <?php echo  isset($_GET["id"]) ?  '<a target="_blank" href="upload/'.$row["img"].'"> <img style="width: 91px;height: 89px;" id="image" src="upload/'.$row["img"].'"> </a>' : "" ?>
                  </div>
                  <div class="col-md-4" style="padding:0">
                    <button type="button" class="btn btn-info" style="margin-top:17px" onclick="add_product_img()">ADD Product img</button>
                  </div>
                    </div>
                    <?php
if (isset($_GET["id"])) {
  # code...

if(count($p_img_rows) > 0){
                     
foreach ($p_img_rows as $value) {
 
  ?>

<div class="form-group col-md-12 img_num_${image_num}" >
  <div class="col-md-8 ">
    <label for="">Image</label>
    <input  type="file" class="product_image"  name="product_images[]">
   <a target="_blank" href="<?php  echo "product_images/".$value["p_img"] ?>"> <img style="width: 91px;height: 89px;" id="image" src="<?php  echo "product_images/".$value["p_img"] ?>"> </a>
  </div>
  <div class="col-md-4  " style="text-align:end;padding:0">
   <a href="<?php echo '?id='.$_GET["id"].'&cat_id='.$_GET["cat_id"].'&sub_cat_id='.$_GET["sub_cat_id"].'&brand_id='.$_GET["brand_id"].'&pi='.$value["id"].''  ?>" class="btn btn-danger" style="margin-top:17px" >Dalete</a>
  </div></div>
  <input type="hidden" name="p_imgs_ids[]" id="" value="<?php echo $value['id'] ?>">
  <?php
}
                    }
                  }

                    ?>
              </div>
               
                <div class="form-group col-md-12">
                    <label>Status</label>
                    <select class="form-control product_status" name="product_status">
                      <?php
                      
                      if (isset($_GET["id"]) || $_GET["id"]!="") {
                        if ($row["P_status"] == 1) {
                          echo '<option selected value="1">Active</option>
                           <option value="0">Deactive</option>';
                          }else{
                            echo '<option  value="1">Active</option>
                           <option selected value="0">Deactive</option>';
                          }
                      } else {
                        echo '<option  value="">Seelect Status</option>
                        <option  value="1">Active</option>
                        <option  value="0">Deactive</option>';
                      }
                      ?>
                    </select>
                 
                </div>
            </div> 
        </form>
    </div>
                  
<?php
include "footer.php";
if (isset($_GET["cat_id"]) && isset($_GET["sub_cat_id"]) && isset($_GET["brand_id"])) {
  $cat_id = $_GET["cat_id"];
  $sub_cat_id = $_GET["sub_cat_id"];
  $brand_id = $_GET["brand_id"];
  ?>
<script>
      get_options(<?php echo $cat_id ?>,<?php echo $sub_cat_id ?>,<?php echo $brand_id ?>);
     </script>
     <?php
}
?>
    

