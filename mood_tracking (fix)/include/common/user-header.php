<body>
	<header id="header">
		<div class="container">
			<div class="flex align-center justify-between header-wrapper">
				<div class="header-logo"><a href="<?php echo url_for('index.php');?>"><img src="<?php echo url_for('PUT THE LOGO FILE PATH HERE'); ?>"></a></div>
				<nav class="main-nav-menu">
					<ul class="flex justify-between align-center">
						<li><a href="<?php echo url_for('content/user/moods.php'); ?>">Moods</a></li>
						<li><a href="<?php echo url_for('content/user/goals.php'); ?>">Goals</a></li>
						<li><a href="<?php echo url_for('content/logout.php'); ?>">Logout</a></li>
						<li class="flex align-center">
							<img src="<?php echo url_for('assets/icons/light-icon.png'); ?>" class="light-mode-icon">
							<!-- Rounded switch -->
							<label class="switch">
				  				<input class="enable-disable-switch" id="light-dark-switch" type="checkbox"  >
				  				<span class="slider round"></span>
							</label>
							<img src="<?php echo url_for('assets/icons/dark-icon.png'); ?>" class="light-mode-icon">
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</header>
