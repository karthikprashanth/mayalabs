<?php
	require_once('phpQuery.php');
	$psf_scid = $_GET['id'];
	
	$idNameLookup = array(
						  1 => "Aerospace",
						  2 => "Bioengineering",
						  3 => "Communication, Networking & Broadcasting",
						  4 => "Components, Circuits, Devices & Systems",
						  5 => "Computing & Processing (Hardware/Software)",
						  6 => "Engineered Materials, Dielectrics & Plasmas",
						  7 => "Engineering Profession",
						  8 => "Fields, Waves & Electromagnetics",
						  9 => "General Topics for Engineers (Math, Science & Engineering)",
						  10 => "Geoscience",
						  11 => "Nuclear Engineering",
						  12 => "Photonics & Electro-Optics",
						  13 => "Power, Energy, & Industry Applications",
						  14 => "Robotics & Control Systems",
						  15 => "Signal Processing & Analysis",
						  16 => "Transportation"
					);	  
	$psf_scn = urlencode($idNameLookup[$psf_scid]);
	
	$baseurl = "http://ieeexplore.ieee.org";
	
	$url = "http://ieeexplore.ieee.org/xpl/periodicalsBySubjectCategory.jsp?psf_scid=" . $psf_scid . "&psf_scn=" . $psf_scn . "psf_pn=1";
	$htmlContent = file_get_contents($url);
	
	phpQuery::newDocument($htmlContent);
	
	$browseResults = pq('#browse-results');
	phpQuery::newDocument($browseResults);
	echo "<ul>";
	foreach(pq('li') as $key => $value)
	{
		$cont = pq($value)->find('div div h3')->text();
		$href = pq($value)->find('div div h3 a')->attr('href');
		echo "<li><a href = '$baseurl.$href'>$cont</a></li>";
	}
	echo "</ul>";
?>