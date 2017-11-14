<?php
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	function similarity($str1, $str2) {
	    $len1 = strlen($str1);
	    $len2 = strlen($str2);
	    
	    $max = max($len1, $len2);
	    $similarity = $i = $j = 0;
	    
	    while (($i < $len1) && isset($str2[$j])) {
	        if ($str1[$i] == $str2[$j]) {
	            $similarity++;
	            $i++;
	            $j++;
	        } elseif ($len1 < $len2) {
	            $len1++;
	            $j++;
	        } elseif ($len1 > $len2) {
	            $i++;
	            $len1--;
	        } else {
	            $i++;
	            $j++;
	        }
	    }

	    return round($similarity / $max, 2);
	}

	$str1 = '|:AG|FEFA GFD2|defd dcAF|G2GF GFDE|FGAF GBAG|! F2FA GFD2|defd dcAG|Ad (3cBA GBAG|F2D2 D2:|! |:fg|agfa gfeg|fdec dcA2|agfa gfde|(3fed gf e2fg|! (3agf ge f2fe|d2de fdec|dcAF GBAG|F2D2 D2:|';
	$str2 = 'Bd|eAA BAG|EAA ABd|eAA BAB|dBG GBd|! eAA BAG|EAA AGE|GAB d2e|1dBA A:|2dBA A3|:! aba g2e|dBG AGE|aba g2e|dBd g3|! aba g2e|dBG AGE|GAB d2e|dBA A3:|';

	// the similarity is extremely small
	echo 'Similarity: ' . (similarity($str1, $str2) * 100) . '%';
