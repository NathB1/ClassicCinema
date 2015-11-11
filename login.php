<?php
	
	// Start the session
	if (session_id() === "") { 
		session_start();
	}
	
	if (isset($_POST['loginUser']) && isset($_POST['loginPassword'])) {
		$con = new mysqli('sapphire', 'nblomfield', 'oR69754', 'nblomfield_dev');
		if ($con->connect_errno) {
			// Something went wrong with the connection.
			echo "<p>Cannot connect to the database. Please try again later.</p>";
		}

		$username = $con->real_escape_string($_POST['loginUser']);
		$password = $con->real_escape_string($_POST['loginPassword']);

		$query = "SELECT * FROM Users WHERE username = \"$username\" AND password = SHA(\"$password\");";
		$result = $con->query($query);

		if ($result->num_rows === 1) {
			$_SESSION['authenticatedUser'] = $username;

			if (isset($_SESSION['PHP_SELF'])) {
				header('Location: '.$_SESSION['PHP_SELF']);
			} else {
				header('Location: index.php');
			}
			exit;
		} else {
			echo "<p>Login unsuccessful</p>";
		}

		$result->free();
		$con->close();

	}

?>