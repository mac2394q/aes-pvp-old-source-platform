<?php
class audit extends Model {
	function retrieveAuditRequirements($provider, $branch) {
		$query  = "SELECT rd.* ";
		$query .= "FROM requirementsdata rd, auditinstance ai ";
		$query .= "WHERE ai.provider = ? and ai.branch = ? and rd.auditInstance = ai.id AND NOT ISNULL(ai.acceptanceDate) ";
		$query .= "ORDER BY rd.order limit 80 ";
		
		$params = array($provider, $branch);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function retrieveAuditRequirementsByAI($auditInstance) {
		$query  = "SELECT rd.* ";
		$query .= "FROM requirementsdata rd, auditinstance ai ";
		$query .= "WHERE ai.id = ? and rd.auditinstance = ai.id AND NOT ISNULL(ai.acceptanceDate) ";
		$query .= "ORDER BY rd.order limit 80";
		
		$params = array($auditInstance);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function setStatus($id, $status){
		$query  = "UPDATE auditinstance SET status = ? ";
		$query .= "WHERE branch = ?";

		$params = array($status, $id);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }
	}
	
	function setArchive($file, $id, $type) {
		$ext = explode('.', $file['name']);
		$ext = $ext[count($ext)-1];

		$query   = "INSERT INTO archives (rData_id, extension, nombre, type) ";
		$query  .= "VALUES(?, ?, ?, ?) ";

		$params = array($id, $ext, $file['name'], $type);

		$data = $this->insert($query, $params, true);

		return $data . "." . $ext;
	}
	
	function setArchiveAI($file, $id, $type) {
		$ext = explode('.', $file['name']);
		$ext = $ext[count($ext)-1];

		$query   = "INSERT INTO archives (aInstance_id, extension, nombre, type) ";
		$query  .= "VALUES(?, ?, ?, ?) ";

		$params = array($id, $ext, $file['name'], $type);

		$data = $this->insert($query, $params, true);

		return $data . "." . $ext;
	}
	
	function getArchive($id){
		$query  = "SELECT * FROM archives WHERE id = ? limit 40";

		$params = array($id);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data[0];
	}
	
	function deleteArchive($id){
		$query  = "DELETE FROM archives WHERE id = ? ";
		
		$params = array($id);
		
		try {
			return $this->update($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function retrieveAuditRequirementsArchivesByAI($id, $type) {
		$query  = "SELECT a.* ";
		$query .= "FROM archives a ";
		$query .= "WHERE a.aInstance_id = ? and type = ? limit 40";

		$params = array($id, $type);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function retrieveAuditRequirementsArchivesByR($requirement) {
		$query  = "SELECT a.* ";
		$query .= "FROM archives a ";
		$query .= "WHERE a.rData_id = ? and type = '1' limit 80";

		$params = array($requirement);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function retrieveCurrentAudits($provider) {
		$query  = "SELECT c.*, b.id as branch, b.name as branchName, ai.id as auditInstance, DATE_FORMAT(ai.cdate,'%Y-%m-%d') as cdate, ai.audittemplate, s.name as statusName "; 
		$query .= "FROM companies c LEFT OUTER JOIN branches b ON (b.company = c.id) ";
		$query .= "			LEFT OUTER JOIN auditinstance ai ON (ai.provider = b.company AND ai.branch = b.id AND ai.cdate = (SELECT max(cdate) FROM auditinstance WHERE provider = b.company AND branch = b.id)) ";
		$query .= "			LEFT OUTER JOIN status s ON(s.id = ai.status) ";
		$query .= "WHERE c.id = ? limit 80";
			
		$params = array($provider);
			
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}

	function retrieveAuditsAbleToCloseToAdmins() {
		$query  = "SELECT c.*, b.id as branch, b.name as branchName, ai.id as auditInstance, DATE_FORMAT(ai.cdate,'%Y-%m-%d') as cdate, ai.openingDate, ai.closureDate, s.name as statusName "; 
		$query .= "FROM companies c LEFT OUTER JOIN branches b ON (b.company = c.id) ";
		$query .= "LEFT OUTER JOIN auditinstance ai ON (ai.provider = b.company AND ai.branch = b.id AND ai.cdate = (SELECT max(cdate) FROM auditinstance WHERE provider = b.company AND branch = b.id)) ";
		$query .= "LEFT OUTER JOIN status s ON(s.id = ai.status) ";
		$query .= "WHERE NOT isnull(ai.reportedDate) AND isnull(ai.closedDate) limit 80";

		$params = array();
			
		$audits = $this->preparedQuery($query, $params);
		$data = array();
		
		foreach ($audits as $audit) {
			$query = "SELECT count(*) as hm FROM requirementsdata WHERE auditinstance = ?";
			$params = array($audit["id"]);
			
			$howMany = $this->preparedQuery($query, $params);
			
			$audit["howMany"] = $howMany[0]["hm"];
			$data[] = $audit;
		}
		
		return $data;
	}
	
	function retrieveAuditsAbleToCloseToAuditor($id_user) {
		$query  = "SELECT c.*, b.id as branch, b.name as branchName, ai.id as auditInstance, DATE_FORMAT(ai.cdate,'%Y-%m-%d') as cdate, ai.openingDate, ai.closureDate, s.name as statusName "; 
		$query .= "FROM companies c LEFT OUTER JOIN branches b ON (b.company = c.id) ";
		$query .= "LEFT OUTER JOIN branchusers bu ON ( b.id = bu.branch ) ";
		$query .= "LEFT OUTER JOIN auditinstance ai ON (ai.provider = b.company AND ai.branch = b.id AND bu.user = ? AND ai.cdate = (SELECT max(cdate) FROM auditinstance WHERE provider = b.company AND branch = b.id)) ";
		$query .= "LEFT OUTER JOIN status s ON(s.id = ai.status) ";
		$query .= "WHERE NOT isnull(ai.reportedDate) AND isnull(ai.closedDate) limit 80";

		$params = array($id_user);
			
		$audits = $this->preparedQuery($query, $params);
		$data = array();
		
		foreach ($audits as $audit) {
			$query = "SELECT count(*) as hm FROM requirementsdata WHERE auditinstance = ? limit 40";
			$params = array($audit["id"]);
			
			$howMany = $this->preparedQuery($query, $params);
			
			$audit["howMany"] = $howMany[0]["hm"];
			$data[] = $audit;
		}
		
		return $data;
	}
	
	function closeAudit($id){
		$query  = "UPDATE auditinstance SET closedDate = NOW() WHERE id = ? ";

		$params = array($id);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
			return $e->getMessage();
		}

		return null;
	}
		
	function retrieveAuditReport($provider, $branch) {
		$query  = "SELECT rd.* ";
		$query .= "FROM requirementsdata rd, auditinstance ai ";
		$query .= "WHERE ai.provider = ? AND ai.branch = ? AND rd.auditinstance = ai.id AND rd.status in(?, ?, ?) AND NOT ISNULL(ai.acceptanceDate) ";
		$query .= "ORDER BY rd.order limit 80";
		
		$params = array($provider, $branch, ND, NC, OK);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function retrieveAuditReportByAI($auditInstance) {
		$query  = "SELECT rd.* ";
		$query .= "FROM requirementsdata rd, auditinstance ai ";
		$query .= "WHERE ai.id = ? and rd.auditinstance = ai.id AND NOT ISNULL(ai.plannedDate) ";
		$query .= "ORDER BY rd.order limit 80";
		
		$params = array($auditInstance);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function retrieveComplimentaryAudit($provider, $branch) {
		$query  = "SELECT rd.* ";
		$query .= "FROM requirementsdata rd, auditinstance ai ";
		$query .= "WHERE ai.provider = ? AND ai.branch = ? AND rd.auditinstance = ai.id AND (rd.status in(?, ?) OR isCritical = 1) AND NOT ISNULL(ai.acceptanceDate) ";
		$query .= "ORDER BY rd.order limit 80";
		
		$params = array($provider, $branch, ND, NC);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function retrieveComplimentaryAuditByAI($auditInstance) {
		$query  = "SELECT rd.* ";
		$query .= "FROM requirementsdata rd, auditinstance ai ";
		$query .= "WHERE ai.id = ? and rd.auditinstance = ai.id AND (rd.status in(?, ?) OR isCritical = 1) AND NOT ISNULL(ai.reportedDate) ";
		$query .= "ORDER BY rd.order limit 80";
		
		$params = array($auditInstance, ND, NC);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
//aqui puse el alternativo para llenar el plan de acci�n de puros NC
	
	function ncForPlanAction($auditInstance) {
		$query  = "SELECT * ";
		$query .= "FROM requirementsdata rd, statusreportaudit sr ";
		$query .= "WHERE rd.auditInstance = ? ";
		$query .= "AND sr.status = ? ";
		$query .= "AND sr.id_rData = rd.id limit 80";
		
		$params = array($auditInstance, NC);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function insertComplimentary($comment, $id, $autor){
		/****
		$query  = "UPDATE requirementsdata SET observanceComments = '$comment' ";
		$query .= "WHERE requirementsdata.id = $id";
		****/
		$query  = "INSERT INTO plancoments (planComment, id_rData, fecha, user_id) ";
		$query .= "VALUES(?, ?, NOW(), ?)";
		
		$params = array($comment, $id, $autor);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }
	}

	function retrieveAuditInstanceIdByBranch($provider, $branch) {
		$query  = "SELECT ai.id ";
		$query .= "FROM auditinstance ai ";
		$query .= "WHERE ai.provider = ? AND ai.branch = ?  ";
		$query .= "ORDER BY ai.cdate DESC LIMIT 0, 1";

		$params = array($provider, $branch);
		
		$data = $this->preparedQuery($query, $params);
		
		if(count($data) >= 1) {
			return $data[0]["id"];
		} else {
			return 0;
		}
	}
	
	function saveSolutionReq($id_auditinstance, $id_rData){
		$query  = "INSERT INTO okperfilaudit (id_auditinstance, id_rData) ";
		$query .= "VALUES (?, ?)";
		
		$params = array($id_auditinstance, $id_rData);
		
		try {
			$this->insert($query, $params, true);
		} catch (Exception $e) {
			return $e->getMessage();
		}

		return null;
	}
	
	function getSolutionReq($requirement){
		$query  = "SELECT * FROM okperfilaudit ";
		$query .= "WHERE id_rData = ? limit 80";
		
		$params = array($requirement);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function deleteSolutionReq($requirement){
		$query  = "DELETE FROM okperfilaudit WHERE id_rData = ? ";
		
		$params = array($requirement);
		
		try {
			return $this->update($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function getAuditRequirement($requirement) {
		$query  = "SELECT rd.* ";
		$query .= "FROM requirementsdata rd ";
		$query .= "WHERE rd.id = ? limit 80";
		
		$params = array($requirement);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function getBranchByAuditInstance($id){
		$query  = "SELECT b.id, b.name, c.id as company, c.socialName, c.postalAddress, c.city, c.legalRepresentative, c.email, s.id as sector, s.name as sectorName, at.id as auditTemplate ";
		$query .= "FROM auditinstance a, branches b, companies c, sector s LEFT OUTER JOIN audittemplate at ON at.sector = s.id ";
		$query .= "WHERE a.id = ? AND b.id = a.branch AND c.id = b.company AND s.id = c.sector limit 80";

		$params = array($id);
		
		$data = $this->preparedQuery($query, $params);
		
		if(isset($data[0])){
			return $data[0];
		}
	}
	
	function getBranch($id){
		$query  = "SELECT b.id, b.name, c.id as company, c.socialName, s.id as sector, s.name as sectorName, at.id as auditTemplate ";
		$query .= "FROM branches b, companies c, sector s LEFT OUTER JOIN audittemplate at ON at.sector = s.id ";
		$query .= "WHERE b.id = ? AND c.id = b.company AND s.id = c.sector limit 80";
		
		$params = array($id);
		
		$data = $this->preparedQuery($query, $params);
		
		if(isset($data[0])){
			return $data[0];
		}
	}
	
	function getAuditInstance($id) {
		$query  = "SELECT *, DATE_FORMAT(cdate,'%Y-%m-%d') as cdate ";
		$query .= "FROM auditinstance ";
		$query .= "WHERE id = ? limit 80";

		$params = array($id);
		
		$data = $this->preparedQuery($query, $params);
		
		if(isset($data[0])){
			return $data[0];
		}
	}
	
	function getAuditInstanceType($id) {
		$query  = "SELECT at.name ";
		$query .= "FROM audittype at ";
		$query .= "LEFT JOIN auditinstance ai ";
		$query .= "ON at.id = ai.type ";
		$query .= "WHERE ai.id = ? limit 80";

		$params = array($id);
		
		$data = $this->preparedQuery($query, $params);
		
		if(isset($data[0])){
			return $data[0];
		}
	}
	
	function getAuditInstanceIdByActivity($activity) {
		$query  = "SELECT au.id ";
		$query .= "FROM auditinstance au, planactivities pa ";
		$query .= "WHERE pa.id = ? AND au.id = pa.auditinstance limit 80";
		
		$params = array($activity);
		
		$data = $this->preparedQuery($query, $params);
		
		if(isset($data[0]["id"])){
			return $data[0]["id"];
		}
	}
	
	function saveAuditRequirement($requirement) {
		
		if(isset($_POST["status"])){
			$query  = "UPDATE requirementsdata ";
			$query .= "SET status = ?, reviewStatus = ?";
			$query .= "WHERE id = ? ";
		
			$params = array($_POST["status"], $_POST["status"], $requirement);
		
			try {
				$this->update($query, $params);
			} catch (Exception $e) {
				return $e->getMessage();
			}

			return null;
		}
	}
	
	function saveAuditRequirementCommentAud($id) {
		if(isset($_POST["comentarios"]) && !empty($_POST["comentarios"])){
			$query  = "INSERT INTO perfil_comentarios(comentario, rData_id, auditor_id, fecha) ";
			$query .= "VALUES(?, ?, ?, NOW())";
		
			$params = array($_POST['comentarios'], $id, $_SESSION['user']['id']);
		
			try {
				$this->insert($query, $params, true);
			} catch (Exception $e) {
				return $e->getMessage();
			}

			return null;
		}
	}
	
	function saveAuditRequirementCommentPro($id) {
		$query  = "INSERT INTO perfil_comentarios(comentario, rData_id, proveedor_id, fecha) ";
		$query .= "VALUES(?, ?, ?, NOW())";
		
		$params = array($_POST['comentarios'], $id, $_SESSION['user']['id']);
		
		try {
			$this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function saveAuditReportRequirement($requirement, $reportComment, $status, $isCritical, $sol) {
		$query  = "UPDATE requirementsdata ";
		$query .= "SET reportComments = ?, validationStatus = ?, isCritical = ?, sol = ? ";
		$query .= "WHERE id = ? ";
		
		$params = array($reportComment, $status, $isCritical, $sol, $requirement);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }
	    
		return null;
	}
	
	function saveStatusReportAudit($auditInstance, $status, $requirement){
		$query  = "INSERT INTO statusreportaudit (id_auditinstance, status, id_rData) ";
		$query .= "VALUES (?, ?, ?)";
		
		$params = array($auditInstance, $status, $requirement);
		
		try {
			$this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function setStatusReportAudit($status, $requirement){
		$query  = "UPDATE statusreportaudit ";
		$query .= "SET status = ?";
		$query .= "WHERE id_rData = ?";
		
		$params = array($status, $requirement);
		
		try {
			$this->update($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function getStatusReportAudit($requirement){
		$query  = "SELECT id_rData ";
		$query .= "FROM statusreportaudit ";
		$query .= "WHERE id_rData = $requirement"." limit 80";

		$params = array($requirement);
		
		$data = $this->preparedQuery($query, $params);

		return $data;
	}
	
	function saveStatusPlanAudit($auditInstance, $status, $requirement){
		$query  = "INSERT INTO statusplanaudit (id_auditinstance, status, id_rData) ";
		$query .= "VALUES (?, ?, ?)";
		
		$params = array($auditInstance, $status, $requirement);
		
		try {
			$this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function setStatusPlanAudit($status, $requirement){
		$query  = "UPDATE statusplanaudit ";
		$query .= "SET status = ?";
		$query .= "WHERE id_rData = ?";
		
		$params = array($status, $requirement);
		
		try {
			$this->update($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function getStatusPlanAudit($requirement){
		$query  = "SELECT id_rData ";
		$query .= "FROM statusplanaudit ";
		$query .= "WHERE id_rData = $requirement"." limit 80";
		
		$params = array($requirement);
		
		$data = $this->preparedQuery($query, $params);

		return $data;
	}
	
	function saveReportComents($comment, $rdata, $auditInstance){
		if(!empty($comment)){
			$query  = "INSERT INTO reportcoments(reportComment, id_rData, fecha, id_auditInstance) ";
			$query .= "VALUES(?, ?, NOW(), ?)";
		
			$params = array($comment, $rdata, $auditInstance);
		
			try {
				$this->insert($query, $params, true);
			} catch (Exception $e) {
				return $e->getMessage();
			}

			return null;
		}
	}
	
	function closeReport($auditInstance, $positiveConclussions, $improvementConclussions, $recommendations, $obsreport) {
		$query  = "UPDATE auditinstance ";
		$query .= "SET positiveConclussions = ?, improvementConclussions = ?, recommendations = ?, obsreports = ?, reportedDate = CURDATE(), closeReportDate = NOW() ";
		$query .= "WHERE id = ? ";
		
		$params = array($positiveConclussions, $improvementConclussions, $recommendations, $obsreport, $auditInstance);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }
	    
		return null;
	}
	
	function openReport($id){
		$query  = 	"UPDATE auditinstance ";
		$query .=	"SET reportedDate = NULL ";
		$query .=	"WHERE id = ?";
		
		$params = array($id);
		
		try {
			$this->update($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function retrieveAuditRequirementsCommentsAudByR($requirement) {
		$query  = "SELECT pc.*, u.fullname ";
		$query .= "FROM perfil_comentarios pc, users u ";
		$query .= "WHERE pc.rData_id = ? and pc.proveedor_id = '0' and pc.auditor_id = u.id ";
		$query .= "ORDER BY pc.fecha limit 80";
		
		$params = array($requirement);
		
		$data = $this->preparedQuery($query, $params);

		return $data;
	}
	
	function retrieveAuditRequirementsCommentsProByR($requirement) {
		$query  = "SELECT pc.*, u.fullname ";
		$query .= "FROM perfil_comentarios pc, users u ";
		$query .= "WHERE pc.rData_id = ? and pc.auditor_id = '0' and pc.proveedor_id = u.id ";
		$query .= "ORDER BY pc.fecha limit 80";
		
		$params = array($requirement);
		
		$data = $this->preparedQuery($query, $params);

		return $data;
	}
	
	function retrieveAllTemplates() {
		$query  = "SELECT at.id, s.name FROM auditTemplate at, sector s WHERE s.id = at.sector ";
		$query .= "ORDER BY s.name limit 80";
		
		$params = array();
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function retrieveAllAuditors() {
		$query  = "SELECT u.* "; 
		$query .= "FROM users u ";
		$query .= "WHERE u.role = ? limit 80";
			
		$params = array(AUDITOR);
			
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function retrieveAllTypes() {
		$query  = "SELECT at.* "; 
		$query .= "FROM audittype at limit 80";
			
		$params = array();
			
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function insertAuditInstance($provider, $branch, $auditor, $status, $auditTemplate, $scope, $criteria, $type, $openingDate, $closureDate, $grantDate, $renewalDate, $maturityDate, $auditObj){
		$query  = "INSERT INTO auditinstance(provider, branch, auditor, cdate, status, auditTemplate, scope, criteria, type, openingDate, closureDate, grantDate, renewalDate, maturityDate, auditObjectives) VALUES(?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
		$params = array($provider, $branch, $auditor, $status, $auditTemplate, $scope, $criteria, $type, $openingDate, $closureDate, $grantDate, $renewalDate, $maturityDate, $auditObj);
		
		try {
			$auditInstance = $this->insert($query, $params, true);
			
			$query  = "INSERT INTO requirementsdata (auditInstance, name, description, status, number, `order`, isCustom) ";
			$query .= " 	SELECT ai.id, r.name, r.description, 0, r.number, r.order, 0 ";
			$query .= "		FROM auditinstance ai, audittemplate at, requirements r ";
			$query .= "		WHERE r.audittemplate = at.id AND at.id = ai.audittemplate AND ai.id = ? ";
			
			$params = array($auditInstance);
			
			$this->insert($query, $params, false);
			
			return $auditInstance;
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function updateAuditInstance($id, $auditor, $status, $scope, $criteria, $type, $openingDate, $closureDate, $grantDate, $renewalDate, $maturityDate, $auditObj){
		$query  = "UPDATE auditinstance SET auditor = ?, status = ?, scope = ?, criteria = ?, type = ?, openingDate = ?, closureDate = ?, grantDate = ?, renewalDate = ?, maturityDate = ?, auditObjectives = ? WHERE id = ?";
		$params = array($auditor, $status, $scope, $criteria, $type, $openingDate, $closureDate, $grantDate, $renewalDate, $maturityDate, $auditObj, $id);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function retrieveAuditsForAcceptance($auditor) {
		$query  = "SELECT ai.*, c.id as company, c.socialName as companyName, b.id as branch, b.name as branchName, s.name as statusName "; 
		$query .= "FROM auditinstance ai, companies c, branches b, status s  ";
		$query .= "WHERE b.id = ai.branch AND c.id = b.company AND s.id = ai.status AND ai.auditor = ? AND isnull(ai.acceptanceDate) ";
			
		$params = array($auditor);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function acceptAudit($id){
		$query  = "UPDATE auditinstance SET acceptanceDate = CURDATE() WHERE id = ?";
		
		$params = array($id);
		
		try {
			$this->update($query, $params);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function retrieveAuditsForPlan($auditor) {
		$query  = "SELECT ai.*, c.id as company, c.socialName as companyName, b.id as branch, b.name as branchName, s.name as statusName "; 
		$query .= "FROM auditinstance ai, companies c, branches b, status s  ";
		$query .= "WHERE b.id = ai.branch AND c.id = b.company AND s.id = ai.status AND ai.auditor = ? AND NOT isnull(ai.acceptanceDate) ";
			
		$params = array($auditor);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function retrieveAuditsForPlanByPr($auditor) {
		$query  = "SELECT ai . * , c.id AS company, c.socialName AS companyName, b.id AS branch, b.name AS branchName, s.name AS statusName, u.id AS user ";
		$query .= "FROM auditinstance ai, companies c, branches b, status s, users u, branchusers br ";
		$query .= "WHERE u.id = br.user	AND br.branch = b.id AND b.id = ai.branch AND c.id = b.company AND s.id = ai.status	AND u.id = ? AND NOT isnull( ai.acceptanceDate )";

		$params = array($auditor);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;
	}
	
	function retrieveActivities($auditInstance) {
		$query  = "SELECT pa.* FROM planactivities pa WHERE pa.auditinstance = ? ";
		$query .= "ORDER BY pa.auditDate limit 50";
		
		$params = array($auditInstance);
		
		$data = $this->preparedQuery($query, $params);
		
		return $data;		
	}
	
	function setNotas($notas, $auditInstance){
		$query = "UPDATE auditinstance SET notas = ? WHERE id = ?";
		$params = array($notas, $auditInstance);
		
		$this->update($query, $params, true);
		return null;
	}
	
	function insertPlanActivity($id, $auditInstance, $auditor, $auditDate, $description, $audited) {
		$query  = "INSERT INTO planactivities(auditInstance, auditor, auditDate, description, audited) VALUES(?, ?, ?, ?, ?)";
		
		$params = array($auditInstance, $auditor, $auditDate, $description, $audited);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function updatePlanActivity($id, $auditInstance, $auditor, $auditDate, $description, $audited) {
		$query  = "UPDATE planactivities SET auditinstance = ?, auditor = ?, auditDate = ?, description = ?, audited = ? WHERE id = ?";
		
		$params = array($auditInstance, $auditor, $auditDate, $description, $audited, $id);
		
		try {
			return $this->update($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function setPlanReady($auditInstance) {
		$query  = "UPDATE auditinstance SET plannedDate = CURDATE() WHERE id = ?";
		
		$params = array($auditInstance);
		
		try {
			return $this->update($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function deletePlanActivity($id) {
		$query  = "DELETE FROM planactivities WHERE id = ?";
		
		$params = array($id);
		
		try {
			return $this->update($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function retrieveBranchUsers($branch) {
		$query = "SELECT b.name, u.* ";
		$query .= "FROM users u, branches b, branchusers bu ";
		$query .= "WHERE b.id = ? ";
		$query .= "AND b.id = bu.branch ";
		$query .= "AND u.id = bu.user limit 80";
		
		$params = array($branch);
		
		$data = $this->preparedQuery($query, $params);
			
		return $data;
	}
	
	function retrieveAllCoorAdmin(){
		$query = "SELECT u.* ";
		$query .= "FROM users u ";
		$query .= "WHERE u.role = 2 ";
		$query .= "OR u.role = 1 limit 50";
		//$query .= "OR u.role = 0 ";
		
		$params = array();
		
		$data = $this->preparedQuery($query, $params);
			
		return $data;
	}
	
	function retrieveBranchAuditors($branch){
		$query = "SELECT b.name, u.* ";
		$query .= "FROM users u, branches b, branchusers bu ";
		$query .= "WHERE b.id = ? ";
		$query .= "AND b.id = bu.branch ";
		$query .= "AND u.id = bu.user ";
		$query .= "AND u.role = 3 limit 80";
		
		$params = array($branch);
		
		$data = $this->preparedQuery($query, $params);
			
		return $data;
	}
	
	function retrieveBranchExporters($branch){
		$query = "SELECT b.name, u.* ";
		$query .= "FROM users u, branches b, branchusers bu ";
		$query .= "WHERE b.id = ? ";
		$query .= "AND b.id = bu.branch ";
		$query .= "AND u.id = bu.user ";
		$query .= "AND u.role = 4 limit 80";

		$params = array($branch);
		
		$data = $this->preparedQuery($query, $params);
			
		return $data;
	}
	
	function retrieveBranchProveedors($branch){
		$query = "SELECT b.name, u.* ";
		$query .= "FROM users u, branches b, branchusers bu ";
		$query .= "WHERE b.id = ? ";
		$query .= "AND b.id = bu.branch ";
		$query .= "AND u.id = bu.user ";
		$query .= "AND u.role = 5 limit 80";

		$params = array($branch);
		
		$data = $this->preparedQuery($query, $params);
			
		return $data;
	}
	
	function numberNC($id){
		$query  = "SELECT COUNT( * ) AS numbernc ";
		$query .= "FROM `requirementsdata` ";
		$query .= "WHERE status = 1 ";
		$query .= "AND auditInstance = ? limit 80";
		
		$params = array($id);
		
		$data = $this->preparedQuery($query, $params);
			
		if(isset($data[0])){
			return $data[0];
		}
	}
	
	function updateReviewAI($provider, $branch){
		$query  = "UPDATE auditinstance SET reviewDate = NOW() ";
		$query .= "WHERE provider = ? AND branch = ?";
		
		$params = array($provider, $branch);
		
		try {
			return $this->update($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function getAuditor($id){
		$query  = "SELECT * FROM users WHERE id = ? limit 80";
		
		$params = array($id);
		
		$data = $this->preparedQuery($query, $params);
			
		if(isset($data[0])){
			return $data[0];
		}
	}
	
	function closeReportStatus($id){
		$query  = "UPDATE auditinstance SET status = 7 ";
		$query .= "WHERE id = ?";
		
		$params = array($id);
		
		try {
			return $this->update($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function openReportStatus($id){
		$query  = "UPDATE auditinstance SET status = 1 ";
		$query .= "WHERE id = ?";
		
		$params = array($id);
		
		try {
			return $this->update($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function getCertified($id){
    $query = "SELECT certificate FROM companies limit 80";
    $query .= "WHERE id = ? ";
    $params = array($id);
    $data = $this->preparedQuery($query, $params);
    if(isset($data[0])){
      return $data[0];
    }
  }
}
