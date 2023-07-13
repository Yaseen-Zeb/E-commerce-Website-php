<?php
include "header.php";
$err = "";
if (isset($_GET["operation"]) && isset($_GET["id"])) {
   if ($_GET["operation"] == "deactive") {
    $status = 0;
   }else{
    $status = 1;
   }
   $id = $_GET["id"];
   if ($_GET["operation"] == "active" || $_GET["operation"] == "deactive") {
    $obj->update("sub_categries",["sub_status" => $status],"sub_id = $id");
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
      $obj->delete("sub_categries","sub_id = $id");
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
        <a class="btn btn-success" href="manage_sub_category.php">Add Sub Category</a>
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
                $obj->select("sub_categries","*","categries on sub_categries.cat_id = categries.id");
                $rows = $obj->getResult()[0];
                foreach ($rows as $row) {
                ?>
                <tr>
                    <td><?php echo $row["title"] ?></td>
                    <td><?php echo $row["name"] ?></td>
                    <td> <?php if($row["sub_status"]== 1){echo "<a style='background:green;' href='?operation=deactive&id=".$row['sub_id']."' class='badge badge-complete'>active</a>";} else {echo "<a style='background:red;' href='?operation=active&id=".$row["sub_id"]."' class='badge bg-primary'>DeActive</a>";}?></td>
                    
                    <td>
                    <a href="manage_sub_category.php?id=<?php echo $row["sub_id"]?>" class="fa fa-edit"></a> 
                    <a href="?operation=delete&id=<?php echo $row["sub_id"] ?>" class="fa fa-trash"></a>
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