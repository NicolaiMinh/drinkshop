<?php

	require_once '../../db_function.php';
	$db = new DB_Functions();
/*
endpoint: http://<domain>/drinkshop/server/category/updateCategory.php
method: post
param: phone
result: json
*/
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$imgPath = $_POST['imgPath'];
		
		//updateCategory
		$result = $db->updateCategory($id, $name, $imgPath);

		if($result)
		{
			echo json_encode("Update category(menu) table success!");
		}
		else
		{
			echo json_encode($this->conn->error);
		}
	}else{
		echo json_encode("Require parameter (name, imgPath) is missing!");
	}

?>