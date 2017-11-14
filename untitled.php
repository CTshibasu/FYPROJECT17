<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// want to see if I can scrape the data from the website instead of requesting it
	// I will attempt to use DOMdocument class in PHP

	$alpha = file_get_contents('https://thesession.org/tunes/1209/sets');