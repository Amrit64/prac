<?php
    require_once('database.php');
    require_once('dbConnect.php');  
    class dbFunction { 

        function __construct() {  

            // connecting to database  
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    }  
        // destructor  
    function __destruct() {  

    }  
// public function Add(){   
//  // if(isset($_GET['id'])) {
//        $sql = "SELECT * FROM employee"; 
//         $result = $this->db->query($sql);
//         // return $sql;  


//                If(mysqli_num_rows($result)>0)
//                {
//                  while($row=mysqli_fetch_array($result))
//                  {  
//                      // echo $row['uid'];
//                      // echo $row['username']; 
//                      // echo "<td>" . $row['uid'] . "</td>";
//                      //  echo "<td>" . $row['username'] . "</td>";

// }
// 	} 
//  }
 //    public function select()
 // {
 //  $res=mysql_query("SELECT * FROM employee");
 //  return $res;
 // }
    public function fetchdata()
{
$result=mysqli_query($this->db,"select * from employee");
return $result;
}
}
?>


<!-- $sql = " SELECT candidate.cand_number,candidate.cand_fname,candidate.cand_desc FROM candidate ".$join.' where '.$condition;
$result = mysql_query($sql) or die(mysql_error()); 
while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
      // echo "EMP ID :{$row['emp_id']}  <br> ".
      //    "EMP NAME : {$row['emp_name']} <br> ".
      //    "EMP SALARY : {$row['emp_salary']} <br> ".
      //    "--------------------------------<br>";
   } -->