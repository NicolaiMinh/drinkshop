<?php

	require_once '../../db_function.php';
	$db = new DB_Functions();
/*
endpoint: http://<domain>/drinkshop/server/category/add_category.php
method: post
param: phone
result: json
*/
	if(isset($_POST['name']) &&
	   isset($_POST['imgPath'])&&
	   isset($_POST['price'])&&
	   isset($_POST['menuId'])){
	   
		$name = $_POST['name'];
		$imgPath = $_POST['imgPath'];
		$price = $_POST['price'];
		$menuId = $_POST['menuId'];
		
		//insertNewCategory
		$result = $db->insertNewDrink($name, $imgPath, $price, $menuId);

		if($result)
		{
			echo json_encode("Insert product to drink table success!");
		}
		else
		{
			echo json_encode($this->conn->error);
		}
	}else{
		echo json_encode("Require parameter (name, imgPath, price, menuId) is missing!");
	}

?>