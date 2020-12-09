<?php
require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . 'controller.class.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'model.class.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'catalog.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'alerts.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'template.class.php');

class templatescontroller extends Controller {
	private $Sector;
	private $Catalog;
	
	function main() {
		$this->set('templates', $this->Templates->retrieveAllTemplates());
	}
	
	function edit($id) {
		$this->Catalog = new catalog();
		
		$this->set('template', $this->Templates->getTemplate($id));
		$this->set('sector', $this->Catalog->getSector($id));
	}
	
	function clonar_save() {
		$this->Catalog = new catalog();
		
		if(isset($_POST['titulo'])){
			$titulo = $_POST['titulo'];

			$sid = $this->Templates->insertSector($titulo);
			$aid = $this->Templates->insertAuditTemplate($sid);

			$ids = $_POST['id'];
			$numbers = $_POST['number'];
			$names = $_POST['name'];
			$descriptions = $_POST['description'];
			$orders = $_POST['order'];
			
			$lastOrder = 0;
			if(is_array($ids)){
				foreach ($ids as $id) {
					$lastOrder++;
					$this->Templates->insertAuditRequirement($aid, $numbers[$id], $names[$id], $descriptions[$id], $lastOrder);
				}
			} else{
				echo "not an array";
			}
		}
		
		$this->set('templates', $this->Templates->retrieveAllTemplates());
	}
	
	function clonar() {
		$this->Catalog = new catalog();
		
		foreach($_POST['clonar'] as $key => $value){
			$_templates[] = $this->Templates->getTemplate($key);
		}
		
		foreach($_templates as $key => $value){
			foreach($value as $_key => $_value){
				$templates[] = $_value;
			}
		}
		
		$this->set('template', $templates);
	}
	
	function add($id) {
		$this->Catalog = new catalog();
		
		$this->Templates->insertAuditTemplate($id);
		$this->set('template', $this->Templates->getTemplate($id));
		$this->set('sector', $this->Catalog->getSector($id));
	}
	
	function save($sector) {
		$this->Catalog = new catalog();
		
		$ids = $_POST['id'];
		$numbers = $_POST['number'];
		$names = $_POST['name'];
		$descriptions = $_POST['description'];
		$orders = $_POST['order'];
		
		$aid = $this->Templates->getAuditTemplate($sector);
		$this->Templates->deleteAuditRequirements($aid);

		$lastOrder = 0;
		if(is_array($ids)){
			foreach ($ids as $id) {
				if(trim($numbers[$id]) != "") {
					$lastOrder++;
					$this->Templates->insertAuditRequirement($aid, $numbers[$id], $names[$id], $descriptions[$id], $lastOrder);
				}
			}
		} else{
			echo "not an array";
		}
		
		$this->set('template', $this->Templates->getTemplate($sector));
		$this->set('sector', $this->Catalog->getSector($sector));
	}
	
	function deletetemplate($id) {
		$this->Templates->deleteSector($id);
		$aid = $this->Templates->getAuditTemplate($id);
		if($aid){
			$this->Templates->deleteAudit($id);
		}
		$this->set('templates', $this->Templates->retrieveAllTemplates());
	}
}