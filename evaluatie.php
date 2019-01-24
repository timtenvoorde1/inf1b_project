<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Evaluatie</title>
        <link type="text/css" rel="stylesheet" href="css/style.css" >
        <link type="text/css" rel="stylesheet" href="css/evaluatie.css" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                            <li><a href="logout.php" >Log out</a></li>
                        </ul>
                    </div>
                    <div class="language">
                        <ul>
                            <li>&#127760;</li>
                            <li class=""><a href="evaluatie.php">NL</a></li>
                            <li class=""><a href="en/evaluatie.php">EN</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div id="middlebox">
                <div class="linkforms">
                    <iframe src= "https://forms.office.com/Pages/ResponsePage.aspx?id=SJ5qAQu69EmX-KiDUhZOWJFTzZNpXY5MkFHZVb6galZUQVRSNzVPNldUWU1SWjJIOTJRTTJWS0lSMC4u&embed=true"></iframe>
                </div>
            </div>
            <?php include 'footer.html'; ?>
        </div>
    </body>
</html>
