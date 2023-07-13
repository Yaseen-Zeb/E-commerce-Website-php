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
$err = "";
if (isset($_GET["operation"]) && isset($_GET["id"])) {
   if ($_GET["operation"] == "deactive") {
    $status = 0;
   }else{
    $status = 1;
   }
   $id = $_GET["id"];
   if ($_GET["operation"] == "active" || $_GET["operation"] == "deactive") {
    $obj->update("brands",["brand_status" => $status],"brand_id = $id");
   $obj->getResult();
   header("Location:".$_SERVER['PHP_SELF']."");
   die();
   }
   
  
   
   if ($_GET["operation"] == "delete"){
    $obj->select("products","*",null,"cat_id = $id");
    $count = count($obj->getResult()[0]) ;
    // show_arr($count);
    if ($count > 0) {
        $err = "you cannot delete this category because you have ".$count." product from this category";
    }else{
      $obj->delete("brands","brand_id = $id");
    $obj->getResult();
    header("Location:".$_SERVER['PHP_SELF']."");
    }
      
    
   }
}

// show_arr($_SERVER);
?>
<div class="admin-content-container">
    <div style="display: flex;align-items: flex-start;justify-content: space-between; margin-bottom:20px;" >
        <h1>Categries</h1>
        <a class="btn btn-success" href="manage_brands.php">Add Brand</a>
    </div>
    <p class="text-center" style="color:red;"><?php echo $err?></p>
    <table class="table table-striped table-inverse table-responsive table-bordered">
        <thead class="thead-inverse">
            <tr class="bg-warning" style="color:black">
                <th>Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $obj->select("brands","*","categries on brands.cat_id = categries.id");
                $rows = $obj->getResult()[0];
                foreach ($rows as $row) {
                ?>
                <tr>
                    <td><?php echo $row["brand_title"] ?></td>
                    <td><?php echo $row["name"] ?></td>
                    <td> <?php if($row["brand_status"]== 1){echo "<a style='background:green;' href='?operation=deactive&id=".$row['brand_id']."' class='badge badge-complete'>active</a>";} else {echo "<a style='background:red;' href='?operation=active&id=".$row["brand_id"]."' class='badge bg-primary'>DeActive</a>";}?></td>
                    <td>
                    <a href="manage_brands.php?id=<?php echo $row["brand_id"] ?>" class="fa fa-edit"></a> 
                    <a href="?operation=delete&id=<?php echo $row["brand_id"] ?>" class="fa fa-trash"></a>
                    </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
    </table>
</div>

<?php
include "footer.php"
?>