<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
include '../db/connect.php';
// Selecting Database
//$db = mysql_select_db("company", $connection);

session_start();
// Starting Session
// Storing Session
$user_check = $_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
//$ses_sql=mysql_query("select username from login where username='$user_check'", $connection);
$stid = oci_parse($conn, 'select * from T_USER where USER_ID =:username');
if (!$stid) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

oci_bind_by_name($stid, ':username', $_SESSION['login_user']);

// Perform the logic of the query
$r = oci_execute($stid);
if (!$r) {

	$e = oci_error($stid);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$row = oci_fetch_array($stid, OCI_ASSOC);

//$row = mysql_fetch_assoc($ses_sql);
$login_session = $row['USER_ID'];

include '../db/disconnect.php';
if (!isset($login_session)) {
	
	//mysql_close($connection); // Closing Connection
	header('Location: ../index.php'); // Redirecting To Home Page
}
?>
