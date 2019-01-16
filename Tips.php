<?php
//session_start();
// if(!isset($_SESSION['loggedin'])){
//        header('Location: index.php');
// }
 ?>
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
        <link href="css/tips.css" rel="stylesheet" type="text/css" />
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
                <div class="tipdoos">
                    <form name="tipdoos" action="Tips.php">
                        <h2>Geef feedback of een suggestie!</h2>
                        <p>Geef een module op</p>
                        <input type="text" name="Module" class="tipdoos">
                        <p>Geef een schooljaar op</p>
                        <input type="text" name="schooljaar" class="tipdoos">
                        <p>Geef een periode op</p>
                        <input type="radio" name="periode" value="1">
                        <input type="radio" name="periode" value="2">
                        <input type="radio" name="periode" value="3">
                        <input type="radio" name="periode" value="4">
                        <p>Type hier je tekst</p>
                        <textarea></textarea>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>