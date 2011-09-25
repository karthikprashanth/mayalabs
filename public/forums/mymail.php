<?php
	echo "hey";
	require_once("/var/www/hive/library/Zend/Mail.php");
	require_once("/var/www/hive/library/Zend/Mail/Transport/Smtp.php");
	$config = array('ssl' => "tls", 'port' => 587, 'auth' => "login", 'username' => "admin@hiveusers.com", 'password' => "swordfish");
	$tr = new Zend_Mail_Transport_Smtp("smtp.gmail.com",$config);
	Zend_Mail::setDefaultTransport($tr);
    $mail = new Zend_Mail();
    $mail->setBodyHtml("hey mail");
    $mail->setFrom($mcon['fromadd'], $mcon['fromname']);
    $mail->addTo("pv.srivathsa@gmail.com", "Srivathsa PV");
    $mail->setSubject('GT Data Notification');
    $mail->send();
	echo "hey";
?>