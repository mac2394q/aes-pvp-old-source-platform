<?php
	$timeout = (TIMEOUT + 1) * 60; 
	ini_set('session.gc_maxlifetime', $timeout);

	session_start();
	
	if(!(strstr($_SERVER["REQUEST_URI"], 'auth')) && !isset($_SESSION["user"]["id"])) {
		header('Location: ' . SITE_URL . 'auth/logout');
	}