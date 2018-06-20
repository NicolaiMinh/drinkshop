<?php
	require_once 'db_function.php';
	$db = new DB_Functions();
/*
endpoint: http://<domain>/drinkshop/submitorder.php
method: post
param: orderDetail, userPhone, orderAddress, orderComment, orderPrice
result: json
*/
	//json response
	$response = array();
	if(isset($_POST['orderDetail']) &&
		isset($_POST['userPhone']) &&
		isset($_POST['orderAddress']) &&
		isset($_POST['orderComment']) &&
		isset($_POST['orderPrice']))
	{
		$orderDetail = $_POST['orderDetail'];
		$userPhone = $_POST['userPhone'];
		$orderAddress = $_POST['orderAddress'];
		$orderComment = $_POST['orderComment'];
		$orderPrice = $_POST['orderPrice'];

		//insertNewOrder
		$result = $db->insertNewOrder($orderPrice, $orderComment, $orderAddress, $orderDetail, $userPhone);

		if($result)
		{
			echo json_encode("Insert to order table success!");
		}
		else
		{
			echo json_encode($this->conn->error);
		}
	}
	else
	{
		echo json_encode("Require parameter (orderDetail, userPhone, orderAddress, orderComment, orderPrice) is missing!");
	}
?>
