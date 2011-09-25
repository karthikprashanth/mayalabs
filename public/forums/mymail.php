<?php
	echo "hey1";
	echo $_SERVER['DOCUMENT_ROOT'];
	require_once("/var/www/hive/library/Zend/Mail.php");
	echo "hey2";
	require_once("/var/www/hive/library/Zend/Mail/Transport/Smtp.php");
	echo "hey3";
	$config = array('ssl' => "tls", 'port' => 587, 'auth' => "login", 'username' => "admin@hiveusers.com", 'password' => "swordfish");
	echo "hey4";
	$tr = new Zend_Mail_Transport_Smtp("smtp.gmail.com",$config);
	echo "hey5";
	Zend_Mail::setDefaultTransport($tr);
	echo "hey6";
    $mail = new Zend_Mail();
	echo "hey7";
    $mail->setBodyHtml("hey mail");
	echo "hey8";
    $mail->setFrom($mcon['fromadd'], $mcon['fromname']);
	echo "hey9";
    $mail->addTo("pv.srivathsa@gmail.com", "Srivathsa PV");
	echo "hey10";
    $mail->setSubject('GT Data Notification');
	echo "hey11";
    $mail->send();
	echo "hey12";
?>