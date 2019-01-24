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
        <link href="css/fullcalendar.min.css" rel="stylesheet" />
        <script type="text/javascript" src="js/moment.min.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/fullcalendar.min.js"></script>
        <script type="text/javascript" src="js/gcal.js"></script>
        <script>
            $(document).ready(function() {
              // page is now ready, initialize the calendar...
              $('#calendar').fullCalendar({
                header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,listYear'
              },
                googleCalendarApiKey: 'Y-Q6mrohO1x5r3ZFoSW8QPE9',
                defaultView: 'month'
              })

            });
        </script>
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
                        <div id="calendar"></div>
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
                        <a href="showgroepen.php">
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
        </div>
        <?php include 'footer.html'; ?>
    </body>
</html>