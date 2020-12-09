<?php
	require_once(ROOT . DS . 'config' . DS . 'config.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
print $message." Hola";
	$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	$bd = mysql_select_db(DB_NAME) or die ("Verifique la Base de Datos");

	$query = "SELECT  co.email, au.closureDate AS dateclose  FROM auditinstance au, companies co WHERE au.provider = co.id";
	
	$datas = mysql_query($query);
	while($reg = mysql_fetch_array($datas)){

	// To send HTML mail, the Content-type header must be set
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
      // Additional headers
      $headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
      $message  = "Faltan Tres meses para terminar su auditoria. {$datas['dateclose']}";
      //mail($user["email"], "Notification PVP - AES", $message, $headers);
     	
     	print $message;
	}

?>