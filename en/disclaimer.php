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
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Disclaimer</title>
    </head>
    <body>
        <div id="mainContainer">
            <div id="header">
                <div id="logo">
                    <a href="StartPage.php">
                        <img src="../img/stenden.png" alt="NHL_STENDEN"> 
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
                            <li><a href="index.php" >Log out</a></li>
                        </ul>
                    </div>
                    <div class="person">
                    </div>
                    <div class="language">
                        <ul>
                            <li>&#127760;</li>
                            <li class=""><a href="../disclaimer.php">NL</a></li>
                            <li class=""><a href="disclaimer.php">EN</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div id="middlebox">
                <div id="disclaimertext">
                    <h2>
                    NHLStenden does its best to implement missing items and changes to the offer for the functions and their descriptions as quickly as possible on the website.
                        Do you have questions about the content or do you encounter something that is not correct or not clear? Then fill in the contact form.</h2>
                    <h2>This website is protected by copyright and other intellectual property rights. Content of this website may only be copied, quoted and made public for personal and non-commercial use and with full source reference.</h2>
                </div>
            </div>
        </div>
<?php include 'footer.html'; ?>
    </body>
</html>