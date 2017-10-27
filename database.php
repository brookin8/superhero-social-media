<?php

	function getDb() {

		if(file_exists($_SERVER['DOCUMENT_ROOT'].'/.env')) {
			require ($_SERVER['DOCUMENT_ROOT']. '/vendor/autoload.php');
			$dotenv = new Dotenv\Dotenv($_SERVER['DOCUMENT_ROOT']);
			$dotenv->load();
		}

		$url = parse_url(getenv("DATABASE_URL"));
		// var_dump($url);

		$db_port = $url['port'];
		$db_host = $url['host'];
		$db_user = $url['user'];
		$db_pass = $url['pass'];
		$db_name = substr($url['path'],1);

		$db = pg_connect(
			"host=" . $db_host .
			" port=" . $db_port . 
			" dbname=" . $db_name . 
			" user=" . $db_user .
			" password=" . $db_pass);
			
		return $db;

		// $db = pg_connect("host=localhost port=5432 dbname=super_dev user=superhero password=upandaway");

	}

?>