<?php session_start();
    if(!isset($_SESSION['loggedin'])){
        header('Location: index.php');
    }?>
<!DOCTYPE html>
<!--
STARTPAGE WEBAPP
17-12-2018
-->
<html lang="nl">
    <head>
        <link rel="stylesheet" type="text/css" href="css/style - kopie.css">
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
                    <div class="uitlog">
                        <ul>
<<<<<<< HEAD
                            <li><a href="index.php" >Inloggen</a></li>
                        </ul>
                    </div>
                    <div class="person">
                        <ul>
                            <li class=""><a href="">Docent</a></li>
                            <li class=""><a href="">Student</a></li>
=======
                            <li><a href="index.php" >Uitloggen</a></li>
>>>>>>> b6892ff798d57fa89a28dccf22b3a5760be7a462
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
                        <a href="groepen.php">
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