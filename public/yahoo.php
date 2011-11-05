<?php
	require("phpQuery/phpQuery/phpQuery.php");	
	$sunSign = $_GET['sun_sign'];
	$html = file_get_contents("http://askganesha.com/" . $sunSign . "/" . $sunSign . "-daily-horoscope.asp");
	$doc = phpQuery::newDocument($html);
	$doc = phpQuery::newDocument($doc["table:[height=125]:first"]);
	$json = array(
		'sunSign' => $sunSign,
		'astro' => strip_tags($doc['p'])
	);
	echo json_encode($json);
?>
