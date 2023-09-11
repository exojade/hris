<?php  

// use Fahriztx\Zksoapphp\Fingerprint;


// $machine = Fingerprint::connect('192.168.12.2', '4370', 0);
// echo "Machine Status : ".$machine->getStatus(); // connect | disconnect
// // dump($machine->getStatus());
// // get all user data
// try {
//     print_r($machine->getUserInfo());
//   }
  
//   //catch exception
//   catch(Exception $e) {
//     echo 'Message: ' .$e->getMessage();
//   }

//  // return Array of User Info Data

// // get specific pin user data
// print_r($machine->getUserInfo(1)); // return Array of User Info Data
// // OR Array
// print_r($machine->getUserInfo([1, 2])); // return Array of User Info Data
// dump("exit");

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      


    }
    else
    {   
        // dump($_SESSION);
        $pds = query("select * from tblemployee where Employeeid = ?", $_SESSION["hris"]["employee_id"]);
        $pds = $pds[0];
        render("apps/pds/pds_app/pds_form.php", 
		[
			"title" => "PDS",
			"pds" => $pds,
		],
        "pds"
    );
    }
?>