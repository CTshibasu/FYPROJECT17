<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// may have to change the data structure of (more like expand), on the way the JSON is presented
	// may have to add an extra parameter for the functions, that count the page I'm on
	// first and foremost, take a function with a parameter that will return a bearable number of information
	// create a new version of the function with the extra parameter, $pageItem

	// for this example, I will take the get_search function and add a new parameter to that here
	// get_search() function

	// word, for the particular section of the session site you're on and also
	// the searched word being made on the query
	function get_search($word, $searchTerm, $pageItem = 50, $pageNo = 1){
		// do nothing...

		// have the link of the search as a variable with the query at the end of it
		$url = "https://thesession.org/".$word."/search?q=".$searchTerm."&format=json&perpage=".$pageItem."&page=".$pageNo;

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
				$res = $response;

				// return JSON object;
				return $res;
		} 

	}

	// echo '<pre>'.get_search("tunes", "Jig").'</pre>';
	// echo '------------------------------------------<br>';
	$a = get_search("tunes", "Jig");
	$arr = json_decode($a, 1);
	// $tunes = ($arr['tunes']);
	// echo $arr['pages'];

	$numPages = $arr['pages'];
	$itemLimit = 50;

	$str = '[';
	// now create a loop
	for($i = 1; $i <= $numPages; $i++){
		if($i != 1){
			$str .= ",";
		}
		$str.= get_search("tunes", "Jig", $itemLimit, $i);
	}
	$str.="]";

	echo json_encode($str);
	

	// echo $arr['tunes']['id'];

	// now try to get the loop going on the page
	// thinking of how I'm going to output this
	// $str = '<pre>{
	// 		"tunes":[';

	// // for loop 
	// for($i = 1; $i <= intval($arr['pages']); $i++){
	// 	// echo
	// 	// NOW to print out the function
	// 	$retf = get_search("tunes", "Jig", $i);

	// 	// convert into an array
	// 	$resarray = json_decode($retf, 1);
	// 	var_dump(count($resarray));
	// 	// traverse the tunes section of the array
	// 	for($j = 0; $j <= count($resarray['tunes']); $j++){
	// 		if($j != 0){
	// 			$str .= ", ";
	// 		}

	// 		// now for the rest of the strings with the parameters of it
	// 		$str.='{
	// 			"id":'.$resarray['tunes']['id'].',
	// 			"name":"'.$resarray['tunes']['name'].'",
	// 			"url": "'.$resarray['tunes']['url'].'",
	// 			"member":{
	// 				"id":'.$resarray['tunes']['member']['id'].',
	// 				"name": "'.$resarray['tunes']['member']['name'].'",
	// 				"url": "'.$resarray['tunes']['member']['url'].'"
	// 			},
	// 			"date": "'.$resarray['tunes']['date'].'",
	// 			"type": "'.$resarray['tunes']['type'].'"
	// 		}';
	// 	}

	// 	$str.=']
	// 	}</pre>';
	// }