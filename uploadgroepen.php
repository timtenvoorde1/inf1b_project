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
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inlog Pagina</title>
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
				<div class="login">
					<ul>
						<li><a href="index.php" >Uitloggen</a></li>
					</ul>
				</div>
				<div class="person">
				</div>
				<div class="language">
					<ul>
						<li class=""><a href="">NL</a></li>
						<li class=""><a href="">EN</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div id="formbox">
			<h2>Groepen</h2>
			<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
				<input type="text" name="cohort" placeholder="Cohort" required>
				<input type="text" name="schooljaar" placeholder="Schooljaar" required>
				<input type="text" name="periode" placeholder="Periode" required>
				<div class="avatar"><label>Selecteer Groepsindeling: </label><input type="file" name="avatar" accept="image/*" required /></div>
				<input type="submit" name="submit" value="Submit" />
			</form>
			<?php
			require 'DBFuncs.php';

			if ($_SERVER['REQUEST_METHOD'] === 'POST')
			{

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

		<div id="footer" >
			<div id="footercontainer" >
				<div id="footersearch">
					<div id="search">
						<input type="text" placeholder="Zoeken..." class="zoektext">
					</div>
				</div>
				<div id="footerinfo">
                                    <div class="vl"></div>
					<div class="footertext" >
						<p class="textfooter"> Contact </p>
					</div>
					<div class="footertext" >
						<a href="disclaimer.php">
							<p class="textfooter"> Disclaimer </p>
						</a>
					</div>
					<div class="footertext" >
						<p class="textfooter"> &copy; NHL Stenden </p>
					</div>
				</div>
			</div>
                    <div id="footercopyright"> <h3> Alle rechten voorbehouden &copy; NHL Stenden 2018-2019 </h3>
		</div>
	</div>
</body>
</html>