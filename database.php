<?php

	function getDb() {

		$db = pg_connect("host=localhost port=5432 dbname=super_dev user=superhero password=upandaway");

		return $db;
	}

?>