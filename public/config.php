<?php
// Configuration settings for My Site
 
// Email Settings
$site['from_name'] = 'My Name'; // from email name
$site['from_email'] = 'admin@hiveusers.com'; // from email address
 
// Just in case we need to relay to a different server,
// provide an option to use external mail server.
$site['smtp_mode'] = 'enabled'; // enabled or disabled
$site['smtp_host'] = "ssl://smtp.gmail.com";
$site['smtp_port'] = 465;
$site['smtp_username'] = "admin@hiveusers.com";
$site['smtp_password'] = "swordfish";
?>