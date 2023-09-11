<?php

	function create_uuid($id_type) {
		$dtime = date("ymd");
		$g_uuid = generate_uuid();
		$generated_id = $id_type . '-' . $g_uuid . '-' . $dtime;
		return $generated_id;
	}
	
	function create_trackid($id_type){
		$g_uuid = generate_uuid();
		$g_uuid = strtoupper($g_uuid);
		$generated_id = $id_type . $g_uuid;		
		return $generated_id;
	}

	function create_ticket($id_type){
		$g_uuid = generate_ticket();
		$g_uuid = strtoupper($g_uuid);
		$generated_id = $id_type . $g_uuid;		
		return $generated_id;
	}

	function generate_uuid($lenght = 13) {
		// uniqid gives 13 chars, but you could adjust it to your needs.
		if (function_exists("random_bytes")) {
			$bytes = random_bytes(ceil($lenght / 2));
		} elseif (function_exists("openssl_random_pseudo_bytes")) {
			$bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
		} else {
			throw new Exception("no cryptographically secure random function available");
		}
		return substr(bin2hex($bytes), 0, $lenght);
	}


	function generate_ticket($lenght = 6) {
		// uniqid gives 13 chars, but you could adjust it to your needs.
		if (function_exists("random_bytes")) {
			$bytes = random_bytes(ceil($lenght / 2));
		} elseif (function_exists("openssl_random_pseudo_bytes")) {
			$bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
		} else {
			throw new Exception("no cryptographically secure random function available");
		}
		return substr(bin2hex($bytes), 0, $lenght);
	}

	function create_referenceid($id_type){
		$g_uuid = generate_uuid();
		$g_uuid = strtoupper($g_uuid);
		$generated_id = $id_type . $g_uuid;		
		return $generated_id;
	}

?>
