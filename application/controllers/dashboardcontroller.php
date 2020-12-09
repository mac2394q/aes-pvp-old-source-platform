<?php
require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . 'controller.class.php');
require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'model.class.php');
require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'template.class.php');

class dashboardcontroller extends Controller {
	function main() {
		//session_start();
		if ($_SESSION['user']['role'] == SA || $_SESSION['user']['role'] == ADMIN || $_SESSION['user']['role'] == COORDINADOR) {
		  if($_POST['w'] == ""){ 
			  $this->set('companies', $this->Dashboard->retrieveCompaniesForAdmin());
      } else {
        $this->set('companies', $this->Dashboard->searchCompaniesForAdmin($_POST['w']));
      }
		} else {
		  if($_POST['w'] == ""){ 
			  $this->set('companies', $this->Dashboard->retrieveCompanies($_SESSION['user']['id']));
      } else {
        $this->set('companies', $this->Dashboard->searchCompanies($_SESSION['user']['id'], $_POST['w']));
      }
		}
	}
}
