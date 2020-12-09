<?php	
date_default_timezone_set("CET");

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

if(isset($_GET['url']))
	$url = $_GET['url'];
else
	$url = "";

require_once (ROOT . DS . 'library' . DS . 'bootstrap.php');
