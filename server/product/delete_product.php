<?php

	require_once '../../db_function.php';
	$db = new DB_Functions();
/*
endpoint: http://<domain>/drinkshop/server/product/deleteProduct.php
method: post
param: phone
result: json
*/
	if(isset($_POST['id'])){
	
		$id = $_POST['id'];	
		//deleteProduct
		$result = $db->deleteProduct($id);

		if($result)
		{
			echo json_encode("Delete product table success!");
		}
		else
		{
			echo json_encode($this->conn->error);
		}
	}else{
		echo json_encode("Require parameter (id) is missing!");
	}

?>