<?php
function startsWith($haystack, $needle) {
	// search backwards starting from haystack length characters from the end
	return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

//$rowid = $_GET['table'];

include ('../login/session.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Edit Tables</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
		<link rel="stylesheet" href="../apps/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
		<script type="text/javascript" src="../apps/fancybox/jquery.fancybox.pack.js"></script>
	</head>
	<body> 
		<div id="admin">
			<b id="welcome">Welcome <?php echo $_SESSION['login_role']; ?>: <i><?php echo $login_session; ?></i></b>
			<b id="logout"><a href="../login/logout.php">Log Out</a></b>
			<b><a href="admin.php">Back</a></b>
			<?php
			if ($_GET['table'] != "T_LOG")
				print "      <td><a style='position: relative; left: 100px;'class='fancybox' href=\"crudtable.php?table=T_LOG&ID='-1'&Action='None'\">LOGS</a></td>\n";

			print "      <td><a style='position: relative; left: 200px;'class='fancybox' href=\"stats.php\">STATISTICS</a></td>\n";

			include '../db/connect.php';
			$tablename = $_GET['table'];
			//*** Delete Condition ***//
			if ($_GET["Action"] == "Del") {
				include 'delete.php';

				//header("location:$_SERVER[PHP_SELF]");
				//exit();
			}

			if ($_GET["Action"] == "Add") {
				include 'insert.php';

				//header("location:$_SERVER[PHP_SELF]");
				//exit();
			}

			if ($_GET["Action"] == "Update") {
				include 'update.php';

				//header("location:$_SERVER[PHP_SELF]");
				//exit();
			}

			$sqlstr = 'Select COLUMN_NAME from user_tab_columns where table_name= :tablename ';

			$stid_i = oci_parse($conn, $sqlstr);
			//$stid_i = oci_parse($conn, 'Select COLUMN_NAME,DATA_TYPE from user_tab_columns where table_name= :tablename');

			if (!$stid_i) {
				$e = oci_error($conn);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}

			print "<h3>" . $tablename . "</h3>";

			oci_bind_by_name($stid_i, ':tablename', $tablename, -1) or die('Error binding string');

			// Perform the logic of the query
			$r_i = oci_execute($stid_i);
			if (!$r_i) {

				$e = oci_error($stid_i);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}

			$sqlstr = 'Select * from ' . $_GET['table'] . '';
			if ($tablename == "T_LOG") {
				$sqlstr = $sqlstr . " order by log_id asc";

			} else
				$sqlstr = $sqlstr;

			$stid = oci_parse($conn, $sqlstr);
			if (!$stid) {
				$e = oci_error($conn);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}

			//oci_bind_by_name($stid, ':tablename', $_GET['table']);

			// Perform the logic of the query
			$r = oci_execute($stid);
			if (!$r) {

				$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
			$i = 0;
			$j = 0;

			print '<form name="crudtable" method="get" action="' . $_SERVER["PHP_SELF"] . '">';
			print '<input type="hidden" name="Action" value="">';
			print '<input type="hidden" name="table" value="' . $tablename . '">';
			print '<input type="hidden" name="ID" value="-1">';

			print "<table border='2'>\n";
			print "<tr>\n";
			while ($row = oci_fetch_array($stid_i, OCI_NUM + OCI_RETURN_NULLS)) {

				foreach ($row as $item) {
					print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
				}

			}
			if ($tablename != "T_QUESTION" && $tablename != "T_LOG")
				print "<td>Edit</td><td>Delete</td>";
			else if ($tablename != "T_LOG") {
				print "<td>Send Email</td><td>Delete</td>";
			}
			print "</tr>\n";
			while ($row = oci_fetch_array($stid, OCI_NUM + OCI_RETURN_NULLS)) {
				print "<tr>\n";
				if ($_GET["ID"] == $row[0] and $_GET["Action"] == "Edit") {
					//$i = 0;
					foreach ($row as $item) {

						print '<td><input type="text" name="y' . $i . '" size="" value="' . $item . '" ' . ($i == 0 ? 'disabled="disabled"' : "&nbsp;") . '></td>';
						$i++;
						//print "    <td>x" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
					}
					//print '<td colspan="2"><input type="button" value="Update!" onclick="alert(\'hazırlanıyor..\')" />';
					print '<td colspan="2"><input name="btnUpd" type="button" id="btnAdd" value="Update!" OnClick="crudtable.Action.value=\'Update\';crudtable.ID.value=\'' . $row[0] . '\';crudtable.submit();" />';

					print '<input name="btnAdd" type="button" id="btnCancel" value="Cancel" OnClick="window.location=\'' . $_SERVER["PHP_SELF"] . '?Action=None&ID=' . $tablename . '&table=' . $tablename . '\'"> </td>';

				} else {
					foreach ($row as $item) {
						print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
					}
					if (startsWith($tablename, "T_PHONE_"))
						print '<td>NotEditable';
					else if ($tablename == "T_QUESTION")
						print '<td><a href="mailto:' . $row[3] . '">Send an email</a>';
					else if ($tablename != "T_LOG")
						print '<td><a href="' . $_SERVER["PHP_SELF"] . '?Action=Edit&ID=' . $row[0] . '&table=' . $tablename . '">Edit</a>';
					if ($tablename != "T_LOG")
						print '<td align="center"><a href="JavaScript:if(confirm(\'Confirm Delete?\')==true){window.location=\'' . $_SERVER["PHP_SELF"] . '?Action=Del&table=' . $tablename . '&ID=' . $row[0] . '&IDX=' . $row[1] . '\';}">X</a></td>';
				}
				print "</tr>\n";

			}

			$r_i = oci_execute($stid_i);
			if (!$r_i) {

				$e = oci_error($stid_i);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}
			print "<tr>\n";
			if ($tablename != "T_QUESTION" && $tablename != "T_LOG") {
				while ($row = oci_fetch_array($stid_i, OCI_NUM + OCI_RETURN_NULLS)) {
					foreach ($row as $item) {
						print '<td><input type="text" name="x' . $j . '" size="" placeholder="' . $item . '" ' . ($j == 0 && !startsWith($tablename, "T_PHONE_") && $tablename != "T_USER" ? 'disabled="disabled"' : "&nbsp;") . '></td>';
						$j++;
						//print "    <td>x" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
					}

				}
				print '<td colspan="2"><input name="btnAdd" type="button" id="btnAdd" value="Insert!" OnClick="crudtable.Action.value=\'Add\';crudtable.submit();" /></td>';

				print "</tr>\n";
			}
			print "</table>\n";
			print "</form>";

			include '../db/disconnect.php';
			?>
			
		</div>
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