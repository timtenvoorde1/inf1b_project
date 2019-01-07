<!--
Title Tipdoos PlenWEBAPP
Authors Thijs v.d Wall, Twan Verdel
Front-end Dev.
-->
<?php
session_start()
?>

<!DOCTYPEhtml>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>PlenairWebApp</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<h1>Suggesties</h1>
		<p>Suggestie toevoegen:</p>
		<form>
			<p>Suggestie<input type="textarea" name="suggestion"/></p>
			<p><input type="submit" value="toevoegen"/></p>
		</form>
		<p><a href="ShowTips.php">Vorige tips</a></p>
	</body>
</html>