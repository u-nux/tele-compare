<?php
/*
echo "UPDATE ";
print $tablename;
print_r($_GET);
echo "UPDATE ";
*/

$uID = $_GET["ID"];

switch ($tablename) {

	case 'T_PICTURE' :
		$y1 = $_GET["y1"];
		$sqlstr = "BEGIN update_Picture(".$uID.",'" . $y1 . "'); END;";
		print $sqlstr;
		break;

	case 'T_REVIEW' :
		$y1 = $_GET["y1"];
		$y2 = $_GET["y2"];
		$sqlstr = "BEGIN update_Review(".$uID.",'" . $y1 . "','" . $y2 . "'); END;";
		break;

	case 'T_COLOUR' :
		$y1 = $_GET["y1"];
		$sqlstr = "BEGIN update_Colour(".$uID.",'" . $y1 . "'); END;";
		break;

	case 'T_LANGUAGE' :
		$y1 = $_GET["y1"];
		$sqlstr = "BEGIN update_Language(".$uID.",'" . $y1 . "'); END;";
		break;

	case 'T_OPERATING_SYSTEM' :
		$y1 = $_GET["y1"];
		$y2 = $_GET["y2"];
		$sqlstr = "BEGIN update_Operating_System(".$uID.",'" . $y1 . "'," . $y2 . "); END;";
		break;

	case 'T_NETWORK' :
		$y1 = $_GET["y1"];
		$y2 = $_GET["y2"];
		$y3 = $_GET["y3"];

		$sqlstr = "BEGIN update_Network(".$uID.",'" . $y1 . "','" . $y2 . "'," . $y3 . "); END;";
		break;

	case 'T_BRAND' :
		$y1 = $_GET["y1"];
		$y2 = $_GET["y2"];
		$y3 = $_GET["y3"];

		$sqlstr = "BEGIN update_Brand(".$uID.",'" . $y1 . "',TO_DATE('" . $y2 . "', 'dd/mm/yyyy'),'" . $y3 . "'); END;";
		break;

	case 'T_FEATURE' :
		$y1 = $_GET["y1"];
		$y2 = $_GET["y2"];
		$sqlstr = "BEGIN update_Feature(".$uID.",'" . $y1 . "','" . $y2 . "'); END;";
		break;

	case 'T_DISPLAY' :
		//update_Display(4.3,'tft','300*200',233,'ful hd','y');
		$y1 = $_GET["y1"];
		$y2 = $_GET["y2"];
		$y3 = $_GET["y3"];
		$y4 = $_GET["y4"];
		$y5 = $_GET["y5"];
		$y6 = $_GET["y6"];
		$sqlstr = "BEGIN update_Display(".$uID."," . $y1 . ",'" . $y2 . "','" . $y3 . "'," . $y4 . ",'" . $y5 . "','" . $y6 . "'); END;";
		break;

	case 'T_CPU' :
		$y1 = $_GET["y1"];
		$y2 = $_GET["y2"];
		$sqlstr = "BEGIN update_CPU(".$uID.",'" . $y1 . "'," . $y2 . "); END;";

		break;

	case 'T_CAMERA' :
		//update_Camera('y','yeka',3.2,'300*200','ful hd');
		$y1 = $_GET["y1"];
		$y2 = $_GET["y2"];
		$y3 = $_GET["y3"];
		$y4 = $_GET["y4"];
		$y5 = $_GET["y5"];
		$sqlstr = "BEGIN update_Camera(".$uID.",'" . $y1 . "','" . $y2 . "'," . $y3 . ",'" . $y4 . "','" . $y5 . "'); END;";
		break;

	case 'T_MEMORY' :
		//update_Memory('sd hh',127,'y');

		$y1 = $_GET["y1"];
		$y2 = $_GET["y2"];
		$y3 = $_GET["y3"];
		$sqlstr = "BEGIN update_Memory(".$uID.",'" . $y1 . "'," . $y2 . ",'" . $y3 . "'); END;";
		break;

	case 'T_BATTERY' :
		$y1 = $_GET["y1"];
		$y2 = $_GET["y2"];
		$y3 = $_GET["y3"];
		$sqlstr = "BEGIN update_Battery(".$uID.",'" . $y1 . "'," . $y2 . ",'" . $y3 . "'); END;";
		break;

	case 'T_USER' :
		$y1 = $_GET["y1"];
		$y2 = $_GET["y2"];
		$sqlstr = "BEGIN update_USER('".$uID."','" . $y1 . "','" . $y2 . "'); END;";
		//echo   $uID ."   ". $_GET["y1"] . "   ". $_GET["y2"] . "   ------" . $_GET["y0"];
		//echo $sqlstr;
		break;

	case 'T_SIM' :
		$y1 = $_GET["y1"];
		$sqlstr = "BEGIN update_SIM(".$uID.",'" . $y1 . "'); END;";
		break;

	case 'T_PHONE' :
		//update_Phone('acro s',2600,TO_DATE('2013/04/03', 'yyyy/mm/dd'),129,65,23,123,12,10,'detail bu',2,2,2,2,2,2,2);
		$y1 = $_GET["y1"];
		$y2 = $_GET["y2"];
		$y3 = $_GET["y3"];
		$y4 = $_GET["y4"];
		$y5 = $_GET["y5"];
		$y6 = $_GET["y6"];
		$y7 = $_GET["y7"];
		$y8 = $_GET["y8"];
		$y9 = $_GET["y9"];
		$y10 = $_GET["y10"];
		$y11 = $_GET["y11"];
		$y12 = $_GET["y12"];
		$y13 = $_GET["y13"];
		$y14 = $_GET["y14"];
		$y15 = $_GET["y15"];
		$y16 = $_GET["y16"];
		$y17 = $_GET["y17"];

		$sqlstr = "BEGIN update_Phone(".$uID.",'" . $y1 . "'," . $y2 . ",TO_DATE('" . $y3 . "', 'dd/mm/yyyy')," . $y4 . "," . $y5 . "," . $y6 . "," . $y7 . "," . $y8 . "," . $y9 . ",'" . $y10 . "'," . $y11 . "," . $y12 . "," . $y13 . "," . $y14 . "," . $y15 . "," . $y16 . "," . $y17 . "); END;";
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
	//print "UPDATED";
	//$error = 'Signed up <br/><b id="index"><a href="index.php">LOGIN</a></b>';
	//$_SESSION['login_user'] = $username;
	// Initializing Session
	//header("location: ./login/profile.php"); // Redirecting To Other Page
} else {
	//print "goddam";
	$error = "ERROR";
}
?>