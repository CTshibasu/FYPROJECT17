<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// now to create a function that returns from a tunebook, may not work and
	// will be deprecated
	function getTunebook($id,  $pageNo = 1, $pageItem = 10){

		// this function will take in a link and it will append the word onto it to pull data from
		// in. JSON format.. e.g. "https://thesession.org/tunes/new?format=json"

		$url = "https://thesession.org/members/".$id."/tunebook?format=json&perpage=".$pageItem."&page=".$pageNo;	

		// put in the  curl function
		$ch = curl_init($url);

		// create an array for the data to be pulled into
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json;', 'Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		// save response to variable
		$response = curl_exec($ch);

		if(empty($response)) {
			$error = curl_error($ch);
	        //$error now contains the error thrown when curl_exec failed to execute
	        echo $error;
		} else {

			//prints out the JSON for the new tunes for the session API
			$res = json_decode(html_entity_decode($response), true);

			// return JSON object;
			return $res;

			// print a break...
			// get as string...
			// $res = json_decode($response, true);
			// var_dump($res['settings']);

			// now that I know that the $res variable holds an array that was decoded from JSON, now a loop would be helpful to get...
			// specific parameters...will attempt
		} 
	}

	// proved successful!
	// $a = getTunebook(109869);

	// accessed index
	// var_dump($a["tunes"]);
	// member id - 109869
	// echo "<pre>".getTunebook(109869)."</pre>";

	// LOOKS LIKE THERE IS NO WAY TO GET A PARTICULAR MEMBER
	// // partition the the page
	// echo "----------------------------------";

	// function getMember($id){

	// 	$url = "https://thesession.org/members/".$id."?format=json";	

	// 	// put in the  curl function
	// 	$ch = curl_init($url);

	// 	// create an array for the data to be pulled into
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json;', 'Content-Type: application/json'));
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	// 	// save response to variable
	// 	$response = curl_exec($ch);

	// 	if(empty($response)) {
	// 		$error = curl_error($ch);
	//         //$error now contains the error thrown when curl_exec failed to execute
	//         echo $error;
	// 	} else {

	// 		//prints out the JSON for the new tunes for the session API
	// 		$res = $response;

	// 		// return JSON object; may not work
	// 		return $res;

	// 		// print a break...
	// 		// get as string...
	// 		// $res = json_decode($response, true);
	// 		// var_dump($res['settings']);

	// 		// now that I know that the $res variable holds an array that was decoded from JSON, now a loop would be helpful to get...
	// 		// specific parameters...will attempt
	// }

	// echo "<pre>".getMember(109869)."</pre>";



