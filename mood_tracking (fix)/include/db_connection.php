<?php
	define('db_host', 'localhost'); //Define the database hostname
	define('db_user', 'root'); //Define the database username
	define('db_pass', ''); //Define the database password
	define('db_name', 'mood_tracking'); //Define the database name
	

	/*return the database connection variable after defining it*/
	function start_database_connection(){
		$db_connection = new mysqli(db_host,db_user,db_pass,db_name);
		if ($db_connection->connect_error) {
			echo "Error database connection: ".$db_connection->connect_error." error No.:".$db_connection->connect_errno;
			exit();
		}else{
			return $db_connection;
		}
	}
	/*close the database connection function*/
	function close_database_connection($db_connection){
		$db_connection->close();
	}

?>