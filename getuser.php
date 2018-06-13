<?php
	require_once 'db_function.php';
	$db = new DB_Functions();
/*
endpoint: http://<domain>/drinkshop/register.php
method: post
param: phone, name, birthday, address
result: json
*/
	//json response
	$response = array();
	if(isset($_POST['phone']))
	{
		$phone = $_POST['phone'];
		$user = $db -> getUserInformation($phone);
		if($user)
		{
			$response["phone"] = $user["Phone"];
			$response["name"] = $user["Name"];
			$response["birthday"] = $user["Birthday"];
			$response["address"] = $user["Address"];
			echo json_encode($response);
		}
		else
		{
			$response["error_msg"] = "User does not exist!";
			echo json_encode($response);
		}
	}
	else
	{
		$response["error_msg"] = "Require parameter (phone) is missing!";
		echo json_encode($response);
	}
?>