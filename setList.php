<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// now to dump the page info: the information on the set onto the page
	// two things that should be returned because of the use of GET would be the member_id and the set_id
	// this will give me the full info 

	// 2 of the variables
	$member_id = $_GET["member_id"];
	$tune_id = $_GET["tune_id"];

	// using the full setting of the tune sets
	// return the list [...]
	