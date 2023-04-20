	<footer>
		
	</footer>
</body>
<script type="text/javascript" src="<?php echo url_for('assets/js/script.js'); ?>"></script>
<?php
	if ($page_title=="Dashboard") {
		/* call the notifications script if we are on user's dashboard page */
?>
<script type="text/javascript">
	
		if (Notification.permission!=="granted") {
			Notification.requestPermission(); /* if notifications are not granted by user, we ask for permission */
		}else{
			var xhr = new XMLHttpRequest(); /*Initialize the AJAX request*/

			xhr.onload = function(){
				var userGoals = JSON.parse(xhr.responseText);/* We get the user goals data in JSON format */

				for(i=0;i<userGoals.length;i++){
					const goalTitle = userGoals[i].goal_title;

					const goalDate = new Date(userGoals[i].goal_date);
					const todayDate = new Date();
					/* calculate the remaining days for each goal */
					const diffTime = goalDate - todayDate;
					const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

					/* check if there are less than 3 days left and send a notification by calling the sendNotification function */
					if (diffDays<3 && diffDays>0) {
						let sentNotification = sessionStorage.getItem("sentNotification");

						if (!sentNotification || sentNotification!=="sent") {
							sendNotification(goalTitle,diffDays);
						}

					}
				}
			}

			xhr.open("POST","get_user_goals.php");
			xhr.send();
		}

		function sendNotification(goalTitle,daysLeft){
			var notification = new Notification(goalTitle,{
				body:"You have "+daysLeft+" left to achieve your "+goalTitle
			})
			sessionStorage.setItem("sentNotification","sent")
		}
	
</script>
<?php
	}
?>
</html>
<?php
	close_database_connection($db_connection);
?>