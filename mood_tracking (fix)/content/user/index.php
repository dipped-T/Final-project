<?php
	require_once '../../include/config.php';
	$page_title = "Dashboard";
	include  COMMON_PATH . '/head.php';
	include  COMMON_PATH . '/user-header.php';

	if (!isset($_SESSION['user_id'])) {
		redirect_to('content/login.php');
	}else{
		$user = select_user_by_id($db_connection,$_SESSION['user_id']);
	}
?>
<main>
	<div class="container">
		<h1 class="text-center">Welcome, <?php echo $user['username']; ?></h1>
		<div class="user-dashboard-menu">
			<ul class="flex align-center justify-start user-dashboard-menu-links">
				<li class="user-dashboard-menu-link"><a href="<?php echo url_for('content/user/goals/add_goal.php'); ?>">Add Goal</a></li>
				<li class="user-dashboard-menu-link"><a href="<?php echo url_for('content/user/moods/add_mood.php'); ?>">New Mood</a></li>
			</ul>
		</div>

	</div>
</main>
<?php
	include COMMON_PATH . '/footer.php';
?>