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
	if(isset($_FILES["uploaded_file"]["name"]))//truyen vao uploaded_file , tên file
	{
		if(isset($_POST["phone"]))//tham so phone
		{
			$phone = $_POST["phone"];//var phone

			$name = $_FILES["uploaded_file"]["name"];//var name file
			$tmp_file = $_FILES["uploaded_file"]["tmp_name"];
			$error = $_FILES["uploaded_file"]["error"];

			if (!empty($name)) {
				$location = './user_avarta/';//tao location save file
				if(!is_dir($location))
				{
					mkdir($location);//create location
				}
				if(move_uploaded_file($tmp_file, $location . $name))//move file vào location
				{
					$result = $db -> updateAvatar($phone, $name);//update avatar theo phone
					if($result)
					{
						echo json_encode("Uploaded!");
					}
					else {
						echo json_encode("Error while write to databasae!");
					}
				}
			}

		}
		else {
			echo json_encode("Missing phone field!");
		}
	}
	else
	{
		echo json_encode("Please select file!");
	}
?>
