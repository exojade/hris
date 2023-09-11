<?php

    // configuration
//    dump($_SESSION);

	if(!isset($_SESSION["hris"])) {
		redirect("index");
	}
	
	// log out current user, if any
	logout();
	
	// redirect user
	redirect("index");

?>
