<?php session_start() ?>
<!DOCTYPE html>
<!--
INLOG WEBAPP
17-12-2018
-->
<html lang="nl">
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/inlog.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inlog Pagina</title>
    </head>
    <body>
<<<<<<< HEAD
        <div id="mainContainer">
            <div id="header">
                <div id="logo">
                    <img src="img/stenden.png" alt="NHL_STENDEN"> 
                </div>
            </div>
            <div id="inlog"> 
                <div id="inlogbox">
                    <div id="formbox">

                        <form action=.....php" method="POST">
                            <div class="container">
                                <h2>Login</h2>
                                <p><b>Username</b></p>
                                <input type="text" placeholder="Enter Username" name="uname" required>
                                <p><b>Password</b></p>
                                <input type="password" placeholder="Enter Password" name="psw" required>
                                <button type="submit">Login</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</body>
=======
        <div id="inlog"> 
            <div id="inlogbox">
                <div id="formbox">
                   <h2>Login</h2>
                   <form action="/ppw/loggedin.php" method="POST">
                        <div class="container">
                            <p><b>Gebruikersnaam</b></p>
                            <input type="text" placeholder="Enter Username" name="uname" required>
                            <p><b>Wachtwoord</b></p>
                            <input type="password" placeholder="Enter Password" name="psw" required>
                            <button type="submit">Login</button>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </body>
>>>>>>> 44622d4baae4c8cb41e7f898e211361be23f487c
</html>

