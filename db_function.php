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

	/*
	get list menu
	return list of menu object
	*/
	public function getMenus(){
		$result = $this->conn->query("SELECT * FROM menu");
		$menus = array();
		while ($item = $result->fetch_assoc())
			$menus[] = $item;
		return $menus;
	}

	/*
	get drink menu by menuID
	return list of drink object
	*/
	public function getDrinkByMenuID($menuId){
		$query = "SELECT * FROM drink WHERE MenuId = '".$menuId."'";
		$result = $this->conn->query($query);
		$drinks = array();
		while ($item = $result->fetch_assoc())
			$drinks[] = $item;
		return $drinks;
	}

	/*
	update avatarUrl
	return list of drink object
	*/
	public function updateAvatar($phone, $filename){
		return $result = $this->conn->query("UPDATE user SET AvatarUrl ='$filename' WHERE Phone = '$phone'");
	}

	/*
	get all drink table for search
	return list of drink object
	*/
	public function getAllDrinks(){
		$result = $this->conn->query("SELECT * FROM drink WHERE 1") or die($this->conn->error);
		$drinks = array();
		while ($item = $result->fetch_assoc())
			$drinks[] = $item;
		return $drinks;
	}

	/*
	insert data to order table
	return true or false
	*/
	public function insertNewOrder($orderPrice, $orderComment, $orderAddress, $orderDetail, $userPhone){
		$stmt = $this->conn->prepare("INSERT INTO `order`(`orderStatus`, `orderPrice`, `orderDetail`,
			`orderComment`, `orderAddress`, `userPhone`)
			VALUES (0,?,?,?,?,?)");
		$stmt->bind_param("sssss",$orderPrice, $orderDetail, $orderComment, $orderAddress, $userPhone);
		$result = $stmt->execute();
		$stmt->close();

		if($result)
		{
			return true;
		}
		else
		{
			return false;
		}
	}


}

?>
