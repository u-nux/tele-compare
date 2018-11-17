<?php
date_default_timezone_set('Asia/Istanbul');
ob_start();
$file = "../files/temp/download.txt";
$handle = fopen($file, 'w');
include ('../login/session.php');
include '../db/connect.php';
//print_r($_GET);

$t_phone = oci_parse($conn, 'select distinct Phone_Model, Price, Release_Date, Height,Width,Thickness,Weight,StandBy_Time,Talk_Time,Details from T_PHONE where phone_ID = ' . $_GET["ID"]);
if (!$t_phone) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_phone = oci_execute($t_phone);
if (!$r_t_phone) {

	$e = oci_error($t_phone);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_battery = oci_parse($conn, 'select distinct Type, Capacity, More_Details from T_PHONE NATURAL JOIN T_Battery where phone_ID = ' . $_GET["ID"]);
if (!$t_battery) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_battery = oci_execute($t_battery);
if (!$r_t_battery) {

	$e = oci_error($t_battery);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_brand = oci_parse($conn, 'select distinct Brand_Name, Establishment_Date, Website_URL from T_PHONE NATURAL JOIN T_Brand where phone_ID = ' . $_GET["ID"]);
if (!$t_brand) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_brand = oci_execute($t_brand);
if (!$r_t_brand) {

	$e = oci_error($t_brand);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_cpu = oci_parse($conn, 'select distinct Model, Processor_Speed from T_PHONE NATURAL JOIN T_CPU where phone_ID = ' . $_GET["ID"]);
if (!$t_cpu) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_cpu = oci_execute($t_cpu);
if (!$r_t_cpu) {

	$e = oci_error($t_cpu);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_display = oci_parse($conn, 'select distinct Display_Size, Display_Description,Resolution,Pixel_Density,Technology,Touchscreen  from T_PHONE NATURAL JOIN T_Display where phone_ID = ' . $_GET["ID"]);
if (!$t_display) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_display = oci_execute($t_display);
if (!$r_t_display) {

	$e = oci_error($t_display);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_memory = oci_parse($conn, 'select distinct Ram_Size, Internal_Memory, Card_Slot  from T_PHONE NATURAL JOIN T_Memory where phone_ID = ' . $_GET["ID"]);
if (!$t_memory) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_memory = oci_execute($t_memory);
if (!$r_t_memory) {

	$e = oci_error($t_memory);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_os = oci_parse($conn, 'select distinct OS_Description, Version  from T_PHONE NATURAL JOIN T_Operating_System where phone_ID = ' . $_GET["ID"]);
if (!$t_os) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_os = oci_execute($t_os);
if (!$r_t_os) {

	$e = oci_error($t_os);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_sim = oci_parse($conn, 'select distinct SIM_Size  from T_PHONE NATURAL JOIN T_SIM where phone_ID = ' . $_GET["ID"]);
if (!$t_sim) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_sim = oci_execute($t_sim);
if (!$r_t_sim) {

	$e = oci_error($t_sim);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_picture = oci_parse($conn, 'select distinct picture from T_picture natural join T_PHONE_PICTURE where phone_ID = ' . $_GET["ID"]);
if (!$t_picture) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_picture = oci_execute($t_picture);
if (!$r_t_picture) {

	$e = oci_error($t_picture);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_camera = oci_parse($conn, 'select distinct Camera_Description,Quality,Image_Size,Video_Quality,Front_Camera  from T_Camera natural join T_PHONE_Camera where phone_ID = ' . $_GET["ID"]);
if (!$t_camera) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_camera = oci_execute($t_camera);
if (!$r_t_camera) {

	$e = oci_error($t_camera);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_color = oci_parse($conn, 'select distinct Colour_Name from T_Colour natural join T_PHONE_Colour where phone_ID = ' . $_GET["ID"]);
if (!$t_color) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_color = oci_execute($t_color);
if (!$r_t_color) {

	$e = oci_error($t_color);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_feature = oci_parse($conn, 'select distinct Feature_Descriptions,Details from T_Feature natural join T_PHONE_Feature where phone_ID = ' . $_GET["ID"]);
if (!$t_feature) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_feature = oci_execute($t_feature);
if (!$r_t_feature) {

	$e = oci_error($t_feature);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_language = oci_parse($conn, 'select distinct Language_Description from T_Language natural join T_PHONE_Language where phone_ID = ' . $_GET["ID"]);
if (!$t_language) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_language = oci_execute($t_language);
if (!$r_t_language) {

	$e = oci_error($t_language);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_network = oci_parse($conn, 'select distinct Generation, System, Frequency_band   from T_Network natural join T_PHONE_Network where phone_ID = ' . $_GET["ID"]);
if (!$t_network) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_network = oci_execute($t_network);
if (!$r_t_network) {

	$e = oci_error($t_network);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$t_review = oci_parse($conn, 'select distinct Review_File,Comments  from T_Review natural join T_PHONE_Review where phone_ID = ' . $_GET["ID"]);
if (!$t_review) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r_t_review = oci_execute($t_review);
if (!$r_t_review) {

	$e = oci_error($t_review);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Phone</title>
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
		<?php
		print '<div id="images">';
		$i = 1;
		while ($row = oci_fetch_array($t_picture, OCI_ASSOC + OCI_RETURN_NULLS)) {
			print '<img id="image' . $i . '" src="' . $row['PICTURE'] . '" />';
			$i++;
		}
		print '</div>';
		print '<div id="slider">';

		$j = 1;
		while ($j < $i) {
			print '<a href="#image' . $j . '">' . $j . '</a>';
			$j++;

		}
		print '</div>';
	?>
		<table border='1'>
		<tr><td>Phone Specs.</td><td>Specs</td></tr>
		<tr><td>Phone</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_phone, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print "<li>Model: " . $row["PHONE_MODEL"] . "</li>";
				print "<li>Price: " . $row["PRICE"] . " $</li>";
				print "<li>Release Date: " . $row["RELEASE_DATE"] . "</li>";
				print "<li>Height: " . $row["HEIGHT"] . " mm</li>";
				print "<li>Width: " . $row["WIDTH"] . " mm</li>";
				print "<li>Thickness: " . $row["THICKNESS"] . " mm</li>";
				print "<li>Weight: " . $row["WEIGHT"] . " gr</li>";
				print "<li>Standby Time: " . $row["STANDBY_TIME"] . " Hours</li>";
				print "<li>Talk Time: " . $row["TALK_TIME"] . " min</li>";
				print "<li>Details: " . $row["DETAILS"] . "</li>";

				$string = "PHONE:\nModel: " . $row["PHONE_MODEL"] . "\n";
				$string = $string . "Price: " . $row["PRICE"] . " $\n";
				$string = $string . "Release Date: " . $row["RELEASE_DATE"] . "\n";
				$string = $string . "Height: " . $row["HEIGHT"] . " mm\n";
				$string = $string . "Width: " . $row["WIDTH"] . " mm\n";
				$string = $string . "Thickness: " . $row["THICKNESS"] . " mm\n";
				$string = $string . "Weight: " . $row["WEIGHT"] . " gr\n";
				$string = $string . "Standby Time: " . $row["STANDBY_TIME"] . " Hours\n";
				$string = $string . "Talk Time: " . $row["TALK_TIME"] . " min\n";
				$string = $string . "Details: " . $row["DETAILS"] . "\n";

				fwrite($handle, $string);

				$logstr = "BEGIN insert_Log('" . $_SESSION['login_role'] . ":" . $_SESSION['login_user'] . "',CURRENT_TIMESTAMP,'LOOK PHONE:" . $row["PHONE_MODEL"] . "'); END;";
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
			 ?></ul></td></tr>
			 
			 <tr><td>Battery</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_battery, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print "<li>Type: " . $row["TYPE"] . "</li>";
				print "<li>Capacity: " . $row["CAPACITY"] . " mAh</li>";
				print "<li>More Details: " . $row["MORE_DETAILS"] . "</li>";

				$string = "\n\nBATTERY:\nType: " . $row["TYPE"] . "\n";
				$string = $string . "Capacity: " . $row["CAPACITY"] . " mAh\n";
				$string = $string . "More Details: " . $row["MORE_DETAILS"] . "\n";

				fwrite($handle, $string);

			}
			 ?></ul></td></tr>
			 
			<tr><td>Brand</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_brand, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print "<li>Brand_Name: " . $row["BRAND_NAME"] . "</li>";
				print "<li>Establishment_Date: " . $row["ESTABLISHMENT_DATE"] . "</li>";
				print "<li>Website_URL: " . $row["WEBSITE_URL"] . "</li>";

				$string = "\n\nBRAND:\nBrand_Name: " . $row["BRAND_NAME"] . "\n";
				$string = $string . "Establishment_Date: " . $row["ESTABLISHMENT_DATE"] . "\n";
				$string = $string . "Website_URL: " . $row["WEBSITE_URL"] . "\n";

				fwrite($handle, $string);

			}
			 ?></ul></td></tr>
			 
			<tr><td>CPU</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_cpu, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print "<li>Model: " . $row["MODEL"] . "</li>";
				print "<li>Processor Speed: " . $row["PROCESSOR_SPEED"] . " GHz</li>";

				$string = "\n\nCPU:\nModel: " . $row["MODEL"] . "\n";
				$string = $string . "Processor Speed: " . $row["PROCESSOR_SPEED"] . " GHz\n";

				fwrite($handle, $string);

			}
			 ?></ul></td></tr>
			 
			 <tr><td>Display</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_display, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print "<li>Display_Size: " . $row["DISPLAY_SIZE"] . " inches</li>";
				print "<li>Display_Description: " . $row["DISPLAY_DESCRIPTION"] . "</li>";
				print "<li>Resolution: " . $row["RESOLUTION"] . "</li>";
				print "<li>Pixel_Density: " . $row["PIXEL_DENSITY"] . " ppi</li>";
				print "<li>Technology: " . $row["TECHNOLOGY"] . "</li>";
				print "<li>Touchscreen: " .  (($row["TOUCHSCREEN"] == "Y") ? "Yes" : "No")  . "</li>";

				$string = "\n\nDISPLAY:\nDisplay_Size: " . $row["DISPLAY_SIZE"] . " inches\n";
				$string = $string . "Display_Description: " . $row["DISPLAY_DESCRIPTION"] . "\n";
				$string = $string . "Resolution: " . $row["RESOLUTION"] . "\n";
				$string = $string . "Pixel_Density: " . $row["PIXEL_DENSITY"] . " ppi\n";
				$string = $string . "Technology: " . $row["TECHNOLOGY"] . "\n";
				$string = $string . "Touchscreen: " . (($row["TOUCHSCREEN"] == "Y") ? "Yes" : "No") . "\n";

				fwrite($handle, $string);

			}
			 ?></ul></td></tr>
			 
			  <tr><td>Memory</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_memory, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print "<li>Ram_Size: " . $row["RAM_SIZE"] . "</li>";
				print "<li>Internal_Memory: " . $row["INTERNAL_MEMORY"] . " Gb</li>";
				print "<li>Card_Slot: " . (($row["CARD_SLOT"] == "Y") ? "Yes" : "No") . "</li>";

				$string = "\n\nMEMORY:\nRam_Size: " . $row["RAM_SIZE"] . "\n";
				$string = $string . "Internal_Memory: " . $row["INTERNAL_MEMORY"] . " Gb\n";
				$string = $string . "Card_Slot: " . (($row["CARD_SLOT"] == "Y") ? "Yes" : "No") . "\n";

				fwrite($handle, $string);

			}
			 ?></ul></td></tr>
			 
			<tr><td>Operating System</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_os, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print "<li>OS_Description: " . $row["OS_DESCRIPTION"] . "</li>";
				print "<li>Version: " . $row["VERSION"] . "</li>";

				$string = "\n\nOPERATING SYSTEM:\nOS_Description: " . $row["OS_DESCRIPTION"] . "\n";
				$string = $string . "Version: " . $row["VERSION"] . "\n";

				fwrite($handle, $string);

			}
			 ?></ul></td></tr>
			 
						<tr><td>SIM</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_sim, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print "<li>SIM_Size: " . $row["SIM_SIZE"] . "</li>";

				$string = "\n\nSIM:\nSIM_Size: " . $row["SIM_SIZE"] . "\n";

				fwrite($handle, $string);

			}
			 ?></ul></td></tr>
			 
			 
			 
			<tr><td>Camera</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_camera, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print "<li>Camera_Description: " . $row["CAMERA_DESCRIPTION"] . "</li>";
				print "<li>Quality: " . $row["QUALITY"] . " MP</li>";
				print "<li>Image_Size: " . $row["IMAGE_SIZE"] . "</li>";
				print "<li>Video_Quality: " . $row["VIDEO_QUALITY"] . "</li>";
				print "<li>Front_Camera: " . $row["FRONT_CAMERA"] . "</li>";

				$string = "\n\nCAMERA:\nCamera_Description: " . $row["CAMERA_DESCRIPTION"] . "\n";
				$string = $string . "Quality: " . $row["QUALITY"] . " MP\n";
				$string = $string . "Image_Size: " . $row["IMAGE_SIZE"] . "\n";
				$string = $string . "Video_Quality: " . $row["VIDEO_QUALITY"] . "\n";
				$string = $string . "Front_Camera: " . $row["FRONT_CAMERA"] . "\n\n\n";

				fwrite($handle, $string);

			}
			 ?></ul></td></tr>
			 
						 
			 			<tr><td>Colour</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_color, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print "<li>" . $row["COLOUR_NAME"] . "</li>";

				$string = "COLOUR: " . $row["COLOUR_NAME"] . "\n";

				fwrite($handle, $string);

			}
			 ?></ul></td></tr>
			 
			 			 
			 			<tr><td>Feature</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_feature, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print "<li>Feature_Descriptions: " . $row["FEATURE_DESCRIPTIONS"] . "</li>";
				print "<li>Details: " . $row["DETAILS"] . "</li>";

				$string = "\nFEATURE: " . $row["FEATURE_DESCRIPTIONS"] . "";
				$string = $string . "\nDetails: " . $row["DETAILS"] . "\n";

				fwrite($handle, $string);

			}
			 ?></ul></td></tr>
			 
			  			 
			 			<tr><td>Language</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_language, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print "<li>" . $row["LANGUAGE_DESCRIPTION"] . "</li>";

				$string = "\nLANGUAGE:" . $row["LANGUAGE_DESCRIPTION"] . "";

				fwrite($handle, $string);

			}
			 ?></ul></td></tr>
			 
			  			 
			 			<tr><td>Network</td>
			<td><ul><?php
			$network = "";
			$string = "\n\nNETWORK:\n";
			while ($row = oci_fetch_array($t_network, OCI_ASSOC + OCI_RETURN_NULLS)) {
				$network .= "<li>".$row["GENERATION"] . "&nbsp;&nbsp;" . $row["SYSTEM"] . "&nbsp;&nbsp;" . $row["FREQUENCY_BAND"] . "</li>";
				$string .= "\n".$row["GENERATION"] . "/" . $row["SYSTEM"] . "/" . $row["FREQUENCY_BAND"] . "";
			}
			print $network . "";
			

			$string .= "\n";

			fwrite($handle, $string);
			 ?></ul></td></tr>
			 
			   			 
			 			<tr><td>Reviews</td>
			<td><ul><?php
			while ($row = oci_fetch_array($t_review, OCI_ASSOC + OCI_RETURN_NULLS)) {
				print "<li>Review_File: <a href=\"" . $row["REVIEW_FILE"] . "\">file</a></li>";
				print "<li>Comments: " . $row["COMMENTS"] . "</li>";

			}
			 ?></ul></td></tr>
			 
			 
			 
			 

</table>
	</body>
</html>

<?php
include '../db/disconnect.php';

file_put_contents('../files/temp/download.html', ob_get_contents());
//file_put_contents('../files/temp/download.txt', ob_get_contents());

include "../apps/dompdf/dompdf_config.inc.php";
//define("DOMPDF_TEMP_DIR", "../temp");

$dompdf = new DOMPDF();

//$dompdf->set_paper("A4");
$dompdf -> load_html(ob_get_contents());
$dompdf -> render();

$output = $dompdf -> output();
file_put_contents("../files/temp/download.pdf", $output);

print '<h1><a  href="../files/temp/download.html" download>HTML</a></h1>';
print '<h1><a  href="../files/temp/download.txt" download>TXT</a></h1>';
print '<h1><a  href="../files/temp/download.pdf" download>PDF</a></h1>';

//print_r($_dompdf_debug);
//print_r($_dompdf_warnings);
//$dompdf->stream("hello.pdf", array("Attachment" => 1));
 ?>