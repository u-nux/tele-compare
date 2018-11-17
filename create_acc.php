<?php
include ('login/create.php');
// Includes Login Script
?>
<!DOCTYPE html>
<html>
<head>
	<title>Enter the Matrix</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="main">
	<h1>Signup to Matrix</h1>
	<div id="login">
		<h2>Create</h2>
		<form action="" method="post">
		<label>UserName :</label>
		<input id="name" name="username" placeholder="username" type="text">
		<label>Password :</label>
		<input id="password" name="password" placeholder="**********" type="password">
		<input name="submit" type="submit" value=" Create ">
		<span><?php echo $error; ?></span>
		
		
	</form>
	</div>
	</div>
</body>
</html>