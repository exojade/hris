<?php   
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      


    }
    else
    {
        render("apps/portal/portal_app/portal_form.php", 
		[
			"title" => "Portal",
		],
        "pds"
    );
    }
?>