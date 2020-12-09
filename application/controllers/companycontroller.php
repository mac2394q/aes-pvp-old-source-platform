<?php
require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . 'controller.class.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'model.class.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'catalog.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'alerts.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'template.class.php');

class companycontroller extends Controller {
	private $Catalog;
	
	function main($company) {
		$this->Catalog = new catalog();
		
		if($company == 0) {
		  
      $this->set('company', array("id" => "0", "code" => $this->Company->getCompanyLastId(), "socialName" => "", "commercialName" => "", "sector" => "", "status" => 1, 
 										"postalAddress" => "", "phoneFax" => "", "webAddress" => "", "city" => "", "legalRepresentative" => "", "email" => "", "carge" => "",
 										"nit" => "", "aes" => 0, "country" => 0, "invoiceToAddress" => NULL, "invoiceToCity" => NULL, "invoiceDueDate" => NULL, "grantDate" => "",
 										"taxpayerType" => NULL, "icaRetainer" => NULL, "accountingName" => NULL, "accountingEmail" => NULL, "treasuryName" => NULL, "renewalDate" => "",
 										"treasuryEmail" => NULL, "hrName" => NULL, "hrEmail" => NULL, "securityName" => NULL, "securityEmail" => NULL, "maturityDate" => "",
 										"logisticsName" => NULL, "logisticsEmail" => NULL, "securityMgmtName" => NULL, "securityMgmtCharge" => NULL, 
 										"securityMgmtEmail" => NULL, "securityMgmtPhone" => NULL, "securityMgmtMobile" => NULL, "securityMgmtAddress" => NULL, "securityMgmtCity" => NULL));
		} else {
			$this->set('company', $this->Company->getCompany($company));
		}
		
		$this->set('sectors', $this->Catalog->retrieveAllSectors());
		$this->set('countrys', $this->Catalog->retrieveAllCountrys());
	}
	
	function savegeneral($company) {
		$this->Catalog = new catalog();
		
		@$code = $_POST["code"];
		@$socialName = $_POST["socialName"];
		@$postalAddress = $_POST["postalAddress"];
		@$phoneFax = $_POST["phoneFax"];
		@$webAddress = $_POST["webAddress"];
		@$city = $_POST["city"];
		@$country = $_POST["country"];
		@$legalRepresentative = $_POST["legalRepresentative"];
		@$carge = $_POST["carge"];
		@$email = $_POST["email"];
		@$nit = $_POST["nit"];
		@$sector = $_POST["sector"];
		
		if(!empty($socialName) && !empty($sector)){
			if ($company == 0) {
				$exist = $this->Company->getCompanyByNit($nit);
				if(empty($exist)){
   			     $company = $this->Company->insertGeneral($code, $socialName, $postalAddress, $phoneFax, $webAddress, $city, $country, $legalRepresentative, $carge, $email, $nit, $sector);
					    if($company){
						    $this->set('success', true);
						    $this->set('saveMessage',  MSG_SAVE_OK);
					    } else {
						    $this->set('success', false);
						    $this->set('saveMessage', MSG_SAVE_ERROR . $company);
					    }
				    }else{
					    $this->set('success', false);
					    $this->set('saveMessage',  "La compa&ntilde;ia que intenta crear ya existe o no contiene datos fundamentales, verifique los datos ingresados y vuelva a intentarlo");
				    }
			} else {
			    
        if($_FILES['certificate']['type'] == 'application/pdf'){
          $certificado = file_get_contents($_FILES['certificate']['tmp_name']);
				  $message = $this->Company->updateGeneral($company, $code, $socialName, $postalAddress, $phoneFax, $webAddress, $city, $country, $legalRepresentative, $carge, $email, $nit, $sector, $certificado);
          
          if($message){
            $this->set('success', false);
            $this->set('saveMessage',  MSG_SAVE_ERROR . $message);
          } else {
            $this->set('success', true);
            $this->set('saveMessage', MSG_SAVE_OK);
          }

        } else {
          $this->set('success', false);
          $this->set('saveMessage',  MSG_SAVE_ERROR . 'Debe ser un archivo PDF');
        }
			}
		}
		
		$this->set('company', $this->Company->getCompany($company));
		$this->set('sectors', $this->Catalog->retrieveAllSectors());
		$this->set('countrys', $this->Catalog->retrieveAllCountrys());
		
	}
	
	function contact($company) {
		$this->set('company', $this->Company->getCompany($company));
	}
	
