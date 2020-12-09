<?php
require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . 'controller.class.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'model.class.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'catalog.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'company.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'alerts.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'template.class.php');
require_once(ROOT . DS . 'application' . DS . 'PHPWord.php');

class auditcontroller extends Controller {
	private $Company;
	private $Catalog;
	
	function main($provider) {
		$this->Company = new company();
		
		if(!empty($_POST["branchs"])){
			$branchess = $_POST["branchs"];
			foreach($branchess as $branch => $status){
				if(!empty($status)){
					$this->Audit->setStatus($branch, $status);
					if($status == 4){
						$cambio = "Aprobado";
					}else{
						$cambio = "Reprobado";
					}
					
					$users = $this->set('users', $this->Audit->retrieveBranchUsers($branch));
					$sede = $this->Audit->getBranch($branch);
					$users = $this->Audit->retrieveBranchUsers($branch);
					foreach($users as $user){
						// To send HTML mail, the Content-type header must be set
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
						// Additional headers
						$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
						$br = "<br/>";
						$message  = "El usuario " . $_SESSION["user"]["username"] . " acaba de actualizar el estatus de la Empresa ".$sede["socialName"]." Sede ".$sede["name"]." a : <strong>$cambio</strong>.".$br;
						mail($user["email"], "Notification PVP - AES", $message, $headers);
					}
					$CoorAdmins = $this->Audit->retrieveAllCoorAdmin();
					foreach($CoorAdmins as $ca){
						// To send HTML mail, the Content-type header must be set
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
						// Additional headers
						$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
						$br = "<br/>";
						$message  = "El usuario " . $_SESSION["user"]["username"] . " acaba de actualizar el estatus de la Empresa ".$sede["socialName"]." Sede ".$sede["name"]." a : <strong>$cambio</strong>.".$br;
						mail($ca["email"], "Notification PVP - AES", $message, $headers);
					}
				}
			}
		}
		
		$branches = $this->Audit->retrieveCurrentAudits($provider);
		
		if(isset($_REQUEST["branch"])){
			$branch = $_REQUEST["branch"];
		} else {
			$branch = 0;
		}

		$this->set('branches', $branches);
		$this->set('company', $this->Company->getCompany($provider));
		
		$auditInstance = $this->Audit->retrieveAuditInstanceIdByBranch($provider, $branch);
		
		$this->set('requirements', $this->Audit->retrieveAuditRequirementsByAI($auditInstance));
		if(isset($_POST["branch"])){
			$_SESSION["branch"] = $branch;
		}
		
		if(isset($_GET['r']) && $_GET['r'] == 1 && isset($_GET['b'])){
			$this->set('success', true);
			$this->set('saveMessage',  "Se ha revisado el perfil de seguridad");
			$this->Audit->updateReviewAI($provider, $_GET['b']);
		}
		
		$_SESSION["provider"] = $provider;
		$_SESSION["company"] = $provider;
	}
	
	function upload($requirement) {
		$this->set('archivo', $this->Audit->setArchive($_FILES['uploadedfile'], $requirement, 1));
	}

	function rupload($id) {
		$this->set('archivo', $this->Audit->setArchiveAI($_FILES['uploadedfile'], $id, 2));
	}

	function cupload($id) {
		$this->set('archivo', $this->Audit->setArchiveAI($_FILES['uploadedfile'], $id, 3));
	}
	
	function delupload($id){
		$this->set('archivo', $this->Audit->getArchive($id));
		$this->Audit->deleteArchive($id);
	}

	function report($provider) {
		$this->Company = new company();
		
		if(isset($_REQUEST["branch"])){
			$branch = $_REQUEST["branch"];
		} else {
			$branch = 0;
		}
		
		$auditInstance = $this->Audit->retrieveAuditInstanceIdByBranch($provider, $branch);
		
		if ($auditInstance != 0) {
			$this->set('auditInstance', $this->Audit->getAuditInstance($auditInstance));
		} else {
			$this->set('auditInstance', array("plannedDate" => null, "reportedDate" => null));
		}
		
		$this->set('archives', $this->Audit->retrieveAuditRequirementsArchivesByAI($auditInstance, '2'));
		$this->set('requirementsReport', $this->Audit->retrieveAuditReportByAI($auditInstance));
		$this->set('requirements', $this->Audit->retrieveAuditRequirementsByAI($auditInstance));
		$this->set('company', $this->Company->getCompany($provider));
	}
	
