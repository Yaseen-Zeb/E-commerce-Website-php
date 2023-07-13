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
    $obj->update("reviews",["status" => $status],"r_id = $id");
   $obj->getResult();
   header("Location:".$_SERVER['PHP_SELF']."");
   die();
   }
   
  
   
   if ($_GET["operation"] == "delete"){
      $obj->delete("reviews","r_id = $id");
    $obj->getResult();
    header("Location:".$_SERVER['PHP_SELF']."");
    }
      
    
   }


// show_arr($_SERVER);
?>
<div class="admin-content-container">
    <div style="display: flex;align-items: flex-start;justify-content: space-between; margin-bottom:20px;" >
        <h1>Categries</h1>
        <a class="btn btn-success" href="manage_category.php">Add Category</a>
    </div>
    <p class="text-center" style="color:red;"><?php echo $err?></p>
    <table class="table table-striped table-inverse table-responsive table-bordered">
        <thead class="thead-inverse">
            <tr class="bg-warning" style="color:black">
                <th>#</th>
                <th>Product Title</th>
                <th>Name</th>
                <th>Email</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $obj->select("reviews","*","products on reviews.p_id = products.P_id join users on reviews.u_email = users.email");
                $rows = $obj->getResult()[0];
                foreach ($rows as $row) {
                ?>
                <tr>
                <td><?php echo $row["r_id"] ?></td>
                    <td><?php echo $row["P_name"] ?></td>
                    <td><?php echo $row["name"] ?></td>
                    <td><?php echo $row["email"] ?></td>
                    <td><?php echo $row["rating"] ?></td>
                    <td><?php echo $row["comment"] ?></td>
                    <td> <?php if($row["status"]== 1){echo "<a style='background:green;' href='?operation=deactive&id=".$row['r_id']."' class='badge badge-complete'>active</a>";} else {echo "<a style='background:red;' href='?operation=active&id=".$row["r_id"]."' class='badge bg-primary'>DeActive</a>";}?></td>
                    <td>
                    <a href="?operation=delete&id=<?php echo $row["r_id"] ?>" class="fa fa-trash"></a>
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