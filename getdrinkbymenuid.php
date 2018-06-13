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
	if(isset($_POST['menuid']))
	{
		$menuid = $_POST['menuid'];
		$drinks = $db -> getDrinkByMenuID($menuid);
		echo json_encode($drinks);

	}
	else
	{
		$response["error_msg"] = "Require parameter (menuID) is missing!";
		echo json_encode($response);
	}
?>
