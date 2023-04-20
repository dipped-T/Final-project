<?php
	require_once '../../../include/config.php';//Import the config script that contains the database connection, functions and database queries functions
	$page_title = "Delete Goal";//Set the page title
	include  COMMON_PATH . '/head.php';//Import the head markup
	include  COMMON_PATH . '/user-header.php';//Import the header markup

	/*Check if the user is logged in (the user_id is stored in the SESSION variable) otherwise redirect to login page*/
	if (!isset($_SESSION['user_id'])) {
		redirect_to('content/login.php');
	}else{
		$user_id = $_SESSION['user_id'];
	}

	/*Get the goal ID with the GET Method and retrieve the goal data from database by calling the function selection_goal_by_id. If the goal ID is not defined, we redirect to goals page*/
	if (!isset($_GET['id'])) {
		redirect_to('content/user/goals.php');
	}else{
		$goal_id = $_GET['id'];
		$goal = select_goal_by_id($db_connection,$goal_id);
	}
?>
<?php
	if (is_post_request()) {
		/*Once the delete confirmation button is clicked, the form is submitted and the delete_goal function is called and we pass the goal_id, the goal data is deleted from database*/
		if (delete_goal($db_connection,$goal_id)) {
			redirect_to('content/user/goals.php');
		}else{
			$error_msg = "Error deleting goal, please try again";
		}
	}
?>
<main>
	<div class="container">
		<div class="user-dashboard-menu">
			<ul class="flex align-center justify-start user-dashboard-menu-links">
				<li class="user-dashboard-menu-link"><a href="<?php echo url_for('content/user/index.php'); ?>">Dashboard</a></li>
			</ul>
		</div>
		<h1 class="text-center">Delete Goal</h1>
		<div class="signin-signup-form-wrapper">
			<form action="<?php echo url_for('content/user/goals/delete_goal.php?id='.$goal_id); ?>" method="POST">
				<p>Are you sure you want to delete <?php echo $goal['goal_title']; ?>?</p>
				<?php
					if (isset($error_msg)) {
						echo "<p>".$error_msg."</p>";
					}
				?>
				<button type="submit" class="submit-button">Delete Goal</button>
			</form>
		</div>
	</div>
</main>
<?php
	include COMMON_PATH . '/footer.php';
?>