<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// now in this page we will...
	include '/Applications/MAMP/htdocs/SessionCURL/test_session.php';

	$res = get_search("tunes", "jig");
	echo $res;