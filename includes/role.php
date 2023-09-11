<?php
	function this_admin(){
		if($_SESSION["cho_system"]["role"] != 'TheAdmin'){
			redirect("404.php");
		}
	}
?>
