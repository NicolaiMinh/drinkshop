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
	if(isset($_POST['phone']) &&
		isset($_POST['name']) &&
		isset($_POST['birthday']) &&
		isset($_POST['address']))
	{
		$phone = $_POST['phone'];
		$name = $_POST['name'];
		$birthday = $_POST['birthday'];
		$address = $_POST['address'];

		if($db -> checkUserExist($phone))
		{
			$response["error_msg"] = "User already exists with ".$phone;
			echo json_encode($response);
		}
		else
		{
			//create new user
			$user = $db -> registerNewUser($phone, $name, $birthday, $address);
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
				$response["error_msg"] = "Unknow error occured in registration!";
				echo json_encode($response);
			}
		}
	}
	else
	{
		$response["error_msg"] = "Require parameter (phone, name, birthday, address) is missing!";
		echo json_encode($response);
	}
?>