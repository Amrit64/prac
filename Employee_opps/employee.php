<?php 
require_once 'dbFunction.php';  
if(!isset($_SESSION['uid'])){
	header("location: index.php");
}
?> 
<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$funObj = new dbFunction();    
	$first_name = $_POST['first_name'];  
	$last_name = $_POST['last_name'];  
	$address = $_POST['address'];
	$phone_number = $_POST['phone_number'];
	$gender = $_POST['gender'];
	$dob = $_POST['dob'];  
	$update = $funObj->Add($first_name,$last_name,$address,$phone_number,$gender,$dob);  
	if($update){  
		echo "<script>alert('Update Successful')</script>";  
	}else{  
		echo "<script>alert('Update Not Successful')</script>"; 
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
	<?php
	require_once('config.php');  
	$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	// include_once 'config.php';
	if(isset($_SESSION["uid"])) {
		$data=$_SESSION['uid'];
		$sql = "SELECT * FROM employee_opps_details AS E LEFT JOIN employee_opps_detail AS ED ON E.id = ED.id WHERE E.id ='".$data."'";
		$result = $conn->query($sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
	?> 
	<form action="log_out.php" method=post>
		<button name="log_out">Log Out</button>
	</form>
	<div class="col-sm-6">
		<form  class="form-horizontal" name="form" method="POST" action="" >
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<div class="form-group">
				<label for="exampleInputName1" class="col-sm-4 control-label">First Name :</label>
				<input type="text" name="first_name" class="col-sm-8 control-label"
				id="control-label1" value="<?php echo $row['first_name'];?>" style="
				text-align: -webkit-auto;">
			</div>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-4 control-label">Last Name :</label>
				<input type="text" name="last_name" class="col-sm-8 control-label"
				id="control-label1" value="<?php echo $row['last_name'];?>" style="
				text-align: -webkit-auto;">
			</div>
			<div class="form-group">
				<label for="exampleInputName2" class="col-sm-4 control-label">Email :</label>
				<input type="text" name="email" class="col-sm-8 control-label"
				id="control-label1" value="<?php echo $row['email'];?>" style="
				text-align: -webkit-auto;" readonly>
			</div>
			<div class="form-group">
				<label for="exampleInputName3" class="col-sm-4 control-label">Address :</label>
				<input type="text" name="address" class="col-sm-8 control-label"
				id="control-label1" value="<?php echo $row['address'];?>" style="
				text-align: -webkit-auto;">
			</div>
			<div class="form-group">
				<label for="exampleInputName5" class="col-sm-4 control-label">Phone Number :</label>
				<input type="number" name="phone_number" class="col-sm-8 control-label"
				id="control-label1" value="<?php echo $row['phone_number'];?>" style="
				text-align: -webkit-auto;">
			</div>
			<div class="form-group">
				<label for="exampleInputName4" class="col-sm-4 control-label">DOB :</label>
				<input type="date" name="dob" class="col-sm-8 control-label"
				id="control-label1" value="<?php echo $row['dob'];?>" style="
				text-align: -webkit-auto;">
			</div>
			<div class="form-group">
				<label for="exampleInputName4" class="col-sm-4 control-label">Gender :</label>
				<input type="radio" name="gender" <?=$row['gender']=="female" ? "checked" : ""?> value="female">Female
				<input type="radio" name="gender" <?=$row['gender']=="male" ? "checked" : ""?> value="male">Male
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" name="submit" class="btn btn-default" value="Submit" >
				</div>
			</div>
		</form>
	</div> 
</body>  
</html>