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
		$stmt = $this->conn->prepare("INSERT INTO `order`(`orderDate`, `orderStatus`, `orderPrice`, `orderDetail`,
			`orderComment`, `orderAddress`, `userPhone`)
			VALUES (NOW(),0,?,?,?,?,?)");
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

	/*
	insert new menu(category)
	return true or false
	*/
	public function insertNewCategory($name, $imgPath){
		$stmt = $this->conn->prepare("INSERT INTO `menu`(`Name`, `Link`) VALUES (?,?)");
		$stmt->bind_param("ss",$name, $imgPath);
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

	/*
	update menu(category)
	return true or false
	*/
	public function updateCategory($id, $name, $imgPath){
		$stmt = $this->conn->prepare("UPDATE `menu` SET `Name`=?,`Link`=? WHERE `ID`= ?");
		$stmt->bind_param("sss",$name, $imgPath, $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}

	/*
	update menu(category)
	return true or false
	*/
	public function deleteCategory($id){
		$stmt = $this->conn->prepare("DELETE FROM `menu` WHERE `ID`= ?");
		$stmt->bind_param("s", $id);
		$result = $stmt->execute();
		return $result;
	}

	/*
	insert new menu(category)
	return true or false
	*/
	public function insertNewDrink($name, $imgPath, $price, $menuId){
		$stmt = $this->conn->prepare("INSERT INTO `drink`(`Name`, `Link`, `Price`, `MenuId`) VALUES (?,?,?,?)");
		$stmt->bind_param("ssss",$name, $imgPath, $price, $menuId);
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

	/*
	update drink(product)
	return true or false
	*/
	public function updateProduct($id, $name, $imgPath, $price, $menuId){
		$stmt = $this->conn->prepare("UPDATE `drink` SET `Name`=?,`Link`=?, `Price`=?, `MenuId`=? WHERE `ID`= ?");
		$stmt->bind_param("sssss",$name, $imgPath,$price,$menuId, $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}

	/*
	delete product(drink)
	return true or false
	*/
	public function deleteProduct($id){
		$stmt = $this->conn->prepare("DELETE FROM `drink` WHERE `ID`= ?");
		$stmt->bind_param("s", $id);
		$result = $stmt->execute();
		return $result;
	}

	/*
	get all orders by userphone and status
	return list or null
	*/
	public function getOrderByStatus($userPhone, $status){
		$query = "SELECT * FROM `order` WHERE `orderStatus` = '" . $status . "' AND `userPhone` = '" . $userPhone . "'";
		$result = $this->conn->query($query) or die($this->conn->error);

		$orders = array();
		while ($order = $result->fetch_assoc())
			$orders[] = $order;
		return $orders;
	}

	/*
	get all orders by status for server
	return list or null
	*/
	public function getOrderServerByStatus($status){
		$query = "SELECT * FROM `order` WHERE `orderStatus` = '" . $status . "'";
		$result = $this->conn->query($query) or die($this->conn->error);

		$orders = array();
		while ($order = $result->fetch_assoc())
			$orders[] = $order;
		return $orders;
	}

	/*
	insert or update token
	return token object or false
	*/
	public function insertToken($phone, $token, $isServerToken){
		$stmt = $this->conn->prepare("INSERT INTO `token`(`phone`, `token`, `isServerToken`) VALUES (?,?,?)
																	ON DUPLICATE KEY UPDATE `token` = ?, `isServerToken` = ?")
																	OR DIE ($this->conn->error);
		$stmt->bind_param("sssss", $phone, $token, $isServerToken, $token, $isServerToken);
		$result = $stmt->execute();
		$stmt->close();
		//check for successful store_result
		if($result)
		{
				$stmt = $this->conn->prepare("SELECT * FROM `token` WHERE `phone` = ?");
				$stmt->bind_param("s", $phone);
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

}

?>
