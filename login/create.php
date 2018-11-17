<?php

error_reporting(0);
// Starting Session
$error = '';
// Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = 'Username or Password is invalid <br/><b id="index"><a href="index.php">LOGIN</a></b>';
	} else {
		// Define $username and $password
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$role = "user";
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		include './db/connect.php';

		$stid = oci_parse($conn, 'BEGIN insert_USER(:username, :password, :role); END;');
		if (!$stid) {
			$e = oci_error($conn);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		oci_bind_by_name($stid, ':username', $username);
		oci_bind_by_name($stid, ':password', $password);
		oci_bind_by_name($stid, ':role', $role);
		
		// Perform the logic of the query
		$r = oci_execute($stid);
		/*if (!$r) {
			//echo "!R";
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}*/

		
		if ($r) {
			
			$error = 'Signed up <br/><b id="index"><a href="index.php">LOGIN</a></b>';
			//$_SESSION['login_user'] = $username;
			// Initializing Session
			//header("location: ./login/profile.php"); // Redirecting To Other Page
		} else {
			$error = 'Username or Password is invalid, or Username already taken<br/><b id="index"><a href="index.php">LOGIN</a></b>';
		}
		include './db/disconnect.php';
	}
}
?>