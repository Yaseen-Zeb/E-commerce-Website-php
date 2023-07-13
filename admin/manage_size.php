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
   $obj->select("size","*",null,"id=$id");
   $row = $obj->getResult()[0][0];
}
?>
<div class="admin-content-container">
    <h1  style="margin-bottom:20px;">Add New Size</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>"  class="col-md-6 form" >
   <div class="form-group ">
     <label for="">Size</label>
     <?php if (isset($_GET["id"]) && $_GET["id"]!="") echo "<input type='text' value='$id' class='hidden'>"?>
     <input type="text"  class="form-control size_name" placeholder="Size name" required <?php if (isset($_GET["id"]) && $_GET["id"]!="") echo "value=".$row['size'].""; else echo "" ?> >
   </div>
   <!--  -->
   <?php if (isset($_GET["id"]) && $_GET["id"]!="") echo '<button onclick="manage_size()" name="submit" type="submit" class="btn btn-primary add_size_login_btn">Update</button>'; else echo '<button name="submit" type="submit" class="btn btn-primary add_size_login_btn" onclick="manage_size()">ADD</button>' ?>
   <div class="alert alert-danger error" style="padding: 4px;margin-top: 8px; display:none;"></div>
   <div class="alert alert-success success" style="padding: 4px;margin-top: 8px; display:none;"></div>
   
     </form>
     
</div>
<?php
include "footer.php"
?>