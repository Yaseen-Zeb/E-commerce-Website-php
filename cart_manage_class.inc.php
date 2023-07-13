<?php
class cart{
    public function addProduct($pid,$qty,$attr_id)
    {
      $_SESSION["cart"][$pid][$attr_id]["qty"]=$qty;
      
    }

    public function updateProduct($pid,$new_qty,$attr_id)
    {
        if (isset($_SESSION["cart"][$pid][$attr_id])) {
            $_SESSION["cart"][$pid][$attr_id]["qty"]=$new_qty;
        }
    }

    public function removeProduct($pid,$attr_id)
    {
        if (isset($_SESSION["cart"][$pid][$attr_id])) {
            unset($_SESSION["cart"][$pid][$attr_id]);
             if (count($_SESSION["cart"][$pid]) === 0) {
               unset($_SESSION["cart"][$pid]);
            }
        }
    }

    public function emptyProduct()
    {
        session_unset(["cart"]);
    }

    public function countProduct()
    {
        $arr = [];
        if (isset($_SESSION["cart"])) {
            foreach ($_SESSION["cart"] as $key => $value) {
                foreach ($value as $k => $v) {
                  $arr[] = $k;
                }
              }
              return count($arr);
        }else{
            return 0;
        }
        
    }
}

?>