	function savereport($provider) {
		if(isset($_REQUEST["branch"])){
			$branch = $_REQUEST["branch"];
		} else {
			$branch = 0;
		}
		
		@$requirements = $_POST["requirementId"];
		@$reportComments = $_POST["reportComments"];
		@$statuss = $_POST["status"];
		@$isCriticals = $_POST["isCritical"];
		@$sols = $_POST["sol"];
		
		$auditInstance = $this->Audit->retrieveAuditInstanceIdByBranch($provider, $branch);
		
		if(!empty($requirements)){
			foreach($requirements as $requirement) {
				$reportComment = $reportComments[$requirement];
				$status = isset($statuss[$requirement]) ? $statuss[$requirement] : 0;
				$isCritical = isset($isCriticals[$requirement]) ? 1 : 0;
				$sol = isset($sols[$requirement]) ? 1 : 0;
			
				$this->Audit->saveAuditReportRequirement($requirement, $reportComment, $status, $isCritical, $sol);
				$rdata = $this->Audit->getStatusReportAudit($requirement);
				if(!empty($status)){
					if(empty($rdata)){
						$this->Audit->saveStatusReportAudit($auditInstance, $status, $requirement);
					}else{
						$this->Audit->setStatusReportAudit($status, $requirement);
					}
				}
				$this->Audit->saveReportComents($reportComment, $requirement, $auditInstance);
			}
		}
		
		if ($auditInstance != 0) {
			$this->set('auditInstance', $this->Audit->getAuditInstance($auditInstance));
		} else {
			$this->set('auditInstance', array("plannedDate" => null));
		}
		
		$this->set('archives', $this->Audit->retrieveAuditRequirementsArchivesByAI($auditInstance, '2'));
		$this->set('requirementsReport', $this->Audit->retrieveAuditReportByAI($auditInstance));
		$this->set('requirements', $this->Audit->retrieveAuditRequirementsByAI($auditInstance));
	}

	function statusaudit($auditInstance){
		$this->Company = new company();
		$this->Catalog = new catalog();

		$ai = $this->Audit->getAuditInstance($auditInstance);
		$this->set('branch', $this->Audit->getBranch($ai["branch"]));
		$this->set('auditInstance', $ai);
		$this->set('company', $this->Company->getCompanyByBranch($ai["branch"]));
		$this->set('auditType', $this->Audit->getAuditInstanceType($auditInstance));
		$this->set('auditor', $this->Catalog->getUser($ai["auditor"]));
		$this->set('requirementsReport', $this->Audit->retrieveAuditReportByAI($auditInstance));
		$this->set('requirements', $this->Audit->retrieveAuditRequirementsByAI($auditInstance));
		$this->set('activities', $this->Audit->retrieveActivities($auditInstance));
		$this->set('nc', $this->Audit->numberNC($auditInstance));
		$company = $this->Company->getCompanyByBranch($ai["branch"]);
		$this->set('sedes', $this->Company->retrieveBranches($company["id"]));
		$this->set('archives', $this->Audit->retrieveAuditRequirementsArchivesByAI($auditInstance, '2'));	
	}
	
	function word($auditInstance){
		$this->Company = new company();
		$this->Catalog = new catalog();

		$ai = $this->Audit->getAuditInstance($auditInstance);
		$this->set('branch', $this->Audit->getBranch($ai["branch"]));
		$this->set('auditInstance', $ai);
		$this->set('company', $this->Company->getCompanyByBranch($ai["branch"]));
		$this->set('auditType', $this->Audit->getAuditInstanceType($auditInstance));
		$this->set('auditor', $this->Catalog->getUser($ai["auditor"]));
		$this->set('requirementsReport', $this->Audit->retrieveAuditReportByAI($auditInstance));
		$this->set('requirements', $this->Audit->retrieveAuditRequirementsByAI($auditInstance));
		$this->set('activities', $this->Audit->retrieveActivities($auditInstance));
		$this->set('nc', $this->Audit->numberNC($auditInstance));
		$company = $this->Company->getCompanyByBranch($ai["branch"]);
		$this->set('sedes', $this->Company->retrieveBranches($company["id"]));
		$this->set('archives', $this->Audit->retrieveAuditRequirementsArchivesByAI($auditInstance, '2'));
	}


	function wordplan($provider) {
		$this->Company = new company();
		
		if(isset($_REQUEST["branch"])){
			$branch = $_REQUEST["branch"];
		} else {
			$branch = 0;
		}
		
		$auditInstance = $this->Audit->retrieveAuditInstanceIdByBranch($provider, $branch);
		
		if ($auditInstance != 0) {
			$this->set('auditInstance', $this->Audit->getAuditInstance($auditInstance));
		} else {
			$this->set('auditInstance', array("reportedDate" => null));
		}
		
		$this->set('archives', $this->Audit->retrieveAuditRequirementsArchivesByAI($auditInstance, '3'));
		$this->set('complimentaryRequirements', $this->Audit->ncForPlanAction($auditInstance));
		$this->set('requirements', $this->Audit->retrieveAuditRequirementsByAI($auditInstance));
		$this->set('company', $this->Company->getCompany($provider));
	}

	
	function complimentary($provider) {
		$this->Company = new company();
		
		if(isset($_REQUEST["branch"])){
			$branch = $_REQUEST["branch"];
		} else {
			$branch = 0;
		}
		
		$auditInstance = $this->Audit->retrieveAuditInstanceIdByBranch($provider, $branch);
		
		if ($auditInstance != 0) {
			$this->set('auditInstance', $this->Audit->getAuditInstance($auditInstance));
		} else {
			$this->set('auditInstance', array("reportedDate" => null));
		}
		
		$this->set('archives', $this->Audit->retrieveAuditRequirementsArchivesByAI($auditInstance, '3'));
		$this->set('complimentaryRequirements', $this->Audit->ncForPlanAction($auditInstance));
		$this->set('requirements', $this->Audit->retrieveAuditRequirementsByAI($auditInstance));
		$this->set('company', $this->Company->getCompany($provider));
	}

