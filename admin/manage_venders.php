<?php
include "header.php";
if (!isset($_SESSION["id"])) {
  header("Location:dashboard.php");
  if ($row["role"] == 0) {
      header("Location:products.php");
  }
}else{
    if (!isset($_GET["id"]) || $_GET["id"]!="") {
 $admin_id =$_GET["id"];
  $obj->select("admin","*",null,"id = $admin_id");
  $row = $obj->getResult()[0][0];
//   show_arr($row);
  
}}
?>
<div class="admin-content-container">
    <h1 onclick="manage_cat(1)" style="margin-bottom:20px;"><?php if (!isset($_GET["id"]) && $_GET["id"]=="") echo "Add New Vender or Admin"; else echo "Update Vender or Admin" ?></h1>
    <form method="post"   class="col-md-6 form vender_form" >
    <!--  -->
   <div class="form-group" >
     <label for="">Name</label>
     <?php if (isset($_GET["id"]) && $_GET["id"]!="") echo "<input type='text' value='$admin_id' class='hidden'>"?>
     <input  name="name" type="text"  class="form-control cat_name" name="name" placeholder="Enter Name" required <?php if (isset($_GET["id"]) && $_GET["id"]!="") echo "value=".$row['admin_name'].""; else echo "" ?> >
   </div>
   <!--  -->
   <div class="form-group ">
     <label for="">Email</label>
     <input name="email" type="text"  class="form-control cat_name" placeholder="Enter Email" required <?php if (isset($_GET["id"]) && $_GET["id"]!="") echo "value=".$row['email'].""; else echo "" ?> >
   </div>
   <!--  -->
   <div class="form-group ">
     <label for="">Password</label>
     <input name="password" type="text"  class="form-control cat_name" placeholder="Enter Password" required <?php if (isset($_GET["id"]) && $_GET["id"]!="") echo "value=".$row['password'].""; else echo "" ?> >
   </div>
   <!--  -->
   <div class="form-group ">
     <label for="">Mobile</label>
     <input name="mobile" type="text"  class="form-control cat_name" placeholder="Enter Mobile Number" required value = '<?php if (isset($_GET["id"]) && $_GET["id"]!="") echo $row['moblie'].""; else echo "" ?>' >
   </div>

   <?php if (isset($_GET["id"]) && $_GET["id"]!="") echo '<button onclick="manage_venders()" name="submit" type="submit" class="btn btn-primary add_cat_login_btn add_vender_btn">Update</button>'; else echo '<button name="submit" type="submit" class="btn btn-primary add_vender_btn" onclick="manage_venders()">ADD</button>' ?>
   <div class="alert alert-danger vender_error" style="padding: 4px;margin-top: 8px; display:none;">fgdfg</div>
   <div class="alert alert-success vender_success" style="padding: 4px;margin-top: 8px; display:none;"></div>
   
     </form>
     
</div>
<?php
echo $row['moblie'];
include "footer.php"
?>

