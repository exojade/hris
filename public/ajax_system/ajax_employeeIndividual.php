<?php
	$sql = query("select * from tblemployee where Employeeid = ?
					", $_POST["wildcard"]);
					$json_data = array(
						"results" => $sql[0]
					);
	
					echo json_encode($json_data);
?>