	function savecomplimentary($provider){
		if(isset($_REQUEST["branch"])){
			$branch = $_REQUEST["branch"];
		} else {
			$branch = 0;
		}

		if(isset($_REQUEST["branch"])){
			$users = $this->set('users', $this->Audit->retrieveBranchUsers($_REQUEST["branch"]));
			$sede = $this->Audit->getBranch($_REQUEST["branch"]);
			$users = $this->Audit->retrieveBranchUsers($_REQUEST["branch"]);
			foreach($users as $user){
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
				// Additional headers
				$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
				$br = "<br/>";
				$message  = "Se actualizo el plan de acci&oacute;n en la empresa ".$sede["socialName"]." Sede ".$sede["name"].", para m&aacute;s informaci&oacute;n por favor ingrese al programa de verificaci&oacute;n de proveedores.".$br;
				mail($user["email"], "Notification PVP - AES", $message, $headers);
			}
			$CoorAdmins = $this->Audit->retrieveAllCoorAdmin();
			foreach($CoorAdmins as $ca){
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
				// Additional headers
				$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
				$br = "<br/>";
				$message  = "Se actualizo el plan de acci&oacute;n en la empresa ".$sede["socialName"]." Sede ".$sede["name"].", para m&aacute;s informaci&oacute;n por favor ingrese al programa de verificaci&oacute;n de proveedores.".$br;
				mail($ca["email"], "Notification PVP - AES", $message, $headers); 
			}
		}
		
		if(isset($_POST["contador"])){
			$i = $_POST["contador"];			
			for($a = 1; $a < $i; $a++){
				$id = $_POST["id_requirement_".$a];
				$comment = $_POST["reportComments_".$a];
				if(!empty($comment)){
					$in = $this->Audit->insertComplimentary($comment, $id, $_SESSION["user"]["id"]);
				}
			}
		}
		
		$auditInstance = $this->Audit->retrieveAuditInstanceIdByBranch($provider, $branch);
		
		@$statuss = $_POST["status"];
		@$requirements = $_POST["requirementId"];
		if(!empty($requirements)){
			foreach($requirements as $requirement) {
				$status = isset($statuss[$requirement]) ? $statuss[$requirement] : 0;
				$isCritical = isset($isCriticals[$requirement]) ? 1 : 0;

				$rdata = $this->Audit->getStatusPlanAudit($requirement);
				if(!empty($status)){
					if(empty($rdata)){
						$this->Audit->saveStatusPlanAudit($auditInstance, $status, $requirement);
					}else{
						$this->Audit->setStatusPlanAudit($status, $requirement);
					}
				}
			}
		}
			
		if ($auditInstance != 0) {
			$this->set('auditInstance', $this->Audit->getAuditInstance($auditInstance));
		} else {
			$this->set('auditInstance', array("reportedDate" => null));
		}
		
		$this->set('archives', $this->Audit->retrieveAuditRequirementsArchivesByAI($auditInstance, '3'));
		$this->set('complimentaryRequirements', $this->Audit->ncForPlanAction($auditInstance));
		$this->set('requirements', $this->Audit->retrieveAuditRequirementsByAI($auditInstance));
	}
	
	function edit($requirement) {
		$auditInstance = $this->Audit->retrieveAuditInstanceIdByBranch($_SESSION["provider"], $_SESSION["branch"]);

		$this->set('comentarios_auds', $this->Audit->retrieveAuditRequirementsCommentsAudByR($requirement));
		$this->set('comentarios_pros', $this->Audit->retrieveAuditRequirementsCommentsProByR($requirement));
		$this->set('requirements', $this->Audit->retrieveAuditRequirementsByAI($auditInstance));
		$this->set('id', $requirement);
		$this->set('archives', $this->Audit->retrieveAuditRequirementsArchivesByR($requirement));
		$editedRequirement = $this->Audit->getAuditRequirement($requirement);
		$this->set('editedRequirement', $editedRequirement[0]);
	}
	
