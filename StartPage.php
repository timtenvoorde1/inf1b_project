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
                        <img src="img/calendar.png" alt="Calendar" class="imgmain">
                    </div>

                    <div class="tile">
                        <img src="img/feedback3.png" alt="Evaluatie" class="imgmain">
                    </div>

                    <div class="tile">
                        <img src="img/group-vector-icon-png-4.png" alt="Groepen" class="imgmain">
                    </div>

                    <div class="tile">
                        <img src="img/tips.png" alt="Tips" class="imgmain">
                    </div>
                </div>
                <div id="footer" >
                    <div id="footercontainer" >
                        <div id="footersearch">
                            <div id="search">
                                <input type="text" placeholder="Zoeken...">
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
        </div>
    </body>
</html>