<?php
error_reporting(E_ALL ^ E_NOTICE);
class Controller {
	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_template;
	
	private $Alerts;

	function __construct($model, $controller, $action) {
		$this->_controller = $controller;
		$this->_action = $action;
		$this->_model = $model;
		$this->$model = new $model;
		$this->_template = new Template($controller,$action);
		
		$this->set('action', $this->_action);
		$this->set('controller', $this->_controller);
		
		if(isset($_SESSION['user'])){
			$this->set('alerts', $this->retrieveAlerts($_SESSION['user']['id']));
		}
	}

	function set($name,$value) {
		$this->_template->set($name,$value);
	}

	function __destruct() {
		// Al terminar el controlador, se dispara la vista
		$this->_template->render();
	}
	
	function alertUser($users, $type, $description){
		$this->Alerts = new alerts();

		$alert = $this->Alerts->insertAlert($type, $description);
		
		foreach($users as $user){
			$this->Alerts->insertAlertUser($alert, $user);
		}
	}
	
	function retrieveAlerts($user) {
		$this->Alerts = new alerts();
		
		return $this->Alerts->retrieveAlerts($user);
	}
	
	// Esto probablemente iría mejor en otro lado pero...
	function createPagesArray($totalObjects, $objectsPerPage, $currentPage){
		$pages = Array();
		$pagesBefore = 4;
		$pagesAfter = 4;
		
		$totalPages = ceil($totalObjects / $objectsPerPage);
		
		if($currentPage > 1){
			$links = Array("etiqueta" => "<<&nbsp;Anterior", "pagina" => $currentPage - 1);
			$pages[] = $links;
		}
		
		for($i = 1; $i <= $totalPages; $i++){
			//La página actual por fuerza se incluye, pero no tiene liga, ergo pagina es null
			if ($i == $currentPage){
				$links = Array("etiqueta" => $i, "pagina" => null);
				$pages[] = $links;
			} else {
				// Sólo 4 páginas antes y después de la actual serían navegables
				if ($i < $currentPage && $i >= ($currentPage - $pagesBefore)) {
					$links = Array("etiqueta" => $i, "pagina" => $i);
					$pages[] = $links;
				} else if ($i > $currentPage && $i <= ($currentPage + $pagesAfter)) {
					$links = Array("etiqueta" => $i, "pagina" => $i);
					$pages[] = $links;
				} else if ($i == 1 && $i < ($currentPage - $pagesBefore)) {
					// Este es el caso de la primer página, cuando no es la actual ni está 4 antes de la actual
					$links = Array("etiqueta" => $i, "pagina" => $i);
					$pages[] = $links;
				} else if ($i == $totalPages && $i > ($currentPage + $pagesAfter)) {
					// Este es el caso de la ultima página, cuando no es la actual ni está 4 después de la actual
					$links = Array("etiqueta" => $i, "pagina" => $i);
					$pages[] = $links;
				}
			}
		}
		
		if($totalPages > $currentPage){
			$links = Array("etiqueta" => "Siguiente&nbsp;>>", "pagina" => $currentPage + 1);
			$pages[] = $links;
		}

		return $pages;
	}
}