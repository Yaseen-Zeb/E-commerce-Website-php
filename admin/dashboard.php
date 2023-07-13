<?php
include "header.php";
   $admin_id = $_SESSION["id"];
    $obj->select("admin","*",null,"id = $admin_id");
    if ($obj->getResult()[0][0]["role"] == 0) {
        header("Location:products.php");
    }
 $obj->sql("SELECT count(products.P_id) as total_products from products");
 $products = $obj->getResult();

 $obj->sql("SELECT count(categries.id) as total_categries from categries");
 $categries = $obj->getResult();

 $obj->sql("SELECT count(sub_categries.sub_id) as total_sub_categries from sub_categries");
 $sub_categries = $obj->getResult();

 $obj->sql("SELECT count(brands.brand_id) as total_brands from brands");
 $brands = $obj->getResult();

 $obj->sql("SELECT count(users.id) as total_users from users");
 $users = $obj->getResult();
 
?>

<div class="admin-content-container">
        <h1 class="" style="width: 100%;margin-bottom: 20px;text-align:center;margin-bottom:56px;" >Dashboard</h1>
        <div class="row">
            <!--  -->
            <div class="col-md-4">
                <div class="detail-box">
                    <span class="count"><?php echo $products[0][0]["total_products"] ?></span>
                    <span class="count-tag">products</span>
                </div>
            </div>
             <!--  -->
            <div class="col-md-4">
                <div class="detail-box">
                    <span class="count"><?php echo $categries[0][0]["total_categries"] ?></span>
                    <span class="count-tag">categories</span>
                </div>
            </div> 
             <!--  -->
           <div class="col-md-4">
                <div class="detail-box">
                    <span class="count"><?php echo $sub_categries[0][0]["total_sub_categries"] ?></span>
                    <span class="count-tag">Sub Categories</span>
                </div>
            </div>
             <!--  -->
             <div class="col-md-4">
                <div class="detail-box">
                    <span class="count"><?php echo $brands[0][0]["total_brands"] ?></span>
                    <span class="count-tag">Brands</span>
                </div>
            </div>
             <!--  -->
             <div class="col-md-4">
                <div class="detail-box">
                    <span class="count"><?php echo $users[0][0]["total_users"] ?></span>
                    <span class="count-tag">Users</span>
                </div>
            </div>
             <!--  -->
           
           
        </div>
    </div>
<?php
//    include footer file
    include "footer.php";

?>
