<?php
session_start();
if(!isset($_SESSION['loggedin'])){
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
        <title>Suggesties</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/kalender.css" rel="stylesheet" type="text/css" />
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
                </div>
            </div>

            <div id="middleboxCal">
<!--                 <iframe src="https://calendar.google.com/calendar/embed?src=1tu1trr2fqthm1n7s4kfpkloh0%40group.calendar.google.com&ctz=Europe%2FAmsterdam" 
                        style="border: 0" width="80%" height="100%" frameborder="0" scrolling="no">
                </iframe> -->
                <div id='calendar'></div>
            </div>
            <?php include 'footer.html'; ?>
        </div>
    </body>
</html>