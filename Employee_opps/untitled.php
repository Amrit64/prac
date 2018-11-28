<?php  
    include_once('dbFunction.php');  
       
    $funObj = new dbFunction();  
    if($_POST['login']){  
        $emailid = $_POST['emailid'];  
        $password = $_POST['password'];  
        $user = $funObj->Login($emailid, $password);  
        if ($user) {  
            // Registration Success  
           // header("location:home.php");  
        } else {  
            // Registration Failed  
            echo "<script>alert('Emailid / Password Not Match')</script>";  
        }  
    }  
    if($_POST['register']){  
        $emailid = $_POST['emailid'];  
        $password = $_POST['password'];  
        $confirmPassword = $_POST['confirm_password'];  
        if($password == $confirmPassword){  
            $email = $funObj->isUserExist($emailid);  
            if(!$email){  
                $register = $funObj->UserRegister($username, $emailid, $password);  
                if($register){  
                     echo "<script>alert('Registration Successful')</script>";  
                }else{  
                    echo "<script>alert('Registration Not Successful')</script>";  
                }  
            } else {  
                echo "<script>alert('Email Already Exist')</script>";  
            }  
        } else {  
            echo "<script>alert('Password Not Match')</script>";  
          
        }  
    }  
?> 


     <div class="container">  
              
              
            <header>  
                <h1>Login and Registration Form  </h1>  
            </header>  
            <section>               
                <div id="container_demo" >  
                     
                    <a class="hiddenanchor" id="toregister"></a>  
                    <a class="hiddenanchor" id="tologin"></a>  
                    <div id="wrapper">  
                        <div id="login" class="animate form">  
                           <form name="login" method="post" action="">  
                                <h1>Log in</h1>   
                                <p>   
                                    <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>  
                                    <input id="emailsignup" name="emailid" required="required" type="email" placeholder="mysupermail@mail.com"/>   
                                </p>  
                                <p>   
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>  
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" />   
                                </p>  
                                <p class="keeplogin">   
                                    <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" />   
                                    <label for="loginkeeping">Keep me logged in</label>  
                                </p>  
                                <p class="login button">   
                                    <input type="submit" name="login" value="Login" />   
                                </p>  
                                <p class="change_link">  
                                    Not a member yet ?  
                                    <a href="#toregister" class="to_register">Join us</a>  
                                </p>  
                            </form>  
                        </div>  
  
                        <div id="register" class="animate form">  
                            <form name="login" method="post" action="">  
                                <h1> Sign up </h1>   
                                <p>   
                                    <label for="usernamesignup" class="uname" data-icon="u">Your username</label>  
                                    <input id="usernamesignup" name="username" required="required" type="text" placeholder="mysuperusername690" />  
                                </p>  
                                <p>   
                                    <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>  
                                    <input id="emailsignup" name="emailid" required="required" type="email" placeholder="mysupermail@mail.com"/>   
                                </p>  
                                <p>   
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>  
                                    <input id="passwordsignup" name="password" required="required" type="password" placeholder="eg. X8df!90EO"/>  
                                </p>  
                                <p>   
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>  
                                    <input id="passwordsignup_confirm" name="confirm_password" required="required" type="password" placeholder="eg. X8df!90EO"/>  
                                </p>  
                                <p class="signin button">   
                                    <input type="submit" name="register" value="Sign up"/>   
                                </p>  
                                <p class="change_link">    
                                    Already a member ?  
                                    <a href="#tologin" class="to_register"> Go and log in </a>  
                                </p>  
                            </form>  
                        </div>  
                          
                    </div>  
                </div>    
            </section>  
        </div> 
        <?php 
$servername = "localhost";
$username = "root";
$password = "root";
$dbname='Employee';


?>
<span style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></span>
<?php 
include_once 'config.php';
$address=$phone_number=$gender=$dob="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 


// check which button was clicked
// perform calculation
    if ($_POST['submit'])
    {
       if (isset($_SESSION["uid"])) {
     // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $data=$_SESSION['uid'];
        $count = 0;
    /////////// To verify is record is already exist or not/////////
        $is_exist = "SELECT id FROM employee_opps_details WHERE id = '".$data."'";
        $result_is_exist = mysqli_query($conn,$is_exist);
        $count=mysqli_num_rows($result_is_exist);
        if($count > 0){
        $imgname=$target_file;
          $sql="UPDATE `employee_opps_details` SET `first_name`='$_POST[first_name]',`last_name`='$_POST[last_name]',`address`='$_POST[address]',`phone_number`='$_POST[phone_number]',`gender`='$_POST[gender]',`dob`='$_POST[dob]',`profile_pic`='$imgname' WHERE id='".$data."'"; 
          if ($conn->query($sql) === FALSE) {
                // header("Location: registration.php");
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else{
        $imgname=$_FILES['fileToUpload']['name'];
      $sql="INSERT INTO `employee_opps_details`(`id`, `first_name`, `last_name`, `address`, `phone_number`, gender`,`dob`,'`profile_pic`) VALUES ('$data','$_POST[first_name]','$_POST[last_name]','$_POST[address]','$_POST[phone_number]','$_POST[gender]','$_POST[dob]',`$imgname`)";
      if ($conn->query($sql) === FALSE) {
                // header("Location: registration.php");
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
}
} 
}
?>

   <?php 
   require_once 'dbFunction.php'; 
     if(isset($_SESSION["uid"])) {
     $data=$_SESSION['uid'];
     $sql = "SELECT * FROM employee_opps_details AS E LEFT JOIN employee_opps_detail AS ED ON E.id = ED.id WHERE E.id ='".$data."'";
     $result = $conn->query($sql);
     $row = mysqli_fetch_array($result,MYSQLI_ASSOC);   
  
   ?>

   
if (isset($_SESSION["user_id"])) {
     // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $data=$_SESSION['user_id'];
        $count = 0;
    /////////// To verify is record is already exist or not/////////
        $is_exist = "SELECT id FROM employee_detail WHERE id = '".$data."'";
        $result_is_exist = mysqli_query($conn,$is_exist);
        $count=mysqli_num_rows($result_is_exist);
        if($count > 0){
        $imgname=$target_file;
          $sql="UPDATE `employee_detail` SET `first_name`='$_POST[first_name]',`last_name`='$_POST[last_name]',`address`='$_POST[address]',`phone_number`='$_POST[phone_number]',`gender`='$_POST[gender]',`dob`='$_POST[dob]',`profile_pic`='$imgname' WHERE id='".$data."'"; 
          if ($conn->query($sql) === FALSE) {
                // header("Location: registration.php");
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else{
        $imgname=$_FILES['fileToUpload']['name'];
      $sql="INSERT INTO `employee_detail`(`id`, `first_name`, `last_name`, `address`, `phone_number`, gender`,`dob`,'`profile_pic`) VALUES ('$data','$_POST[first_name]','$_POST[last_name]','$_POST[address]','$_POST[phone_number]','$_POST[gender]','$_POST[dob]',`$imgname`)";
      if ($conn->query($sql) === FALSE) {
                // header("Location: registration.php");
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
}