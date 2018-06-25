<?php

	require_once '../../db_function.php';
	$db = new DB_Functions();
/*
endpoint: http://<domain>/drinkshop/server/product/updateProduct.php
method: post
param: phone
result: json
*/
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$imgPath = $_POST['imgPath'];
		$price = $_POST['price'];
		$menuId = $_POST['menuId'];
		
		//updateProduct
		$result = $db->updateProduct($id, $name, $imgPath, $price, $menuId);

		if($result)
		{
			echo json_encode("Update product(drink) success!");
		}
		else
		{
			echo json_encode($this->conn->error);
		}
	}else{
		echo json_encode("Require parameter (name,imgPath,price,menuId) is missing!");
	}

?>