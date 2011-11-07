<?php

	/** An API for getting the daily astrology for various sun signs
	* @author   Srivathsa PV <pv.srivathsa@gmail.com>
 	* @date    11-07-2011
	* @resource Askganesha.com
	*/
	
	// Including the phpQuery library for HTML Parsing	
	require("phpQuery/phpQuery/phpQuery.php"); 
	
	// Getting the sun_sign parameter. Ex: Virgo (or) VIRGO (or) virgo
	$sunSign = strtolower($_GET['sun_sign']); 
	
	/* Getting the HTML content
	 * sample URI - http://askganesha.com/virgo/virgo-daily-horoscope.asp
	 */
	$html = file_get_contents("http://askganesha.com/" . $sunSign . 
	"/" . $sunSign . "-daily-horoscope.asp");
	
	// Creating a phpQuery document out of the HTML content
	$doc = phpQuery::newDocument($html); 
	
	/* The astrology for each sun sign seems to be the 'first' table with height 125
	 * in the whole document
	 */
	$doc = phpQuery::newDocument($doc["table:[height=125]:first"]);
	
	/* The 'prediction' , 'lucky colour' and the 'lucky number' 
	 * seem to be separated by a <br> tag
	 */
	$astro = explode("<br>",$doc['p']);
	
	/* Splitting the space delimited sentence to get
	 * the name of the lucky color. Sample - 'Your lucky color is
	 * Orange'. And the name of the color is the 4th element of the array 
	 */
	$colorArr = explode(" ",$astro[1]);
	$color = $colorArr[4];
	
	/* Splitting the space delimited sentence to get
	 * the lucky number. Sample - 'Your lucky number is
	 * 7'. And the lucky number is the 4th element of the array 
	 */
	$luckyNumArr = explode(" ",$astro[2]);
	$luckyNum = (int)substr($luckyNumArr[4],0);
	
	//Contructing the JSON Array
	
	$json = array(
		'sunSign' => $sunSign,
		'astro' => strip_tags($astro[0]),
		'color' => $color,
		'luckyNum' => $luckyNum
	);
	
	//Outputting the array in JSON Encoded Format
	
	echo json_encode($json);
?>