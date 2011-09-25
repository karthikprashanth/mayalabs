<?php
	$doc_root =  $_SERVER['DOCUMENT_ROOT'];
	$doc_root = substr($doc_root,0,strlen($doc_root)-6);
	$doc_root = $doc_root . "library/Zend";
	require_once($doc_root . "/Mail.php");
	require_once($doc_root . "/Mail/Transport/Smtp.php");
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