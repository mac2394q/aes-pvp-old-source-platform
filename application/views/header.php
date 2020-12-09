<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>Programa de Verificaci&oacute;n de Proveedores</title>
		<link href="<?=SITE_URL ?><?=CSS_LOCATION ?>layout.css" rel="stylesheet" type="text/css">
		<link href="<?=SITE_URL ?><?=CSS_LOCATION ?>wysiwyg.css" rel="stylesheet" type="text/css">
		<link href="<?=SITE_URL ?><?=CSS_LOCATION ?>styles.css" rel="stylesheet" type="text/css">
		<link href="<?=SITE_URL ?><?=CSS_LOCATION ?>jquery-ui-1.8.10.custom.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="<?=SITE_URL ?><?=JS_LOCATION ?>enhance.js"></script>	
		<script type="text/javascript" src="<?=SITE_URL ?><?=JS_LOCATION ?>excanvas.js"></script>
		<script type="text/javascript" src="<?=SITE_URL ?><?=JS_LOCATION ?>jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="<?=SITE_URL ?><?=JS_LOCATION ?>jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="<?=SITE_URL ?><?=JS_LOCATION ?>jquery.wysiwyg.js"></script>
		<script type="text/javascript" src="<?=SITE_URL ?><?=JS_LOCATION ?>jquery.titlealert.min.js"></script>
		<script type="text/javascript" src="<?=SITE_URL ?><?=JS_LOCATION ?>jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="<?=SITE_URL ?><?=JS_LOCATION ?>visualize.jQuery.js"></script>
		<script type="text/javascript" src="<?=SITE_URL ?><?=JS_LOCATION ?>functions.js"></script>
		<script type="text/javascript" src="<?=SITE_URL ?><?=JS_LOCATION ?>jquery.ui.datepicker-es.js"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<!--[if IE 6]>
		<script type='text/javascript' src='scripts/png_fix.js'></script>
		<script type='text/javascript'>
		  DD_belatedPNG.fix('img, .notifycount, .selected');
		</script>
		<![endif]--> 
	</head>
	<body id="homepage">
		<div id="header">
			<a href="" title=""><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>pvp_logo.png" alt="Control Panel" class="logo"></a>
			<div id="searcharea">
		    <img src="<?=SITE_URL ?><?=IMG_LOCATION ?>logo-aes-pvp.png" width="196" height="79" alt="AES" /></div>
		</div>
		<!-- Top Breadcrumb Start -->
		<div id="breadcrumb">
			<ul>	
				<li><img src="<?=SITE_URL ?><?=IMG_LOCATION ?>icons/icon_breadcrumb.png" alt="Location"></li>
				<li><strong>Location:</strong></li>
				<li><a href="<?=SITE_URL ?>dashboard/main" title="">Sub Section</a></li>
				<li>/</li>
				<li class="current">Control Panel</li>
			</ul>
			<div style="float:right;"><div style="float:left;">Tiempo restante de sesi&oacute;n:&nbsp;</div><div id="remainingTime" style="float:left;"><?=TIMEOUT?>:00</div>&nbsp;</div>
		</div>
		<!-- Top Breadcrumb End -->

		<!-- Right Side/Main Content Start -->
		<div id="rightside">
