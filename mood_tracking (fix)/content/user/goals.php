<?php
	require_once '../../include/config.php'; //Import the config script that contains the database connection, functions and database queries functions
	$page_title = "My Goals";//Set the page title
	include  COMMON_PATH . '/head.php';//Import the head markup
	include  COMMON_PATH . '/user-header.php';//Import the header markup

	/*Check if the user is logged in (the user_id is stored in the SESSION variable) otherwise redirect to login page*/
	if (!isset($_SESSION['user_id'])) {
		redirect_to('content/login.php');
	}else{
		$user_id = $_SESSION['user_id'];
	}
?>
<main>
	<div class="container">
		<div class="user-dashboard-menu">
			<ul class="flex align-center justify-start user-dashboard-menu-links">
				<li class="user-dashboard-menu-link"><a href="<?php echo url_for('content/user/index.php'); ?>">Dashboard</a></li>
			</ul>
		</div>
		<h1 class="text-center">My Goals</h1>
		<div class="flex justify-start align-stretch goal-mood-cards">
			<?php
			/*We select all the goals data that belong to the corresponding logged in user by passing the user_id to the select_user_goals function*/
				$goals = select_user_goals($db_connection,$user_id);
				while ($goal = $goals->fetch_assoc()) {
			?>
			<div class="goal-mood-card">
				<div class="card-title"><?php echo $goal['goal_title']; ?></div>
				<div class="card-date"><?php echo $goal['goal_date']; ?></div>
				<div class="flex align-center justify-between card-buttons">
					<a href="<?php echo url_for('content/user/goals/edit_goal.php?id='.$goal['id']); ?>">Edit</a>
					<a href="<?php echo url_for('content/user/goals/delete_goal.php?id='.$goal['id']); ?>">Delete</a>
				</div>
			</div>
			<?php
				}
			?>
			
		</div>
	</div>
</main>
<?php
	include COMMON_PATH . '/footer.php';//Import the footer markup
?>