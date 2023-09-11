<?php
	$search = $_REQUEST["q"];
	$sql = query("select Deptid as id, concat(DeptName, ' (' , DeptCode, ') ' ) as name from tbldepartment 
					where 
					DeptName like '%".$search."%' OR
					DeptCode like '%".$search."%'
					");

					$json_data = array(
						"results" => $sql
					);
	
					echo json_encode($json_data);
?>
