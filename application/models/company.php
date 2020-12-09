<?php
class company extends Model {
	function getCompany($companyId) {
		$query  = "SELECT c.*, s.name as sectorName, c.status, st.name as statusName ";
		$query .= "FROM companies c, countrys ct, sector s, status st ";
		$query .= "WHERE c.id = ? AND c.country = ct.id AND s.id = c.sector AND st.id = c.status limit 20";
		
		$params = array($companyId);
		
		$data = $this->preparedQuery($query, $params);
		
		
		if(count($data) == 1)
			return $data[0];
		else 	
			return null;
	}
	
	function getCompanyByBranch($branchId) {
		$query  = "SELECT c.*, s.name as sectorName, c.status, st.name as statusName ";
		$query .= "FROM companies c, branches b, sector s, status st ";
		$query .= "WHERE b.id = ? AND c.id = b.company AND s.id = c.sector AND st.id = c.status  limit 20";
		
		$params = array($branchId);
		
		$data = $this->preparedQuery($query, $params);
		
		if(count($data) == 1)
			return $data[0];
		else 	
			return null;
	}
	
	function retrieveBranches($companyId) {
		$query  = "SELECT b.*, c.socialName, s.name AS statusname ";
		$query .= "FROM branches b, companies c, status s ";
		$query .= "WHERE c.id = ? AND b.company = c.id  AND b.status = s.id limit 20";
		
		$params = array($companyId);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function updateGeneral($company, $code, $socialName, $postalAddress, $phoneFax, $webAddress, $city, $country, $legalRepresentative, $carge, $email, $nit, $sector, $certificate){
	  
    if($certificate != "" ){
		  $query  = "UPDATE companies SET code = ?, socialName = ?, postalAddress = ?, phoneFax = ?, webAddress = ?, city = ?, country = ?, legalRepresentative = ?, carge = ?, email = ?, nit = ?, sector = ?, certificate = ? WHERE id = ?";
		  $params = array($code, $socialName, $postalAddress, $phoneFax, $webAddress, $city, $country, $legalRepresentative, $carge, $email, $nit, $sector, $certificate, $company);
    } else {
      $query  = "UPDATE companies SET code = ?, socialName = ?, postalAddress = ?, phoneFax = ?, webAddress = ?, city = ?, country = ?, legalRepresentative = ?, carge = ?, email = ?, nit = ?, sector = ? WHERE id = ?";
      $params = array($code, $socialName, $postalAddress, $phoneFax, $webAddress, $city, $country, $legalRepresentative, $carge, $email, $nit, $sector, $company);
    }
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function insertGeneral($code, $socialName, $postalAddress, $phoneFax, $webAddress, $city, $country, $legalRepresentative, $carge, $email, $nit, $sector){
		$query  = "INSERT INTO companies (code, socialName, postalAddress, phoneFax, webAddress, city, country, legalRepresentative, carge, email, nit, sector, status, aes) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, 0)";

		$params = array($code, $socialName, $postalAddress, $phoneFax, $webAddress, $city, $country, $legalRepresentative, $carge, $email, $nit, $sector);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }
	}
	
	function updateBranch($company, $branch, $isMain, $workers, $id){
		$query  = "UPDATE branches SET company = ?, name = ?, main = ?, workers = ? WHERE id = ?";
		
		$params = array($company, $branch, $isMain, $workers, $id);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function insertBranch($company, $branch, $isMain, $workers){
		$query  = "INSERT INTO branches (company, name, main, status, workers) VALUES(?, ?, ?, 4, ?)";
		
		$params = array($company, $branch, $isMain, $workers);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }
	}

	function updateContact($invoiceToAddress, $invoiceToCity, $invoiceDueDate, $taxpayerType, $icaRetainer, $accountingName, $accountingEmail, $treasuryName, $treasuryEmail, $hrName, $hrEmail, $securityName, $securityEmail, $logisticsName, $logisticsEmail, $company){
		$query  = "UPDATE companies SET invoiceToAddress = ?, invoiceToCity = ?, invoiceDueDate = ?, taxpayerType = ?, icaRetainer = ?, accountingName = ?, accountingEmail = ?, treasuryName = ?, treasuryEmail = ?, hrName = ?, hrEmail = ?, securityName = ?, securityEmail = ?, logisticsName = ?, logisticsEmail  = ? WHERE id = ?";
		
		$params = array($invoiceToAddress, $invoiceToCity, $invoiceDueDate, $taxpayerType, $icaRetainer, $accountingName, $accountingEmail, $treasuryName, $treasuryEmail, $hrName, $hrEmail, $securityName, $securityEmail, $logisticsName, $logisticsEmail, $company);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function updateSecurity($securityMgmtName, $securityMgmtCharge, $securityMgmtEmail, $securityMgmtPhone, $securityMgmtMobile, $securityMgmtAddress, $securityMgmtCity, $company){
		$query  = "UPDATE companies SET securityMgmtName = ?, securityMgmtCharge = ?, securityMgmtEmail = ?, securityMgmtPhone = ?, securityMgmtMobile = ?, securityMgmtAddress = ?, securityMgmtCity = ? WHERE id = ?";
		
		$params = array($securityMgmtName, $securityMgmtCharge, $securityMgmtEmail, $securityMgmtPhone, $securityMgmtMobile, $securityMgmtAddress, $securityMgmtCity, $company);

		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function retrieveCustomers($companyId) {
		$query  = "SELECT c.*, s.name as sectorName "; 
		$query .= "FROM customerproviders cp, companies c, sector s ";
		$query .= "WHERE s.id = c.sector AND c.id = cp.customer AND cp.provider = ? limit 20";
			
		$params = array($companyId);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function searchCustomers($company, $search) {
		$query = "SELECT c.*, s.name as sectorName FROM companies c, sector s WHERE s.id = c.sector AND c.socialName LIKE ? AND c.id NOT IN (SELECT customer FROM customerproviders WHERE provider = ? limit 20)"; 

		$params = array('%' . $search . '%', $company);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function addCustomer($provider, $customer){
		$query  = "INSERT INTO customerproviders (customer, provider, registerDate, status) VALUES(?, ?, CURDATE(), 1)";

		$params = array($customer, $provider);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }
	}
	
	function deleteCustomer($provider, $customer){
		$query  = "DELETE FROM customerproviders WHERE provider = ? AND customer = ?";
		
		$params = array($provider, $customer);
		
		try {
			return $this->update($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function retrieveProviders($companyId) {
		$query  = "SELECT c.*, s.name as sectorName "; 
		$query .= "FROM customerproviders cp, companies c, sector s ";
		$query .= "WHERE s.id = c.sector AND c.id = cp.provider AND cp.customer = ? limit 20";
			
		$params = array($companyId);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function searchProviders($company, $search) {
		$query = "SELECT c.*, s.name as sectorName FROM companies c, sector s WHERE s.id = c.sector AND c.socialName LIKE ? AND c.id NOT IN (SELECT provider FROM customerproviders WHERE customer = ? limit 20)"; 

		$params = array('%' . $search . '%', $company);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function addProvider($customer, $provider){
		$query  = "INSERT INTO customerproviders (customer, provider, registerDate, status) VALUES(?, ?, CURDATE(), 1)";
		
		$params = array($customer, $provider);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }
	}
	
	function deleteProvider($customer, $provider){
		$query  = "DELETE FROM customerproviders WHERE customer = ? AND provider = ?";
		
		$params = array($customer, $provider);
		
		try {
			return $this->update($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function getCompanyByNit($nit){
		$query = "SELECT socialName FROM companies ";
		$query .= "WHERE nit = ? limit 20";
		
		$params = array($nit);
		
		$data = $this->preparedQuery($query, $params);
		
		if(isset($data[0])){
			return $data[0];
		}
	}
  
  function getCompanyLastId(){
    $query = "SELECT MAX(id) as maxid FROM companies";
    $data = $this->exec($query);
    return $data[0]['maxid'] + 1; 
  }
  
}


















