<?php
	require_once '../../../include/config.php'; //Import the config script that contains the database connection, functions and database queries functions
	$page_title = "Add Goal"; //Set the page title
	include  COMMON_PATH . '/head.php'; //Import the head markup
	include  COMMON_PATH . '/user-header.php'; //Import the header markup

	/*Check if the user is logged in (the user_id is stored in the SESSION variable) otherwise redirect to login page*/
	if (!isset($_SESSION['user_id'])) {
		redirect_to('content/login.php');
	}else{
		$user_id = $_SESSION['user_id'];
	}
?>
<?php
	if (is_post_request()) {
		/*Retrieve the new goal inputs and store the goal data in the database by calling the add_goal function pass the add goal form inputs*/
		$new_goal= [];
		$new_goal['user_id'] = $user_id;
		$new_goal['goal_title'] = $_POST['goal_title'] ?? "";
		$new_goal['goal_date'] = $_POST['goal_date'] ?? "";
		if (add_goal($db_connection,$new_goal)) {
			$success_msg = "You goal has been added successfully";
		}else{
			$error_msg = "Error adding goal, please try again";
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
		<h1 class="text-center">Add Goal</h1>
		<div class="signin-signup-form-wrapper">
			<form action="<?php echo url_for('content/user/goals/add_goal.php'); ?>" method="POST">
				<label for="goal_title">Goal Title</label>
				<input type="text" name="goal_title" id="goal_title" required>
				<label for="goal_date">Goal Date</label>
				<input type="date" name="goal_date" id="goal_date" required>
				<?php
					if (isset($error_msg)) {
						echo "<p>".$error_msg."</p>";
					}
					if (isset($success_msg)) {
						echo "<p>".$success_msg."</p>";
					}
				?>
				<button type="submit" class="submit-button">Add Goal</button>
			</form>
		</div>
	</div>
</main>
<?php
	include COMMON_PATH . '/footer.php'; //Import the footer markup
?>