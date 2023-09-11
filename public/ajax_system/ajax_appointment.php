<?php

$search = $_REQUEST["q"];
$sql = query("select employment_status as supplier from tblemployee_service_record 
                where employment_status like '%".$search."%' group by employment_status");

// dump($sql);
if($sql == null)
    $sql[0]["supplier"] = $search;

                $json_data = array(
                    "results" => $sql
                );
                echo json_encode($json_data);

?>