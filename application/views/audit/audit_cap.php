<?php 
 
 $arrayCap =  array();
//&& $statusReq != "0" && $statusReq != "3"
function addValues ($keyCap, $statusReq){
	if($keyCap != "" && $statusReq != ""){
 			global $arrayCap;
 			 $indexCapinArray = -1;
			//Create the first row in the global Array to count the advance of the audit.
			if (count($arrayCap) == 0){		

				$newRow = createArray($keyCap, $statusReq);
			//Save the record for each 
			}else {
				//Search the row in the Global Array
				$indexCapinArray = searchIndex($keyCap);					
				//Create Cap audit
				if ($indexCapinArray == -1) {
					$newRow = createArray($keyCap, $statusReq);
					//echo("-->".$keyCap."\n--->".$statusReq);		
				}
				//Add data to the array if the index exist
				if ($indexCapinArray > -1) {
					$currRow = $arrayCap[$indexCapinArray];
					$currRow = addValuesArray($currRow, $keyCap, $statusReq);

					$arrayCap[$indexCapinArray][0] = $currRow[0];
					$arrayCap[$indexCapinArray][1] = $currRow[1];
					$arrayCap[$indexCapinArray][2] = $currRow[2];
					$arrayCap[$indexCapinArray][3] = $currRow[3];
					$arrayCap[$indexCapinArray][4] = $currRow[4];
					$arrayCap[$indexCapinArray][5] = $currRow[5];
					
				}													
			}						

			if ($indexCapinArray == -1) {
				$arrayCap[] = $newRow;
			}			
		}
	}

	function addValuesArray($currRow, $keyCap, $statusReq) {	
		

		if ($statusReq == 2) {
			$currRow[0] = $keyCap;
			$currRow[1] = $currRow[1] + 1;	
		}
		if ($statusReq == 1) {
			$currRow[0] = $keyCap;		
			$currRow[2] = $currRow[2] + 1;		
		}
		if ($statusReq == 0) {
			$currRow[0] = $keyCap;	
			$currRow[3] = $currRow[3] + 1;					
		}
		if ($statusReq == 3) {
			$currRow[0] = $keyCap;	
			$currRow[4] = $currRow[4] + 1;
		}		
		if ($statusReq == "") {
			$currRow[0] = $keyCap;		
			$currRow[5] = $currRow[5] + 1;				
		}				

		return $currRow;
	}

	function searchIndex ($keyCap){		
	 	global $arrayCap;
	
		for($i = 0; $i < count($arrayCap); $i++) {	
    		if ($arrayCap[$i][0] == $keyCap) {  		
    	 		return $i;    			
    		}
		}
		return -1;
	}


	function createArray($keyCap, $statusReq) {
		$newRow = array($keyCap, "0", "0","0", "0", "0","0");
		if ($statusReq == 2) {
			$newRow[0] = $keyCap;
			$newRow[1] = $newRow[1] + 1;
		}
		if ($statusReq == 1) {
			$newRow[0] = $keyCap;			
			$newRow[2] = $newRow[2] + 1;	
		}
		if ($statusReq == 0) {
			$currRow[0] = $keyCap;		
			$currRow[3] = $currRow[3] + 1;		
		}
		if ($statusReq == 3) {
			$currRow[0] = $keyCap;		
			$currRow[4] = $currRow[4] + 1;		
		}				
		if ($statusReq == "") {
			$currRow[0] = $keyCap;		
			$currRow[5] = $currRow[5] + 1;		
		}				

		return $newRow;
	}	
	if(!empty($requirementsReport)){
 	//print_r($requirementsReport); die;
		foreach ($requirementsReport as $key) {
			$keyCap = $key['name'];	
			$query = "SELECT * FROM statusreportaudit WHERE id_rData = ".$key["id"];
					$res = mysql_query($query);
					$reg = mysql_fetch_array($res);
					$statusReq = $reg["status"];
			addValues($keyCap, $statusReq);

		}
	}
		global $arrayCap;
?>