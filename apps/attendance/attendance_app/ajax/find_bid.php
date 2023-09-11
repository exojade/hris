<?php

    $q = $_POST["q"];

    if(strlen($q) < 3){
        echo("not enough");
        exit();
    }

    $search = $q;
    $limit = 10;
    $query_string = "select *, b.ReferenceNumber as ReferenceNumber, FORMAT(amount, 2) as amount from tblbids b
    left join tblbid_pdfs p
    on b.ReferenceNumber = p.ReferenceNumber
    where b.Title like '%".$search."%'
    or b.rfqnumber like '%".$search."%'
    or b.amount like '%".$search."%'
    or b.ReferenceNumber like '%".$search."%'
    or b.supplier like '%".$search."%'
    or p.description_file like '%".$search."%'
    group by b.ReferenceNumber
    Order by b.DateCreated DESC
    limit ".$limit."";

    $transactions = query($query_string);
    echo(json_encode($transactions));

?>