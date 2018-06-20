<?php
	session_start();
	require_once ("lib/autoload.php");

	if(file_exists(__DIR__ . "/../.env"))
	{
		$dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
		$dotenv->load();
	}
	Braintree_Configuration::environment('sandbox');
	Braintree_Configuration::merchantId('5pwxb4ty6v9bnfx8');
	Braintree_Configuration::publicKey('dk5txtj76c8c57nn');
	Braintree_Configuration::privateKey('58c7cec8f3b3b7ffc35ac2f6e2ca4efe');
?>

