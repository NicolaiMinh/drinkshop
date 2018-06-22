<?php

	require_once '../../db_function.php';
	$db = new DB_Functions();
/*
endpoint: http://<domain>/drinkshop/server/category/upload_category_img.php
method: post
param: phone
result: json
*/
	//json response
	if(isset($_FILES["uploaded_file"]["name"]))//truyen vao uploaded_file , tên file
	{
			$name = $_FILES["uploaded_file"]["name"];//var name file
			$tmp_file = $_FILES["uploaded_file"]["tmp_name"];
			$error = $_FILES["uploaded_file"]["error"];

			if (!empty($name)) {
				$location = './category_img/';//tao location save file
				if(!is_dir($location))
				{
					mkdir($location);//create location
				}
				if(move_uploaded_file($tmp_file, $location . $name))//move file vào location
				{
					echo json_encode($name);//in ra name de insert name vao database
				}
				else
				{
					echo json_encode("Uploaded fail. Move location error.");
				}
			}
	}
	else
	{
		echo json_encode("Please select file!");
	}

?>