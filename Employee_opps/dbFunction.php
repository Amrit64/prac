<?php  
session_start();  
require_once 'dbConnect.php'; 
require_once('config.php');  
class dbFunction {  
  public $db;
  function __construct() {  

            // connecting to database  
    $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

  }  
        // destructor  
  function __destruct() {  

  }  
  public function UserRegister($email, $password){  
    $sql = mysqli_query($this->db,"INSERT INTO employee_opps_details(email,password,user_role,is_active) values('$_POST[email]',md5('$_POST[password]'),'employee','Yes')") or die(mysqli_error($this->db)); 
    return $sql;  

  }  
  public function Login($email, $mypassword){  
    $res = mysqli_query($this->db,"SELECT * FROM employee_opps_details WHERE email = '$email' && password = '$mypassword' && is_active='YES'"); 
    $user_data = mysqli_fetch_array($res);  
            //print_r($user_data);  
    $count = mysqli_num_rows($res);  

    if ($count == 1)   
    {  
      if($user_data['user_role']=='employee')
      {
       $_SESSION['login'] = true;  
       $_SESSION['uid'] = $user_data['id'];
       header("Location: employee.php");   
       return TRUE;  

     }
     elseif ($user_data['user_role']=='admin') {
       $_SESSION['login'] = true;  
       $_SESSION['uid'] = $user_data['id']; 
       header("Location: dashboard.php");  
       return TRUE;  

     }
     else{

      return FALSE; 
    }


  }
}


public function Add($first_name,$last_name,$address,$phone_number,$gender,$dob){   
 if(isset($_SESSION["uid"])) {
  $data=$_SESSION['uid'];
  $count = 0;
  $is_exist = "SELECT id FROM employee_opps_detail WHERE id = '".$data."'";
  $result_is_exist = mysqli_query($this->db,$is_exist);
  $count=mysqli_num_rows($result_is_exist);
  if($count > 0){
   $sql=mysqli_query($this->db,"UPDATE `employee_opps_detail` SET `first_name`='$_POST[first_name]',`last_name`='$_POST[last_name]',`address`='$_POST[address]',`phone_number`='$_POST[phone_number]',`gender`='$_POST[gender]',`dob`='$_POST[dob]' WHERE id='".$data."'") or die(mysqli_error($this->db));
   return $sql;  
 }else{
  $sql=mysqli_query($this->db,"INSERT INTO `employee_opps_detail`(`id`, `first_name`, `last_name`, `address`, `phone_number`,`gender`,`dob`) VALUES ('$data','$_POST[first_name]','$_POST[last_name]','$_POST[address]','$_POST[phone_number]','$_POST[gender]','$_POST[dob]')");
  return $sql;
}


}
}   
public function isUserExist($email){  
  $qr = mysqli_query($this->db,"SELECT * FROM employee_opps_details WHERE email= '$email'");   
  $row = mysqli_num_rows($qr);  
  if($row > 0){  
    return true;  
  } else {  
    return false;  
  }  
}  
public function fetchdata()
{
  $result=mysqli_query($this->db,"SELECT * FROM `employee_opps_detail` ORDER BY `employee_opps_detail`.`id` ASC");
  return $result;
}
public function Update($first_name,$last_name,$address,$phone_number,$gender,$dob){
if(isset($_GET['id'])) {
  $data=$_GET['id'];
$sql=mysqli_query($this->db,"UPDATE `employee_opps_detail` SET `first_name`='$_POST[first_name]',`last_name`='$_POST[last_name]',`address`='$_POST[address]',`phone_number`='$_POST[phone_number]',`gender`='$_POST[gender]',`dob`='$_POST[dob]' WHERE id='".$data."'") or die(mysqli_error($this->db));
   return $sql;  
}
}
}  
?> 

