<?php session_start() ?>
<!DOCTYPE html>
<!--
STARTPAGE WEBAPP
17-12-2018
-->
<html lang="nl">
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Start Pagina</title>
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
                            <li><a href="inlog.php" >Inloggen</a></li>
                        </ul>
                    </div>
                    <div class="person">
                        <ul>
                            <li class=""><a href="">Docent</a></li>
                            <li class=""><a href="">Student</a></li>
                        </ul>
                    </div>
                    <div class="language">
                        <ul>
                            <li class=""><a href="">NL</a></li>
                            <li class=""><a href="">EN</a></li>
                        </ul>
                    </div>
                </div>
            </div> 
            <div id="middlebox">
                <div id="tilecontainer">
                    <div class="calender">

                    </div>

                    <div class="tile">
                        <a href="kalender.php"> 
                            <img src="img/calendar.png" alt="Calendar" class="imgmain">
                            <p class="ptile">Kalender</p>
                        </a>
                    </div>

                    <div class="tile">
                        <a href="evaluatie.php">
                            <img src="img/feedback3.png" alt="Evaluatie" class="imgmain">
                            <p class="ptile">Evaluatie</p>
                        </a>
                    </div>

                    <div class="tile">
                        <a href="shownotulen.php">
                            <img src="img/notulen.png" alt="Notulen" class="imgmain">
                            <p class="ptile">Notulen</p>
                        </a>
                    </div>

                    <div class="tile">
                        <a href="groepen.php">
                            <img src="img/group-vector-icon-png-4.png" alt="Groepen" class="imgmain">
                            <p class="ptile">Groepen</p>
                        </a>
                    </div>

                    <div class="tile">
                        <a href="tips.php">
                            <img src="img/tips.png" alt="Tips" class="imgmain">
                            <p class="ptile">Tipdoos</p>
                        </a>
                    </div>
                </div>
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
                            <p class="textfooter"> Disclaimer </p>
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