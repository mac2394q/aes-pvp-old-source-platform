<?php
class PDOConnectionFactory{
	// receives the connection
	public $con = null;
	// swich database?
	private $dbType 	= "mysql";
	
	// arrow the persistence of the connection
	private $persistent = false;
	
	public function PDOConnectionFactory( $persistent=false ){
		if( $persistent != false){ $this->persistent = true; }
	}
	
	public function getConnection($connectUrl, $username, $password){
		try{
			// it carries through the connection
			$this->con = new PDO($connectUrl, $username, $password, array( PDO::ATTR_PERSISTENT => $this->persistent ) );

			return $this->con;
		}
		catch ( PDOException $ex ){ 
			throw new Exception('Failed to create connection: ' . $ex->getMessage());
		}
	}
	
	// close connection
	public function Close(){
		if( $this->con != null )
			$this->con = null;
	}
}
?>