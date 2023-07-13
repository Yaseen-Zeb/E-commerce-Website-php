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
if (isset($_GET["operation"]) && isset($_GET["id"])) {
   if ($_GET["operation"] == "unreaded") {
    $status = 1;
   }else{
    $status = 0;
   }
   $id = $_GET["id"];
   $obj->update("contact",["status" => $status],"id = $id");
   $obj->getResult();
   header("Location:".$_SERVER['PHP_SELF']."");

   if ($_GET["operation"] == "delete"){
    $obj->delete("contact","id = $id");
    $obj->getResult();
    header("Location:".$_SERVER['PHP_SELF']."");
   }
}

// show_arr($_SERVER);
?>
<div class="admin-content-container">
    <div style="display: flex;align-items: flex-start;justify-content: space-between; margin-bottom:20px;" >
        <h1>Contact</h1>
    </div>

    <table class="table table-striped table-inverse table-responsive table-bordered">
        <thead class="thead-inverse">
            <tr class="bg-warning" style="color:black">
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Message</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $obj->select("contact","*",null,null,"status");
                foreach ($obj->getResult()[0] as $row) {
                ?>
                <tr>
                    <td><?php echo $row["user_name"] ?></td>
                    <td><?php echo $row["email"] ?></td>
                    <td><?php echo $row["mob_number"] ?></td>
                    <td><?php echo $row["msg"] ?></td>
                    <td> <?php if($row["status"]== 0){echo "<a style='background:green;' href='?operation=unreaded&id=".$row['id']."' class='badge badge-complete'>unReaded</a>";} else {echo "<a style='background:red;' href='?operation=readed&id=".$row["id"]."' class='badge bg-primary'>Readed</a>";}?></td>
                    <td><?php echo $row["at"] ?></td>
                    <td class="text-center">
                    <a href="?operation=delete&id=<?php echo $row["id"] ?>" class="fa fa-trash"></a>
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