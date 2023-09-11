<?php

		function getme($id){
			$sql = query("select * from mtop_users where userId = ?", $id);
			$sql = $sql[0];
			return($sql);
			
		}
		
		function checkhit($objid){
		$hitarray = [];
		$constants = get_defined_constants(true);
		$db = $constants["user"]["DATABASE2"];
		$sql = query("select * from mtop where operator_id = ?", $objid);
		$i = 0;
			$sql = query("SELECT ei.objid AS objid, firstname, lastname, middlename, gender, 
						text FROM $db.entityindividual AS ei 
						LEFT JOIN $db.entity_address AS ea
						ON ei.objid = ea.parentid where ei.objid = ?", $objid);
			$sql = $sql[0];
			$stringquery = "
			select * from mtop where 
			(lastname LIKE '%".$sql["lastname"]."%' OR firstname LIKE '%".$sql["firstname"]."%')
			";
			$sql = query($stringquery);
			if ($sql != ""):
			foreach ($sql as $row)
			{
				$hitarray[$i]["MTOP_NO"] = $row["MTOP_NO"];
				$hitarray[$i]["fullname"] = $row["firstname"] . " " . $row["middlename"] . " " . $row["lastname"];
				$hitarray[$i]["address"] = $row["address"];
				$hitarray[$i]["expiration_date"] = $row["expiration_date"];
				$hitarray[$i]["percent"] = "-";
				$i++;
			}
			endif;
		return ($hitarray);
			
	}
	
	function checkname($criteria){
		$constants = get_defined_constants(true);
		$db = $constants["user"]["DATABASE2"];
		$criteria = '%' . $criteria . '%';
		$stringquery = "
		SELECT ei.objid AS objid, firstname, lastname, middlename, gender, text FROM $db.entityindividual AS ei 
		LEFT JOIN $db.entity_address AS ea
		ON ei.objid = ea.parentid where 
		(lastname LIKE '".$criteria."' OR firstname LIKE '".$criteria."')
		";
		$sql = query($stringquery);
		return($sql);
	}
	
	function getobjetracs($objid){
		$constants = get_defined_constants(true);
		$db = $constants["user"]["DATABASE2"];
		
		$sql = query("SELECT ei.objid AS objid, firstname, lastname, middlename, gender, 
						text FROM $db.entityindividual AS ei 
						LEFT JOIN $db.entity_address AS ea
						ON ei.objid = ea.parentid where ei.objid = ?", $objid);
		$sql = $sql[0];
		return($sql);
	}
	
	function getvehicle($vehicleid){
		$sql = query("select * from new_vehicle where ID = ?", $vehicleid);
		$sql = $sql[0];
		return($sql);
	}
	
	function checkpending($mtop,$action){
		$sql = query("select * from pending_application where MTOP_NO = ? and transaction_type = ?", $mtop, $action);
		$array = [];
		// print_r($sql);
		$result = "";
		if ($sql == NULL){
					$array["result"] = '-';
					$array["color"] = 'primary';
					$array["objid"] = '-';
					$array["status"] = '-';
		}
		else{
			$sql = $sql[0];
			if($action == 'TRANSFER'){
				if(empty($sql["tmu_status"])){
					$array["result"] = 'transfer';
					$array["color"] = 'warning';
					$array["objid"] = $sql["operator_id"];
					$array["status"] = "blank";
				}
				else if($sql["tmu_status"] == 'pending'){
					$array["result"] = 'transfer';
					$array["color"] = 'warning';
					$array["objid"] = $sql["operator_id"];
					$array["status"] = "pending";
				}
				else if($sql["tmu_status"] == 'rejected'){
					$array["result"] = 'transfer';
					$array["color"] = 'danger';
					$array["objid"] = $sql["operator_id"];
					$array["status"] = "rejected";
				}
				else{
					$array["result"] = 'transfer';
					$array["color"] = 'success';
					$array["objid"] = $sql["operator_id"];
					$array["tmu_control_no"] = $sql["tmu_control_no"];
					$array["status"] = "accepted";
				}
				$array["pending_id"] = $sql["pending_id"];
			}
			
			else if($action == 'SUBSTITUTION'){
				if(empty($sql["tmu_status"])){
					$array["result"] = 'sub';
					$array["color"] = 'warning';
					$array["objid"] = $sql["operator_id"];
					$array["status"] = "blank";
				}
				else if($sql["tmu_status"] == 'pending'){
					$array["result"] = 'sub';
					$array["color"] = 'warning';
					$array["objid"] = $sql["operator_id"];
					$array["status"] = "pending";
				}
				else if($sql["tmu_status"] == 'rejected'){
					$array["result"] = 'sub';
					$array["color"] = 'danger';
					$array["objid"] = $sql["operator_id"];
					$array["status"] = "rejected";
				}
				else{
					$array["result"] = 'sub';
					$array["color"] = 'success';
					$array["objid"] = $sql["operator_id"];
					$array["status"] = "accepted";
					$array["tmu_control_no"] = $sql["tmu_control_no"];
				}
				$array["pending_id"] = $sql["pending_id"];
				$array["make"] = $sql["make"];
				$array["motor"] = $sql["motor"];
				$array["plate"] = $sql["plate"];
				$array["cert"] = $sql["cert"];
				$array["route"] = $sql["route"];
				$array["chassis"] = $sql["chassis"];
				$array["lto_reg"] = $sql["lto_reg"];
				$array["lto_reg_date"] = $sql["lto_reg_date"];
				$array["classification"] = $sql["classification"];
			}
			else if($action == 'MP'){
				$array["result"] = 'mp';
				$array["pending_id"] = $sql["pending_id"];
				if(empty($sql["tmu_status"])){
					$array["color"] = 'warning';
					$array["objid"] = $sql["operator_id"];
					$array["status"] = "blank";
				}
				else if($sql["tmu_status"] == 'pending'){
					$array["color"] = 'warning';
					$array["objid"] = $sql["operator_id"];
					$array["status"] = "pending";
				}
				else if($sql["tmu_status"] == 'rejected'){
					$array["color"] = 'danger';
					$array["objid"] = $sql["operator_id"];
					$array["status"] = "rejected";
					$array["tmu_control_no"] = $sql["tmu_control_no"];
				}
				else{
					$array["color"] = 'success';
					$array["objid"] = $sql["operator_id"];
					$array["status"] = "accepted";
					$array["tmu_control_no"] = $sql["tmu_control_no"];
				}
			}

				
			else if($sql["transaction_type"] == 'AWARD')
				$result = 'award';
		}
		return($array);
	}
	
	function cmtopowner($mtop,$operatorid){
		
		$mymtop = getmtop($mtop);
		
		query("UPDATE mtop_operator SET Status = 'Inactive' WHERE MTOP_NO = ?",
				$mtop);
		
		if (query("INSERT INTO mtop_operator (MTOP_NO,operator_id,Status,operator_id2) 
				VALUES(?,?,?,?)", 
				$mtop,$operatorid,"Active",$mymtop["operator_id"]) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
				
		
		$operator = getobjetracs($operatorid);
		
		query("UPDATE mtop SET operator_id = ?, firstname = ?, middlename = ?, lastname = ?,
				address = ?, Gender = ?, status = 'Active'
				WHERE MTOP_NO = ?",
				$operator["objid"],$operator["firstname"],$operator["middlename"],$operator["lastname"]
				,$operator["text"],$operator["gender"],$mtop);
		
	}
	
	function cmtopvehicle($mtop,$vehicleid,$tmu,$route){
		
		$mymtop = getmtop($mtop);
		query("UPDATE mtop_vehicle SET Status = 'Inactive' WHERE MTOP_NO = ?",
				$mtop);
		
		if (query("INSERT INTO mtop_vehicle (MTOP_NO,vehicle_id,Status,vehicle2_id) 
				VALUES(?,?,?,?)", 
				$mtop,$vehicleid,"Active",$mymtop["vehicle_id"]) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
				
		
		// $vehicle_id = getvehicle($vehicleid);
		
		query("UPDATE mtop SET vehicle_id = ?, status = 'Active', tmu_control_no = ?, route = ?
				WHERE MTOP_NO = ?",
				$vehicleid,$tmu,$route,$mtop);
		
	}
	
	function getmtop($mtop){
		$sql = query("select * from mtop where MTOP_NO = ?", $mtop);
		return($sql[0]);
	}
	
	function explodedate($datea){
		if($datea == ''){
			return(date("Y-m-d"));
		}
		else{
		$orderdate = explode('/', $datea);
		$month = $orderdate[0];
		$day   = $orderdate[1];
		$year  = $orderdate[2];
		$newdate = $year . "-" . $month . "-" . $day;
		return($newdate);
		}
	}
	
	
	
?>
