<?php
	require_once '../include/config.php'; //Import the config script that contains the database connection, functions and database queries functions
	$page_title = "Signup"; //Set the page title
	include  COMMON_PATH . '/head.php'; //Import the head markup
	include  COMMON_PATH . '/header.php'; //Import the header markup
?>
<?php
	if (is_post_request()) {
		/*Retrieve the Signup Form inputs and store them in $signup_creds array*/
		$signup_creds = [];
		$signup_creds['username'] = $_POST['username'] ?? "";
		$signup_creds['password_text'] = $_POST['password'] ?? "";
		$signup_creds['password'] = password_hash($signup_creds['password_text'], PASSWORD_BCRYPT);

		if (!check_user_exists($db_connection,$signup_creds)) { //Check if the user doesn't exists by passing the form inputs in the check_user_exists function
			if (create_user($db_connection,$signup_creds)) { //We store the user credentials (username and pasword) in the database 
				$success_signup = "Your account has been successfully created. "; //If the database query is executed successfully, we define the $success_signup message
			}else{
				$error_signup = "Error creating account, please try again"; //If the database query is NOT executed successfully, we define the $error_signup message
			}
		}else{
 			$error_signup = "This user already exists in our system"; //In case the username input exists, the $error_signup message is declared
		}
	}
?>
<main>
	<div class="container">
		<h1 class="text-center">Signup</h1>
		<div class="signin-signup-form-wrapper">
			<form action="<?php echo url_for('content/signup.php'); ?>" method="POST">
				<p>Do you already have an account? <a href="<?php echo url_for('content/login.php'); ?>">Login</a></p>
				<label for="username">Username</label>
				<input type="text" name="username" id="username" required>
				<label for="password">Password</label>
				<input type="password" name="password" id="password" required>
				<?php
					//Display the $error_signup message declared
					if (isset($error_signup)) {
						echo "<p>".$error_signup."</p>";
					}
					//Display the $success_signup message declared
					if (isset($success_signup)) {
						echo "<p>".$success_signup."<a href=\"".url_for('content/login.php')."\">Login</a></p>";
					}
				?>
				<button type="submit" class="submit-button">Register</button>
			</form>
		</div>
	</div>
</main>

<?php
	include COMMON_PATH . '/footer.php';
?>