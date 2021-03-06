<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<!--

17-12-2018
-->
<html lang="nl">
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Disclaimer</title>
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
                            <li><a href="index.php" >Uitloggen</a></li>
                        </ul>
                    </div>
                    <div class="person">
                    </div>
                    <div class="language">
                        <ul>
                            <li>&#127760;</li>
                            <li class=""><a href="disclaimer.php">NL</a></li>
                            <li class=""><a href="en/disclaimer.php">EN</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div id="middlebox">
                <div id="disclaimertext">
                    <h2>NHL STENDEN doet haar best om ontbrekende zaken en wijzigingen in het aanbod voor de functies en hun beschrijvingen zo snel mogelijk op de website door te voeren.
                        Heb je vragen over de inhoud of kom je iets tegen dat niet correct of niet duidelijk is? Vul dan het contact formulier in.</h2>
                    <h2>Deze website is beschermd door het auteursrecht en andere intellectuele eigendomsrechten. Inhoud van deze website mag je alleen kopiëren, citeren en openbaar maken voor persoonlijk en niet-commercieel gebruik en met volledige bronvermelding.</h2>
                </div>
            </div>
        </div>
<?php include 'footer.html'; ?>
    </body>
</html>