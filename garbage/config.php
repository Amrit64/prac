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

    public function fetchdata()
{
$result=mysqli_query($this->db,"select * from employee");
return $result;
}
}
?>

