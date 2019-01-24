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
                <div id="headertxt">
                    <div class="language">
                        <ul>
                            <li>&#127760;</li>
                            <li class=""><a href="StartPage.php">NL</a></li>
                            <li class=""><a href="en/StartPage_en.php">EN</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="inlog"> 
                <div id="inlogbox">
                    <div id="formbox">
                        <h2>Login</h2>
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
                            <div class="container">
                                <p><b>Student/Docent nummer</b></p>
                                <input type="text" placeholder="Enter Username" name="uname" required class="unamepsw">
                                <p><b>Wachtwoord</b></p>
                                <input type="password" placeholder="Enter Password" name="psw" required class="unamepsw">
                                <p><label for="teachlogin">Log in als docent? <input type="checkbox" name="teachlogin" id="teachlogin"></label></p>
                                <input type="submit" name="submit" value="Inloggen">
                            </div>
                        </form>
                        <?php
                        /*
                         * Programmer: Maurice Hoekstra
                         * Date Created: 07-01-2019
                         * Description: Plenair web app login page
                         */
                        require 'DBFuncs.php';
                        if (isset($_POST['submit'])) {
                            $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                            $DBName = 'projectplenair';
                            $TableName = 'users';
                            $Table2Name = 'admins';
                            $Username = $_POST['uname'];
                            $Password = $_POST['psw'];
                            if (isset($_POST['teachlogin'])) {
                                if (TableExistCheck($DBConnect, $DBName, $Table2Name)) {
                                    $Query = "SELECT AdminNR FROM " . $Table2Name
                                            . " WHERE AdminNR = ? AND Password = ?;";
                                    if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                                        mysqli_stmt_bind_param($stmt, 'ss', $Username, $Password);
                                        if (!mysqli_stmt_execute($stmt)) {
                                            DBQueryError($DBConnect);
                                        } else {
                                            mysqli_stmt_bind_result($stmt, $UserID);
                                            mysqli_stmt_store_result($stmt);
                                            if (mysqli_stmt_num_rows($stmt) == 0) {
                                                echo "<p>Onjuiste nummer of wachtwoord</p>";
                                            } else {
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    $_SESSION['admin'] = TRUE;
                                                    $_SESSION['userID'] = $UserID;
                                                    $_SESSION['loggedin'] = TRUE;
                                                    header('Location: Startpage.php');
                                                }
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    } else {
                                        DBQueryError($DBConnect);
                                    }
                                }
                                mysqli_close($DBConnect);
                            } else {
                                if (TableExistCheck($DBConnect, $DBName, $TableName)) {
                                    $Query = "SELECT LeerlingNR FROM " . $TableName
                                            . " WHERE LeerlingNR = ? AND Password = ?;";
                                    if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                                        mysqli_stmt_bind_param($stmt, 'ss', $Username, $Password);
                                        if (!mysqli_stmt_execute($stmt)) {
                                            DBQueryError($DBConnect);
                                        } else {
                                            mysqli_stmt_bind_result($stmt, $UserID);
                                            mysqli_stmt_store_result($stmt);
                                            if (mysqli_stmt_num_rows($stmt) == 0) {
                                                echo "<p>Onjuiste nummer of wachtwoord</p>";
                                            } else {
                                                while (mysqli_stmt_fetch($stmt)) {
                                                    $_SESSION['userID'] = $UserID;
                                                    $_SESSION['loggedin'] = TRUE;
                                                    header('Location: Startpage.php');
                                                }
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    } else {
                                        DBQueryError($DBConnect);
                                    }
                                }
                                mysqli_close($DBConnect);
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php include 'footer.html'; ?>
            </div>
        </div>
    </body>
</html>

