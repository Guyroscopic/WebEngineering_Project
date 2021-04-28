<?php

	/* Database Credentials */

	/*
	define('DB_HOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'webproject');
	*/

	/*
	------------------------------------------------------
	JazzCash API Configuration
	------------------------------------------------------	
	*/
	define('JAZZCASH_MERCHANT_ID', 'enter_merchant_id');
	define('JAZZCASH_PASSWORD', 'enter_password');
	define('JAZZCASH_INTEGERITY_SALT', 'enter_integerity_salt');
	define('JAZZCASH_CURRENCY_CODE', 'PKR');
	define('JAZZCASH_LANGUAGE', 'EN');
	define('JAZZCASH_API_VERSION_1', '1.1');
	define('JAZZCASH_API_VERSION_2', '2.0');

	define('JAZZCASH_RETURN_URL', 'enter_return_url');
	define('JAZZCASH_HTTP_POST_URL', 'https://sandbox.jazzcash.com.pk/ApplicationAPI/API/2.0/Purchase/DoMWalletTransaction');


	/*
	------------------------------------------------------
	JazzCash API Configuration
	------------------------------------------------------	
	*/

	$DB_HOST = "localhost";
	//ENTER YOUR OWN USER AND PASSWORD
	$DB_USERNAME = "root";
	$DB_PASSWORD = "password123";

	$DB_NAME = "lazylearn";

	/* Connecting to MySql Database*/
	$database_connection = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

	/* Check if connection establishes */
	if(!$database_connection){
		die("ERROR: Could not Connect to Database. ". mysqli_connect_error());	
	}
?>