<?php
include "header.php";

if (isset($_SESSION["id"])) {
    $condition = null;
    $admin_id = $_SESSION["id"];
    $obj->select("admin","*",null,"id = $admin_id");
    if ($obj->getResult()[0][0]["role"] == 0) {
      $condition .= "products.admin_id = $admin_id";
    }else{
        $condition = null;
    }
   
}
if (isset($_GET["operation"]) && isset($_GET["id"])) {
   if ($_GET["operation"] == "deactive") {
    $status = 0;
   }else{
    $status = 1;
   }
   $id = $_GET["id"];
   $obj->update("products",["P_status" => $status],"P_id = $id");
   $obj->getResult();
   header("Location:".$_SERVER['PHP_SELF']."");

   if ($_GET["operation"] == "delete")
   {$obj->select("products","*",null,"P_id = $id");
unlink("upload/".$obj->getResult()[0][0]["img"]);
    $obj->delete("products","P_id = $id");
    $obj->getResult();
    header("Location:".$_SERVER['PHP_SELF']."");
   }
}


?>
<div class="admin-content-container">
    <div style="display: flex;align-items: flex-start;justify-content: space-between; margin-bottom:20px;" >
        <h1>Products</h1>
        <a class="btn btn-success" href="manage_product.php">Add Product</a>
    </div>

    <table class="table table-striped table-inverse table-responsive table-bordered">
        <thead class="thead-inverse">
            <tr class="bg-warning" style="color:black">
            <th>Added by</th>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Brand</th>
                <!-- <th>Price</th> -->
                <!-- <th>Quantity</th> -->
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $obj->select("products","*","categries on  products.cat_id=categries.id 
                left join brands on products.brand_id = brands.brand_id 
                join sub_categries on products.sub_cat_id = sub_categries.sub_id 
                join admin on products.admin_id = admin.id
                "
                ,$condition,"P_id DESC",5);
                $rows = $obj->getResult()[0];
                // show_arr($rows);
                if (count($rows) > 0) {
                   foreach ($rows as $row) {
                ?> 
                <tr>
                    <td><?php echo $row["role"] == 1? $row["admin_name"]."(Admin)" : $row["admin_name"] ?></td>
                    <td><?php echo $row["P_name"] ?></td>
                    <td><?php echo $row["description"] ?></td>
                    <td><?php echo $row["name"] ?></td>
                    <td><?php echo $row["title"] ?></td>
                    <td><?php echo $row["brand_title"] ?></td>
                    <!-- <td><?php echo $row["price"] ?></td> -->
                    <!-- <td><?php echo $row["quantity"] ?></td> -->
                    <td style="padding: 1px; width: 55px; height: 80px;"> <img style="height: 79px;" src="upload/<?php echo $row["img"] ?>" alt=""></td>
                    <td><?php if($row["P_status"]== 1){echo "<a style='background:green;' href='?operation=deactive&id=".$row['P_id']."' class='badge badge-complete'>active</a>";} else {echo "<a style='background:red;' href='?operation=active&id=".$row["P_id"]."' class='badge bg-primary'>DeActive</a>";}?></td>
                    <td>
                    <a href="manage_product.php?id=<?php echo $row["P_id"].'&cat_id='.$row["cat_id"].'&sub_cat_id='.$row["sub_cat_id"].'&brand_id='.$row["brand_id"]?>" class="fa fa-edit"></a> 
                    <a href="?operation=delete&id=<?php echo $row["P_id"] ?>" class="fa fa-trash"></a>
                    </td>
                    </tr>
                    <?php
                   }}
                    ?>
                    </tbody>
         </table>  
         <nav aria-label="Page navigation" class="text-center">
           <ul class="pagination justify-content-center">
        <?php
        echo $obj->pagination("products",5);
       ?>
       </ul>
        </nav>
</div>


<?php
include "footer.php";
?>
