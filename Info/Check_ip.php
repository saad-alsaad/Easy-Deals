<?php

function get_ip() {
		//Just get the headers if we can or else use the SERVER global
		if ( function_exists( 'apache_request_headers' ) ) {
			$headers = apache_request_headers();
		} else {
			$headers = $_SERVER;
		}
		//Get the forwarded IP if it exists
		if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
			$the_ip = $headers['X-Forwarded-For'];
		} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
		) {
			$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
		} else {
			
			$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
		}
		return $the_ip;
	}

function checkProxy($ip){
	$contactEmail="saadalsaad32@gmail.com"; //you must change this to your own email address
	$timeout=5; //by default, wait no longer than 5 secs for a response
	$banOnProability=0.99; //if getIPIntel returns a value higher than this, function returns true, set to 0.99 by default
	
	//init and set cURL options
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

	//if you're using custom flags (like flags=m), change the URL below
	curl_setopt($ch, CURLOPT_URL, "https://check.getipintel.net/check.php?ip=$ip&contact=$contactEmail");
	$response=curl_exec($ch);
	
	curl_setopt($ch, CURLOPT_URL, "http://www.shroomery.org/ythan/proxycheck.php?ip=$ip");
	$response2=curl_exec($ch);
	curl_close($ch);

	if (($response > $banOnProability) || $response2 == "Y") {
			return true;
	} else {
			if ($response < 0 || strcmp($response, "") == 0 ) {
			//The server returned an error, you might want to do something
			//like write to a log file or email yourself
			//This could be true due to an invalid input or you've exceeded
			//the number of allowed queries. Figure out why this is happening
			//because you aren't protected by the system anymore
			//Leaving this section blank is dangerous because you assume
			//that you're still protected, which is incorrect
			//and you might think GetIPIntel isn't accurate anymore
			//which is also incorrect.

			//failure to implement error handling is bad for the both of us

		}
			return false;
	}
}


$ip=get_ip();

?>
