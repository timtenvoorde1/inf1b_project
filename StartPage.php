<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
?>
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
                            <li class=""><a href="StartPage.php">NL</a></li>
                            <li class=""><a href="en/StartPage_en.php">EN</a></li>
                        </ul>
                    </div>
                </div> 
            </div> 
            <div id="middlebox">
                <div id="tilecontainer">
                    <div class="calender">
                        <iframe src="https://calendar.google.com/calendar/embed?src=1tu1trr2fqthm1n7s4kfpkloh0%40group.calendar.google.com&ctz=Europe%2FAmsterdam" 
                                style="border: 0" width="100%" height="100%" frameborder="0" scrolling="no">
                        </iframe>
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
                            <div class="ptile">Evaluatie</div>
                        </a>
                    </div>

                    <div class="tile">
                        <a href="shownotulen.php">
                            <img src="img/notulen.png" alt="Notulen" class="imgmain">
                            <div class="ptile">Notulen</div>
                        </a>
                    </div>

                    <div class="tile">
                        <a href="uploadgroepen.php">
                            <img src="img/group-vector-icon-png-4.png" alt="Groepen" class="imgmain">
                            <div class="ptile">Groepen</div>
                        </a>
                    </div>

                    <div class="tile">
                        <a href="Tips.php">
                            <img src="img/tips.png" alt="Tips" class="imgmain">
                            <div class="ptile">Tipdoos</div>
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
                        <div class="vl"></div>
                        <div class="footertext" >
                            <a href="Contact.php" >
                                <p class="textfooter"> Contact </p>
                            </a>
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
        </div>
    </body>
</html>