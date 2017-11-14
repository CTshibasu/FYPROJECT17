<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// get the tunebook info from function
	include '/Applications/MAMP/htdocs/SessionCURL/Tunebook.php';

	var_dump(getTunebook(6451));