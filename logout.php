<?php

	// Start the session
	if (session_id() === "") { 
		session_start();
	}
	
	unset($_SESSION['authenticatedUser']);
	
	if (isset($_SESSION['lastPage'])) {
		header('Location: '.$_SESSION['lastPage']); 	
	} else {
		header('Location: index.php');
	}
	exit;

?>