<?php
	require_once '../../db_function.php';
	$db = new DB_Functions();
/*
endpoint: http://<domain>/drinkshop/server/order/getorder.php
method: post
param: orderstatus
result: json
*/
	//json response
	$response = array();
	if( isset($_POST['status']))
	{
		$status = $_POST['status'];
		
		$orders = $db -> getOrderServerByStatus($status);
		echo json_encode($orders);

	}
	else
	{
		$response["error_msg"] = "Require parameter (status) is missing!";
		echo json_encode($response);
	}
?>
