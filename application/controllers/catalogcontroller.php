<?php
require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . 'controller.class.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'model.class.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'alerts.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'template.class.php');

class catalogcontroller extends Controller {
	function companies() {
	  if($_POST['w'] == ""){         
		  $this->set('companies', $this->Catalog->retrieveAllCompanies());
    } else {
      $this->set('companies', $this->Catalog->searchAllCompanies($_POST['w']));
    }
	}
	
	function deleteCompanies($id) {
		$this->Catalog->deleteCompany($id);
		$this->set('companies', $this->Catalog->retrieveAllCompanies());
	}
	
	function editCompany($company) {
		$this->set('company', $this->Catalog->getCompany($company));
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function statuss() {
		$this->set('statuss', $this->Catalog->retrieveAllStatuss());
	}
	
	function editStatus($status) {
		$this->set('status', $this->Catalog->getStatus($status));
	}
	
	function addStatus() {
		$status = array('id' => 0, 'name' => '');
		
		$this->set('status', $status);
	}
	
	function deleteStatus($id) {
		if($this->Catalog->deleteStatus($id)) {
			$this->set('success', false);
			$this->set('saveMessage', 'Ha ocurrido un error al eliminar el estatus. Por favor verifique que el estatus no se encuentra en uso.');
		} else {
			$this->set('success', true);
			$this->set('saveMessage', 'El estatus ha sido eliminado exitosamente.');
		}
		
		$this->set('statuss', $this->Catalog->retrieveAllStatuss());
	}
	
	function saveStatus($id = 0) {
		if($id == 0) {
			if(isset($_POST['name'])) {
				$id = $this->Catalog->insertStatus($_POST['name']);
				
				$this->set('success', true);
				$this->set('saveMessage', 'El estatus nuevo ha sido agregado exitosamente.');
			} else {
				$this->set('success', false);
				$this->set('saveMessage', 'Por favor, introduzca un valor para el nombre.');
			}
		} else { 
			$this->Catalog->updateStatus($id, $_POST['name']);
			
			$this->set('success', true);
			$this->set('saveMessage', 'Los cambios han sido registrados exitosamente.');
		}
	
		$this->set('status', $this->Catalog->getStatus($id));
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function sectors() {
	 if($_POST['w'] == ""){    
		 $this->set('sectors', $this->Catalog->retrieveAllSectors());
	 } else {
	   $this->set('sectors', $this->Catalog->searchAllSectors($_POST['w']));
	 }
	}
	
	function editSector($sector) {
		$this->set('sector', $this->Catalog->getSector($sector));
	}
	
	function addSector() {
		$sector = array('id' => 0, 'name' => '');
		
		$this->set('sector', $sector);
	}
	
	function deleteSector($id) {
		if($this->Catalog->deleteSector($id)) {
			$this->set('success', false);
			$this->set('saveMessage', 'Ha ocurrido un error al eliminar el sector. Por favor verifique que el sector no se encuentra en uso.');
		} else {
			$this->set('success', true);
			$this->set('saveMessage', 'El sector ha sido eliminado exitosamente.');
		}
		
		$this->set('sectors', $this->Catalog->retrieveAllSectors());
	}
	
	function saveSector($id = 0) {
		if($id == 0) {
			if(isset($_POST['name'])) {
				$id = $this->Catalog->insertSector($_POST['name']);
				
				$this->set('success', true);
				$this->set('saveMessage', 'El sector nuevo ha sido agregado exitosamente.');
			} else {
				$this->set('success', false);
				$this->set('saveMessage', 'Por favor, introduzca un valor para el nombre.');
			}
		} else { 
			$this->Catalog->updateSector($id, $_POST['name']);
			
			$this->set('success', true);
			$this->set('saveMessage', 'Los cambios han sido registrados exitosamente.');
		}
	
		$this->set('sector', $this->Catalog->getSector($id));
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function users() {
	  if($_POST['w'] == ""){ 
		  $this->set('users', $this->Catalog->retrieveAllUsers());
    } else {
      $this->set('users', $this->Catalog->searchAllUsers($_POST['w']));
    }

	}
	
	function roles() {
		$this->set('roles', $this->Catalog->retrieveAllRoles());
	}
	
	function edituser($user) {
		$this->set('roles', $this->Catalog->retrieveAllRoles());
		$this->set('companies', $this->Catalog->retrieveAllCompanies());
		$this->set('user', $this->Catalog->getUser($user));
	}
	
	function addUser() {
		$user = array('id' => 0, 'username' => '', 'password' => '', 'fullname' => '', 'role' => -1, 'company' => 0, 'email' => '');
		$this->set('user', $user);
		$this->set('roles', $this->Catalog->retrieveAllRoles());
		$this->set('companies', $this->Catalog->retrieveAllCompanies());
	}
	
	function deleteUser($id) {
		if($this->Catalog->deleteUser($id)) {
			$this->set('success', false);
			$this->set('saveMessage', 'Ha ocurrido un error al eliminar el usuario. Por favor verifique que el usuario no se encuentra en uso.');
		} else {
			$this->set('success', true);
			$this->set('saveMessage', 'El usuario ha sido eliminado exitosamente.');
		}
		
		$this->set('users', $this->Catalog->retrieveAllUsers());
	}
	
	function saveUser($id = 0) {
		if($id == 0) {
			if(isset($_POST['username']) && !empty($_POST['role'])) {
			  
        if($_POST['password'] != ""){
          $passAuto = $_POST['password'];  
        } else {
          $passAuto = $this->userGeneratePass(); 
        }
        
        $id = $this->Catalog->insertUser($_POST['username'], $passAuto, $_POST['fullname'], $_POST['role'], $_POST['company'], $_POST['email']);
				//Enviar Mail
				$headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
        $headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
        $message = "Se ha creado una nueva cuenta para el usuario: {$_POST['username']}</br>";
        $message .= " La contraseña Asignada a su cuenta es: {$passAuto}</br>";
        mail($_POST['email'], "Usted a Creado una nueva Cuenta en PVP - AES", $message, $headers);
          
				$this->set('success', true);
				$this->set('saveMessage', 'El usuario nuevo ha sido creado exitosamente. Se ha enviado al correo registrado los datos de acceso para ingresar al sistema');
        
			} else {
				$this->set('success', false);
				$this->set('saveMessage', 'Por favor, introduzca un valor para el nombre de usuario y un rol.');
			}
		} else { 
			if(!empty($_POST['username']) && !empty($_POST['role'])) {
				$this->Catalog->updateUser($id, $_POST['username'], $_POST['password'], $_POST['fullname'], $_POST['role'], $_POST['company'], $_POST['email']);
				$this->set('success', true);
				$this->set('saveMessage', 'Los cambios han sido registrados exitosamente.');
			}else{
				$this->set('success', false);
				$this->set('saveMessage', 'Por favor, introduzca un valor para el nombre de usuario y un rol.');
			}
		}
	
		$this->set('roles', $this->Catalog->retrieveAllRoles());
		$this->set('companies', $this->Catalog->retrieveAllCompanies());
		$this->set('user', $this->Catalog->getUser($id));
	}

  function saveNewPass( $id = 0 ){
    if( $id != 0 ){
     if (!empty($_POST['passant']) && !empty($_POST['passnew']) && !empty($_POST['passcnew']) ){
       if( $_POST['passant'] != $this->Catalog->getPassNow($id) ){
           $this->set('success', false);
           $this->set('saveMessage', 'La clave actual no coincide con la registrada.');      
        } else {
          if($_POST['passnew'] == $_POST['passcnew'] ){
             $this->Catalog->updatePass($_POST['passnew'], $id);
             $this->set('success', true);
             $this->set('saveMessage', 'Clave Actualizada');
          } else {
           $this->set('success', false);
           $this->set('saveMessage', 'La clave no coincide verifique');      
          }  
        }
     } else {
        $this->set('success', false);
        $this->set('saveMessage', 'Los campos estan vacios verifique.');
     } 
       
    } else {
        $this->set('success', false);
        $this->set('saveMessage', 'Intento cambiar clave a usuario no asignado.');      
    }
  }

  function userGeneratePass(){
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
	
	function usercompany($id) {
		$user = $this->Catalog->getUser($id);
		$this->set('user', $user);
		
		if(isset($_REQUEST['company'])) {
			$company = $_REQUEST['company'];
		} else {
			$company = '';
		}
		
		$this->set('companies', $this->Catalog->retrieveAllCompanies());
		$this->set('userbranches', $this->Catalog->retrieveUserBranches($id));
		$this->set('companybranches', $this->Catalog->retrieveCompanyBranches($company));
		$this->set('company', $this->Catalog->getCompany($company));
	}
	
	function saveusercompany($id) {
		$user = $this->Catalog->getUser($id);
		$this->set('user', $user);
		
		if(isset($_REQUEST['company'])) {
			$company = $_REQUEST['company'];
		} 
		
		if(isset($_REQUEST['branch'])) {
			$branches = $_REQUEST['branch'];
			$this->Catalog->dropCompanyUserBranches($id, $company);
			foreach ($branches as $branch){
				$this->Catalog->insertUserBranches($id, $company, $branch);
			}
		}else{
			$this->Catalog->dropCompanyUserBranches($id, $company);
		}
		
		$this->set('companies', $this->Catalog->retrieveAllCompanies());
		$this->set('userbranches', $this->Catalog->retrieveUserBranches($id));
		$this->set('companybranches', $this->Catalog->retrieveCompanyBranches($company));
		$this->set('company', $this->Catalog->getCompany($company));
	}
}