	function save($requirement) {
		$message = $this->Audit->saveAuditRequirement($requirement);
		if($_SESSION['user']['role'] == AUDITOR){
			$message = $this->Audit->saveAuditRequirementCommentAud($requirement);
		} elseif($_SESSION['user']['role'] == PROVEEDOR) {
			$message = $this->Audit->saveAuditRequirementCommentPro($requirement);
		}
		
		if($message){
			$this->set('success', false);
			$this->set('saveMessage',  MSG_SAVE_ERROR . $message);
		} else {
			$this->set('success', true);
			$this->set('saveMessage', MSG_SAVE_OK);
		}
		
		$auditInstance = $this->Audit->retrieveAuditInstanceIdByBranch($_SESSION["provider"], $_SESSION["branch"]);
		
		if(isset($_POST['sol']) && !empty($_POST["sol"])){
			$this->Audit->saveSolutionReq($auditInstance, $requirement);
		}
		
		$reg = $this->Audit->getSolutionReq($requirement);
		
		if(!empty($reg) && empty($_POST["sol"])){
			$this->Audit->deleteSolutionReq($requirement);
		}
		
		self::edit($requirement);
	}
	
	function closereportform($auditInstance) {
		$this->set('auditInstance', $this->Audit->getAuditInstance($auditInstance));
	}
	
	function closereport($auditInstance) {
		$positiveConclussions = $_POST["positiveConclussions"];
		$improvementConclussions = $_POST["improvementConclussions"];
		$recommendations = $_POST["recommendations"];
		$obsreport = $_POST["obsreport"];
		
		if(isset($_REQUEST["branch"])){
			$users = $this->set('users', $this->Audit->retrieveBranchUsers($_REQUEST["branch"]));
			$sede = $this->Audit->getBranch($_REQUEST["branch"]);
			$users = $this->Audit->retrieveBranchUsers($_REQUEST["branch"]);
			foreach($users as $user){
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
				// Additional headers
				$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
				$br = "<br/>";
				$message  = "Se acaba de generar el reporte de auditoria para la Empresa ".$sede["socialName"]." Sede ".$sede["name"]." por favor ingrese al Programa de verificaci&oacute;n de proveedores PVP para consultarlo.".$br;
				mail($user["email"], "Notification PVP - AES", $message, $headers);
			}
			$CoorAdmins = $this->Audit->retrieveAllCoorAdmin();
			foreach($CoorAdmins as $ca){
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
				// Additional headers
				$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
				$br = "<br/>";
				$message  = "Se acaba de generar el reporte de auditor&iacute;a para la Empresa ".$sede["socialName"]." Sede ".$sede["name"]." por favor ingrese al Programa de verificaci&oacute;n de proveedores PVP para consultarlo.".$br;
				mail($ca["email"], "Notification PVP - AES", $message, $headers);
			}
		}
		
		$message = $this->Audit->closeReport($auditInstance, $positiveConclussions, $improvementConclussions, $recommendations, $obsreport);
		$this->Audit->closeReportStatus($auditInstance);
		
		if($message){
			$this->set('success', false);
			$this->set('saveMessage',  MSG_SAVE_ERROR . $message);
		} else {
			$this->set('success', true);
			$this->set('saveMessage', MSG_SAVE_OK);
		}
		
		$this->set('auditInstance', $this->Audit->getAuditInstance($auditInstance));
	}
	
	function openreportconfirmation($auditInstance){
		$this->set('auditInstance', $this->Audit->getAuditInstance($auditInstance));
	}
	
	function openreport($auditInstance){
		$this->Audit->openReport($auditInstance);
		$this->Audit->openReportStatus($auditInstance);
	}
	
