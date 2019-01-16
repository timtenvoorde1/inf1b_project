<?php session_start() ?>
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
	            	<form action="<?php htmlentities($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data" autocomplete="off">
	            		<input type="text" name="cohort" placeholder="Cohort" required>
	            		<input type="text" name="schooljaar" placeholder="Schooljaar" required>
	            		<input type="text" name="periode" placeholder="Periode" required>
	            		<div class="avatar"><label>Selecteer Groepfoto: </label><input type="file" name="avatar" accept="image/*" required /></div>
	            		<input type="submit" name="submit" value="Submit" />
	            	</form>
	            	<?php
	            		require 'DBFuncs.php';
	            		$conn = DBHandshake('127.0.0.1', 'root', '');
	            		$db_table = 'groepsindeling';

	            		if ($_SERVER['REQUEST_METHOD'] === 'POST')
	            		{
	            			if (isset($_POST['submit']))
	            			{
	            				$id = '';
	            				$cohort = $conn->real_escape_string($_POST['cohort']);
	            				$schooljaar = $conn->real_escape_string($_POST['schooljaar']);
	            				$periode = $conn->real_escape_string($_POST['periode']);
	            				$imagepath = $conn->real_escape_string('img/' . $_FILES['avatar']['name']);

	            				if (preg_match("!img!", $_FILES['avatar']['type']))
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
	            </div>
        	</div>
    </body>
</html>