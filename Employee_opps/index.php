 <?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
 include_once('dbFunction.php');    
 if($_SERVER["REQUEST_METHOD"] == "POST"){  
 	$funObj = new dbFunction();
 	$mypassword=(md5($_POST['password']));
 	$email = $_POST['email'];  
 	// $password = $_POST['password'];  
 	$user = $funObj->Login($email, $mypassword);  
 	if ($user) {   
 		// header("location:employee.php");  
 	} else {  
 		echo "<script>alert('Emailid / Password Not Match')</script>";  
 	}  
 }  
 ?>
 <!DOCTYPE html>  
 <html lang="en" class="no-js">  
 <head>  

 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

 </head>  
 <body>  
 	<div align = "center">
 		<div style = "margin:30px">
 			<form class="form-horizontal" method="POST" action="" name="login" style = "width:50%">
 				<div class="form-group">
 					<input type="hidden" name="id" value="<?php echo $id;?>">
 					<input type="hidden" name="user_role" value="<?php echo $user_role;?>">
 					<label for="inputEmail3" class="col-sm-2 control-label">Eamil</label>
 					<div class="col-sm-10">
 						<input type="email" class="form-control" id="inputEmail3" placeholder="Eamil" name="email">
 					</div>
 				</div>
 				<div class="form-group">
 					<label for="exampleInputPassword3" class="col-sm-2 control-label">Password</label>
 					<div class="col-sm-10">
 						<input type="Password" class="form-control" id="exampleInputPassword3" placeholder="Password" name="password">
 					</div>
 				</div>
 				<div class="form-group">
 					<div class="col-sm-offset-2 col-sm-10">
 						<input type="submit" name="login" class="btn btn-default" value="Submit" >
 					</div>
 				</div>
 				<div class="text-center p-t-115">
 					<span class="txt1">
 						Don’t have an account?
 					</span>
 					<a class="txt2" href="registration.php">
 						Sign Up
 					</a>
 				</div>
 			</form>
 		</div>
 	</div> 
 </body>  
 </html> 