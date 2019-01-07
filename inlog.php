<!DOCTYPE html>
<!--
INLOG WEBAPP
17-12-2018
-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/inlog.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Start Pagina</title>
    </head>
    <body>
        <div id="inlog"> 
            <div id="inlogbox">
                 <div id="formbox">

                 <h2>Login</h2>
                    <form action="/ppw/loggedin.php" method="POST">
                        <div class="container">
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



    </body>
</html>

