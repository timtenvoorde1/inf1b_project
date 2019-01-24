<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kalender</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/kalender.css" rel="stylesheet" type="text/css" />
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
                            <li><a href="logout.php" >Uitloggen</a></li>
                        </ul>
                    </div>
                    <div class="language">
                        <ul>
                            <li>&#127760;</li>
                            <li class=""><a href="kalender.php">NL</a></li>
                            <li class=""><a href="en/kalender.php">EN</a></li>
                        </ul>
                    </div>
                </div> 
            </div> 

            <div id="middleboxCal">                
                <iframe src="https://outlook.office365.com/owa/calendar/859dd7e5fb414d07ada87e8b06092992@student.nhlstenden.com/b25d378d5ec447dfb6cd6a0dd8cfda7013245085475903644883/calendar.html" 
                        style="border: 0" width="80%" height="100%"></iframe>
            </div>
        </div>
        <?php include 'footer.html'; ?>
    </body>
</html>