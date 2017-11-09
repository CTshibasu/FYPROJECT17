<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// the import of the file functions: working with extending the
	// get_sessions(), extending the session arrays

	// include '/Applications/MAMP/htdocs/SessionCURL/test_session.php';
	// function at hand which is the get_new("Sessions") functions
	function get_new($word, $pageItems = 50, $pageNo = 1){

		// this function will take in a link and it will append the word onto it to pull data from
		// in. JSON format.. e.g. "https://thesession.org/tunes/new?format=json"

		$url = "https://thesession.org/".$word."/new?format=json&perpage=".$pageItems;	

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

	// first call the functions: get_new("sessions")
	$itemsLimit = 50;
	$a = get_new("sessions", $itemsLimit);
	$pages = $a['pages'];
	// echo $pages;

	// helps to tell program what I'm getting the content
	header("Content-type: text/xml");
	// var_dump(count($a['sessions']));

	// ok, so the for loop for this is quite interesting but the right algorithm will set them in place
	// so the creation of the markers tag will be done once
	// have the session function be called and return an array, have the pages variable be saved
	// set that as a limit for the loop that will traverse the page
	// in the sessions array, you'll make the marker tags' attributes and save the XML after

	// first step, create the DOMdoc and the node and the parent node
	$dom = new DOMDocument("1.0");
	$node = $dom->createElement("markers");
	$parnode = $dom->appendChild($node);

	// for loop, will call the function, extract, increment page
	for($i = 1; $i <= $pages; $i++){
		// now call the function for the get_new() sessions
		$array = get_new("sessions", $itemsLimit, $i);

		// returns the array
		foreach ($a['sessions'] as $x) {
			# code...
			$node = $dom->createElement("marker");
			$newnode = $parnode->appendChild($node);

			// session id, and page
			$newnode->setAttribute("id", $x['id']);
			$newnode->setAttribute("url", $x['url']);

			// member of the session being held, head of the session
			$newnode->setAttribute("member-id", $x['member']['id']);
			$newnode->setAttribute("member-name", html_entity_decode($x['member']['name'], ENT_QUOTES ,'UTF-8'));
			$newnode->setAttribute("member-url", $x['member']['url']);

			// date, location
			$newnode->setAttribute("date", $x['date']);
			$newnode->setAttribute("lat", $x['latitude']);
			$newnode->setAttribute("lon", $x['longitude']);

			// venue
			$newnode->setAttribute("venue-id", $x['venue']['id']);
			$newnode->setAttribute("venue-name", $x['venue']['name']);
			$newnode->setAttribute("venue-phone", $x['venue']['telephone']);
			$newnode->setAttribute("venue-email", $x['venue']['email']);
			$newnode->setAttribute("venue-website", $x['venue']['web']);

			// town
			$newnode->setAttribute("town-id", $x['town']['id']);
			$newnode->setAttribute("town-name", $x['town']['name']);

			// area
			$newnode->setAttribute("area-id", $x['area']['id']);
			$newnode->setAttribute("area-name", $x['area']['name']);

			// country
			$newnode->setAttribute("country-id", $x['country']['id']);
			$newnode->setAttribute("country-name", $x['country']['name']);
		}
	}

	// echo out the XML content
	echo $dom->saveXML();

