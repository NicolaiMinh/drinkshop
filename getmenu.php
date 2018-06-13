<?php
	require_once 'db_function.php';
	$db = new DB_Functions();
	$menus = $db -> getMenus();
	echo json_encode($menus);
?>
