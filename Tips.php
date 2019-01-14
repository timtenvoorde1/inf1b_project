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
        <div id="mainContainer">
            <div id="header">
                <div id="logo">
                    <a href="StartPage.php">
                        <img src="img/stenden.png" alt="NHL_STENDEN"> 
                    </a>
                </div>
            </div>

            <div id="middlebox" >
                <div id="tipcontainer" >
                    <div id="tiptext" >
                    <h1>Suggesties</h1>
                    <p>Voeg een Suggestie toe!</p>
                    <form action="Tips.php" method="POST">
                        <p>Suggestie</p>
                        <div id="textarea" >
                        <textarea name="suggestion"></textarea>
                        </div>
                        <p><input type="submit" value="Toevoegen"/></p>
                    </form>
                    <p><a href="ShowTips.php">Vorige tips</a></p>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>