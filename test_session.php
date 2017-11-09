<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	// use the PHP Curl library to get down information from the website
	// $link = "https://thesession.org/"; ... goes in function instead

	// array created
	// $id_array = array();

	// // have a link to the new tunes for the session website
	// $url = "https://thesession.org/tunes/new?format=json";

	// // put in the  curl function
	// $ch = curl_init($url);

	// // create an array for the data to be pulled into
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json;', 'Content-Type: application/json'));
	// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	// // save response to variable
	// $response = curl_exec($ch);

	// if(empty($response)) {
	// 		$error = curl_error($ch);
	//         //$error now contains the error thrown when curl_exec failed to execute
	//         echo $error;
	// 	} else {
	// 		//prints out the JSON for the new tunes for the session API
	// 		// echo '<pre>'.$response.'</pre>';

	// 		// print a break...
	// 		// get as string...
	// 		$res = json_decode($response, true);
	// 		// var_dump($res['settings']);

	// 		// now that I know that the $res variable holds an array that was decoded from JSON, now a loop would be helpful to get...
	// 		// specific parameters...will attempt
	// 		foreach ($res['settings'] as $k) {
	// 			# code...
	// 			echo '<br>';
	// 			echo $k["tune"]["name"].'<br>';
	// 			echo $k["tune"]["url"].'<br>';
	// 			echo $k["date"].'<br>';
	// 			echo $k["id"].'<br>';
	// 			echo $k["url"].'<br>';
	// 			echo $k["key"].'<br>';
	// 			echo $k["member"]["id"].'<br>';
	// 			echo $k["member"]["name"].'<br>';
	// 			echo $k["member"]["url"].'<br>';
	// 			echo '-------------------------------';
	// 		}

			// var_dump($id_array);
			// // now try print out the values
			// foreach($id_array as $key => $value){
			// 	echo $value."<br>";
			// }

		// }

	// can create a function that is able to change and pull data from the website
	// but before that, play around with the array that you pulled from the database\


	// create a function that looks at the new classes of the session API::
	// tunes, recordings, sessions, events, discussions
	// NOTE: the following functions below are read-only functions.

	function get_new($word, $pageNo = 50){

		// this function will take in a link and it will append the word onto it to pull data from
		// in. JSON format.. e.g. "https://thesession.org/tunes/new?format=json"

		$url = "https://thesession.org/".$word."/new?format=json&perpage=".$pageNo;	

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

	// test functions
	// print get_new("recordings");
	// echo "-------------------------------------------------------------------------------------------------------";
	// print get_new("recordings");
	// echo "-------------------------------------------------------------------------------------------------------";
	// print get_new("events");
	// echo "-------------------------------------------------------------------------------------------------------";
	// print get_new("sessions");
	// echo "-------------------------------------------------------------------------------------------------------";
	// print get_new("discussions");

	// now that it is pulling from the function and return a JSON string, now 
	// it's time to create a new function that has search results completed
	// the aim is to have a search box, where a string is read in and then it will have a value
	// when the value is created it goes into the function and then pulls from the site
	// whatever is relevant to the search query being made

	// it will have 2 parameters, one for the word and another for...

	// word, for the particular section of the session site you're on and also
	// the searched word being made on the query
	function get_search($word, $searchTerm, $pageNo = 50){
		// do nothing...

		// have the link of the search as a variable with the query at the end of it
		$url = "https://thesession.org/".$word."/search?q=".$searchTerm."&format=json&perpage=".$pageNo;

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

	// try one, for recording. So the words:
	// $word - recordings
	// $searchTerm - altan

	// test the function inputs...
	// print get_search("recordings", "altan");
	// print get_search("tunes", "humours");
	// print get_search("discussions", "whistle");
	// outputs strange content...

	// now the next function...
	// simpler function where you make

	// get a set of tunes that are available from site on it
	function set_tunes($pageNo = 50){

		// now, to use the URL
		$url = "https://thesession.org/tunes/sets?format=json&perpage=".$pageNo;

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

	// print out the void function
	// print set_tunes();

	// this gets the location of either EVENT or SESSION, possible may include a map feature
	// In this map feature, you will have options:
	// 1. Session ONLY
	// 2. Events ONLY
	// 3. BOTH

	// Pre-existing code, refer to prev.
	// function successful, just to review the co-ordinates of the function and possible solution, maybe on click???
	function locate_item($word, $lat, $lon, $pageNo = 50){

		// create the url variable
		$url = "https://thesession.org/".$word."/nearby?latlon=".$lat.",".$lon."&radius=75&format=json&perpage=".$pageNo;

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

				// return JSON object; may not work
				return $res;
		} 
	}

	// print locate_item("sessions", 42.3487654, -71.5176234);
	// print("-------------------------------------------------");

	// specify the object you're looking for
	// this function doesn't currently work for members...will revise later
	// now will move onto the 
	function spec_obj($word, $id, $pageNo = 50){

		// url
		$url = "https://thesession.org/".$word."/".$id."?format=json&perpage=".$pageNo;

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

				// return JSON object; may not work
				return $res;
		}
	}

	// print spec_obj("members", 105656);

	// activity streams - basically webhooks
	// potentially for individual streams or group streams
	function act_streams($word, $id = null, $pageNo = 50){

		// test string for emptiness, for both id and keywords
		if($word && !$id){ $word = $word."/"; $id = "";} elseif($word && $id) { $word = $word."/"; $id = $id."/"; } else { }

		// the URL variable
		$url = "https://thesession.org/".$word.$id."activity?format=json&perpage=".$pageNo;

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

				// return JSON object; may not work
				return $res;
		}
	}

	// now to create a function that returns from a tunebook, may not work and
	// will be deprecated
	function getTunebook($id, $pageNo = 50){

		// this function will take in a link and it will append the word onto it to pull data from
		// in. JSON format.. e.g. "https://thesession.org/tunes/new?format=json"

		$url = "https://thesession.org/members/".$id."/tunebook?format=json&perpage=".$pageNo;	

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

	// print act_streams("events");

// STRUCTURE OF ARRAY IN PHP FROM DECODING IN JSON
// 	array(4) {
//   ["format"]=>
//   string(4) "json"
//   ["pages"]=>
//   int(2957)
//   ["page"]=>
//   int(1)
//   ["settings"]=>
//   array(10) {
//     [0]=>
//     array(6) {
//       ["id"]=>
//       int(31135)
//       ["url"]=>
//       string(45) "https://thesession.org/tunes/593#setting31135"
//       ["key"]=>
//       string(6) "Eminor"
//       ["member"]=>
//       array(3) {
//         ["id"]=>
//         int(106512)
//         ["name"]=>
//         string(12) "Alpinerabbit"
//         ["url"]=>
//         string(37) "https://thesession.org/members/106512"
//       }
//       ["date"]=>
//       string(19) "2017-10-09 17:50:24"
//       ["tune"]=>
//       array(3) {
//         ["id"]=>
//         int(593)
//         ["name"]=>
//         string(24) "The Rocky Road To Dublin"
//         ["url"]=>
//         string(32) "https://thesession.org/tunes/593"
//       }
//     }
//     [1]=>
//     array(6) {
//       ["id"]=>
//       int(31134)
//       ["url"]=>
//       string(46) "https://thesession.org/tunes/1020#setting31134"
//       ["key"]=>
//       string(6) "Amajor"
//       ["member"]=>
//       array(3) {
//         ["id"]=>
//         int(17544)
//         ["name"]=>
//         string(6) "Yooval"
//         ["url"]=>
//         string(36) "https://thesession.org/members/17544"
//       }
//       ["date"]=>
//       string(19) "2017-10-09 05:12:38"
//       ["tune"]=>
//       array(3) {
//         ["id"]=>
//         int(1020)
//         ["name"]=>
//         string(18) "Palmer&#039;s Gate"
//         ["url"]=>
//         string(33) "https://thesession.org/tunes/1020"
//       }
//     }
//     [2]=>
//     array(6) {
//       ["id"]=>
//       int(31133)
//       ["url"]=>
//       string(46) "https://thesession.org/tunes/3897#setting31133"
//       ["key"]=>
//       string(6) "Dmajor"
//       ["member"]=>
//       array(3) {
//         ["id"]=>
//         int(63653)
//         ["name"]=>
//         string(7) "fluther"
//         ["url"]=>
//         string(36) "https://thesession.org/members/63653"
//       }
//       ["date"]=>
//       string(19) "2017-10-08 19:43:41"
//       ["tune"]=>
//       array(3) {
//         ["id"]=>
//         int(3897)
//         ["name"]=>
//         string(18) "A Visit To Ireland"
//         ["url"]=>
//         string(33) "https://thesession.org/tunes/3897"
//       }
//     }
//     [3]=>
//     array(6) {
//       ["id"]=>
//       int(31132)
//       ["url"]=>
//       string(45) "https://thesession.org/tunes/537#setting31132"
//       ["key"]=>
//       string(7) "Adorian"
//       ["member"]=>
//       array(3) {
//         ["id"]=>
//         int(88649)
//         ["name"]=>
//         string(14) "Michael Toomey"
//         ["url"]=>
//         string(36) "https://thesession.org/members/88649"
//       }
//       ["date"]=>
//       string(19) "2017-10-08 19:16:21"
//       ["tune"]=>
//       array(3) {
//         ["id"]=>
//         int(537)
//         ["name"]=>
//         string(8) "Up Sligo"
//         ["url"]=>
//         string(32) "https://thesession.org/tunes/537"
//       }
//     }
//     [4]=>
//     array(6) {
//       ["id"]=>
//       int(31131)
//       ["url"]=>
//       string(47) "https://thesession.org/tunes/16433#setting31131"
//       ["key"]=>
//       string(6) "Gmajor"
//       ["member"]=>
//       array(3) {
//         ["id"]=>
//         int(45277)
//         ["name"]=>
//         string(13) "chansherly212"
//         ["url"]=>
//         string(36) "https://thesession.org/members/45277"
//       }
//       ["date"]=>
//       string(19) "2017-10-08 12:01:56"
//       ["tune"]=>
//       array(3) {
//         ["id"]=>
//         int(16433)
//         ["name"]=>
//         string(19) "James Murray&#039;s"
//         ["url"]=>
//         string(34) "https://thesession.org/tunes/16433"
//       }
//     }
//     [5]=>
//     array(6) {
//       ["id"]=>
//       int(31130)
//       ["url"]=>
//       string(45) "https://thesession.org/tunes/604#setting31130"
//       ["key"]=>
//       string(6) "Dmajor"
//       ["member"]=>
//       array(3) {
//         ["id"]=>
//         int(61738)
//         ["name"]=>
//         string(10) "wheresrhys"
//         ["url"]=>
//         string(36) "https://thesession.org/members/61738"
//       }
//       ["date"]=>
//       string(19) "2017-10-07 22:41:14"
//       ["tune"]=>
//       array(3) {
//         ["id"]=>
//         int(604)
//         ["name"]=>
//         string(18) "The Little Diamond"
//         ["url"]=>
//         string(32) "https://thesession.org/tunes/604"
//       }
//     }
//     [6]=>
//     array(6) {
//       ["id"]=>
//       int(31129)
//       ["url"]=>
//       string(47) "https://thesession.org/tunes/16431#setting31129"
//       ["key"]=>
//       string(6) "Dmajor"
//       ["member"]=>
//       array(3) {
//         ["id"]=>
//         int(61738)
//         ["name"]=>
//         string(10) "wheresrhys"
//         ["url"]=>
//         string(36) "https://thesession.org/members/61738"
//       }
//       ["date"]=>
//       string(19) "2017-10-07 22:34:22"
//       ["tune"]=>
//       array(3) {
//         ["id"]=>
//         int(16431)
//         ["name"]=>
//         string(28) "Cowley Crosses The Chilterns"
//         ["url"]=>
//         string(34) "https://thesession.org/tunes/16431"
//       }
//     }
//     [7]=>
//     array(6) {
//       ["id"]=>
//       int(31128)
//       ["url"]=>
//       string(47) "https://thesession.org/tunes/16430#setting31128"
//       ["key"]=>
//       string(6) "Dmajor"
//       ["member"]=>
//       array(3) {
//         ["id"]=>
//         int(61738)
//         ["name"]=>
//         string(10) "wheresrhys"
//         ["url"]=>
//         string(36) "https://thesession.org/members/61738"
//       }
//       ["date"]=>
//       string(19) "2017-10-07 22:31:36"
//       ["tune"]=>
//       array(3) {
//         ["id"]=>
//         int(16430)
//         ["name"]=>
//         string(23) "The Last Days Of Summer"
//         ["url"]=>
//         string(34) "https://thesession.org/tunes/16430"
//       }
//     }
//     [8]=>
//     array(6) {
//       ["id"]=>
//       int(31127)
//       ["url"]=>
//       string(47) "https://thesession.org/tunes/16429#setting31127"
//       ["key"]=>
//       string(6) "Dminor"
//       ["member"]=>
//       array(3) {
//         ["id"]=>
//         int(96660)
//         ["name"]=>
//         string(12) "pbsinclair42"
//         ["url"]=>
//         string(36) "https://thesession.org/members/96660"
//       }
//       ["date"]=>
//       string(19) "2017-10-07 18:23:23"
//       ["tune"]=>
//       array(3) {
//         ["id"]=>
//         int(16429)
//         ["name"]=>
//         string(10) "The Rakers"
//         ["url"]=>
//         string(34) "https://thesession.org/tunes/16429"
//       }
//     }
//     [9]=>
//     array(6) {
//       ["id"]=>
//       int(31126)
//       ["url"]=>
//       string(43) "https://thesession.org/tunes/2#setting31126"
//       ["key"]=>
//       string(6) "Dmajor"
//       ["member"]=>
//       array(3) {
//         ["id"]=>
//         int(1531)
//         ["name"]=>
//         string(6) "Stiamh"
//         ["url"]=>
//         string(35) "https://thesession.org/members/1531"
//       }
//       ["date"]=>
//       string(19) "2017-10-07 18:00:09"
//       ["tune"]=>
//       array(3) {
//         ["id"]=>
//         int(2)
//         ["name"]=>
//         string(21) "The Bucks Of Oranmore"
//         ["url"]=>
//         string(30) "https://thesession.org/tunes/2"
//       }
//     }
//   }
// }