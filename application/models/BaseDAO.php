<?php
 ini_set('memory_limit', '1024M'); 
/**
 * Class BaseDAO. Base data access object class. All DAOs in system should inherit from it.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: Music and Images is by this mean authorized to copy and redistribute this code, keeping
 * acknowledgement for Avide IT Solutions of the original version development.
 * All copyrights are property of Music and Images.
 *
 * @category	Abstract
 * @package		DAO
 * @author		Josue Dorantes <josue.dorantes@avideit.com>
 * @copyright	2008 Music and Images
 * @license		http://www.avideit.com/mi/license/1_0.txt  Avide IT License 1.0
 * @version		SVN: $Id:$
 * @link       
 * @see        
 * @since		File available since Release 0.0.01
 */

require_once('PDOConnectionFactory.php');

class BaseDAO
{
    // {{{ properties    
    private $_pdo = null;
	private $_rs = null;
    // }}}

    function __construct()
    {
        $connectUrl = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=latin1";
        $username = DB_USER;
        $password = DB_PASSWORD;
		
		$this->connect($connectUrl, $username, $password);
    }
    
    ////////////////////////
    // Connection related
    ////////////////////////  
    function connect($connectUrl, $username, $password)
    {
    	if($this->_pdo == null) {
			$connectionFactory = new PDOConnectionFactory();
	
			try {
				$this->_pdo = $connectionFactory->getConnection($connectUrl, $username, $password);
		    }
			catch(Exception $e)
		    {
				echo "Failed to create connection: " . $e->getMessage();
				throw new Exception('Failed to create connection: ' . $e->getMessage());
		    }
    	}
    }
	
    function exec($sql) {
        if($this->_pdo != null) {
        	try {
				$statement = $this->_pdo->query($sql);
				$arr = $statement->fetchALL(PDO::FETCH_ASSOC);
				
				return $arr;
        	} catch(Exception $e){
        		echo $e->getMessage() . '<br>';
				throw new Exception('Failed to issue query: ' . $e->getMessage());
			}
        } else {
			throw new Exception('No connection was previously created.');
        }
    }
	
    function preparedQuery($sql, $params){
		if($this->_pdo != null) {
	    	try {
		    	$statement = $this->_pdo->prepare($sql);
				$statement->execute($params);
				//print_r($statement->fetchALL(PDO::FETCH_ASSOC));
				//echo  memory_get_usage();
				return $statement->fetchALL(PDO::FETCH_ASSOC);
	    	} catch (Exception $e) {
	    		throw new Exception('Data couldn\'t be retrieved: ' . $e->getMessage());
	    	}
		} else {
			throw new Exception('No connection was previously created.');
		}
    }
    
	function insert($sql, $data, $getId = false){
		try {
			$statement = $this->_pdo->prepare($sql);
			$statement->execute($data);
			
			if($getId){
				return $this->_pdo->lastInsertId();
			}else{
				return $statement->rowCount();
			}
		} catch (Exception $e) {
			throw new Exception('Failed to issue insert: ' . $e->getMessage());
		}
	}

	function update($sql, $data){
		try {
			$statement = $this->_pdo->prepare($sql);
			$statement->execute($data);

			return $statement->rowCount();
		} catch (Exception $e) {
			echo $e->getMessage();
			throw new Exception('Failed to issue update: ' . $e->getMessage());
		}
	}

	function delete($sql, $data){
		try {
			$statement = $this->_pdo->prepare($sql);
			$statement->execute($data);
		} catch (Exception $e) {
			echo $e->getMessage();
			throw new Exception('Failed to issue delete: ' . $e->getMessage());
		}
	}
    
    function query($sql) {
        return $this->exec($sql);    
    }
    
    function close() {
        if($this->_pdo != null) {
        	
//			MDB2::disconnect();
            $this->_pdo = null;
            $this->_rs = null;
        }    
    }
        
    function getLastId() {
        $this->_pdo->lastInsertId();
    }
	
    ////////////////////////
    // Transaction related
    ////////////////////////
    function beginTrans() {
		if ($this->_pdo->supports('transactions')) {
		    $this->_pdo->beginTransaction();
		
		}
    }

    function commitTrans() {
	    if ($this->_pdo->in_transaction) {
	        $this->_pdo->commit();
	    }
    }

    function rollbackTrans() {
	    if ($this->_pdo->in_transaction) {
	        $this->_pdo->rollback();
	    }
    }
}

?>
