<?php

	require_once 'db_function.php';
	$db = new DB_Functions();
/*
endpoint: http://<domain>/drinkshop/checkuser.php
method: post
param: phone
result: json
*/
	$response = array();
	if(isset($_POST['phone'])){
		$phone = $_POST['phone'];
		if($db -> checkUserExist($phone)){
			$response["exists"] = TRUE;
			echo json_encode($response);
		}else{
			$response["exists"] = FALSE;
			echo json_encode($response);
		}
	}else{
		$response["error_msg"] = "Require parameter (phone) is missing!";
		echo json_encode($response);
	}

?>