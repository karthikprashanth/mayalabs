<?php
	$content = $_GET['content'];
	require_once('phpQuery.php');
	$htmlContent = file_get_contents("http://www.annauniv.edu");
	phpQuery::newDocument($htmlContent);
	
	if($content == 'whatsnew')
	{
		$whatsNew = pq('marquee:first');
		phpQuery::newDocument($whatsNew);
	}
	else if($content == 'results')
	{
		$results = pq('marquee:last');
		phpQuery::newDocument($results);		
	}
	echo "<ul>";
	foreach(pq('a') as $key => $value)
	{
		$e = pq($value)->find('span')->text();
		if($e != "")
			echo "<li>" . $e . "</li>";
	}
	echo "</ul>";
?>