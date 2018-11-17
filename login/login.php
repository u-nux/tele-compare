<?php
session_start();
// Starting Session
$error = '';
// Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	} else {
		// Define $username and $password
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		include './db/connect.php';

		$stid = oci_parse($conn, 'select * from T_USER where USER_ID =:username AND PASS= :password');
		if (!$stid) {
			$e = oci_error($conn);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		oci_bind_by_name($stid, ':username', $username);
		oci_bind_by_name($stid, ':password', $password);

		

		// Perform the logic of the query
		$r = oci_execute($stid);
		if (!$r) {
			echo "!R";
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$row = oci_fetch_array($stid, OCI_ASSOC);
		
		print_r($row['ROL']);
		
		if ($row['ROL'] == "user") {
			$_SESSION['login_user'] = $username;
			$_SESSION['login_role'] = $row['ROL'];
			
			// Initializing Session
			header("location: ./user/index.php?formSubmit='notSubmit'"); // Redirecting To Other Page
		} else if ($row['ROL'] == "admin") {
			echo "2ok";
			$_SESSION['login_user'] = $username;
			$_SESSION['login_role'] = $row['ROL'];
			
			// Initializing Session
			header("location: ./admin/admin.php"); // Redirecting To Other Page
		} else {
			$error = "Username or Password is invalid";
		}
		include './db/disconnect.php';
	}
}
?>