	function savecontact($company) {
		$invoiceToAddress = $_POST["invoiceToAddress"];
		$invoiceToCity = $_POST["invoiceToCity"];
		$invoiceDueDate = $_POST["invoiceDueDate"];
		$taxpayerType = $_POST["taxpayerType"];
		$icaRetainer = $_POST["icaRetainer"];
		$accountingName = $_POST["accountingName"];
		$accountingEmail = $_POST["accountingEmail"];
		$treasuryName = $_POST["treasuryName"];
		$treasuryEmail = $_POST["treasuryEmail"];
		$hrName = $_POST["hrName"];
		$hrEmail = $_POST["hrEmail"];
		$securityName = $_POST["securityName"];
		$securityEmail = $_POST["securityEmail"];
		$logisticsName = $_POST["logisticsName"];
		$logisticsEmail = $_POST["logisticsEmail"];
		
		$message = $this->Company->updateContact($invoiceToAddress, $invoiceToCity, $invoiceDueDate, $taxpayerType, $icaRetainer, $accountingName, $accountingEmail, $treasuryName, $treasuryEmail, $hrName, $hrEmail, $securityName, $securityEmail, $logisticsName, $logisticsEmail, $company);
		
		if($message){
			$this->set('success', false);
			$this->set('saveMessage',  MSG_SAVE_ERROR . $message);
		} else {
			$this->set('success', true);
			$this->set('saveMessage', MSG_SAVE_OK);
		}
		
		$this->set('company', $this->Company->getCompany($company));
	}
	
	function security($company) {
		$this->set('company', $this->Company->getCompany($company));
	}
	
	function savesecurity($company) {
		$securityMgmtName = $_POST["securityMgmtName"];
		$securityMgmtCharge = $_POST["securityMgmtCharge"];
		$securityMgmtEmail = $_POST["securityMgmtEmail"];
		$securityMgmtPhone = $_POST["securityMgmtPhone"];
		$securityMgmtMobile = $_POST["securityMgmtMobile"];
		$securityMgmtAddress = $_POST["securityMgmtAddress"];
		$securityMgmtCity = $_POST["securityMgmtCity"];
		
		$message = $this->Company->updateSecurity($securityMgmtName, $securityMgmtCharge, $securityMgmtEmail, $securityMgmtPhone, $securityMgmtMobile, $securityMgmtAddress, $securityMgmtCity, $company);
		
		if($message){
			$this->set('success', false);
			$this->set('saveMessage',  MSG_SAVE_ERROR . $message);
		} else {
			$this->set('success', true);
			$this->set('saveMessage', MSG_SAVE_OK);
		}
		
		$this->set('company', $this->Company->getCompany($company));
	}
	
	function customers($company) {
		if(isset($_POST["customer"])) {
			$customer = $this->Company->addCustomer($company, $_POST["customer"]);
		}
		
		if(isset($_POST["search"])) {
			$this->set('search', $_POST["search"]);
			
			$this->set('companiesSearched', $this->Company->searchCustomers($company, $_POST["search"]));
		}
		
		if(isset($_POST["delete"])){
			$customers = $_POST["delete"];
			foreach($customers AS $customer){
				$this->Company->deleteCustomer($company, $customer);
			}
		}
		
		$this->set('company', $this->Company->getCompany($company));
		$this->set('companies', $this->Company->retrieveCustomers($company));
	}
	
	function providers($company) {
		if(isset($_POST["provider"])) {
			$provider = $this->Company->addProvider($company, $_POST["provider"]);
		}
		
		if(isset($_POST["search"])) {
			$this->set('search', $_POST["search"]);
			
			$this->set('companiesSearched', $this->Company->searchProviders($company, $_POST["search"]));
		}
		
		if(isset($_POST["delete"])){
			$providers = $_POST["delete"];
			foreach($providers AS $provider){
				$this->Company->deleteProvider($company, $provider);
			}
		}
		
		$this->set('company', $this->Company->getCompany($company));
		$this->set('companies', $this->Company->retrieveProviders($company));
	}
	
	function legal($company) {
		$this->set('company', $this->Company->getCompany($company));
	}
	
	function branches($company) {
		if(isset($_POST["id"]) && isset($_POST["name"]) && isset($_POST["main"])) {
			$ids = $_POST["id"];
			$names = $_POST["name"];
			$main = $_POST["main"];
			
			foreach($ids as $id){
				$setMain = $main == $id ? true: false;
				
				if(!empty($names[$id])){
					if($id == 0) {
						$this->Company->insertBranch($company, $names[$id], $setMain, $_POST["workers"]);
					} else {
						$this->Company->updateBranch($company, $names[$id], $setMain, $_POST["workers".$id], $id);
					}
				}
			}
		}
		
		$this->set('branches', $this->Company->retrieveBranches($company));
		$this->set('company', $this->Company->getCompany($company));
	}
  
}
