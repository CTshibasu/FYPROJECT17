<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// include
	include 'recRelate.php';

	var_dump(json_decode(getTuneInfo(1209), 1));
