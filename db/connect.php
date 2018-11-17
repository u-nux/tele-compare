<?php

$conn = oci_connect('b21100618', 'EspinasVTYS7', '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = dbs.cs.hacettepe.edu.tr)(PORT = 1521)) (CONNECT_DATA = (SID = ORAVT)))');
if (!$conn) {
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid_b = oci_parse($conn, 'BEGIN refresh_statistics; END;');
if (!$stid_b) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_b = oci_execute($stid_b);
if (!$r_b) {

	$e = oci_error($stid_b);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>