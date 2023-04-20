<?php
	require_once '../include/config.php';
	unset($_SESSION['user_id']);
	session_destroy();
	close_database_connection($db_connection);
	redirect_to('index.php');
?>