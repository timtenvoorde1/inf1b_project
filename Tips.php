<?php session_start() ?>
<!DOCTYPE html>
<!--
Title Tipdoos PlenWEBAPP
Authors Thijs v.d Wall, Twan Verdel
Front-end Dev.
-->
<html lang="nl">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Suggesties</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <h1>Suggesties</h1>
        <p>Voeg een Suggestie toe!</p>
        <form action="Tips.php" method="POST">
            <p>Suggestie</p>
            <textarea name="suggestion"></textarea>
            <p><input type="submit" value="Toevoegen"/></p>
        </form>
        <p><a href="ShowTips.php">Vorige tips</a></p>
    </body>
</html>