<?php
$error = "Ready..";

error_reporting(0);
// Starting Session
$error = '';
// Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['email']) || empty($_POST['question'])) {
		$error = "missing or invalid form input";
	} else {
		// Define $username and $password
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		$question = $_POST['question'];
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		include './db/connect.php';

		$stid = oci_parse($conn, 'BEGIN insert_Question(:name, :surname, :email, :question); END;');
		if (!$stid) {
			$e = oci_error($conn);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		oci_bind_by_name($stid, ':name', $name);
		oci_bind_by_name($stid, ':surname', $surname);
		oci_bind_by_name($stid, ':email', $email);
		oci_bind_by_name($stid, ':question', $question);

		// Perform the logic of the query
		$r = oci_execute($stid);
		if (!$r) {
			//echo "!R";
			$e = oci_error($stid);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		if ($r) {

			$error = 'Sent! <br/><b id="index"><a href="index.php">Homepage</a></b>';
			//$_SESSION['login_user'] = $username;
			// Initializing Session
			//header("location: ./login/profile.php"); // Redirecting To Other Page
		} else {
			$error = "invalid form input";
		}
		include './db/disconnect.php';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ask Question</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="main">
		<b id="index"><a href="index.php">LOGIN</a></b>
	<h1>Ask Question</h1>
	<div id="login">
		<h2>Any question will be answered.</h2>
		<form action="" method="post">
		<label>Name :</label>
		<input id="name" name="name" placeholder="name" type="text">
		<label>Surname :</label>
		<input id="surname" name="surname" placeholder="surname" type="text">
		<label>E-mail :</label>
		<input id="email" name="email" type="email" placeholder="bbm@bbm.hacettepe.edu.tr" type="password">
		<label>Question :</label>
		<textarea name="question" cols="40" rows="6" placeholder="any question?"></textarea>

		
		
		<input name="submit" type="submit" value=" Send ">
		<span><?php echo $error; ?></span>
		<!--<b id="create_account"><a href="create_acc.php">Create User Account</a></b>-->
	</form>
	</div>
	</div>
</body>
</html>