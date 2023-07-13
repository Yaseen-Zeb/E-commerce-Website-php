<?php
include "../Database/DB.inc.php";
if (isset($_SESSION["admin_login"])) {
    header("Location:dashboard.php");
}

?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin : OnlineShop</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../css/style.css">
    </head>
    
    <body style="height: 100vh;">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-offset-3 col-md-6">
                    <div class="login-form">
                        <h1 class="logo">Online Shop</h1>
                        <!-- Form -->
                        <form  autocomplete="off" class="form">
                            <div class="form-group">
                                <label>Username</label>
                                <input name="name" type="text" class="form-control adminName" required placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input name="pass" type="password" class="form-control adminPass" required placeholder="password" >
                            </div>
                            <input type="submit" name="login" class="btn btn-danger" value="login" onclick="admin_login()" />
                        </form>
                        <div style="display:none; margin-top:5px" class=" alert alert-danger error" id="none"></div>
                        <div style="display:none; margin-top:5px" class=" alert alert-success success" id="none"></div>
                        <!-- /Form -->
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/admin_actions.js"></script>
    </body>
</html>
