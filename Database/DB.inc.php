<?php
class database {
private $host_name = "localhost";
private $user_name = "root";
private $pass = "";
private $base_name = "ecom";

public $conn = false;
public $result = [];
public $mysqli = "";
public $sp = [];

// constructor function
public function __construct(){
    if ($this->conn == false) {
        $this->mysqli = new mysqli($this->host_name,$this->user_name,$this->pass,$this->base_name);
        if ($this->mysqli) {
            $this->conn = true;
        }else{
            $this->conn = false;
        }
    }
}


//insert function
public function insert($table,$params=[]){
    if ($this->check_table($table) == true) {
        $column_names =implode("," , array_keys($params));
        $values = implode("," , $params);
       $i_sql = "INSERT INTO $table ($column_names) VALUES ($values)";
    //    echo $i_sql;
       if ($this->mysqli->query($i_sql)) {
        array_push($this->result,1);
       }else {
        array_push($this->result,"query failed!!!");
       }
    }
}

// Select function
public function select($table,$rows="*",$join=null,$where=null,$order=null,$limit=null){
    if ($this->check_table($table)) {
        if (isset($_GET["page"])) {
           $page = $_GET["page"];
           $offset = ($page-1)*$limit;
        }else{
            $page = 1;
            $offset = 0;
        }
        
    $s_sql = "SELECT $rows FROM $table";
    if ($join != null) {
        $s_sql .= " JOIN $join";
     }
    if ($where != null) {
       $s_sql .= " WHERE $where";
    }
    
     
    if ($order != null) {
        $s_sql .= " ORDER BY $order";
     }
     if ($limit != null) {
       $s_sql .= " LIMIT $offset,$limit";
    }
    
//    echo $s_sql;
     $s_query = $this->mysqli->query($s_sql);
     
    
     if ($s_query == true) {
        $data = $s_query->fetch_all(MYSQLI_ASSOC);
        array_push($this->sp,$s_sql);
        array_push($this->result,$data);
     }else {
        array_push($this->result , 'select query error');
     }
    }else {
        return false;
    }
}

//pagination function
public function pagination($table,$limit=null,){
    if ($this->check_table($table)) {
        if ($limit != null) {
            $p_sql = "SELECT COUNT(*) FROM $table";
            $p_query = $this->mysqli->query($p_sql);
            $totalRows = $p_query->fetch_all();
            

            $val = $this->sp;
           $val = explode("LIMIT",$val[count($val)-1]);
           $sp_query = $this->mysqli->query($val[0]);
           $data = $sp_query->fetch_all(MYSQLI_ASSOC);
           $totalRows=count($data);
           $this->sp = [];
            if (isset($_GET["page"])) {
            $page = $_GET["page"];
            }else{
                $page = 1;
            }
            // $totalRows = $totalRows[0][0];
            $totalpages =ceil($totalRows/$limit);
            $url = $_SERVER["PHP_SELF"];
            $str = "";
          

             //if search and sort set logic start
             if (isset($_GET["search"]) && isset($_GET["sort"])) {
                $search = $_GET["search"];
                $sort = $_GET["sort"];
                if ($page != 1) {
                    $str .= '<li class="page-item ">
                    <a class="page-link" href="'.$url.'?search='.$search.'&sort='."$sort".'&page='.($page - 1).'">
                    Prev
                    </a>
                  </li>';
                  }

                for ($i=1; $i <=$totalpages ; $i++) { 
                    if ($page==$i) {
                       $active = "active";
                    }else{
                        $active = "";
                    }
                    $str .= '<li class="page-item '.$active.'"><a class="page-link"  href="'.$url.'?search='.$search.'&sort='."$sort".'&page='.$i.'">'.$i.'</a></li>';
                }
                if ($page <= ($totalpages-1)) {
                    $str .= '<li class="page-item">
                    <a class="page-link" href="'.$url.'?search='.$search.'&sort='."$sort".'&page='.($page + 1).'">
                    Next
                    </a>
                  </li>';
                }
             }
             //if search and sort set logic end

            //  if search not and sort set logic start
             if ($_SERVER["QUERY_STRING"] != "") {
                $i = 1;
              $query_string = "";
           foreach (explode("&",$_SERVER["QUERY_STRING"]) as $value) {
	      $sin = $i == 1 ? "" : "&" ;
	      if (substr($value,0,4) != "page") {
	       $query_string .= $sin.$value;
	     }
	       $i++;
         }
                
                if ($page != 1) {
                    $str .= '<li class="page-item ">
                    <a class="page-link" href="'.$url.'?'.$query_string.'&page='.($page - 1).'">
                    Prev
                    </a>
                  </li>';
                  }
                for ($i=1; $i <=$totalpages ; $i++) { 
                    if ($page==$i) {
                       $active = "active";
                    }else{
                        $active = "";
                    }
                    $str .= '<li class="page-item '.$active.'"><a class="page-link" href="'.$url.'?'.$query_string.'&page='.$i.'">'.$i.'</a></li>';
                }
                if ($page <= ($totalpages-1)) {
                    $str .= '<li class="page-item">
                    <a class="page-link" href="'.$url.'?'.$query_string.'&page='.($page + 1).'">
                    Next
                    </a>
                  </li>';
                }
             }else{
                if ($page != 1) {
                    $str .= '<li class="page-item ">
                    <a class="page-link" href="'.$url.'?page='.($page - 1).'">
                    Prev
                    </a>
                  </li>';
                  }
                for ($i=1; $i <=$totalpages ; $i++) { 
                    if ($page==$i) {
                       $active = "active";
                    }else{
                        $active = "";
                    }
                    $str .= '<li class="page-item '.$active.'"><a class="page-link" href="'.$url.'?page='.$i.'">'.$i.'</a></li>';
                }
                if ($page <= ($totalpages-1)) {
                    $str .= '<li class="page-item">
                    <a class="page-link" href="'.$url.'?page='.($page + 1).'">
                    Next
                    </a>
                  </li>';
                }
             }
            
            return $str;
        }
        
    }else{
        return false;
    }
}


//update function
public function update($table,$params=[],$where=null){
    if ($this->check_table($table)) {
        $str = "";
        $arr = [];
        $num = 0;
        foreach ($params as $key => $value) {
         array_push($arr,"$key = $value");
        }
        $v = implode(",",$arr);
       $u_sql = "UPDATE $table SET $v";
       if ($where != null) {
        $u_sql .= " WHERE $where";
       }
    //    echo $u_sql;
      $query = $this->mysqli->query($u_sql);
       if ($query) {
        array_push($this->result,1);
       }else{
        array_push($this->result,"update query error");
       }
    }else{
        return false;
    }
}

//delete function
public function delete($table,$where=null){
    if ($this->check_table($table)) {
        $d_sql = "DELETE FROM $table";
        if ($where != null) {
            $d_sql .= " WHERE $where";
           }
      $query = $this->mysqli->query($d_sql);

       if ($query) {
        array_push($this->result,1);
       }else{
        array_push($this->result,"delete query error");
       }
    }else{
        return false;
    }
}

//SQL FUNCTION
public function SQL($sql){
if ($sql != "") {
    $identity = explode(" ", $sql);
    $identity = $identity[0];
    // echo $sql;
    $query = $this->mysqli->query($sql);
    if ($query == true) {
    switch ($identity) {
        case 'SELECT':
        array_push($this->result , $query->fetch_all(MYSQLI_ASSOC));
            break;
            case 'UPDATE':
            array_push($this->result ,1);
            break;
            case 'DELETE':
            array_push($this->result ,1);
            break;
            case 'INSERT':
            array_push($this->result ,1);
            break;
        
        default:
            break;
    }
}else{
    array_push($this->result ,"sql error || query faild");
}

}
}



//chk table function
private function check_table($table){
if ($this->conn == true) {
    $c_t_sql = "SHOW TABLES FROM $this->base_name LIKE '$table'";
    if ($this->mysqli->query($c_t_sql)) {
        return true;
        echo "ok";
    }else{
        return false;
    }}}

    public function getResult()
    {
      $val = $this->result;
      $this->result = [];
      return $val;
    }

    function escapeString($data){
        return $this->mysqli->real_escape_string($data);
      }
}

function show_arr($arr)
{
   echo "<pre>";
 return print_r($arr);

}

session_start();

// $obj = new database();
// $sql = $obj->select("admin","*",null,"name='admin' AND password = 'admin'");
// $sql = $obj->select("admin","*",null,"name='admin' AND password = 'admin'");
// show_arr($obj->get_result());
// $this->check_table("admin");
?>