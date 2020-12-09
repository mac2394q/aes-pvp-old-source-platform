<?php
	require_once(ROOT . DS . 'application' . DS . 'models' . DS . 'BaseDAO.php');

	class Model extends BaseDAO {
		protected $_model;
	
		function __construct() {	
//			$this->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$this->_model = get_class($this);
			$this->_table = strtolower($this->_model)."s";
			
			parent::__construct();
		}
	
		function __destruct() {
		}
	}