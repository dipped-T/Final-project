<?php
	require_once '../../../include/config.php';//Import the config script that contains the database connection, functions and database queries functions
	$page_title = "Today's Mood"; //Set the page title
	include  COMMON_PATH . '/head.php';//Import the head markup
	include  COMMON_PATH . '/user-header.php';//Import the header markup

	/*Check if the user is logged in (the user_id is stored in the SESSION variable) otherwise redirect to login page*/
	if (!isset($_SESSION['user_id'])) {
		redirect_to('content/login.php');
	}else{
		$user_id = $_SESSION['user_id'];
	}
?>
<?php
	if (is_post_request()) {
		/*Retrieve the today's mood inputs and store the mood data in the database by calling the add_mood function and we pass the today's mood form inputs*/
		$new_mood= [];
		$new_mood['user_id'] = $user_id;
		$new_mood['mood_value'] = $_POST['mood_value'] ?? "";
		$new_mood['mood_date'] = date("Y-m-d");
		if (add_mood($db_connection,$new_mood)) {
			$success_msg = "You mood has been added successfully";
		}else{
			$error_msg = "Error adding mood, please try again";
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
		<h1 class="text-center">Today's Mood</h1>
		<div class="signin-signup-form-wrapper">
			<form action="<?php echo url_for('content/user/moods/add_mood.php'); ?>" method="POST">
				<label for="mood">Select Mood</label>
				<div class="flex justify-between align-center mood-labels">
					<div class="mood-label">Lowest</div>
					<div class="mood-label">Happiest</div>
				</div>
				<input type="range" name="mood_value" min="1" max="5" step="1">
				<?php
					if (isset($error_msg)) {
						echo "<p>".$error_msg."</p>";
					}
					if (isset($success_msg)) {
						echo "<p>".$success_msg."</p>";
					}
				?>
				<button type="submit" class="submit-button">Add Mood</button>
			</form>
		</div>
	</div>
</main>
<?php
	include COMMON_PATH . '/footer.php';
?>