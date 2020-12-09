<?php
class catalog extends Model {
	function retrieveAllCompanies() {
		$query  = "SELECT c.*, st.name as statusName, s.name as sectorName ";
		$query .= "FROM companies c, status st, sector s ";
		$query .= "WHERE st.id = c.status AND s.id = c.sector ";
		$query .= "ORDER BY id DESC limit 20";
		
		$params = array();
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
  
  function searchAllCompanies($word) {
    
    $query  = "SELECT c.*, st.name as statusName, s.name as sectorName ";
    $query .= "FROM companies c, status st, sector s ";
    $query .= "WHERE st.id = c.status AND s.id = c.sector AND c.socialName LIKE '%{$word}%'";
    $query .= "ORDER BY id DESC limit 20 ";
    
    $params = array();
    
    $data = $this->preparedQuery($query, $params); 
    
    return $data;
  }
	
	function getCompany($company) {
		$query  = "SELECT c.* ";
		$query .= "FROM companies c ";
		$query .= "WHERE c.id = ? limit 20 ";
		
		$params = array($company);
		
		$data = $this->preparedQuery($query, $params);
		
		if(isset($data[0])){
			return $data[0];
		}
	}
	
	function getCompanyAndBranchByAudit($audit){
		$query  = "SELECT c.socialName, b.name AS branchName ";
		$query .= "FROM companies c, auditinstance ai, branches b ";
		$query .= "WHERE ai.id = ? ";
		$query .= "AND ai.provider = c.id ";
		$query .= "AND ai.branch = b.id limit 20 ";
		
		$params = array($audit);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data[0];
	}
	
	function deleteCompany($id){
		$query  = "DELETE FROM companies ";
		$query .= "WHERE id = ? ";
		$params = array($id);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function retrieveAllStatuss() {
		$query  = "SELECT s.* ";
		$query .= "FROM status s ";
		$query .= "ORDER BY name limit 20 ";
		
		$params = array();
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function getStatus($status) {
		$query  = "SELECT s.* ";
		$query .= "FROM status s ";
		$query .= "WHERE s.id = ? limit 20  ";

		$params = array($status);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data[0];
	}
	
	function updateStatus($id, $name){
		$query  = "UPDATE status ";
		$query .= "SET name = ? ";
		$query .= "WHERE id = ? ";
		
		$params = array($name, $id);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function insertStatus($name){
		$query  = "INSERT INTO status(name) VALUES(?)";
		
		$params = array($name);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function deleteStatus($id){
		$query  = "DELETE FROM status ";
		$query .= "WHERE id = ? ";
		
		$params = array($id);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function retrieveAllCountrys() {
		$query  = "SELECT ct.* ";
		$query .= "FROM countrys ct ";
		$query .= "ORDER BY nombre limit 20 ";
		
		$params = array();
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	function retrieveAllSectors() {
		$query  = "SELECT s.* ";
		$query .= "FROM sector s ";
		$query .= "ORDER BY name limit 20 ";
		
		$params = array();
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
  
  function searchAllSectors($word) {
    $query  = "SELECT s.* ";
    $query .= "FROM sector s ";
    $query .= "WHERE s.name like '%{$word}%' ";
    $query .= "ORDER BY name limit 20 ";
    
    $params = array();
    
    $data = $this->preparedQuery($query, $params);
    
    return $data;
  }
	
	function getSector($sector) {
		$query  = "SELECT s.* ";
		$query .= "FROM sector s ";
		$query .= "WHERE s.id = ? limit 20 ";
		
		$params = array($sector);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data[0];
	}
	
	function updateSector($id, $name){
		$query  = "UPDATE sector ";
		$query .= "SET name = ? ";
		$query .= "WHERE id = ? ";
		
		$params = array($name, $id);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function insertSector($name){
		$query  = "INSERT INTO sector(name) VALUES(?)";
		
		$params = array($name);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function deleteSector($id){
		$query  = "DELETE FROM sector ";
		$query .= "WHERE id = ? ";
		
		$params = array($id);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function retrieveAllUsers() {
		$query  = "SELECT u.*, r.id as roleId, r.name as roleName ";
		$query .= "FROM users u, roles r ";
		$query .= "WHERE r.id = u.role ";
		$query .= "ORDER BY u.username limit 20 ";
		
		$params = array();
		
		$data = $this->preparedQuery($query, $params);

		return $data;
	}
	
  
  function searchAllUsers($word) {
    $query  = "SELECT u.*, r.id as roleId, r.name as roleName ";
    $query .= "FROM users u, roles r ";
    $query .= "WHERE r.id = u.role AND u.fullname LIKE '%{$word}%'";
    $query .= "ORDER BY u.username limit 20 ";
    
    $params = array();
    
    $data = $this->preparedQuery($query, $params);

    return $data;
  }
  
  
	function retrieveAllRoles() {
		$query  = "SELECT r.* ";
		$query .= "FROM roles r ";
		$query .= "ORDER BY id limit 20 ";
		
		$params = array();
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function getUser($user) {
		$query  = "SELECT u.* ";
		$query .= "FROM users u ";
		$query .= "WHERE u.id = ? limit 20 ";
		
		$params = array($user);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data[0];
	}
	
	function updateUser($id, $username, $password, $fullname, $role, $company, $email){
		if(trim($password) != "") {
			$query  = "UPDATE users ";
			$query .= "SET username = ?, password = ?, fullname = ?, role = ?, company = ?, email = ? ";
			$query .= "WHERE id = ? ";
			
			$params = array($username, $password, $fullname, $role, $company, $email, $id);
		} else {
			$query  = "UPDATE users ";
			$query .= "SET username = ?, fullname = ?, role = ?, company = ?, email = ? ";
			$query .= "WHERE id = ? ";
			
			$params = array($username, $fullname, $role, $company, $email, $id);
		}
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	  }

		return null;
	}
	
	function insertUser($username, $password, $fullname, $role, $company, $email){
		$query  = "INSERT INTO users(username, password, fullname, role, company, email) VALUES(?, ?, ?, ?, ?, ?)";
		
		$params = array($username, $password, $fullname, $role, $company, $email);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function deleteUser($id){
		$query  = "DELETE FROM users ";
		$query .= "WHERE id = ? ";
		
		$params = array($id);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function getPassNow( $id ){
	  $query  = "SELECT password ";
    $query .= "FROM users ";
    $query .= "WHERE id = ? limit 20 ";
    
    $params = array( $id );
    $data = $this->preparedQuery($query, $params);
    
    return $data[0]['password'];
	}
  
	function updatePass($password, $id){
    $query  = "UPDATE users ";
    $query .= "SET password = ? ";
    $query .= "WHERE id = ? ";
    $params = array( $password, $id);
    
    try {
      $this->update($query, $params);
    } catch (Exception $e) {
      return $e->getMessage();
    }
    return null;
	}
  
  
	function retrieveUserBranches($user) {
		$query  = "SELECT c.socialName, b.* ";
		$query .= "FROM companies c, branches b, branchusers bu ";
		$query .= "WHERE bu.user = $user AND b.id = bu.branch AND c.id = b.company AND c.aes = 0 limit 20 ";
		
		$params = array($user);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function retrieveBranchUserIds($branch) {
		$query  = "SELECT bu.user ";
		$query .= "FROM branchusers bu ";
		$query .= "WHERE bu.branch = ? limit 20 ";

		$params = array($branch);
		
		$data = $this->preparedQuery($query, $params);
		$retData = array();
		
		foreach ($data as $datum) {
			$retData[] = $datum["user"];
		}
		
		return $retData;
	}
	
	function retrieveCompanyBranches($company) {
		$query  = "SELECT b.* ";
		$query .= "FROM branches b ";
		$query .= "WHERE b.company = ? ";
		$query .= "ORDER BY b.name limit 20 ";
		
		$params = array($company);
		
		$data = $this->preparedQuery($query, $params);

		return $data;
	}
	
	function dropCompanyUserBranches($id, $company){
		$query  = "DELETE FROM branchusers ";
		$query .= "WHERE user = ? AND company = ? ";
		
		$params = array($id, $company);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function insertUserBranches($id, $company, $branch){
		$query  = "INSERT INTO branchusers(branch, user, company) VALUES(?, ?, ?)";

		$params = array($branch, $id, $company);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
}
