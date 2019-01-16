<?php session_start();
    if(!isset($_SESSION['loggedin'])){
        header('Location: index.php');
    }?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Notulen</title>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/notulen.css">
    </head>
    <body>
        <div id="mainContainer">
            <div id="header">
                <div id="logo">
                    <img src="img/stenden.png" alt="NHL_STENDEN"> 
                </div>
                <div id="headertxt">
                    
                </div>
            </div> 
            <div id="middlebox">
                <div id="tilecontainer">
                <?php
                    if(isset($_SESSION['admin'])){
                        echo '<a href="createnotulen.php">Creëer notulen</a>';
                        echo '<a href="assignnotulen.php">Selecteer een student om de volgende notulen te uploaden:</a>';
                    }
                    else if(isset($_SESSION['loggedin'])){
                        echo '<a href="createnotulen.php">Creëer notulen</a>';
                    }
                    else{
                        die('Niemand is ingelogd!');
                    }
                ?>
                    
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
                            <p class="textfooter"> Disclaimer </p>
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
