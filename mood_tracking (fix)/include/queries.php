<?php
	/*Select the user's data from database by given username input and see if the row exists*/
	function check_user_exists($db_conn,$login_creds){
		$sql = "SELECT * FROM users WHERE username='".a($login_creds['username'])."';";
		$result = $db_conn->query($sql);
		if ($result) {
			if ($result->num_rows>0) {
				return true;
			}else{
				return false;
			}
		}else{
			echo $db_conn->error;
			return false;
		}
	}
	/*Select the user's data from database by given username input and check if password given is correct*/
	function check_user_password($db_conn,$login_creds){
		$sql = "SELECT * FROM users WHERE username='".a($login_creds['username'])."';";
		$result = $db_conn->query($sql);
		if ($result) {
			$user = $result->fetch_assoc();
			if (password_verify($login_creds['password'], $user['password'])) {
				return true;
			}else{
				return false;
			}
		}else{
			echo $db_conn->error;
			return false;
		}
	}
	/*save user's data in database*/
	function create_user($db_conn,$signup_creds){
		$fields = ['username','password'];
		$sanitized_inputs = sanitize_create_inputs($fields,$signup_creds);
		$sql = "INSERT INTO users (".join(",",$fields).") VALUES ('".join("','",$sanitized_inputs)."');";
		$result = $db_conn->query($sql);
		if ($result) {
			return true;
		}else{
			echo $db_conn->error;
			return false;
		}
	}
	/*Select user's data from database by given username*/
	function select_user_by_username($db_conn,$login_creds){
		$sql = "SELECT * FROM users WHERE username='".a($login_creds['username'])."';";
		$result = $db_conn->query($sql);
		if ($result) {
			$user = $result->fetch_assoc();
			return $user;
		}else{
			echo $db_conn->error;
		}
	}
	/*Select user's data from database by their id*/
	function select_user_by_id($db_conn,$user_id){
		$sql = "SELECT * FROM users WHERE id='".$user_id."';";
		$result = $db_conn->query($sql);
		if ($result) {
			$user = $result->fetch_assoc();
			return $user;
		}else{
			echo $db_conn->error;
		}
	}
	/* add created goal data to database */
	function add_goal($db_conn,$new_goal){
		$columns = ['user_id','goal_title','goal_date'];
		$sanitized_inputs = sanitize_create_inputs($columns,$new_goal);
		$sql = "INSERT INTO goals (".join(",",$columns).") VALUES ('".join("','",$sanitized_inputs)."');";
		$result = $db_conn->query($sql);
		if ($result) {
			return true;
		}else{
			echo $db_conn->error;
			return false;
		}
	}
	/* update goal data to database */
	function edit_goal($db_conn,$goal_id,$edited_goal){
		$columns = ['goal_title','goal_date'];
		$sanitized_inputs = sanitize_edit_inputs($columns,$edited_goal);
		$sql = "UPDATE goals SET ".join(",",$sanitized_inputs)." WHERE id='".$goal_id."';";
		$result = $db_conn->query($sql);
		if ($result) {
			return true;
		}else{
			echo $db_conn->error;
			return false;
		}
	}
	/* delete goal data from database */
	function delete_goal($db_conn,$goal_id){
		$sql = "DELETE FROM goals WHERE id='".$goal_id."';";
		$result = $db_conn->query($sql);
		if ($result) {
			return true;
		}else{
			echo $db_conn->error;
			return false;
		}
	}
	/* select user goals data */
	function select_user_goals($db_conn,$user_id){
		$sql = "SELECT * FROM goals WHERE user_id='".$user_id."';";
		$result = $db_conn->query($sql);
		if ($result) {
			return $result;
		}else{
			echo $db_conn->error;
		}
	}
	/* select goal data by goal ID */
	function select_goal_by_id($db_conn,$goal_id){
		$sql = "SELECT * FROM goals WHERE id='".$goal_id."';";
		$result = $db_conn->query($sql);
		$goal = $result->fetch_assoc();
		return $goal;
	}
	/*add created mood data to database*/
	function add_mood($db_conn,$new_mood){
		$columns = ['user_id','mood_value','mood_date'];
		$sql = "INSERT INTO moods (".join(",",$columns).") VALUES ('".join("','",$new_mood)."');";
		$result = $db_conn->query($sql);
		if ($result) {
			return true;
		}else{
			echo $db_conn->error;
			return false;
		}
	}
	/* select user moods data from database */
	function select_user_moods($db_conn,$user_id){
		$sql = "SELECT * FROM moods WHERE user_id='".$user_id."';";
		$result = $db_conn->query($sql);
		if ($result) {
			return $result;
		}else{
			echo $db_conn->error;
		}
	}
?>