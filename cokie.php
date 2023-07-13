<?php
// $time = time();
// $RC = unserialize($_COOKIE["name"]) ;
// // print_r($RC);
// array_push($RC,"name");
// // print_r($RC);
setcookie("name",serialize($RC),time()-30*30);
echo $_COOKIE["name"];
// unset($_COOKIE);






?>