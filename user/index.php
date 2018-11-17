<?php
include ('../login/session.php');
include '../db/connect.php';

$cpu = oci_parse($conn, 'select CPU_ID, MODEL from T_CPU order by MODEL asc');
if (!$cpu) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_cpu = oci_execute($cpu);
if (!$r_cpu) {

	$e = oci_error($cpu);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$brand = oci_parse($conn, 'select BRAND_ID, BRAND_NAME from T_BRAND order by BRAND_NAME asc');
if (!$brand) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_brand = oci_execute($brand);
if (!$r_brand) {

	$e = oci_error($brand);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Your Home Page</title>
<link href="../style.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<link rel="stylesheet" href="../apps/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="../apps/fancybox/jquery.fancybox.pack.js"></script>

<style>
	label, a {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}

	input[type="text"] {
		border: 1px solid #ccc;
		font-family: raleway;
		font-size: 12px;
		margin-top: 8px;
		padding: 10px 10px 10px 5px;
		width: 6%;
	}

	input[type="submit"] {
		background-color: #ffbc00;
		border: 2px solid #ffcb00;
		border-radius: 5px;
		color: #fff;
		cursor: pointer;
		font-size: 14px;
		margin-bottom: 12px;
		padding: 6px;
		width: 20%;
	}

	* {
		margin: 0;
		padding: 0;
	}

	div {
		margin: 20px;
	}

	ul {
		list-style-type: none;
		width: 500px;
	}

	h1 {
		font: bold 30px/1.5 Helvetica, Verdana, sans-serif;
	}

	li img {
		float: left;
		margin: 0 15px 0 0;
	}

	li p {
		font: 200 16px/1.5 Georgia, Times New Roman, serif;
	}

	li {
		padding: 10px;
		overflow: auto;
	}

	li:hover {
		background: #eee;
		cursor: pointer;
	}

</style>
</head>
<body>
<div id="profile">
<b id="welcome">Welcome <?php echo $_SESSION['login_role']; ?>: <i><?php echo $login_session; ?></i></b>
<b id="logout"><a href="../login/logout.php">Log Out</a></b>
</div>

<div>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="get">

	<p>
		<label for='minPrice'>Min-Max Price? </label>
		<input type="text" name="minPrice" size="5" maxlength="5" value="" />
		<label for='maxPrice'>-</label>
		<input type="text" name="maxPrice" size="5" maxlength="5" value="" />
		
	</p>
 
 	<p>
		<label for='brands'>Brands?</label>
		<?php
		while ($row = oci_fetch_array($brand, OCI_ASSOC + OCI_RETURN_NULLS))
			print '<input type="checkbox" name="brand_list[]" value="' . $row["BRAND_ID"] . '"><label>' . $row["BRAND_NAME"] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>';
		 ?>
	</p>

	<p>
		<label for='minDisplay'>Min-Max Display Size(inch)? </label>
		<input type="text" name="minDisplay" size="5" maxlength="5" value="" />
		<label for='maxDisplay'>-</label>
		<input type="text" name="maxDisplay" size="5" maxlength="5" value="" />
		
	</p>
 
  <p>
	<label for='cpu'>CPU Model?</label>
  	<select name="cpu">
  	<option value="">Select...</option>
  	<?php
	while ($row = oci_fetch_array($cpu, OCI_ASSOC + OCI_RETURN_NULLS))
		print '<option value="' . $row["CPU_ID"] . '">' . $row["MODEL"] . '</option>';
	?>
     
	</select><br/>
  </p>
  
  <p>
		<label for='minPrice'>Camera Quality? </label>
		<input type="radio" name="cam" value="0" checked>All &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
		<input type="radio" name="cam" value="1" >&lt;5MP   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
		<input type="radio" name="cam" value="2" >&gt;=5MP and &lt;=8MP    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cam" value="3" >&gt;8MP and &lt;=13MP    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cam" value="4" >&gt;13MP	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</p>
 
<input type="submit" name="formSubmit" value="Submit" />
</form>	


</div>
<div id="phones">
<?php

if ($_GET['formSubmit'] == "Submit") {

	switch ($_GET["cam"]) {
		case '1' :
			$minQuality = "QUALITY >= 0";
			$maxQuality = "QUALITY < 5";

			break;
		case '2' :
			$minQuality = "QUALITY >= 5";
			$maxQuality = "QUALITY <= 8";

			break;
		case '3' :
			$minQuality = "QUALITY > 8";
			$maxQuality = "QUALITY <= 13";

			break;
		case '4' :
			$minQuality = "QUALITY > 13";
			$maxQuality = "QUALITY <= 999";

			break;

		default :
			$minQuality = "QUALITY >= 0";
			$maxQuality = "QUALITY <= 999";

			break;
	}

	$sqlstr = "select distinct phone_ID, phone_model, price from T_PHONE , T_Display where phone_ID in 
(select phone_ID from T_PHONE_CAMERA where camera_ID in 
(select camera_ID from T_camera where ";
	$sqlstr .= $minQuality;
	$sqlstr .= " and ";
	$sqlstr .= $maxQuality;
	$sqlstr .= " and FRONT_CAMERA ='F') ) ";

	$sqlstr .= ($_GET["minPrice"]) ? "and T_Phone.price >= " . $_GET["minPrice"] . " " : "";
	$sqlstr .= ($_GET["maxPrice"]) ? "and T_Phone.price <= " . $_GET["maxPrice"] . " " : "";

	$sqlstr .= ($_GET["minDisplay"]) ? "and T_Display.display_size >= " . $_GET["minDisplay"] . " " : "";
	$sqlstr .= ($_GET["maxDisplay"]) ? "and T_Display.display_size <= " . $_GET["maxDisplay"] . " " : "";

	$sqlstr .= ($_GET["cpu"]) ? "and CPU_ID = " . $_GET["cpu"] . " " : "";

	if (!empty($_GET['brand_list'])) {
		// Loop to store and display values of individual checked checkbox.
		$sqlstr .= "and (";
		foreach ($_GET['brand_list'] as $selected) {
			$sqlstr .= "T_Phone.Brand_ID =" . $selected . " or ";
		}
		$sqlstr .= "T_Phone.Brand_ID =0 ) ";
	}

	//echo $sqlstr;
	
	$phones = oci_parse($conn, $sqlstr);
	if (!$phones) {
		$e = oci_error($conn);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	// Perform the logic of the query
	$r_phones = oci_execute($phones);
	if (!$r_phones) {

		$e = oci_error($phones);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	} else {
		$logstr = "BEGIN insert_Log('".$_SESSION['login_role'].":".$_SESSION['login_user']."',CURRENT_TIMESTAMP,'FILTERS PHONE'); END;";
		$log = oci_parse($conn, $logstr);
		if (!$log) {
			$e = oci_error($conn);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Perform the logic of the query
		$r_log = oci_execute($log);
		if (!$r_log) {

			$e = oci_error($logs);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
	}

	print '<h1 style = "color: blue">PHONES</h1>';
	//print '<form action="" method="get">';
	while ($row = oci_fetch_array($phones, OCI_ASSOC + OCI_RETURN_NULLS)) {
		$photos = oci_parse($conn, 'select distinct picture from T_picture natural join T_PHONE_PICTURE where phone_ID =' . $row["PHONE_ID"]);
		if (!$photos) {
			$e = oci_error($conn);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Perform the logic of the query
		$r_photos = oci_execute($photos);
		if (!$r_photos) {

			$e = oci_error($photos);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		$row_p = oci_fetch_array($photos, OCI_ASSOC + OCI_RETURN_NULLS);

		print '<div>';
		print '<ul>';
		print '<li>';
		print ' <img src="' . $row_p["PICTURE"] . '" alt="phone_photo" height="150" width="150"> ';
		print '<h1><a  class="fancybox" title="' . $row["PHONE_MODEL"] . '" href="listing.php?ID=' . $row["PHONE_ID"] . '">' . $row["PHONE_MODEL"] . '</a></h1>';
		print ' <p style="color: red">' . $row['PRICE'] . '<small>,00 $</small></p>';
		//print '<p><input type="checkbox" name="phone_list[]" value="' . $row["PHONE_ID"] . '"><label>add to compare list</label></p>';
		//print '<h1><a title="' . $row["PHONE_MODEL"] . '" href="saveashtml.php?ID=' . $row["PHONE_ID"] . ' ">HTML</a></h1>';

		print '</li></ul></div>';

	}
	//print '<input class ="fancybox" type="submit" name="formSubmit" value="Compare" /></form>';

}
?>
 
</div>
<?php
include '../db/disconnect.php';
 ?>

<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox({
			type : 'iframe',
			maxWidth : 1600,
			maxHeight : 1200,
			fitToView : false,
			width : '80%',
			height : '80%',
			autoSize : false,
			closeClick : false,
			openEffect : 'none',
			closeEffect : 'none'
		});
	}); 
</script>

</body>
</html>
