<?php 
class Database{
    public function conn_db(){		
		$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
		if($conn->connect_error){

			die("Connection Failed: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
    
    public function create_tb(){
        $conn = $this->conn_db();
        $conn->query("CREATE TABLE IF NOT EXISTS LZQuery ( id int AUTO_INCREMENT ,`name` varchar(50), surname varchar(50), added timestamp, PRIMARY KEY(id))");
        $conn -> close();
    }
}
?>