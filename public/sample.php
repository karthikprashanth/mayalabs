<?php
	// INIT CURL
	$ch = curl_init();
	
	// SET URL FOR THE POST FORM LOGIN
	curl_setopt($ch, CURLOPT_URL, 'http://hive.dev/authentication/login');
	
	// ENABLE HTTP POST
	curl_setopt ($ch, CURLOPT_POST, 1);
	
	// SET POST PARAMETERS : FORM VALUES FOR EACH FIELD
	curl_setopt ($ch, CURLOPT_POSTFIELDS, 'username=admin&password=reason&ext=yes');
	
	// IMITATE CLASSIC BROWSER'S BEHAVIOUR : HANDLE COOKIES
	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	
	# Setting CURLOPT_RETURNTRANSFER variable to 1 will force cURL
	# not to print out the results of its query.
	# Instead, it will return the results as a string return value
	# from curl_exec() instead of the usual true/false.
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	
	// EXECUTE 1st REQUEST (FORM LOGIN)
	$sid = curl_exec ($ch);
	
	echo "Your secure ID is : $sid<br>";
	
	curl_setopt($ch, CURLOPT_URL, 'http://hive.dev/search/view?keyword=hive&eoh=&ll=1&ul=10&cat=forum');
	
	
	curl_setopt ($ch, CURLOPT_POST, 1);
	
	
	curl_setopt ($ch, CURLOPT_POSTFIELDS, 'uname=admin&sid='.$sid);
	$searchresults = curl_exec ($ch);
	echo $searchresults;
	
	curl_setopt($ch, CURLOPT_URL, 'http://hive.dev/authentication/extlogout');
	
	
	curl_setopt ($ch, CURLOPT_POST, 1);
	
	
	curl_setopt ($ch, CURLOPT_POSTFIELDS, 'uname=admin&sid='.$sid);
	$logout = curl_exec ($ch);
	
	// CLOSE CURL
	curl_close ($ch); 

?>