<?php
	@session_start();
	if ($_POST &&
		$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && 
		isset($_SERVER['HTTP_REFERER']) && 
		$_SERVER['HTTP_REFERER'] == 'http://www.noelleanthony.com/query.php' &&
		$_POST['token'] == $_SESSION['token']) {		

		if(false) {
		} else {
			echo '{"success":"Query email sent successfully."}';	
		}

	} else {
		echo '{"error":"Not a valid request."}';
	}

?>