<?php
	require_once('config.php');  
	$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$sql = "SELECT * FROM employee_opps_detail";
	$result = $conn->query($sql);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

	$data=$_GET['id'];
$result=mysqli_query($conn,"DELETE FROM employee_opps_detail WHERE id='".$data."'");
if($result==true){
	 mysqli_query($conn,"UPDATE `employee_opps_details` SET `is_active`='NO' WHERE id='".$data."'");
}
mysqli_close($conn);
header("Location: dashboard.php");
?>
