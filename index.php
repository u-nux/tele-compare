<?php
include ('login/login.php');
// Includes Login Script
?>
<!DOCTYPE html>
<html>
<head>
	<title>Enter the Matrix</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div><b id="ask_question"><a href="sendmessage.php">Ask us question.</a></b></div>
	<!--<a id="tour" href="#" class="button"><span>Demo</span></a>-->
	
	<div id="main">
	<h1>Enter the Matrix</h1>
	<div id="login">
		<h2>Login</h2>
		<form action="" method="post">
		<label>UserName :</label>
		<input id="name" name="username" placeholder="username" type="text">
		<label>Password :</label>
		<input id="password" name="password" placeholder="**********" type="password">
		<input name="submit" type="submit" value=" Login ">
		<span><?php echo $error; ?></span>
		<b id="create_account"><a href="create_acc.php">Create User Account</a></b>
	</form>
	</div>
	</div>

</body>
</html>