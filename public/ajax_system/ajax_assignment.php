<?php

$search = $_REQUEST["q"];
$sql = query("select place_assignment as supplier from tblemployee_service_record 
                where place_assignment like '%".$search."%' group by place_assignment");
// dump($sql);
if($sql == null)
    $sql[0]["supplier"] = $search;

                $json_data = array(
                    "results" => $sql
                );
                echo json_encode($json_data);

?>