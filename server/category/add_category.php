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
	   isset($_POST['imgPath'])){
		$name = $_POST['name'];
		$imgPath = $_POST['imgPath'];
		
		//insertNewCategory
		$result = $db->insertNewCategory($name, $imgPath);

		if($result)
		{
			echo json_encode("Insert to category(menu) table success!");
		}
		else
		{
			echo json_encode($this->conn->error);
		}
	}else{
		echo json_encode("Require parameter ($=name, imgPath) is missing!");
	}

?>