	function notifyreport($provider){
		if(isset($_REQUEST["branch"])){
			$branch = $_REQUEST["branch"];
		} else {
			$branch = 0;
		}
		
		$auditInstance = $this->Audit->retrieveAuditInstanceIdByBranch($provider, $branch);
		
		if ($auditInstance != 0) {
			$this->set('auditInstance', $this->Audit->getAuditInstance($auditInstance));
		} else {
			$this->set('auditInstance', array("plannedDate" => null, "reportedDate" => null));
		}
		
		if(isset($_GET["n"])){
			$this->set('users', $this->Audit->retrieveBranchAuditors($branch));
			$sede = $this->Audit->getBranch($branch);
			
			$providers = $this->Audit->retrieveBranchProveedors($branch);
			
			foreach($providers as $p){
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
				// Additional headers
				$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
				$br = "<br/>";
				$message  = "El auditor ".$_SESSION["user"]["fullname"]." ha diligenciado en su totalidad el reporte de auditor&iacute;a de la empresa ".$sede["socialName"]." sede ".$sede["name"].$br;
				$message .= "<br/>Se notifica al proveedor para que verifique si tiene No Conformidades y proceda a diligenciar el plan de acci&oacute;n, antes de cerrar el reporte de Auditor&iacute;a.";
				mail($p["email"], "Notification PVP - AES", $message, $headers);
			}
			
			$users = $this->Audit->retrieveBranchAuditors($branch);
			foreach($users as $user){
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
				// Additional headers
				$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
				$br = "<br/>";
				$message  = "El auditor ".$_SESSION["user"]["fullname"]." ha diligenciado en su totalidad el reporte de auditor&iacute;a de la empresa ".$sede["socialName"]." sede ".$sede["name"].$br;
				$message .= "<br/>Se notifica al proveedor para que verifique si tiene No Conformidades y proceda a diligenciar el plan de acci&oacute;n, antes de cerrar el reporte de Auditor&iacute;a.";
				mail($user["email"], "Notification PVP - AES", $message, $headers);
			}
			
			$CoorAdmins = $this->Audit->retrieveAllCoorAdmin();
			foreach($CoorAdmins as $ca){
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
				// Additional headers
				$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
				$br = "<br/>";
				$message  = "El auditor ".$_SESSION["user"]["fullname"]." ha diligenciado en su totalidad el reporte de auditor&iacute;a de la empresa ".$sede["socialName"]." sede ".$sede["name"].$br;
				$message .= "<br/>Se notifica al proveedor para que verifique si tiene No Conformidades y proceda a diligenciar el plan de acci&oacute;n, antes de cerrar el reporte de Auditor&iacute;a.";
				mail($ca["email"], "Notification PVP - AES", $message, $headers);
			}
		}
		
		$this->set('archives', $this->Audit->retrieveAuditRequirementsArchivesByAI($auditInstance, '2'));
		$this->set('requirementsReport', $this->Audit->retrieveAuditReportByAI($auditInstance));
		$this->set('requirements', $this->Audit->retrieveAuditRequirementsByAI($auditInstance));
	}
	
	function listall($discard = 0) {
		$this->Catalog = new catalog();
		$this->Company = new company();
		
		$provider = isset($_REQUEST["filter"]) ? $_REQUEST["filter"]: 0; 
		
		$this->set('providers', $this->Catalog->retrieveAllCompanies());
		$this->set('audits', $this->Audit->retrieveCurrentAudits($provider));
		$this->set('provider', $provider);
	}
	
	function close($id = 0) {
		$this->Catalog = new catalog();
		
		if($_SESSION["user"]["role"] == SA || $_SESSION["user"]["role"] == ADMIN || $_SESSION["user"]["role"] == COORDINADOR ){
			$this->set('audits', $this->Audit->retrieveAuditsAbleToCloseToAdmins());
		}else{
			$this->set('audits', $this->Audit->retrieveAuditsAbleToCloseToAuditor($_SESSION["user"]["id"]));
		}

		if($id != 0) {
			$message = $this->Audit->closeAudit($id);
			
			$aviso = $this->Catalog->getCompanyAndBranchByAudit($id);
			
			if($message){
				$this->set('success', false);
				$this->set('saveMessage',  MSG_SAVE_ERROR . $message);
			} else {
				$this->set('success', true);
				$this->set('saveMessage', MSG_SAVE_OK);
				
				$auditInstance = $this->Audit->getAuditInstance($id);
				
				$branchUsers = $this->Catalog->retrieveBranchUserIds($auditInstance['branch']);
				$this->alertUser($branchUsers, 1, "Su auditor&iacute;a ha sido cerrada por el auditor a cargo.");
				
				$users = $this->set('users', $this->Audit->retrieveBranchUsers($auditInstance['branch']));
				
				$users = $this->Audit->retrieveBranchUsers($auditInstance['branch']);
				foreach($users as $user){
					// To send HTML mail, the Content-type header must be set
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
					// Additional headers
					$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
					$br = "<br/>";
					$message  = "La auditoria de la empresa ".$aviso["socialName"]." con sede ".$aviso["branchName"]." ha sido cerrada, hemos notificado al responsable Exportador para que cambie el estatus del proveedor.".$br;
					mail($user["email"], "Notification PVP - AES", $message, $headers);
				}
				$CoorAdmins = $this->Audit->retrieveAllCoorAdmin();
				foreach($CoorAdmins as $ca){
					// To send HTML mail, the Content-type header must be set
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
					// Additional headers
					$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
					$br = "<br/>";
					$message  = "La auditor&iacute;a de la empresa ".$aviso["socialName"]." con sede ".$aviso["branchName"]." ha sido cerrada, hemos notificado al responsable Exportador para que cambie el estatus del proveedor.".$br;
					mail($ca["email"], "Notification PVP - AES", $message, $headers);
				}
			}
		}
	}
	
	function editinstance($id){
		$this->Catalog = new catalog();
		
		$this->set('branch', $this->Audit->getBranchByAuditInstance($id));
		$this->set('auditInstance', $this->Audit->getAuditInstance($id));
		$this->set('auditors', $this->Audit->retrieveAllAuditors());
		$this->set('statuss', $this->Catalog->retrieveAllStatuss());
		$this->set('types', $this->Audit->retrieveAllTypes());
	}
	
