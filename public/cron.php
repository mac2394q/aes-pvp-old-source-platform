<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

require_once(ROOT . DS . 'config' . DS . 'config.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'model.class.php');

class cron extends Model {
  
  function getAuditsExpires(){
    
    $now = date("Y-m-d");
    $tmonth = strtotime ( '-3 month' , strtotime ( $now ) ) ;
    $date_new =  date ( 'Y-m-d' , $tmonth);
    
    $query  = "SELECT  co.socialName AS namecompany, co.email, CAST(au.closureDate AS DATE) AS dateclose  FROM auditinstance au, companies co ";
    $query .= "WHERE au.provider = co.id ";
    $params = array('2015-03-17');
    $data = $this->preparedQuery($query, $params);
       
    return $data;
        
  }
  function sendEmailNotify(){

    $datas = $this->getAuditsExpires();
    $now = date("Y-m-d");
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
    // Additional headers
    $headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
    
    foreach($datas as $data){
      
      //mail($user["email"], "Notification PVP - AES", $message, $headers);
      $datetime1 = new DateTime($data['dateclose']);
      $datetime2 = new DateTime($now);

      # obtenemos la diferencia entre las dos fechas
      $interval=$datetime2->diff($datetime1);
       
      # obtenemos la diferencia en meses
      $intervalMeses=$interval->format("%m");
      # obtenemos la diferencia en a«Ðos y la multiplicamos por 12 para tener los meses
      $intervalAnos = $interval->format("%y")*12;
      $meses = $intervalMeses+$intervalAnos;
      $mesAudit = date("F", strtotime($data['dateclose']));
      $title = "Auditoria PVP";
      if($meses == 10){

          
          $message  = "Nos permitimos comunicarle  que la audito&iacute;a PVP de seguimiento para la compa&ntilde;&iacute;a ".$data['namecompany']." se estar&aacute; 
          programando para el pr&oacute;ximo mes de ".$mesAudit." del a&ntilde;o ".date("Y").".  Pr&oacute;ximamente recibir&aacute;  la programaci&oacute;n de la evaluaci&oacute;n.

           Cordial saludo,<br><br>";

           mail("<pclavijo@aes.org.co>,<asistservicios@aes.org.co>", $title, $message, $headers);
      }
      if($meses == 11){
          $message  = "Nos permitimos comunicarle  que la audito&iacute;a PVP de seguimiento para la compa&ntilde;&iacute;a ".$data['namecompany']." se estar&aacute; 
          programando para el pr&oacute;ximo mes de ".$mesAudit." del a&ntilde;o ".date("Y").".  Pr&oacute;ximamente recibir&aacute;  la programaci&oacute;n de la evaluaci&oacute;n.

           Cordial saludo,";
           $result = mail("<pclavijo@aes.org.co>,<asistservicios@aes.org.co>,<".$data['email'].">", $title, $message, $headers);

           echo("RESULTADO:".$data['email'].$result."\n");
      }
      //print $message;
   }
  }
}

$mycron = new cron();
$mycron->sendEmailNotify();
?>