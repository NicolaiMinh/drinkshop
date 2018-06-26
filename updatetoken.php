<?php
	require_once 'db_function.php';
	$db = new DB_Functions();


	if(isset($_POST['phone']) &&
			isset($_POST['token']) &&
			isset($_POST['isServerToken']))
	{
			$phone = $_POST['phone'];
			$token = $_POST['token'];
			$isServerToken = $_POST['isServerToken'];

			$user = $db->insertToken($phone, $token, $isServerToken);
			if($user)
			{
				echo json_encode("Token update success.");
			}
			else
			{
				echo json_encode("Token update fail.");
			}
	}
	else
	{
		echo json_encode("Require parameter (phone, token, isServerToken) is missing!");
	}
?>
