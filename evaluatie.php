<?php session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lan="nl">
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
            </div>
            <div id="inlog"> 
                <div id="inlogbox">
                    <div id="formbox">
                        <h2>Login</h2>
                        <form action="<?php htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
                            <div class="container">
                                <p><b>Student/Docent nummer</b></p>
                                <input type="text" placeholder="Enter Username" name="uname" required class="unamepsw">
                                <p><b>Wachtwoord</b></p>
                                <input type="password" placeholder="Enter Password" name="psw" required class="unamepsw">
                                <p>Log in als docent? <input type="checkbox" name="teachlogin"></p>
                                <input type="submit" name="submit" value="Inloggen">
                            </div>
                        </form>
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
        <?php
        ?>
    </body>
</html>
