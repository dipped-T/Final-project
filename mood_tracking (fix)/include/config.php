<?php
	//Define the INCLUDE_PATH and COMMON_PATH constants to use them when importing the common scripts in all pages of the website
	define('INCLUDE_PATH',dirname(__FILE__));
	define('COMMON_PATH', INCLUDE_PATH.'/common');

	//Define the root url of the website
	$root_url = substr($_SERVER['SCRIPT_NAME'], 0,strpos($_SERVER['SCRIPT_NAME'], 'mood_tracking')+13);
	
	//Import the functions, the database function, and the database queries functions in the config script
	include 'functions.php';
	include 'db_connection.php';
	include 'queries.php';

	//Define the database connection and start the session
	$db_connection = start_database_connection();
	session_start();
?>