<?php
	require_once '../include/config.php'; //Import the config script that contains the database connection, functions and database queries functions
	$page_title = "Login"; //Set the page title
	include  COMMON_PATH . '/head.php'; //Import the head markup
	include  COMMON_PATH . '/header.php'; //Import the header markup
?>
<?php
	if (is_post_request()) {
		/*Retrieve the Login Form inputs and store them in $login_creds array*/
		$login_creds = [];
		$login_creds['username'] = $_POST['username'] ?? "";
		$login_creds['password'] = $_POST['password'] ?? "";

		if (check_user_exists($db_connection,$login_creds)) { //Check if the user exists by passing the form inputs in the check_user_exists function
			if (check_user_password($db_connection,$login_creds)) { //Check if the password is correct by passing the form inputs in the check_user_exists function
				// In case both user exists and password is correct, we retrieve the user data from database and define the user id in the session variable and the user gets redirected to his dashboard
				$user = select_user_by_username($db_connection,$login_creds);
				$_SESSION['user_id'] = $user['id'];
				redirect_to('content/user/index.php');
			}else{
				$error_login = "Incorrect password"; //In case the password input is not correct, the $error_login message is declared
			}
		}else{
			$error_login = "This user doesn't exist in our system!"; //In case the username input doesn't exist, the $error_login message is declared
		}
	}

?>
<main>
	<div class="container">
		<h1 class="text-center">Login</h1>
		<div class="signin-signup-form-wrapper">
			<form action="<?php echo url_for('content/login.php'); ?>" method="POST">
				<p>Don't have an account yet? <a href="<?php echo url_for('content/signup.php'); ?>">Register</a></p>
				<label for="username">Username</label>
				<input type="text" name="username" id="username" required>
				<label for="password">Password</label>
				<input type="password" name="password" id="password" required>
				<?php
					//Display the $error_login message declared
					if (isset($error_login)) {
						echo "<p>".$error_login."</p>";
					}
				?>
				<button type="submit" class="submit-button">Login</button>
			</form>
		</div>
	</div>
</main>

<?php
	include COMMON_PATH . '/footer.php';
?>