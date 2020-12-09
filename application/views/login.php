<?php
	if ($loggedin) {
		header('Location: ' . SITE_URL . 'dashboard/main');
	} else {
		header('Location: ' . SITE_URL . 'auth/logout');
	} 
?>