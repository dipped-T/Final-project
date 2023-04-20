<?php
	require_once '../../include/config.php';

	$goals = select_user_goals($db_connection,$_SESSION['user_id']);
	$goals_arr = [];
	while ($goal = $goals->fetch_assoc()) {
		$goals_arr[] = $goal;

	}
	echo json_encode($goals_arr);
	close_database_connection($db_connection);

?>