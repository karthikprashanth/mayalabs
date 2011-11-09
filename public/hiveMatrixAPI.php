<?php
	// INIT CURL
	$ch = curl_init();
	
	// SET URL FOR THE POST FORM LOGIN
	curl_setopt($ch, CURLOPT_URL, 'http://hive.dev/authentication/login');
	
	// ENABLE HTTP POST
	curl_setopt ($ch, CURLOPT_POST, 1);
	
	// SET POST PARAMETERS : FORM VALUES FOR EACH FIELD
	curl_setopt ($ch, CURLOPT_POSTFIELDS, 'username=admin&password=reason');
	
	// IMITATE CLASSIC BROWSER'S BEHAVIOUR : HANDLE COOKIES
	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	
	# Setting CURLOPT_RETURNTRANSFER variable to 1 will force cURL
	# not to print out the results of its query.
	# Instead, it will return the results as a string return value
	# from curl_exec() instead of the usual true/false.
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	
	// EXECUTE 1st REQUEST (FORM LOGIN)
	$store = curl_exec ($ch);
	
	// SET FILE TO DOWNLOAD
	curl_setopt($ch, CURLOPT_URL, 'http://hive.dev/search/view?keyword=hive&eoh=&ll=1&ul=10&cat=gt&displaymode=full');
	
	// EXECUTE 2nd REQUEST (FILE DOWNLOAD)
	$content = curl_exec ($ch);
	echo $content;
	// CLOSE CURL
	curl_close ($ch); 

?>