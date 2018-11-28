<?php 
require_once 'dbFunction.php'; 
if(!isset($_SESSION["uid"])){
     header("location: index.php");
}
?>
<!--        $_SESSION['uid'] = $user_data['id'];  -->
<?php 
   error_reporting(E_ALL);
 ini_set("display_errors", 1);

$fetchdata = new dbFunction();
 ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
<form action="log_out.php" method=post>
    <button name="submit" >Log Out</button>
</form>
<table class='table table-bordered table-striped'>
  <tr>
    <th >Id</th>
    <th >First Name</th>
    <th >Last Name no</th>
    <th >Gender</th>
    <th >Phone Number</th>
    <th >Date of birth</th>
    <th >Action</th>
  </tr>
  <?php
  $sql=$fetchdata->fetchdata();
  $cnt=1;
  while($row=mysqli_fetch_array($sql))
  {
  ?>
  <tr>
    <!-- <td><?php echo $cnt;?></td>  -->
    <td><?php echo $row['id'];?></td>
    <td><?php echo $row['first_name'];?></td>
    <td><?php echo $row['last_name'];?></td>
    <td><?php echo $row['gender'];?></td>
    <td><?php echo $row['phone_number'];?></td>
    <td><?php echo $row['dob'];?></td>
    <td><?php echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='modal' data-target='#myModal'><span class='glyphicon glyphicon-pencil'></span></a>";?>
		<?php echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' name='deleteItem' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";?></td>
 
  </tr>
  <?php $cnt=$cnt+1;} ?> 
</table>
</body>
</html>
