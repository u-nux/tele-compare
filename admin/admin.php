<?php
include ('../login/session.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Page</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
		<link rel="stylesheet" href="../apps/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
		<script type="text/javascript" src="../apps/fancybox/jquery.fancybox.pack.js"></script>
	</head>
	<body>
		<div id="admin">
			<b id="welcome">Welcome <?php echo $_SESSION['login_role']; ?>: <i><?php echo $login_session; ?></i></b>
			<b id="logout"><a href="../login/logout.php">Log Out</a></b>
			
			<?php
			print "      <td><a style='position: relative; left: 100px;'class='fancybox' href=\"crudtable.php?table=T_LOG&ID='-1'&Action='None'\">LOGS</a></td>\n";
			print "      <td><a style='position: relative; left: 200px;'class='fancybox' href=\"stats.php\">STATISTICS</a></td>\n";
			
			// Establishing Connection with Server by passing server_name, user_id and password as a parameter
			include '../db/connect.php';
			// Selecting Database

			$stid = oci_parse($conn, 'select table_name, num_rows from user_tables order by table_name asc');
			if (!$stid) {
				$e = oci_error($conn);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}

			// Perform the logic of the query
			$r = oci_execute($stid);
			if (!$r) {

				$e = oci_error($stid);
				trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
			}

			print "<table border='1'>\n";
			print "<tr><td>Table</td><td>Rows</td></tr>";
			while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
				if ($row['TABLE_NAME'] != "T_LOG") {

					print "<tr>\n";

					//print "      <td><a href=\"examplepage.php?table=". ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") ."\">". ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") ."</a></td>\n";
					//print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";

					print "      <td><a href=\"crudtable.php?table=" . $row['TABLE_NAME'] . "&ID='-1'&Action='None'\">" . $row['TABLE_NAME'] . "</a></td>\n";
					print "    <td>" . $row['NUM_ROWS'] . "</td>\n";
					//}
					print "</tr>\n";
				}

			}
			print "</table>\n";

			include '../db/disconnect.php';
		?>
		
		<form action="pic_upload.php" method="post">
		<input type="submit" name="formSubmit" value="Picture Upload" />
		<!-- <b><a href="pic_upload.php">Upload Picture</a></b> -->

			
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