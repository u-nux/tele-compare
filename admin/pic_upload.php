<?php
include ('../login/session.php');
//error_reporting(0);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="admin">
			<b id="welcome">Welcome <?php echo $_SESSION['login_role']; ?>: <i><?php echo $login_session; ?></i></b>
			<b id="logout"><a href="../login/logout.php">Log Out</a></b>
			
		
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
		<input type="file" name="dosya" />
		<input type="submit" name="formSubmit" value="upload" />
		</form>
				
		</div>
		<div>
		<?php

		if ($_POST['formSubmit'] == "upload") {
			if (isset($_FILES['dosya'])) {
				echo 'Uploaded..<br/>';
			} else {
				echo 'Pleaase send a file<br/>';
			}

			if (isset($_FILES['dosya'])) {
				$hata = $_FILES['dosya']['error'];
				if ($hata != 0) {
					echo 'An error encounteered while uploading.<br/>';
				} else {
					$boyut = $_FILES['dosya']['size'];
					if ($boyut > (1024 * 1024 * 3 * 10)) {
						echo 'File cannot be more than 30 mb.<br/>';
					} else {
						$tip = $_FILES['dosya']['type'];
						$isim = $_FILES['dosya']['name'];
						$uzanti = explode('.', $isim);
						$uzanti = $uzanti[count($uzanti) - 1];
						/*if ($tip != 'image/jpeg' || $uzanti != 'jpg') {
						 echo 'Yanlızca JPG dosyaları gönderebilirsiniz.<br/>';
						 } else {*/
						$dosya = $_FILES['dosya']['tmp_name'];
						copy($dosya, '../files/pics/' . $_FILES['dosya']['name']);
						echo 'Uploaded!<br/>';
						echo '../files/pics/'.$_FILES['dosya']['name'];
						//}
					}
				}
			}

		}
		?>
		</div>
	</body>
</html>