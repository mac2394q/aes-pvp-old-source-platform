<?php
class dashboard extends Model {
	function retrieveCompanies($userId) {
		$query  = "SELECT DISTINCT c.id, c.socialName, c.commercialName, c.sector, c.code, s.name as sectorName, c.status, st.name as statusName, c.certificate ";
		$query .= "FROM companies c, branches b, branchusers bu, sector s, status st ";
		$query .= "WHERE bu.user = ? AND b.id = bu.branch AND c.id = b.company AND s.id = c.sector AND st.id = c.status AND c.aes = 0 ";

		$params = array($userId);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
  
  
  function searchCompanies($userId, $word) {
    $query  = "SELECT DISTINCT c.id, c.socialName, c.commercialName, c.sector, c.code, s.name as sectorName, c.status, st.name as statusName, c.certificate ";
    $query .= "FROM companies c, branches b, branchusers bu, sector s, status st ";
    $query .= "WHERE bu.user = ? AND b.id = bu.branch AND c.id = b.company AND s.id = c.sector AND st.id = c.status AND c.aes = 0 AND c.socialName LIKE '%?%'";

    $params = array($userId, $word);
    
    $data = $this->preparedQuery($query, $params);
    
    return $data;
  }
	
	function retrieveCompaniesForAdmin() {
		$query  = "SELECT DISTINCT c.id, c.socialName, c.commercialName, c.sector, c.code, s.name as sectorName, c.status, st.name as statusName, c.certificate ";
		$query .= "FROM companies c, sector s, status st ";
		$query .= "WHERE s.id = c.sector AND st.id = c.status AND c.aes = 0 limit 20";

		$params = array();
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
  
   function searchCompaniesForAdmin($word) {
    $query  = "SELECT DISTINCT c.id, c.socialName, c.commercialName, c.sector, c.code, s.name as sectorName, c.status, st.name as statusName, c.certificate ";
    $query .= "FROM companies c, sector s, status st ";
    $query .= "WHERE s.id = c.sector AND st.id = c.status AND c.aes = 0 AND c.socialName LIKE '%{$word}%' limit 20";

    $params = array();
    
    $data = $this->preparedQuery($query, $params);
    
    return $data;
  }
}
