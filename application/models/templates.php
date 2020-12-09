<?php
class templates extends Model {
	function retrieveAllTemplates() {
		$query  = "SELECT s.id, s.name, at.id as audittemplate FROM sector s LEFT OUTER JOIN audittemplate at ON at.sector = s.id ";
		$query .= "ORDER BY s.name ";
		
		$params = array();
		
		$data = $this->preparedQuery($query, $params);
		$returnables = array();

		foreach($data as $datum){
			if($datum['audittemplate'] != null) {
				$query2  = "SELECT count(*) as requirementsQty FROM requirements WHERE auditTemplate = ?";
				$params2 = array($datum['audittemplate']);
				
				$data2 = $this->preparedQuery($query2, $params2);	

				if(count($data2) > 0) {
					$datum['requirementsQty'] = $data2[0]['requirementsQty'];
				} else {
					$datum['requirementsQty'] = 0;
				}
			} else {
				$datum['requirementsQty'] = 0;
			}
			
			$returnables[] = $datum;
		}
		
		return $returnables;
	}
	
	function getTemplate($id) {
		$query  = "SELECT r.* "; 
		$query .= "FROM audittemplate at, requirements r "; 
		$query .= "WHERE at.sector = ? AND r.audittemplate = at.id  ";
		$query .= "ORDER BY r.id ASC  ";
		
		$params = array($id);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function getAuditTemplate($sector) {
		$query  = "SELECT at.id "; 
		$query .= "FROM audittemplate at "; 
		$query .= "WHERE at.sector = ? ";

		$params = array($sector);
		
		$data = $this->preparedQuery($query, $params);
		
		if(isset($data[0]['id'])){
			return $data[0]['id'];
		}
	}
	
	function getLastRequirementOrder($auditTemplate) {
		$query  = "SELECT MAX(`order`) as maxorder "; 
		$query .= "FROM requirements "; 
		$query .= "WHERE audittemplate = ? ";
		
		$params = array($auditTemplate);
		
		$data = $this->preparedQuery($query, $params);
		
		if (count($data) > 0) {
			return $data[0]['maxorder'];
		} else {
			return 0;
		}
	}
	
	function insertSector($name) {
		$query  = "INSERT INTO sector(name) VALUES(?)";
		
		$params = array($name);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function insertAuditTemplate($sector) {
		$query  = "INSERT INTO audittemplate(sector) VALUES(?)";
		
		$params = array($sector);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function insertAuditRequirement($auditTemplate, $number, $name, $description, $order) {
		$query  = "INSERT INTO requirements(audittemplate, number, name, description, `order`) VALUES(?, ?, ?, ?, ?)";
		
		$params = array($auditTemplate, $number, $name, $description, $order);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function updateAuditRequirement($id, $number, $name, $description, $order) {
		$query  = "UPDATE requirements SET number = ?, name = ?, description = ?, `order` = ? WHERE id = ?";
		
		$params = array($number, $name, $description, $order, $id);
		
		try {
			return $this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function deleteSector($id) {
		$query  = "DELETE FROM sector WHERE id = ?";
		$params = array($id);
		
		try {
			return $this->delete($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function deleteAudit($id) {
		$query  = "DELETE FROM audittemplate WHERE sector = ?";
		$params = array($id);
		
		try {
			return $this->delete($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function deleteAuditRequirements($id) {
		$query  = "DELETE FROM requirements WHERE audittemplate = ?";
		$params = array($id);
		
		try {
			return $this->delete($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
}
