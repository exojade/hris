<?php
	$search = $_REQUEST["q"];


	$sql = query("select designation
					from contract_plantilla_list 
					where 
					designation like '%".$search."%'
					group by designation
					");


	if($sql == null){
		$sql[0]["designation"] = $search;
	}
	
					$json_data = array(
						"results" => $sql
					);
	
					echo json_encode($json_data);
?>
