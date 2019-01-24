<?php session_start();
if(!isset($_SESSION['admin']))
{
	header('Location: showgroepen.php');
}
?>
<!DOCTYPE html>
<!--
INLOG WEBAPP
17-12-2018
-->
<html lang="nl">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/inlog.css">
        <link rel="stylesheet" type="text/css" href="css/groepen.css"
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Upload groepen</title>
</head>
<body>
	<div id="mainContainer">
		<div id="header">
			<div id="logo">
				<a href="StartPage.php">
					<img src="img/stenden.png" alt="NHL_STENDEN"> 
				</a> 
			</div>
			<div id="headertxt">
                            <div class="home">
                            <ul>
                            <li><a href="startpage.php">Home</a></li>
                            </ul>
                            </div>
				<div class="login">
					<ul>
						<li><a href="index.php" >Logout</a></li>
					</ul>
				</div>
				<div class="person">
				</div>
				<div class="language">
					<ul>
                                            <li>&#127760;</li>
                                            <li class=""><a href="uploadgroepen.php">NL</a></li>
                                            <li class=""><a href="en/uploadgroepen.php">EN</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div id="formbox">
			<h2>Groepen</h2>
			<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                            <p><input type="text" name="cohort" placeholder="Cohort" required></p>
                            <p><input type="text" name="schooljaar" placeholder="Schooljaar" required></p>
                            <p><input type="text" name="periode" placeholder="Periode" required></p>
                            <div class="avatar">
                                <p class="color"><label>Selecteer Groepsindeling: </label></p>
                                <p><input type="file" name="avatar" accept="image/*" required /></p>
                            </div>
                            <p><input type="submit" name="submit" value="Submit" /></p>
			</form>
                        <p><a href="showgroepen.php">&lt;&lt;Terug</a></p>
			<?php
			require 'DBFuncs.php';

			if ($_SERVER['REQUEST_METHOD'] === 'POST')
			{
                        //complete spaghet
				if (isset($_POST['submit']))
				{
					$conn = DBHandshake('127.0.0.1', 'root', '');
					$db_table = 'groepsindeling';
					$db_name = 'projectplenair';
					$id = '';
					$cohort = $conn->real_escape_string($_POST['cohort']);
					$schooljaar = $conn->real_escape_string($_POST['schooljaar']);
					$periode = $conn->real_escape_string($_POST['periode']);
					$imagepath = $conn->real_escape_string('img/' . $_FILES['avatar']['name']);
					if (TableExistCheck($conn, $db_name, $db_table))
					{
						if (preg_match("!image!", $_FILES['avatar']['type']))
						{
							if (copy($_FILES['avatar']['tmp_name'], $imagepath))
							{
								$query = "INSERT INTO " . $db_table . " VALUES(?, ?, ?, ?, ?)";
								$stmt = mysqli_prepare($conn, $query);
								if ($stmt)
								{
									mysqli_stmt_bind_param($stmt, 'issss', $id, $cohort, $schooljaar, $periode, $imagepath);
									$result = mysqli_stmt_execute($stmt);
									if ($result === FALSE)
									{
										echo "<p>Unable to execute the query.</p>" 
										. "<p>Error code " 
										. mysqli_errno($conn)
										. ": " 
										. mysqli_error($conn)
										. "</p>";
									} else {
										echo "<h4>Succesvol geupload!</h4>";
									}
									mysqli_stmt_close($stmt);
								}
								mysqli_close($conn);
							}
						}
					}
				} else {
					echo "Niet correct ingevuld";
				}
			}
			?>
		</div>
                <?php include 'footer.html'; ?>
	</div>
    </body>
</html>