<?php
	ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);

    include '/Applications/MAMP/htdocs/SessionCURL/test_session.php';

    $dom = new DOMDocument("1.0");
	$node = $dom->createElement("markers");
	$parnode = $dom->appendChild($node);

	$input = "sessions";

	// returns the JSON of the 
	$a =  get_new($input);

	// test that it is in JSON format
	// echo $a;

	// $b = json_decode($a);

	// the problem with the variable a is that it is a string
	// so it won't work now, must check the return of the function get_new()
	// returns NULL at the moment
	// var_dump($a);

	// helps to tell program what I'm getting the content
	header("Content-type: text/xml");

	// for loop through the array
	foreach($a['sessions'] as $x){
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

		// type of marker
		$newnode->setAttribute("type", $input);

	}

	// echo out the XML content
	echo $dom->saveXML();

	// now to try another script to import this XML into and create markers out of them with the use of
	// their latitude and longitude into the google maps API

	// now to try convert the array to html
	// 	array(4) {
	//   ["format"]=>
	//   string(4) "json"
	//   ["pages"]=>
	//   int(391)
	//   ["page"]=>
	//   int(1)
	//   ["sessions"]=>
	//   array(10) {
	//     [0]=>
	//     array(10) {
	//       ["id"]=>
	//       int(6354)
	//       ["url"]=>
	//       string(36) "https://thesession.org/sessions/6354"
	//       ["member"]=>
	//       array(3) {
	//         ["id"]=>
	//         int(1328)
	//         ["name"]=>
	//         string(10) "brendan-be"
	//         ["url"]=>
	//         string(35) "https://thesession.org/members/1328"
	//       }
	//       ["date"]=>
	//       string(19) "2017-10-15 09:12:25"
	//       ["latitude"]=>
	//       float(48.34912491)
	//       ["longitude"]=>
	//       float(10.15425968)
	//       ["venue"]=>
	//       array(5) {
	//         ["id"]=>
	//         int(7360)
	//         ["name"]=>
	//         string(31) "Fiddler&#8217;s Green Irish Pub"
	//         ["telephone"]=>
	//         string(0) ""
	//         ["email"]=>
	//         string(0) ""
	//         ["web"]=>
	//         string(36) "https://fiddlersgreenpub.de/kontakt/"
	//       }
	//       ["town"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(4015)
	//         ["name"]=>
	//         string(24) "Pfaffenhofen An Der Roth"
	//       }
	//       ["area"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(141)
	//         ["name"]=>
	//         string(6) "Bayern"
	//       }
	//       ["country"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(57)
	//         ["name"]=>
	//         string(7) "Germany"
	//       }
	//     }
	//     [1]=>
	//     array(10) {
	//       ["id"]=>
	//       int(6353)
	//       ["url"]=>
	//       string(36) "https://thesession.org/sessions/6353"
	//       ["member"]=>
	//       array(3) {
	//         ["id"]=>
	//         int(103229)
	//         ["name"]=>
	//         string(10) "Ann Hendel"
	//         ["url"]=>
	//         string(37) "https://thesession.org/members/103229"
	//       }
	//       ["date"]=>
	//       string(19) "2017-10-11 22:38:27"
	//       ["latitude"]=>
	//       float(40.92205429)
	//       ["longitude"]=>
	//       float(-81.10032654)
	//       ["venue"]=>
	//       array(5) {
	//         ["id"]=>
	//         int(7359)
	//         ["name"]=>
	//         string(26) "Jupiter Studios And Bistro"
	//         ["telephone"]=>
	//         string(13) "(330)829-3399"
	//         ["email"]=>
	//         string(0) ""
	//         ["web"]=>
	//         string(29) "http://www.jupiterstudios.org"
	//       }
	//       ["town"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(4014)
	//         ["name"]=>
	//         string(8) "Alliance"
	//       }
	//       ["area"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(36)
	//         ["name"]=>
	//         string(4) "Ohio"
	//       }
	//       ["country"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(173)
	//         ["name"]=>
	//         string(3) "USA"
	//       }
	//     }
	//     [2]=>
	//     array(10) {
	//       ["id"]=>
	//       int(6352)
	//       ["url"]=>
	//       string(36) "https://thesession.org/sessions/6352"
	//       ["member"]=>
	//       array(3) {
	//         ["id"]=>
	//         int(109761)
	//         ["name"]=>
	//         string(11) "Ross Lister"
	//         ["url"]=>
	//         string(37) "https://thesession.org/members/109761"
	//       }
	//       ["date"]=>
	//       string(19) "2017-10-11 07:55:53"
	//       ["latitude"]=>
	//       float(-27.04785538)
	//       ["longitude"]=>
	//       float(153.15306091)
	//       ["venue"]=>
	//       array(5) {
	//         ["id"]=>
	//         int(7357)
	//         ["name"]=>
	//         string(35) "Bribie Island Community Arts Centre"
	//         ["telephone"]=>
	//         string(0) ""
	//         ["email"]=>
	//         string(0) ""
	//         ["web"]=>
	//         string(0) ""
	//       }
	//       ["town"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(3750)
	//         ["name"]=>
	//         string(13) "Bribie Island"
	//       }
	//       ["area"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(145)
	//         ["name"]=>
	//         string(10) "Queensland"
	//       }
	//       ["country"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(12)
	//         ["name"]=>
	//         string(9) "Australia"
	//       }
	//     }
	//     [3]=>
	//     array(10) {
	//       ["id"]=>
	//       int(6351)
	//       ["url"]=>
	//       string(36) "https://thesession.org/sessions/6351"
	//       ["member"]=>
	//       array(3) {
	//         ["id"]=>
	//         int(44431)
	//         ["name"]=>
	//         string(17) "Aidan O&#039;Hare"
	//         ["url"]=>
	//         string(36) "https://thesession.org/members/44431"
	//       }
	//       ["date"]=>
	//       string(19) "2017-10-10 19:46:08"
	//       ["latitude"]=>
	//       float(52.37182617)
	//       ["longitude"]=>
	//       float(-1.49313009)
	//       ["venue"]=>
	//       array(5) {
	//         ["id"]=>
	//         int(7355)
	//         ["name"]=>
	//         string(7) "The Oak"
	//         ["telephone"]=>
	//         string(14) "(02476) 518855"
	//         ["email"]=>
	//         string(22) "thebagintonoak@aol.com"
	//         ["web"]=>
	//         string(28) "http://thebagintonoak.co.uk/"
	//       }
	//       ["town"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(4012)
	//         ["name"]=>
	//         string(8) "Baginton"
	//       }
	//       ["area"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(100)
	//         ["name"]=>
	//         string(12) "Warwickshire"
	//       }
	//       ["country"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(47)
	//         ["name"]=>
	//         string(7) "England"
	//       }
	//     }
	//     [4]=>
	//     array(10) {
	//       ["id"]=>
	//       int(6350)
	//       ["url"]=>
	//       string(36) "https://thesession.org/sessions/6350"
	//       ["member"]=>
	//       array(3) {
	//         ["id"]=>
	//         int(97584)
	//         ["name"]=>
	//         string(18) "Sandi O&#039;Regan"
	//         ["url"]=>
	//         string(36) "https://thesession.org/members/97584"
	//       }
	//       ["date"]=>
	//       string(19) "2017-10-09 02:47:50"
	//       ["latitude"]=>
	//       float(45.42086029)
	//       ["longitude"]=>
	//       float(-122.66744232)
	//       ["venue"]=>
	//       array(5) {
	//         ["id"]=>
	//         int(7354)
	//         ["name"]=>
	//         string(23) "Maher&#8217;s Irish Pub"
	//         ["telephone"]=>
	//         string(14) "(503) 305-8087"
	//         ["email"]=>
	//         string(0) ""
	//         ["web"]=>
	//         string(26) "https://www.maherspub.com/"
	//       }
	//       ["town"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(3370)
	//         ["name"]=>
	//         string(11) "Lake Oswego"
	//       }
	//       ["area"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(38)
	//         ["name"]=>
	//         string(6) "Oregon"
	//       }
	//       ["country"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(173)
	//         ["name"]=>
	//         string(3) "USA"
	//       }
	//     }
	//     [5]=>
	//     array(10) {
	//       ["id"]=>
	//       int(6349)
	//       ["url"]=>
	//       string(36) "https://thesession.org/sessions/6349"
	//       ["member"]=>
	//       array(3) {
	//         ["id"]=>
	//         int(81609)
	//         ["name"]=>
	//         string(7) "PaddyVT"
	//         ["url"]=>
	//         string(36) "https://thesession.org/members/81609"
	//       }
	//       ["date"]=>
	//       string(19) "2017-10-05 01:55:33"
	//       ["latitude"]=>
	//       float(44.81219482)
	//       ["longitude"]=>
	//       float(-73.08520508)
	//       ["venue"]=>
	//       array(5) {
	//         ["id"]=>
	//         int(7351)
	//         ["name"]=>
	//         string(19) "Durty Nelly&#8217;s"
	//         ["telephone"]=>
	//         string(14) "(802) 238-1116"
	//         ["email"]=>
	//         string(0) ""
	//         ["web"]=>
	//         string(28) "http://www.durtynellysvt.com"
	//       }
	//       ["town"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(4010)
	//         ["name"]=>
	//         string(9) "St Albans"
	//       }
	//       ["area"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(46)
	//         ["name"]=>
	//         string(7) "Vermont"
	//       }
	//       ["country"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(173)
	//         ["name"]=>
	//         string(3) "USA"
	//       }
	//     }
	//     [6]=>
	//     array(10) {
	//       ["id"]=>
	//       int(6348)
	//       ["url"]=>
	//       string(36) "https://thesession.org/sessions/6348"
	//       ["member"]=>
	//       array(3) {
	//         ["id"]=>
	//         int(106747)
	//         ["name"]=>
	//         string(14) "David Zethmayr"
	//         ["url"]=>
	//         string(37) "https://thesession.org/members/106747"
	//       }
	//       ["date"]=>
	//       string(19) "2017-10-05 01:14:40"
	//       ["latitude"]=>
	//       float(43.00167847)
	//       ["longitude"]=>
	//       float(-89.67324829)
	//       ["venue"]=>
	//       array(5) {
	//         ["id"]=>
	//         int(7350)
	//         ["name"]=>
	//         string(19) "Hawley Auction Barn"
	//         ["telephone"]=>
	//         string(12) "608 432 4154"
	//         ["email"]=>
	//         string(20) "earfirst@outlook.com"
	//         ["web"]=>
	//         string(19) "http://earfirst.net"
	//       }
	//       ["town"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(4009)
	//         ["name"]=>
	//         string(11) "Mount Horeb"
	//       }
	//       ["area"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(50)
	//         ["name"]=>
	//         string(9) "Wisconsin"
	//       }
	//       ["country"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(173)
	//         ["name"]=>
	//         string(3) "USA"
	//       }
	//     }
	//     [7]=>
	//     array(10) {
	//       ["id"]=>
	//       int(6347)
	//       ["url"]=>
	//       string(36) "https://thesession.org/sessions/6347"
	//       ["member"]=>
	//       array(3) {
	//         ["id"]=>
	//         int(84697)
	//         ["name"]=>
	//         string(11) "Hedgegarlic"
	//         ["url"]=>
	//         string(36) "https://thesession.org/members/84697"
	//       }
	//       ["date"]=>
	//       string(19) "2017-10-02 11:07:30"
	//       ["latitude"]=>
	//       float(50.84516525)
	//       ["longitude"]=>
	//       float(4.38597822)
	//       ["venue"]=>
	//       array(5) {
	//         ["id"]=>
	//         int(7349)
	//         ["name"]=>
	//         string(13) "Coolock Café"
	//         ["telephone"]=>
	//         string(16) "+32 486 51 01 17"
	//         ["email"]=>
	//         string(29) "coolockcafebrussels@gmail.com"
	//         ["web"]=>
	//         string(52) "https://www.facebook.com/pg/Coolock-Café-7008979461"
	//       }
	//       ["town"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(256)
	//         ["name"]=>
	//         string(8) "Brussels"
	//       }
	//       ["area"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(181)
	//         ["name"]=>
	//         string(15) "Flemish Brabant"
	//       }
	//       ["country"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(19)
	//         ["name"]=>
	//         string(7) "Belgium"
	//       }
	//     }
	//     [8]=>
	//     array(10) {
	//       ["id"]=>
	//       int(6346)
	//       ["url"]=>
	//       string(36) "https://thesession.org/sessions/6346"
	//       ["member"]=>
	//       array(3) {
	//         ["id"]=>
	//         int(109493)
	//         ["name"]=>
	//         string(11) "PALOMA LIMA"
	//         ["url"]=>
	//         string(37) "https://thesession.org/members/109493"
	//       }
	//       ["date"]=>
	//       string(19) "2017-09-26 20:48:36"
	//       ["latitude"]=>
	//       float(-22.94175529)
	//       ["longitude"]=>
	//       float(-43.18112183)
	//       ["venue"]=>
	//       array(5) {
	//         ["id"]=>
	//         int(7344)
	//         ["name"]=>
	//         string(11) "Casarão 22"
	//         ["telephone"]=>
	//         string(0) ""
	//         ["email"]=>
	//         string(0) ""
	//         ["web"]=>
	//         string(36) "https://www.facebook.com/ocasarao22/"
	//       }
	//       ["town"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(2726)
	//         ["name"]=>
	//         string(14) "Rio De Janeiro"
	//       }
	//       ["area"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(1050)
	//         ["name"]=>
	//         string(14) "Rio De Janeiro"
	//       }
	//       ["country"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(25)
	//         ["name"]=>
	//         string(6) "Brazil"
	//       }
	//     }
	//     [9]=>
	//     array(10) {
	//       ["id"]=>
	//       int(6344)
	//       ["url"]=>
	//       string(36) "https://thesession.org/sessions/6344"
	//       ["member"]=>
	//       array(3) {
	//         ["id"]=>
	//         int(109551)
	//         ["name"]=>
	//         string(11) "John Ingman"
	//         ["url"]=>
	//         string(37) "https://thesession.org/members/109551"
	//       }
	//       ["date"]=>
	//       string(19) "2017-09-21 00:51:52"
	//       ["latitude"]=>
	//       float(57.04899597)
	//       ["longitude"]=>
	//       float(-135.30970764)
	//       ["venue"]=>
	//       array(5) {
	//         ["id"]=>
	//         int(7340)
	//         ["name"]=>
	//         string(24) "Baranof Brewery Tap Room"
	//         ["telephone"]=>
	//         string(0) ""
	//         ["email"]=>
	//         string(0) ""
	//         ["web"]=>
	//         string(32) "http://baranofislandbrewing.com/"
	//       }
	//       ["town"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(4005)
	//         ["name"]=>
	//         string(5) "Sitka"
	//       }
	//       ["area"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(2)
	//         ["name"]=>
	//         string(6) "Alaska"
	//       }
	//       ["country"]=>
	//       array(2) {
	//         ["id"]=>
	//         int(173)
	//         ["name"]=>
	//         string(3) "USA"
	//       }
	//     }
	//   }
	// }

