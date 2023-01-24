<?php 
require_once(APP_ROOT."/Class/database.php");
class Query extends Database {

	public function get_person(){

		$this-> create_tb();
		$conn = $this->conn_db();
		$conn->set_charset('utf8mb4');
		$query = $conn->prepare("SELECT `name`, surname, added FROM LZQuery order by added");		
		$query->execute();			
		$result = $query->get_result();		
		return $result;	
	}
	public function create($name = "", $surname= ""){
		$this-> create_tb();
		$conn = $this->conn_db();
		$conn->set_charset('utf8mb4');
		$query = $conn->prepare("INSERT INTO LZQuery (`name`, surname) VALUES ('".$name."','".$surname."')");
		if(!$query){
			echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
		}
		try {
			$query->execute();
			return "Inserted";		
			
		} catch(PDOException $e) {
			return $conn->errno;
		}
	}
}
?>