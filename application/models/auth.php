<?php
class auth extends Model {	
	function authenticateUser($req) {
		$query = "SELECT * FROM users WHERE username = ? AND password = ?";
		$params = array($req['username'], $req['password']);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function getUserCompany() {
		$query = "SELECT DISTINCT company FROM branchusers WHERE user = ?";
		$params = array($_SESSION['user']['id']);
		
		$data = $this->preparedQuery($query, $params);
		
		if(count($data) > 0)
			return $data[0]['company'];
		else 
			return null;
	}
  
  function getValidateEmail($email, $username){
    
    $query = "SELECT COUNT(id) as nuser FROM users WHERE email = ? AND username = ?";
    $params = array($email, $username);
    
    $data = $this->preparedQuery($query, $params);
    
    return $data;
  }
  
  function resetPassEmail($email, $username){
    $con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
    $bd = mysql_select_db(DB_NAME,$con) or die ("Verifique la Base de Datos");

    $query = "SELECT id as nuser FROM users WHERE email = ? AND username = ?";
    $params = array($email, $username);
    $data = $this->preparedQuery($query, $params);
    


    $pass = $this->usrGeneratePass();
    $uid = $data[0]['nuser'];
    
    //print $uid = $data[0]['nuser'];die;


    $qupd = "UPDATE users SET password = '$pass' WHERE id = ".$uid;
    $result = mysql_query($qupd);

    //$udparams = array($pass, $uid);
    //$result = $this->preparedQuery($qupd, $udparams);
    
    if($result){
      // To send HTML mail, the Content-type header must be set
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
      // Additional headers
      $headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
      $br = "<br/>";
      $message  = "Se ha asignado una nueva clave para el usuario {$username} la nueva clave asignada es {$pass}".$br;
      mail($email, "Recuperar Password PVP - AES", $message, $headers);
      return true;
    } else {
      return false;
    }
 
  }
  
  function usrGeneratePass(){
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $longitudCadena=strlen($cadena);
    $pass = "";
    $longitudPass=10;
    for($i=1 ; $i<=$longitudPass ; $i++){
        $pos=rand(0,$longitudCadena-1);
        $pass .= substr($cadena,$pos,1);
    }
    return $pass;
  }
}
