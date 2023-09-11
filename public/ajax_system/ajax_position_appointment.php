<?php
	$search = $_REQUEST["q"];
	$sql = query("select Positionid, concat(PositionName, ' (' , PositionCode, ') ' , 'SG-', SGRate) as name from tblposition 
					where 
					PositionName like '%".$search."%' OR
					PositionCode like '%".$search."%'
					");

					$json_data = array(
						"results" => $sql
					);
	
					echo json_encode($json_data);
?>
