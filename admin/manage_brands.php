<?php
include "header.php";
if (!isset($_SESSION["id"])) {
    header("Location:index.php");
}else{
   $admin_id = $_SESSION["id"];
    $obj->select("admin","*",null,"id = $admin_id");
    if ($obj->getResult()[0][0]["role"] == 0) {
        header("Location:products.php");
    }
}
if (isset($_GET["id"]) && $_GET["id"]!="") {
    $id = $_GET["id"];
   $obj->select("brands","*",null,"brand_id=$id");
   $row = $obj->getResult()[0][0];
}
?>
<div class="admin-content-container">
    <h1  style="margin-bottom:20px;">Add New Brand</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>"  class="col-md-6 form brand_form">
   <div class="form-group ">
     <label for="">Brands</label>
     <?php if (isset($_GET["id"]) && $_GET["id"]!="") echo "<input type='text' value='$id' class='hidden'>"?>
     <input type="text" name="brand_name"  class="form-control cat_name" placeholder="Brand name" required <?php if (isset($_GET["id"]) && $_GET["id"]!="") echo "value=".$row['brand_title'].""; else echo "" ?> >
   </div>
   <!--  -->
   <div class="form-group">
     <label for=""></label>
     <select class="form-control form-control-sm selected_cat" name="selected_category" id="" >
        <option value="0" >Select category</option>
     <?php  
     $obj->select("categries","*",null,"status = 1");
     $cat_rows = $obj->getResult()[0];
     if (!isset($_GET["id"])) { 
        foreach ($cat_rows as $cat_row) {
           echo ' <option value="'.$cat_row["id"].'">'.$cat_row["name"].'</option>';
        }
    }else{
        $selected = "";
        foreach ($cat_rows as $cat_row) {
            if ($cat_row["id"] == $row["cat_id"]) {
                $selected = "selected";
            }else{
                $selected = "";
            }
           echo ' <option '.$selected.' value="'.$cat_row["id"].'">'.$cat_row["name"].'</option>';
        }
    }
        ?>
     </select>
   </div>
   <!--  -->
   <?php if (isset($_GET["id"]) && $_GET["id"]!="") echo '<button onclick="manage_brands()" name="submit" type="submit" class="btn btn-primary add_brand_login_btn">Update</button>'; else echo '<button name="submit" type="submit" class="btn btn-primary add_brand_login_btn" onclick="manage_brands()">ADD</button>' ?>
   <div class="alert alert-danger error" style="padding: 4px;margin-top: 8px; display:none;"></div>
   <div class="alert alert-success success" style="padding: 4px;margin-top: 8px; display:none;"></div>
   
     </form>
     
</div>
<?php
include "footer.php"
?>