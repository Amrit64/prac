<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
 // include_once 'database.php';
include_once 'config.php';
//   $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
// $table = "employee";
// $res=$conn->select($table);
$fetchdata=new dbFunction();
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<div class="box-body table-responsive">
    <table id="example2" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Sl no.</th>
          <th>Page Name</th>
          <!-- <th>Page Title</th>
          <th>Action</th> -->
        </tr>
      </thead>
      <tbody>


<?php
  $sql=$fetchdata->fetchdata();
  $cnt=1;
  while($row=mysqli_fetch_array($sql))
  {
  ?>
  <tr>
      <!-- <td height="29"><?php echo $cnt;?></td> -->
    <td><?php echo $row['uid'];?></td>
    <td><?php echo $row['username'];?></td>
  </tr>
<?php $cnt=$cnt+1;} ?>
      </tbody>
    </table>
  </div>
</body>
</html>

