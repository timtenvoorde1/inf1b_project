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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <div class="language">
                        <ul>
                            <li>&#127760;</li>
                            <li class=""><a href="StartPage.php">NL</a></li>
                            <li class=""><a href="en/StartPage_en.php">EN</a></li>
                        </ul>
                    </div>
                </div>
            </div> 
            <div id="middlebox">
                <div id="tilecontainer">
                    <div id="seenotulen">
                        
                        <?php
                        /*
                         * Programmer: Maurice Hoekstra
                         * Date Created: 17-01-2019
                         * Description: Agenda & Notule viewing
                         */
                        require 'DBFuncs.php';
                        if (isset($_GET['notulen'])) {
                            $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                            $DBName = 'projectplenair';
                            $TableName = 'notulen';
                            $ID = filter_var($_GET['notulen'], FILTER_VALIDATE_INT);
                            if (TableExistCheck($DBConnect, $DBName, $TableName) === TRUE) {
                                $Query = "SELECT Tekst"
                                        . " FROM " . $TableName
                                        . " WHERE AgendaNR = ? ;";

                                if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                                    mysqli_stmt_bind_param($stmt, 'i', $ID);
                                    if (!mysqli_stmt_execute($stmt)) {
                                        DBQueryError($DBConnect);
                                    } else {
                                        mysqli_stmt_bind_result($stmt, $Text);
                                        mysqli_stmt_store_result($stmt);
                                        if (mysqli_stmt_num_rows($stmt) == 0) {
                                            echo "<p>De notule bestaat niet!</p>";
                                        } else {
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo $Text;
                                            }
                                        }
                                    }
                                    mysqli_stmt_close($stmt);
                                } else {
                                    DBQueryError($DBConnect);
                                }
                            }
                            mysqli_close($DBConnect);
                        }
                        if (isset($_GET['agenda'])) {
                            $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                            $DBName = 'projectplenair';
                            $TableName = 'agenda';
                            $ID = filter_var($_GET['agenda'], FILTER_VALIDATE_INT);
                            if (TableExistCheck($DBConnect, $DBName, $TableName) === TRUE) {
                                $Query = "SELECT Tekst"
                                        . " FROM " . $TableName
                                        . " WHERE AgendaNR = ? ;";

                                if ($stmt = mysqli_prepare($DBConnect, $Query)) {
                                    mysqli_stmt_bind_param($stmt, 'i', $ID);
                                    if (!mysqli_stmt_execute($stmt)) {
                                        DBQueryError($DBConnect);
                                    } else {
                                        mysqli_stmt_bind_result($stmt, $Text);
                                        mysqli_stmt_store_result($stmt);
                                        if (mysqli_stmt_num_rows($stmt) == 0) {
                                            echo "<p>De agenda bestaat niet!</p>";
                                        } else {
                                            while (mysqli_stmt_fetch($stmt)) {
                                                echo '<p>Bespreekpunten:</p><p>' . $Text . '</p>';
                                            }
                                        }
                                    }
                                    mysqli_stmt_close($stmt);
                                } else {
                                    DBQueryError($DBConnect);
                                }
                            }
                            mysqli_close($DBConnect);
                        }
                        ?>
                        
                        <?php
                        if (isset($_GET['notulen'])) {
                            echo '<p><a href="shownotulen.php?notulen">Terug</a></p>';
                        } elseif (isset($_GET['agenda'])) {
                            echo '<p><a href="shownotulen.php?agenda">Terug</a></p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
                        <?php include 'footer.html'; ?>
        </div>
    </body>
</html>


