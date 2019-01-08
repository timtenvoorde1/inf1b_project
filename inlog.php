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
                       <form action="<?php htmlentities($_SERVER['PHP_SELF'])?>" method="POST">
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
            <div id="footer" >
            </div>
        </div>
        <?php
           /*
            * Programmer: Maurice Hoekstra
            * Date Created: 07-01-2019
            * Description: Plenair web app login page
            */
            require 'DBFuncs.php';
            if(isset($_POST['submit'])){
                $DBConnect = mysqli_connect('127.0.0.1', 'root', '');
                $DBName = 'placeholder';
                $TableArrayName = array('placeholder', 'placeholder2');
                $Username = $_POST['uname'];
                $Password = $_POST['psw'];
                $Tablecount = 0;
                foreach($TableArrayName as $TableName){
                    $Tablecount++;
                    if(TableExistCheck($DBConnect, $DBName, $TableName)){
                        $Query = "SELECT UserID FROM ".$TableName
                                ." WHERE UserName = ? AND UserPass = ?;";
                        if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                            mysqli_stmt_bind_param($stmt, 'ss' ,$Username,
                                    $Password);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $UserID);
                            mysqli_stmt_store_result($stmt);
                            if (mysqli_stmt_num_rows($stmt) == 0) {
                                echo "<p>Invalid username or password</p>";
                            }
                            else{
                                while(mysqli_stmt_fetch($stmt)){
                                    if($Tablecount == 2){
                                        $_SESSION['admin'] = TRUE;
                                    }
                                    $_SESSION['userID'] = $UserID;
                                    $_SESSION['loggedin'] = TRUE;
                                    echo "You have been logged in!";
                                    header('Location: '.$_GET['page']);
                                }
                            }
                            mysqli_stmt_close($stmt);
                        }
                        else{
                            DBQueryError($DBConnect);
                        }
                    }
                }
                mysqli_close($DBConnect);
            }
        ?>
    </body>
</html>

