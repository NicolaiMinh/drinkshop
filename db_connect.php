<?php

/**
* 
*/
class DB_CONNECT
{
	private $conn;

	//connecting to database
	public function connect(){
		require_once 'config.php';
		$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
		return $this->conn;
	}
}

?>