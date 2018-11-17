<?php
/*
echo "INSERT ";
print $tablename;
print_r($_GET);
$x1 = $_GET["x1"];
echo "INSERT ";
print $x1;
*/
switch ($tablename) {
	case 'T_PHONE_LANGUAGE' :
		$x1 = $_GET["x0"];
		$x2 = $_GET["x1"];
		$sqlstr = "BEGIN insert_Phone_Language(" . $x1 . "," . $x2 . "); END;";

		break;

	case 'T_PHONE_NETWORK' :
		$x1 = $_GET["x0"];
		$x2 = $_GET["x1"];
		$sqlstr = "BEGIN insert_Phone_Network(" . $x1 . "," . $x2 . "); END;";
		break;

	case 'T_PICTURE' :
		$x1 = $_GET["x1"];
		$sqlstr = "BEGIN insert_Picture('" . $x1 . "'); END;";
		print $sqlstr;
		break;

	case 'T_REVIEW' :
		$x1 = $_GET["x1"];
		$x2 = $_GET["x2"];
		$sqlstr = "BEGIN insert_Review('" . $x1 . "','" . $x2 . "'); END;";
		break;

	case 'T_COLOUR' :
		$x1 = $_GET["x1"];
		$sqlstr = "BEGIN insert_Colour('" . $x1 . "'); END;";
		break;

	case 'T_LANGUAGE' :
		$x1 = $_GET["x1"];
		$sqlstr = "BEGIN insert_Language('" . $x1 . "'); END;";
		break;

	case 'T_OPERATING_SYSTEM' :
		$x1 = $_GET["x1"];
		$x2 = $_GET["x2"];
		$sqlstr = "BEGIN insert_Operating_System('" . $x1 . "'," . $x2 . "); END;";
		break;

	case 'T_NETWORK' :
		$x1 = $_GET["x1"];
		$x2 = $_GET["x2"];
		$x3 = $_GET["x3"];

		$sqlstr = "BEGIN insert_Network('" . $x1 . "','" . $x2 . "'," . $x3 . "); END;";
		break;

	case 'T_BRAND' :
		$x1 = $_GET["x1"];
		$x2 = $_GET["x2"];
		$x3 = $_GET["x3"];

		$sqlstr = "BEGIN insert_Brand('" . $x1 . "',TO_DATE('" . $x2 . "', 'dd/mm/yyyy'),'" . $x3 . "'); END;";
		break;

	case 'T_FEATURE' :
		$x1 = $_GET["x1"];
		$x2 = $_GET["x2"];
		$sqlstr = "BEGIN insert_Feature('" . $x1 . "','" . $x2 . "'); END;";
		break;

	case 'T_DISPLAY' :
		//insert_Display(4.3,'tft','300*200',233,'ful hd','y');
		$x1 = $_GET["x1"];
		$x2 = $_GET["x2"];
		$x3 = $_GET["x3"];
		$x4 = $_GET["x4"];
		$x5 = $_GET["x5"];
		$x6 = $_GET["x6"];
		$sqlstr = "BEGIN insert_Display(" . $x1 . ",'" . $x2 . "','" . $x3 . "'," . $x4 . ",'" . $x5 . "','" . $x6 . "'); END;";
		break;
	case 'T_CPU' :
		$x1 = $_GET["x1"];
		$x2 = $_GET["x2"];
		$sqlstr = "BEGIN insert_CPU('" . $x1 . "'," . $x2 . "); END;";
		
		break;

	case 'T_CAMERA' :
	//insert_Camera('y','yeka',3.2,'300*200','ful hd');
		$x1 = $_GET["x1"];
		$x2 = $_GET["x2"];
		$x3 = $_GET["x3"];
		$x4 = $_GET["x4"];
		$x5 = $_GET["x5"];
		$sqlstr = "BEGIN insert_Camera('" . $x1 . "','" . $x2 . "'," . $x3 . ",'" . $x4 . "','" . $x5 . "'); END;";
		break;

	case 'T_MEMORY' :
	//insert_Memory('sd hh',127,'y');
	
		$x1 = $_GET["x1"];
		$x2 = $_GET["x2"];
		$x3 = $_GET["x3"];
		$sqlstr = "BEGIN insert_Memory('" . $x1 . "'," . $x2 . ",'" . $x3 . "'); END;";
		break;

		

	case 'T_BATTERY' :
		$x1 = $_GET["x1"];
		$x2 = $_GET["x2"];
		$x3 = $_GET["x3"];
		$sqlstr = "BEGIN insert_Battery('" . $x1 . "'," . $x2 . ",'" . $x3 . "'); END;";
		break;

	case 'T_PHONE_FEATURE' :
		$x1 = $_GET["x0"];
		$x2 = $_GET["x1"];
		$sqlstr = "BEGIN insert_Phone_Feature(" . $x1 . "," . $x2 . "); END;";

		break;
	case 'T_USER' :
		$x1 = $_GET["x0"];
		$x2 = md5($_GET["x1"]);
		$x3 = $_GET["x2"];
		$sqlstr = "BEGIN insert_USER('" . $x1 . "','" . $x2 . "','" . $x3 . "'); END;";
		break;

	case 'T_PHONE_COLOUR' :
		$x1 = $_GET["x0"];
		$x2 = $_GET["x1"];
		$sqlstr = "BEGIN insert_Phone_Colour(" . $x1 . "," . $x2 . "); END;";

		break;

	case 'T_PHONE_CAMERA' :
		$x1 = $_GET["x0"];
		$x2 = $_GET["x1"];
		$sqlstr = "BEGIN insert_Phone_Camera(" . $x1 . "," . $x2 . "); END;";

		break;

	case 'T_SIM' :
		$x1 = $_GET["x1"];
		$sqlstr = "BEGIN insert_SIM('" . $x1 . "'); END;";
		break;

	case 'T_PHONE_PICTURE' :
		$x1 = $_GET["x0"];
		$x2 = $_GET["x1"];
		$sqlstr = "BEGIN insert_Phone_Picture(" . $x1 . "," . $x2 . "); END;";

		break;

	case 'T_PHONE_REVIEW' :
		$x1 = $_GET["x0"];
		$x2 = $_GET["x1"];
		$sqlstr = "BEGIN insert_Phone_Review(" . $x1 . "," . $x2 . "); END;";

		break;

	case 'T_PHONE' :
		//insert_Phone('acro s',2600,TO_DATE('2013/04/03', 'yyyy/mm/dd'),129,65,23,123,12,10,'detail bu',2,2,2,2,2,2,2);
		$x1 = $_GET["x1"];
		$x2 = $_GET["x2"];
		$x3 = $_GET["x3"];
		$x4 = $_GET["x4"];
		$x5 = $_GET["x5"];
		$x6 = $_GET["x6"];
		$x7 = $_GET["x7"];
		$x8 = $_GET["x8"];
		$x9 = $_GET["x9"];
		$x10 = $_GET["x10"];
		$x11 = $_GET["x11"];
		$x12 = $_GET["x12"];
		$x13 = $_GET["x13"];
		$x14 = $_GET["x14"];
		$x15 = $_GET["x15"];
		$x16 = $_GET["x16"];
		$x17 = $_GET["x17"];
		
		$sqlstr = "BEGIN insert_Phone('" . $x1 . "'," . $x2 . ",TO_DATE('" . $x3 . "', 'dd/mm/yyyy')," . $x4 . "," . $x5 . "," . $x6 . "," . $x7 . "," . $x8 . "," . $x9 . ",'" . $x10 . "'," . $x11 . "," . $x12 . "," . $x13 . "," . $x14 . "," . $x15 . "," . $x16 . "," . $x17 . "); END;";
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
	//print " okinsert ";
	//$error = 'Signed up <br/><b id="index"><a href="index.php">LOGIN</a></b>';
	//$_SESSION['login_user'] = $username;
	// Initializing Session
	//header("location: ./login/profile.php"); // Redirecting To Other Page
} else {
	//print "goddam";
	$error = "ERROR";
}
?>