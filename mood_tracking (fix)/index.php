<?php
	require_once 'include/config.php'; //Import the config script that contains the database connection, functions and database queries functions
	$page_title = "Home"; //Set the page title
	include  COMMON_PATH . '/head.php'; //Import the head markup
	include  COMMON_PATH . '/header.php'; //Import the header markup
?>
<main>
	<div class="container">
		<h1 class="text-center">Mood and Goal Tracking Application</h1>
	</div>
</main>

<?php
	include COMMON_PATH . '/footer.php'; //Import the footer markup
?>