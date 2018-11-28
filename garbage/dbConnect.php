<?php  
class dbConnect {  
    function __construct() {  

            if(!$conn)// testing the connection  
            {  
                die ("Cannot connect to the database");  
            }else{
               echo "connected";
           }   
           return $conn;  
       }  
       public function Close(){  
        mysqli_close();  
    }  
}  
?>  