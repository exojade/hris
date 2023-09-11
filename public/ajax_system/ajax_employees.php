<?php
	$search = $_REQUEST["q"];
	$sql = query("select Employeeid, concat(FirstName, ' ' , LastName) as name, 
					last_promotion, original_appointment
					from tblemployee 
					where 
					concat(FirstName, ' ', LastName) like '%".$search."%'  or
					concat(LastName, ' ', FirstName) like '%".$search."%'  or
					concat(LastName, ', ', FirstName) like '%".$search."%' or
					Fingerid like '%".$search."%'
					");
	if($sql == null){
		$sql[0]["supplier"]["Employeeid"] = "";
		$sql[0]["supplier"]["name"] = "Not Found";
	}
	
					$json_data = array(
						"results" => $sql
					);
	
					echo json_encode($json_data);
?>
