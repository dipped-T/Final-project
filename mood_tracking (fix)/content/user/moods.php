<?php
	require_once '../../include/config.php'; //Import the config script that contains the database connection, functions and database queries functions
	$page_title = "Moods Monitor";//Set the page title
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
		<h1 class="text-center">Moods Tracking</h1>
		<div class="flex justify-start align-end mood-tracking-chart">
			<?php
				/*We select all the moods data that belong to the corresponding logged in user by passing the user_id to the select_user_moods function*/
				$moods = select_user_moods($db_connection,$user_id);
				while ($mood = $moods->fetch_assoc()) {
			?>
			<!-- We set the height of the chart bar according to the mood value (e.g. a mood of value of 5, the bar will have a 100% height of the chart box) -->
			<div class="mood-bar" style="height: <?php echo ($mood['mood_value'] * 100)/5 .'%'; ?> ;width: <?php echo number_format((100/$moods->num_rows),2).'%'; ?>;">
				<div class="mood-date"><?php echo $mood['mood_date']; ?></div>
			</div>
			<?php
				}
			?>
			<div class="mood-tracking-chart-label happiest">Happiest</div>
			<div class="mood-tracking-chart-label lowest">Lowest</div>
		</div>
	</div>
</main>
<?php
	include COMMON_PATH . '/footer.php';
?>