	function createinstance($branch){
		$this->Catalog = new catalog();
		
		$auditInstance = array("id" => 0, "provider" => 0, "auditTemplate" => 0, "cdate" => date("d/m/Y"), "status" => 0, "branch" => 0, "auditor" => 0, "scope" => "", "criteria" => "", "openingDate" => "", "closureDate" => "", "openingTime" => "00:00", "closureTime" => "00:00", "type" => 0, "grantDate" => "", "renewalDate" => "", "maturityDate" => "", "auditObjectives" => "");
		
		$branchData = $this->Audit->getBranch($branch);
		
		if($branchData['auditTemplate'] == null) {
			$this->set('success', false);
			$this->set('saveMessage', 'No existe una plantilla definida para el sector de esta empresa, no se puede iniciar una auditor&iacute;a.');
		}
		
		$this->set('branch', $branchData);
		$this->set('auditInstance', $auditInstance);
		$this->set('auditors', $this->Audit->retrieveAllAuditors());
		$this->set('statuss', $this->Catalog->retrieveAllStatuss());
		$this->set('types', $this->Audit->retrieveAllTypes());
	}
	
	function saveinstance($id){
		@$this->Catalog = new catalog();
		@$provider = $_POST['provider'];
		@$branch = $_POST['branch'];
		@$auditTemplate = $_POST['auditTemplate'];
		@$auditor = $_POST['auditor'];
		@$status = $_POST['status'];
		@$scope = $_POST['scope'];
		@$criteria = $_POST['criteria'];
		@$type = $_POST['type'];
		@$openingDate = $_POST['openingDate'];
		@$closureDate = $_POST['closureDate'];
		@$grantDate = $_POST['grantDate'];
		@$renewalDate = $_POST['renewalDate'];
		@$maturityDate = $_POST['maturityDate'];
		@$auditObj = $_POST['auditObjectives'];
		
		if($id == 0) {
			$id = $this->Audit->insertAuditInstance($provider, $branch, $auditor, $status, $auditTemplate, $scope, $criteria, $type, $openingDate, $closureDate, $grantDate, $renewalDate, $maturityDate, $auditObj);
      $this->accept($id);
		} else {
			if(!empty($auditor) && !empty($type) && !empty($status)){
				$this->Audit->updateAuditInstance($id, $auditor, $status, $scope, $criteria, $type, $openingDate, $closureDate, $grantDate, $renewalDate, $maturityDate, $auditObj);
			}
		}
		
		$auditor_data = $this->Audit->getAuditor($auditor);
		
		if(isset($_POST["branch"])){
			$users = $this->set('users', $this->Audit->retrieveBranchAuditors($_POST["branch"]));
			$users = $this->Audit->retrieveBranchAuditors($_POST["branch"]);
			foreach($users as $user){
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
				// Additional headers
				$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
				$br = "<br/>";
				$message  = "Se le envia esta notificaci&oacute;n automática por que se ha programado una auditor&iacute;a en el Portal de Verificaci&oacute;n de Proveedores de AES con los siguientes detalles.".$br;
				$message .= "Empresa: " . $_POST["empresa"] . $br . "Sede: " . $_POST["sede"] . $br . "Alcance: " . $scope . $br . "Criterios: " . $criteria . $br . "Fecha de Inicio: " . $openingDate . $br . "Fecha de cierre: " . $closureDate . $br . "Auditor: " . $auditor_data["fullname"];
				mail($user["email"], "Notification PVP - AES", $message, $headers);
			}
			$CoorAdmins = $this->Audit->retrieveAllCoorAdmin();
			foreach($CoorAdmins as $ca){
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
				// Additional headers
				$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n"; 
				$br = "<br/>";
				$message  = "Se le envia esta notificaci&oacute;n autom&aacute;tica por que se ha programado una auditor&iacute;a en el Portal de Verificaci&oacute;n de Proveedores de AES con los siguientes detalles.".$br;
				$message .= "Empresa: " . $_POST["empresa"] . $br . "Sede: " . $_POST["sede"] . $br . "Alcance: " . $scope . $br . "Criterios: " . $criteria . $br . "Fecha de Inicio: " . $openingDate . $br . "Fecha de cierre: " . $closureDate . $br . "Auditor: " . $auditor_data["fullname"];
				mail($ca["email"], "Notification PVP - AES", $message, $headers);
				//echo "<div>=> enviado correo Coordinador => ".$ca["email"]."<br/></div>";
			}
		}require_once(ROOT . DS . 'config' . DS . 'config.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
$bd = mysql_select_db(DB_NAME) or die ("Verifique la Base de Datos");
		
		$this->set('branch', $this->Audit->getBranchByAuditInstance($id));
		$this->set('auditInstance', $this->Audit->getAuditInstance($id));
		$this->set('auditors', $this->Audit->retrieveAllAuditors());
		$this->set('statuss', $this->Catalog->retrieveAllStatuss());
		$this->set('types', $this->Audit->retrieveAllTypes());
	}
	
	function accept($id = 0) {
		$this->Catalog = new catalog();
		if($id != 0) {
			$message = $this->Audit->acceptAudit($id);
		
			if($message){
				$this->set('success', false);
				$this->set('saveMessage',  MSG_SAVE_ERROR . $message);
			} else {
				$this->set('success', true);
				$this->set('saveMessage', MSG_SAVE_OK);
				
				$auditInstance = $this->Audit->getAuditInstance($id);
				
				$branchUsers = $this->Catalog->retrieveBranchUserIds($auditInstance['branch']);
				$this->alertUser($branchUsers, 1, "Una auditoria ha sido programada para dar inicio en la sede que representa.");
				$empresa = $this->Audit->getBranchByAuditInstance($id);
				
				$auditor_data = $this->Audit->getAuditor($auditor);
				
				$users = $this->Audit->retrieveBranchAuditors($auditInstance['branch']);
				foreach($users as $user){
					// To send HTML mail, the Content-type header must be set
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
					// Additional headers
					$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
					$br = "<br/>";
					$message  = "El auditor " . $auditor_data["fullname"] . " acepto realizar la auditoria en la Empresa " . $empresa["socialName"] . " Sede " . $empresa["name"] . " ya se ha notificado al auditor, proveedor y exportador asignados a esta auditor&iacute;a.";
					mail($user["email"], "Notification PVP - AES", $message, $headers);
				}
				
				$provs = $this->Audit->retrieveBranchProveedors($auditInstance['branch']);
				foreach($provs as $ca){
					// To send HTML mail, the Content-type header must be set
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
					// Additional headers
					$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
					$br = "<br/>";
					$message  = "El auditor " . $auditor_data["fullname"] . " acepto realizar la auditoria en la Empresa " . $empresa["socialName"] . " Sede " . $empresa["name"] . $br;
					$message .= "Por favor ingrese al Programa de Verificacion de Proveedores y de esta forma iniciar el proceso de auditoria y entrar a verificar el perfil de seguridad.".$br;
					$message .= "Le recomendamos consultar el manual de manejo del PVP que encontrara al acceder a la aplicacion con su usuario y clave.".$br;
					$message .= "http://aes.org.co/pvp".$br;
					$message .= "En caso de requerir informacion adicional, favor comunicarse a:".$br;
					$message .= "pvp@aes.org.co".$br;
					$message .= "alozano@aes.org.co".$br;
					$message .= "ASOCIACION DE EMPRESAS SEGURAS".$br;
					$message .= "PH: +57 2 489 91 91".$br;
					$message .= "PH: USA (786) 4698309".$br;
					$message .= date ( "D M j Y" );
					mail($ca["email"], "Notification PVP - AES", $message, $headers);
				}
				
				$exporter = $this->Audit->retrieveBranchExporters($auditInstance['branch']);
				foreach($exporter as $ex){
					// To send HTML mail, the Content-type header must be set
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
					// Additional headers
					$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
					$br = "<br/>";
					$message  = "El auditor " . $auditor_data["fullname"] . " acepto realizar la auditoria en la Empresa " . $empresa["socialName"] . " Sede " . $empresa["name"].$br;
					$message .= "En caso de requerir informacion adicional, favor comunicarse con:".$br;
					$message .= "pvp@aes.org.co".$br;
					$message .= "alozano@aes.org.co".$br;
					$message .= "ASOCIACION DE EMPRESAS SEGURAS".$br;
					$message .= "PH: +57 2 489 91 91".$br;
					$message .= "PH: USA (786) 4698309".$br;
					$message .= date ( "D M j Y" );
					mail($ex["email"], "Notification PVP - AES", $message, $headers);				
				}
				
				$CoorAdmins = $this->Audit->retrieveAllCoorAdmin();
				foreach($CoorAdmins as $ca){
					// To send HTML mail, the Content-type header must be set
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
					// Additional headers
					$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
					$br = "<br/>";
					$message  = "El auditor " . $auditor_data["fullname"] . " acepto realizar la auditor&iacute;a en la Empresa " . $empresa["socialName"] . " Sede " . $empresa["name"] . " ya se ha notificado al auditor, proveedor y exportador asignados a esta auditor&iacute;a.";
					mail($ca["email"], "Notification PVP - AES", $message, $headers);
				}
			}
		}
		
		$this->set('audits', $this->Audit->retrieveAuditsForAcceptance($_SESSION['user']['id']));
	}
	
	function plans() {
		if($_SESSION['user']['role'] == AUDITOR){
			$this->set('audits', $this->Audit->retrieveAuditsForPlan($_SESSION['user']['id']));
		}else if($_SESSION['user']['role'] == PROVEEDOR){
			$this->set('audits', $this->Audit->retrieveAuditsForPlanByPr($_SESSION['user']['id']));
		}
	}
	
	function editplan($id) {
		$this->Catalog = new catalog();
		
		$this->set('branch', $this->Audit->getBranchByAuditInstance($id));
		$this->set('auditInstance', $this->Audit->getAuditInstance($id));
		$this->set('auditors', $this->Audit->retrieveAllAuditors());
		$this->set('statuss', $this->Catalog->retrieveAllStatuss());
		$this->set('types', $this->Audit->retrieveAllTypes());
		
		$this->set('activities', $this->Audit->retrieveActivities($id));
	}
	
	function saveplan($auditInstance) {
		$this->Catalog = new catalog();
				
		$ids = $_POST['id'];
		$auditors = $_POST['auditor'];
		$auditDates = $_POST['auditDate'];
		$descriptions = $_POST['description'];
		$auditeds = isset($_POST['audited']) ? $_POST['audited']: array();
		$notas = $_POST["notas"];
		
		if(is_array($ids)){
			foreach ($ids as $id) {
				if($id == 0) {
					if(trim($descriptions[$id]) != "") {
						$this->Audit->insertPlanActivity($id, $auditInstance, $auditors[$id], $auditDates[$id], $descriptions[$id], isset($auditeds[$id]) ? $auditeds[$id]: false);
					}
				} else {
					$this->Audit->updatePlanActivity($id, $auditInstance, $auditors[$id], $auditDates[$id], $descriptions[$id], isset($auditeds[$id]) ? $auditeds[$id]: false);
				}
			}
			$this->Audit->setNotas($notas, $auditInstance);
		}else{
			echo "not an array";
		}
		
		$this->set('branch', $this->Audit->getBranchByAuditInstance($auditInstance));
		$this->set('auditInstance', $this->Audit->getAuditInstance($auditInstance));
		$this->set('auditors', $this->Audit->retrieveAllAuditors());
		$this->set('statuss', $this->Catalog->retrieveAllStatuss());
		$this->set('types', $this->Audit->retrieveAllTypes());
		
		$this->set('activities', $this->Audit->retrieveActivities($auditInstance));
	}
	
	function planready($auditInstance) {
		$this->Catalog = new catalog();
		
		$message = $this->Audit->setPlanReady($auditInstance);
		
		if($message){
				$this->set('success', false);
				$this->set('saveMessage',  MSG_SAVE_ERROR . $message);
		} else {
				$this->set('success', true);
				$this->set('saveMessage', MSG_PLAN_READY);
		}
		
		if(isset($_GET["branch"])){
			$users = $this->set('users', $this->Audit->retrieveBranchUsers($_GET["branch"]));
			$users = $this->Audit->retrieveBranchUsers($_GET["branch"]);
			foreach($users as $user){ 
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
				// Additional headers
				$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
				$br = "<br/>";
				$message  = "Se acaba de realizar el plan de auditor&iacute;a para la empresa ".$_GET['e']." sede ".$_GET['s'].$br;
				mail($user["email"], "Notification PVP - AES", $message, $headers);
			}
			$CoorAdmins = $this->Audit->retrieveAllCoorAdmin();
			foreach($CoorAdmins as $ca){
				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";
				// Additional headers
				$headers .= 'From: PVP - AES <pvp@aes.org.co>' . "\r\n";
				$br = "<br/>";
				$message  = "Se acaba de realizar el plan de auditor&iacute;a para la empresa ".$_GET['e']." sede ".$_GET['s'].$br;
				mail($ca["email"], "Notification PVP - AES", $message, $headers);
			}
		}
		
		$this->set('branch', $this->Audit->getBranchByAuditInstance($auditInstance));
		$this->set('auditInstance', $this->Audit->getAuditInstance($auditInstance));
		$this->set('auditors', $this->Audit->retrieveAllAuditors());
		$this->set('statuss', $this->Catalog->retrieveAllStatuss());
		$this->set('types', $this->Audit->retrieveAllTypes());
		$this->set('activities', $this->Audit->retrieveActivities($auditInstance));
	}
	
	function deleteactivity($id) {
		$this->Catalog = new catalog();
		
		$auditInstance = $this->Audit->getAuditInstanceIdByActivity($id);
		
		$this->Audit->deletePlanActivity($id);

		$this->set('branch', $this->Audit->getBranchByAuditInstance($auditInstance));
		$this->set('auditInstance', $this->Audit->getAuditInstance($auditInstance));
		$this->set('auditors', $this->Audit->retrieveAllAuditors());
		$this->set('statuss', $this->Catalog->retrieveAllStatuss());
		$this->set('types', $this->Audit->retrieveAllTypes());
		$this->set('activities', $this->Audit->retrieveActivities($auditInstance));
	}
  
  function viewcertified($company){
  	$this->set('certified', $this->Audit->getCertified($company) );
		$this->set('filecert',"certificado.pdf" );
  }
}
