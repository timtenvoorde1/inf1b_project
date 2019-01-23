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
                            <li><a href="logout.php" >Uitloggen</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <div id="middlebox">
                <div class="linkforms">
                    <iframe width="640" height= "700" src= "https://forms.office.com/Pages/ResponsePage.aspx?id=SJ5qAQu69EmX-KiDUhZOWJFTzZNpXY5MkFHZVb6galZUQVRSNzVPNldUWU1SWjJIOTJRTTJWS0lSMC4u&embed=true" frameborder= "0" marginwidth= "0" marginheight= "0" style= "border: none; max-width:100%; max-height:100vh"> </iframe>
                </div>
            </div>
            <?php include 'footer.html'; ?>
        </div>
    </body>
</html>
