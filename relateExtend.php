<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// want to see if I can scrape the data from the website instead of requesting it
	// I will attempt to use DOMdocument class in PHP

	// Create a stream
	// include_once('/Applications/MAMP/htdocs/SessionCURL/tools/simple_html_dom.php');

	// $html = file_get_html('http://www.google.com/');

	// // Find all images 
	// foreach($html->find('img') as $element) 
	//        echo $element->src . '<br>';

	// function curl_download($Url){
	//     if (!function_exists('curl_init')){
	//         die('cURL is not installed. Install and try again.');
	//     }

	//     $ch = curl_init();
	//     curl_setopt($ch, CURLOPT_URL, $Url);
	//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//     $output = curl_exec($ch);
	//     curl_close($ch);
	//     return $output;
	// }

	// print curl_download('http://www.gutenberg.org/browse/scores/top');

	// $html = file_get_contents('http://pokemondb.net/evolution'); //get the html returned from the following url
	// $pokemon_doc = new DOMDocument();
	// libxml_use_internal_errors(TRUE); //disable libxml errors

	// if(!empty($html)){ //if any html is actually returned

	// 	$pokemon_doc->loadHTML($html);
	// 	libxml_clear_errors(); //remove errors for yucky html
		
	// 	$pokemon_xpath = new DOMXPath($pokemon_doc);

	// 	//get all the h2's with an id
	// 	$pokemon_row = $pokemon_xpath->query('//h2[@id]');

	// 	if($pokemon_row->length > 0){
	// 		foreach($pokemon_row as $row){
	// 			echo $row->nodeValue . "<br/>";
	// 		}
	// 	}
	// }

	echo "-- RECORDINGS --<br>";

	// now i want to implement the same program for the same thing with a session link 
	$sesh = file_get_contents('https://thesession.org/tunes/1209/recordings'); // get the html from the session site
	$sesh_doc = new DOMDocument();
	libxml_use_internal_errors(TRUE); //disable libxml errors

	if(!empty($sesh)){
		$sesh_doc->loadHTML($sesh);
		libxml_clear_errors(); //remove errors for yucky html

		$sesh_xpath = new DOMXPATH($sesh_doc);

		//get all the h1's with an id
		$sesh_row = $sesh_xpath->query('//a[@class="manifest-item-title"]');
		if($sesh_row->length > 0){
			foreach($sesh_row as $row){
				echo $row->nodeValue . " - ".$row->getAttribute('href')."<br/>";
			}
		}

	}

	// successful




?>