<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ADMIN</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900|Montserrat:400,500,700,900" rel="stylesheet">
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
        <!-- Jquery textEditor -->
        <link rel="stylesheet" href="css/jquery-te-1.4.0.css">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="../css/style.css">

	
    </head>
    <body>
        <!-- HEADER -->
        <div id="admin-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-offset-8 col-md-2">
                        <div class="dropdown">
                            <?php
                            include "../Database/DB.inc.php";
                            $obj = new database();
                            ?>
                            <a href="" class="dropdown-toggle logout" data-toggle="dropdown">Hi <?php if (isset($_SESSION["admin_name"])) {
                               echo $_SESSION["admin_name"];
                            } else {
                                echo "admin";
                            }
                             ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="change_password.php">Change Password</a></li>
                                <li><a href="php_files/admin_logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /HEADER -->
        <?php
        if (!isset($_SESSION["id"])) {
            ?>
            <script>window.location.href = "./"</script>
            <?php
        }
        $obj->select("contact","*",null,"status= 0");
        $data = count($obj->getResult()[0]);
        $obj->getResult();
        ?>
        <div id="admin-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <!-- Menu Bar Start -->
                    <div class="col-md-2 col-sm-3" id="admin-menu">
                         <ul class="menu-list">
                            <?php
                               $admin_id = $_SESSION["id"];
                               $obj->select("admin","*",null,"id = $admin_id");
                               if ($obj->getResult()[0][0]["role"] == 1) {
                            ?>
                            <li  <?php if(basename($_SERVER['PHP_SELF']) == "dashboard.php") echo 'class="active"'; ?>><a href="dashboard.php">Dashboard</a></li>
                            <li <?php if (basename($_SERVER["PHP_SELF"]) == "products.php") echo "class='active'"?>><a href="products.php">Products</a></li>
                            <li  <?php if (basename($_SERVER["PHP_SELF"]) == "category.php") echo "class='active'"?>><a href="category.php">Categories</a></li>
                            <li <?php if (basename($_SERVER["PHP_SELF"]) == "sub_categries.php") echo "class='active'"?>><a href="sub_categries.php">Sub Categories</a></li>
                            <li <?php if (basename($_SERVER["PHP_SELF"]) == "brands.php") echo "class='active'"?>><a href="brands.php">Brands</a></li>
                            <li <?php if (basename($_SERVER["PHP_SELF"]) == "Size.php") echo "class='active'"?>><a href="size.php">Sizes</a></li>
                            <li <?php if (basename($_SERVER["PHP_SELF"]) == "color.php") echo "class='active'"?>><a href="color.php">Colors</a></li>
                            <li  <?php if (basename($_SERVER["PHP_SELF"]) == "venders.php") echo "class='active'"?>><a href="venders.php">venders</a></li>
                            <li  <?php if (basename($_SERVER["PHP_SELF"]) == "users.php") echo "class='active'"?>><a href="users.php">Users</a></li>
                            <li  <?php if (basename($_SERVER["PHP_SELF"]) == "orders.php") echo "class='active'"?>><a href="orders.php">Orders</a></li>
                            <li <?php if (basename($_SERVER["PHP_SELF"]) == "reviews.php") echo "class='active'"?>><a href="reviews.php">Reviews</a></li>
                            <li  <?php if (basename($_SERVER["PHP_SELF"]) == "contact.php") echo "class='active'"?>><a href="contact.php" style="display:flex;justify-content:space-between; align-items:center" ><span>Contact</span> <?php if ($data > 0) {
                              echo '<span style="background-color: yellowgreen;border-radius: 50%;height:16px;width:18px;"></span>';
                            } ?></a></li>
                            <?php }else{
                                ?>
 <li <?php if (basename($_SERVER["PHP_SELF"]) == "products.php") echo "class='active'"?>><a href="products.php">Products</a></li>
 <li  <?php if (basename($_SERVER["PHP_SELF"]) == "orders.php") echo "class='active'"?>><a href="orders_vender_details.php">Orders</a></li>
                                <?php
                            } ?>
                            </ul> 
                    </div>
                    <!-- Menu Bar End -->
                    <!-- Content Start -->
                    <div class="col-md-10 col-sm-9 clearfix" id="admin-content">
