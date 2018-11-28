<?php 
session_start();
if(!isset($_SESSION["uid"])){
     header("location: index.php");
}
?>
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'dbFunction.php';  
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$funObj = new dbFunction();    
	$email = $_POST['email'];  
	$password = $_POST['password'];  
	$confirmPassword = $_POST['confirm_password'];  
        // echo 'gdfg';exit;
	if($password == $confirmPassword){  
		$email = $funObj->isUserExist($email);  
            // echo $email;exit;
		if(!$email){  
			$register = $funObj->UserRegister( $email, $password);  
			if($register){  
				echo "<script>alert('Registration Successful')</script>"; 
				header("Location: index.php"); 
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
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<script type="text/javascript">
	var check = function() {
		if (document.getElementById('password').value ==
			document.getElementById('confirm_password').value) {
			document.getElementById('message').style.color = 'green';
		document.getElementById('message').innerHTML = 'matching';
	} else {
		document.getElementById('message').style.color = 'red';
		document.getElementById('message').innerHTML = 'not matching';
	}
}

</script>
<body>
	
	<form id="tab" name="login" class="form-horizontal" method="POST" action="">
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Eamil</label>
			<div class="col-sm-9">
				<input type="email" class="form-control" id="inputEmail3" placeholder="Eamil" name="email">
			</div>
		</div>
		<div class="form-group">
			<label for="exampleInputPassword3" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-9">
				<input type="Password" class="form-control" id="password" placeholder="Password" name="password" required onkeyup='check();'>
			</div>
		</div>
		<div class="form-group">
			<label for="exampleInputPassword4" class="col-sm-2 control-label">Confirm Password</label>
			<div class="col-sm-9">
				<input type="Password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password"  onkeyup='check();' required>
			</div>
			<span id='message' class="col-sm-1"></span>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="submit" name="submit" class="btn btn-default" value="Submit" >
			</div>
		</div>
	</form>
</body>
</html>
