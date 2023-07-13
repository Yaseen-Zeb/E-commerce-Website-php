<?php
include "header.php";
if (isset($_GET["operation"]) && isset($_GET["id"])) {
$id = $_GET["id"];
   if ($_GET["operation"] == "delete"){
    $obj->delete("users","id = $id");
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
                <th>Password</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
           
                <?php
                $obj->select("users","*",null,null,"id DESC");
                foreach ($obj->getResult()[0] as $row) {
                ?>
                <tr>
                    <td><?php echo $row["name"] ?></td>
                    <td><?php echo $row["email"] ?></td>
                    <td><?php echo $row["password"] ?></td>
                    <td><?php echo $row["created_at"] ?></td>
                    <td><?php echo $row["updated_at"] ?></td>
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