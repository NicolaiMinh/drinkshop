<?php

/**
* 
*/
class DB_Functions
{
	private $conn;
	//constructor
	function __construct(){
		require_once 'db_connect.php';
		$db = new DB_CONNECT();
		$this->conn = $db->connect();
	}

	//destructor
	function __destruct(){

	}

	//check user exist true or false
	function checkUserExist($phone){
		$stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone = ?");
		$stmt->bind_param("s",$phone);
		$stmt->execute();
		$stmt->store_result();

		if($stmt -> num_rows > 0){
			$stmt->close();
			return true;
		}else{
			$stmt->close();
			return false;
		}
	}

/*
register new user
return user object if user was created
return false and show error message if have exception
*/
	public function registerNewUser($phone, $name, $birthday, $address)
	{
		$stmt = $this->conn->prepare("INSERT INTO User(Phone, Name, Birthday, Address) VALUES (?,?,?,?) ");
		$stmt->bind_param("ssss",$phone, $name, $birthday, $address);
		$result = $stmt->execute();
		if($result)
		{
			$stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone = ?");	
			$stmt->bind_param("s",$phone);
			$stmt->execute();
			$user = $stmt->get_result()->fetch_assoc();
			$stmt->close();
			return $user;
		}
		else
		{
			return false;
		}
	}
	
/*
get user information by phone
return user object if user existed
return NULL if user not exist
*/
	public function getUserInformation($phone){
		$stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone = ?");	
		$stmt->bind_param("s",$phone);

		if($stmt->execute())
		{
			$user = $stmt->get_result()->fetch_assoc();
			$stmt->close();
			return $user;
		}
		else
		{
			return NULL;
		}

		
	}

	/*
	get list banner by phone
	return user object if user existed
	return NULL if user not exist
	*/
	public function getBanners(){
		//get 3 item
		$result = $this->conn->query("SELECT * FROM banner ORDER BY ID LIMIT 3");
		$banners = array();
		while ($item = $result->fetch_assoc()) 
			$banners[] = $item;
		return $banners;
	}

}

?>