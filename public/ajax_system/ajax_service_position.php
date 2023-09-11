<?php
	$search = $_REQUEST["q"];
	$sql = query("select position as supplier from tblemployee_service_record 
					where 
					position like '%".$search."%'
					group by supplier
					");

	// dump(count($sql));
	if($sql != null){
$sql[count($sql)+1]["supplier"] = $search;
	}
	

	if($sql == null){
		$sql[0]["supplier"] = $search;
	}
	
					$json_data = array(
						"results" => $sql
					);
	
					echo json_encode($json_data);
?>
