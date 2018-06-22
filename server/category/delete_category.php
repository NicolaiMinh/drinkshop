<?php

	require_once '../../db_function.php';
	$db = new DB_Functions();
/*
endpoint: http://<domain>/drinkshop/server/category/deleteCategory.php
method: post
param: phone
result: json
*/
	if(isset($_POST['id'])){
	
		$id = $_POST['id'];	
		//deleteCategory
		$result = $db->deleteCategory($id);

		if($result)
		{
			echo json_encode("Delete category(menu) table success!");
		}
		else
		{
			echo json_encode($this->conn->error);
		}
	}else{
		echo json_encode("Require parameter (name, imgPath) is missing!");
	}

?>