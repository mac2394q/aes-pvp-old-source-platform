<?php
require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . 'controller.class.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'model.class.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'alerts.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'template.class.php');

class authcontroller extends Controller {
	function main() {
	}
	
	function login() {
	  
    if($_POST){
      
      if($_POST['username'] != '' && $_POST['password'] != ''){
         $userdata = $this->Auth->authenticateUser($_REQUEST);
		 	   if (count($userdata) == 1) {
			     $_SESSION['user'] = $userdata[0];
			     $_SESSION['company'] = $this->Auth->getUserCompany();
				   $this->set('loggedin', true);
		     } else {
		       $_SESSION['MSG_fpass'] = "No se encontraron usuarios con los datos ingresados"; 
			     $this->set('loggedin', false);
		     }
      } else {
        $_SESSION['MSG_fpass'] = "El usuario y la clave no puede ser vacios";
        $this->set('loggedin', false);
      }
    } 
	}
	
	function logout() {
	      $this->set('MSG_fpass', $_SESSION['MSG_fpass']);
        $_SESSION['user'] = array();
        $_SESSION['provider'] = null;
        session_unset('user');
        session_unset('provider');
		    session_destroy(); 
        session_write_close();
	}
	
	function extend() {
		//just in order to make a call to session_start() (was made when passing by library/filters.php)
	}
  
  function fpass(){
   if($_POST){ 
    if($_POST['email']!= '' && $_POST['username'] != ''){  
      $countuser = $this->Auth->getValidateEmail($_POST['email'], $_POST['username']);
      if($countuser[0]['nuser'] == 0){
        $this->set('MSG_fpass', "EL usuario <b>{$_POST['username']}</b> con E-mail <b>{$_POST['email']}</b> no existe");
      } else {
        
        if($this->Auth->resetPassEmail($_POST['email'], $_POST['username'])){
          $this->set('MSG_fpass', "Se ha enviado una nueva contrase&ntilde;a - Verifique su correo");  
        } else {
          $this->set('MSG_fpass', "Se presento un error contacte al administrador");
        }
      }
      } else {
        $this->set('MSG_fpass', "No ha digitado un usuario &oacute; correo electr&oacute;nico valido");
      }
   }
  }
}
