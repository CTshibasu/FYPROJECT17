<?php 
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// import here
	$data = file_get_contents ("data.json");
	$json = json_decode($data, true);

	var_dump($json[0]["settings"]);
	