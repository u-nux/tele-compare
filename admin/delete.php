<?php

$id1 = $_GET["ID"];
$id2 = $_GET["IDX"];

//print $tablename;

switch ($tablename) {
	case 'T_PHONE_LANGUAGE' :
		$sqlstr = "BEGIN delete_Phone_Language(" . $id1 .",".$id2. "); END;";
		
		break;

	case 'T_PHONE_NETWORK' :
		$sqlstr = "BEGIN delete_Phone_Network(" . $id1 .",".$id2. "); END;";
		break;

	case 'T_PICTURE' :
		$sqlstr = "BEGIN delete_Picture(" . $id1 . "); END;";
		print $sqlstr;
		break;

	case 'T_REVIEW' :
		$sqlstr = "BEGIN delete_Review(" . $id1 . "); END;";
		break;

	case 'T_COLOUR' :
		$sqlstr = "BEGIN delete_Colour(" . $id1 . "); END;";
		break;

	case 'T_LANGUAGE' :
		$sqlstr = "BEGIN delete_Language(" . $id1 . "); END;";
		break;

	case 'T_OPERATING_SYSTEM' :
		$sqlstr = "BEGIN delete_Operating_System(" . $id1 . "); END;";
		break;

	case 'T_NETWORK' :
		$sqlstr = "BEGIN delete_Network(" . $id1 . "); END;";
		break;

	case 'T_BRAND' :
		$sqlstr = "BEGIN delete_Brand(" . $id1 . "); END;";
		break;

	case 'T_FEATURE' :
		$sqlstr = "BEGIN delete_Feature(" . $id1 . "); END;";
		break;

	case 'T_DISPLAY' :
		$sqlstr = "BEGIN delete_Display(" . $id1 . "); END;";
		break;
	case 'T_CPU' :
		$sqlstr = "BEGIN delete_CPU(" . $id1 . "); END;";
		print "zDD";
		break;

	case 'T_CAMERA' :
		$sqlstr = "BEGIN delete_Camera(" . $id1 . "); END;";
		break;

	case 'T_MEMORY' :
		$sqlstr = "BEGIN delete_Memory(" . $id1 . "); END;";
		break;

	case 'T_BATTERY' :
		$sqlstr = "BEGIN delete_Battery(" . $id1 . "); END;";
		break;

	case 'T_PHONE_FEATURE' :
		$sqlstr = "BEGIN delete_Phone_Feature(" . $id1 .",".$id2. "); END;";
		break;

	case 'T_USER' :
		//$sqlstr = "BEGIN delete_(" . $id1 . "); END;";
		$sqlstr = "BEGIN delete_USER('" . $id1 . "'); END;";
		break;

	case 'T_PHONE_COLOUR' :
		$sqlstr = "BEGIN delete_Phone_Colour(" . $id1 .",".$id2. "); END;";
		break;

	case 'T_PHONE_CAMERA' :
		$sqlstr = "BEGIN delete_Phone_Camera(" . $id1 .",".$id2. "); END;";
		break;

	case 'T_SIM' :
		$sqlstr = "BEGIN delete_SIM(" . $id1 . "); END;";
		break;

	case 'T_PHONE_PICTURE' :
		$sqlstr = "BEGIN delete_Phone_Picture(" . $id1 .",".$id2. "); END;";
		break;

	case 'T_PHONE_REVIEW' :
		$sqlstr = "BEGIN delete_Phone_Review(" . $id1 .",".$id2. "); END;";
		break;

	case 'T_PHONE' :
		$sqlstr = "BEGIN delete_Phone(" . $id1 . "); END;";
		break;

	case 'T_QUESTION' :
		$sqlstr = "BEGIN delete_Question(" . $id1 . "); END;";
		break;

	default :
		break;
}

$stid_d = oci_parse($conn, $sqlstr);
if (!$stid_d) {
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$r_d = oci_execute($stid_d);
if (!$r_d) {
	//echo "!R";
	$e = oci_error($stid_d);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

if ($r_d) {
	//print "okdelete ";
	//$error = 'Signed up <br/><b id="index"><a href="index.php">LOGIN</a></b>';
	//$_SESSION['login_user'] = $username;
	// Initializing Session
	//header("location: ./login/profile.php"); // Redirecting To Other Page
} else {
	//print "goddam";
	$error = "ERROR";
}
?>