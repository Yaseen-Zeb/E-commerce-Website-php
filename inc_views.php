<?php
include "Database/DB.inc.php";
$obj = new database();
if (!isset($_GET["id"]) || $_GET["id"] == "") {
    ?>
    <script>
 window.location.href = "index.php"
</script>
    <?php
}else{
    $id = $_GET["id"];
}
 $obj->select("products","*","categries on products.cat_id = categries.id","P_id = $id");
         $row = $obj->getResult()[0];
         if (count($row) > 0) {
            $obj->update("products",["views"=>"views + 1"],"P_id = $id");
            $obj->getResult();
         }
        header("Location:detail.php?id=".$id);

?>