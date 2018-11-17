<?php
include ('../login/session.php');
include '../db/connect.php';
//print_r($_GET);

$t_avgbrand = oci_parse($conn, 'select avg (price) as avg_price from T_Phone');
if (!$t_avgbrand) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_avgbrand = oci_execute($t_avgbrand);
if (!$r_t_avgbrand) {

	$e = oci_error($t_avgbrand);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_minbrand = oci_parse($conn, 'select sum (price) as total_price from T_Phone');
if (!$t_minbrand) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_minbrand = oci_execute($t_minbrand);
if (!$r_t_minbrand) {

	$e = oci_error($t_minbrand);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_mostexpensive = oci_parse($conn, 'Select * From V_most_expensive');
if (!$t_mostexpensive) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_mostexpensive = oci_execute($t_mostexpensive);
if (!$r_t_mostexpensive) {

	$e = oci_error($t_mostexpensive);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_minprice = oci_parse($conn, 'SELECT distinct Brand_Name,Phone_Model,price FROM  T_Brand natural join T_Phone WHERE  price =(SELECT  MIN (price) FROM  T_Phone)');
if (!$t_minprice) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_minprice = oci_execute($t_minprice);
if (!$r_t_minprice) {

	$e = oci_error($t_minprice);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_biggestlcd = oci_parse($conn, 'Select * From V_biggest_LCD');
if (!$t_biggestlcd) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_biggestlcd = oci_execute($t_biggestlcd);
if (!$r_t_biggestlcd) {

	$e = oci_error($t_biggestlcd);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_phonenumrows = oci_parse($conn, "SELECT distinct num_rows FROM user_tables where table_name='T_PHONE'");
if (!$t_phonenumrows) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_phonenumrows = oci_execute($t_phonenumrows);
if (!$r_t_phonenumrows) {

	$e = oci_error($t_phonenumrows);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>PHP Form processing example</title>
		<!-- define some style elements-->
		<style>
			label, a {
				font-family: Arial, Helvetica, sans-serif;
				font-size: 12px;
			}

			body {
				text-align: center;
			}
			#images {
				width: 400px;
				height: 250px;
				overflow: hidden;
				position: relative;
				margin: 20px auto;
			}
			#images img {
				width: 400px;
				height: 250px;
				position: absolute;
				top: 0;
				left: -400px;
				z-index: 1;
				opacity: 0;
				transition: all linear 500ms;
				-o-transition: all linear 500ms;
				-moz-transition: all linear 500ms;
				-webkit-transition: all linear 500ms;
			}
			#images img:target {
				left: 0;
				z-index: 9;
				opacity: 1;
			}
			#images img:first-child {
				left: 0;
				opacity: 1;
			}
			#slider a {
				text-decoration: none;
				background: #E3F1FA;
				border: 1px solid #C6E4F2;
				padding: 4px 6px;
				color: #222;
			}
			#slider a:hover {
				background: #C6E4F2;
			}

		</style>
	</head>

	<body>
		<table border='1'>
		<tr><td>Statistics</td><td>Values</td></tr>
		<tr><td>Avarage Phone Price</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_avgbrand, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print $row["AVG_PRICE"]." $ ";

			}
			 ?></ul></td></tr>
			 
			 <tr><td>Total Price of Phones</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_minbrand, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print $row["TOTAL_PRICE"]." $ ";

				//print "-> ";
				//print_r($row);
				//print "\n";

			}
			 ?></ul></td></tr>
			 
			<tr><td>The Most Expensive Phone</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_mostexpensive, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print $row["BRAND_NAME"] . "  " . $row["PHONE_MODEL"] . "  price: " . $row["PRICE"]." $ ";
				//print "-> ";
				//print_r($row);
				//print "\n";

			}
			 ?></ul></td></tr>
			 
			<tr><td>The Cheapest Phone</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_minprice, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print $row["BRAND_NAME"] . "  " . $row["PHONE_MODEL"] . "  price: " . $row["PRICE"] ." $ ";
				//print "-> ";
				//print_r($row);
				//print "\n";

			}
			 ?></ul></td></tr>
			 
			 <tr><td>Phone With The Biggest LCD</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_biggestlcd, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print $row["BRAND_NAME"] . "  " . $row["PHONE_MODEL"] . "  price: " . $row["PRICE"]." $ " . "  lcd: " . $row["DISPLAY_SIZE"]." inches ";
				//print "-> ";
				//print_r($row);
				//print "\n";

			}
			 ?></ul></td></tr>
			 
			  <tr><td>Phone Count</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_phonenumrows, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print $row["NUM_ROWS"];
				//print "-> ";
				//print_r($row);
				//print "\n";

			}
			 ?></ul></td></tr>
			 
			 
			 
			 
			 

</table>
	</body>
</html>

<?php
include '../db/disconnect.php';
 ?>