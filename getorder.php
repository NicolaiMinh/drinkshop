<?php
	require_once 'db_function.php';
	$db = new DB_Functions();
/*
endpoint: http://<domain>/drinkshop/getorder.php
method: post
param: userphone, orderstatus
result: json
*/
	//json response
	$response = array();
	if(isset($_POST['userPhone']) && isset($_POST['status']))
	{
		$userPhone = $_POST['userPhone'];
		$status = $_POST['status'];
		
		$orders = $db -> getOrderByStatus($userPhone, $status);
		echo json_encode($orders);

	}
	else
	{
		$response["error_msg"] = "Require parameter (userPhone,status) is missing!";
		echo json_encode($response);
	}
?>
