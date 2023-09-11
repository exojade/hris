<?php
    require("includes/google_class.php"); 



    // if form was submitted
	
    // dump($_SESSION);
    // require_once 'google.php'; // Include Class File
    // session_start(); //Start the session




    // Check if the user is logged in
    if(!isset($_GET['code'])){ 
        // Go to Google Login Page
        header('Location: '.$google->createAuthUrl());
        exit;
    }

    // If the page is redirected from google authentication
    if(isset($_GET['code'])){
		$_SESSION["hris"]['accessToken'] = $google->authenticate($_GET['code']);


        // // Authenticate and start the session
        // // $google->authenticate($_GET['code']);
		// $token = $google->fetchAccessTokenWithAuthCode($_GET['code']);
		// // dump($token);
  		// $google->setAccessToken($token['access_token']);

		//   $google_oauth = new Google_Service_Oauth2($google);
		//   $google_account_info = $google_oauth->userinfo->get();
		//   $userinfo = [
		// 	'email' => $google_account_info['email'],
		// 	'first_name' => $google_account_info['givenName'],
		// 	'last_name' => $google_account_info['familyName'],
		// 	'gender' => $google_account_info['gender'],
		// 	'full_name' => $google_account_info['name'],
		// 	'picture' => $google_account_info['picture'],
		// 	'verifiedEmail' => $google_account_info['verifiedEmail'],
		// 	'token' => $google_account_info['id'],
		//   ];

		//   $_SESSION['user_token'] = $token;

		redirect("index");
		 
		//   if (isset($_SESSION['user_token'])) {
		// 	// dump($_SESSION);
			
		// 	// die();
		//   }
        # your code ..
		
    }



?>