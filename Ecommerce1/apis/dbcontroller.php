<?php
  error_reporting(E_ALL);
 ini_set("display_errors", 1);

include_once("../config.php");

session_start();

class DBController {
	private $conn = "";
	private $host = DB_HOST;
	private $user = DB_USER;
	private $password = DB_PASSWORD;
	private $database = DB_MAIN_NAME;

	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->conn = $conn;			
		}
	}

	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		mysqli_set_charset($conn,"utf8");
		return $conn;
	}

	function executeQuery($query) {
		$return_result = array();
        $conn = $this->connectDB();    
        $result = mysqli_query($conn, $query);
        if (!$result) {
            //check for duplicate entry
            if($conn->errno == 1062) {
                return false;
            } else {
                trigger_error (mysqli_error($conn),E_USER_NOTICE);
				
            }
        }		
		$return_result['affectedRows'] = mysqli_affected_rows($conn);
		$return_result['last_id'] = mysqli_insert_id($conn);
		return $return_result;
		
    }
	function executeSelectQuery($query) {
        $conn = $this->connectDB();
		$result = mysqli_query($conn,$query);

		$return_result['retrivedtTotalRows'] = mysqli_num_rows($result);

		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		$return_result['records'] = $resultset;
		if(!empty($resultset))
			return $return_result;
	}

	function escapeString($string) {
		return mysqli_real_escape_string($this->conn, $string);
	}
}

?>