<?php
class alerts extends Model {	
	function retrieveAlerts($user) {
		$query = "SELECT a.*, at.name  FROM alerts a, alerttypes at, alertedusers au WHERE au.user = ? AND a.id = au.alert AND at.id = a.type ";
		$params = array($user);
		
		$data = $this->preparedQuery($query, $params);

		return $data;
	}
	
	function insertAlert($type, $description){
		$query  = "INSERT INTO alerts(type, description, generated) VALUES(?, ?, CURDATE())";
		
		$params = array($type, $description);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
	
	function insertAlertUser($alert, $user){
		$query  = "INSERT INTO alertedusers(alert, user, removed) VALUES(?, ?, false)";
		
		$params = array($alert, $user);
		
		try {
			return $this->insert($query, $params, true);
		} catch (Exception $e) {
	    	return $e->getMessage();
	    }

		return null;
	}
}
