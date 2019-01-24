<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<!--
Title Tipdoos PlenWEBAPP
Authors Thijs v.d Wall, Twan Verdel
Front-end Dev.
-->
<html lang="nl">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Tipdoos</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/tips.css" rel="stylesheet" type="text/css" />
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
                    <div class="language">
                        <ul>
                            <li>&#127760;</li>
                            <li class=""><a href="tips.php">NL</a></li>
                            <li class=""><a href="en/tips.php">EN</a></li>
                        </ul>
                    </div>
                </div> 
            </div>
            <?php
            if (isset($_SESSION['admin'])) {
                require "DBFuncs.php";
                $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                $DBName = "projectplenair";
                $Table3Name = "feedbacksuggestie";
                if (TableExistCheck($DBConnect, $DBName, $Table3Name) === TRUE) {
                    $showallquery = "SELECT * FROM " . $Table3Name . " ORDER BY datum;";
                    if ($stmt = mysqli_prepare($DBConnect, $showallquery)) {
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $ID, $tekst, $datum, $cohort, $Schooljaar, $periode, $module);
                        mysqli_stmt_store_result($stmt);
                        if (mysqli_stmt_num_rows($stmt) == 0) {
                            echo "<p>Er zijn geen tips</p>";
                        } else {
                            while (mysqli_stmt_fetch($stmt)) {
                                echo '<table class="title">
                                            <tr>
                                                <th>Tip of feedback nummer: ' . $ID . '   <a href="tipdelete.php?ID=' . $ID . '">DELETE</a></th>
                                            </tr>
                                            <tr>
                                                <td>' . $tekst . '</td>
                                            </tr>
                                        </table>
                                        <table class="info">
                                            <tr>
                                                <td class="small">Cohort:</td>
                                                <td class="small">' . $cohort . '</td>
                                                <td>Schooljaar: ' . $Schooljaar;
                                if (is_null($periode) == FALSE) {
                                    echo ' periode: ' . $periode;
                                }

                                echo '
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="small">Datum:</td>
                                                <td class="small">' . $datum . '</td>
                                                <td>';
                                if (is_null($module) == FALSE) {
                                    echo ' Module: ' . $module;
                                }
                                echo '</td>
                                            </tr>
                                            <tr>

                                            </tr>
                                        </table>';
                            }
                        }
                    }
                    mysqli_stmt_close($stmt);
                }
                mysqli_close($DBConnect);
            } else {
                echo '<div class="tipdoos">
                        <form name="tipdoos" action="Tips.php" method="post">
                            <p>Geef feedback of een suggestie!</p>
                            <p class="tipdoos">Geef een module op</p>
                            <input type="text" name="module" class="tipdoos">
                            <p class="tipdoos">Geef een leerjaar op*</p>
                            <p class="periode"><input type="radio" name="leerjaar" value="1" checked> 1</p>
                            <p class="periode"><input type="radio" name="leerjaar" value="2"> 2</p>
                            <p class="periode"><input type="radio" name="leerjaar" value="3"> 3</p>
                            <p class="periode"><input type="radio" name="leerjaar" value="4"> 4</p>
                            <p class="tipdoos">Geef een periode op</p>
                            <p class="periode"><input type="radio" name="periode" value="1"> 1</p>
                            <p class="periode"><input type="radio" name="periode" value="2"> 2</p>
                            <p class="periode"><input type="radio" name="periode" value="3"> 3</p>
                            <p class="periode"><input type="radio" name="periode" value="4"> 4</p>
                            <div class="clear"></div>
                            <p class="tipdoos">Type hier je tekst* (max 500 letters)</p>
                            <textarea class="tipdoos" name="message" required="" maxlength="500"></textarea>
                            <input type="submit" class="tipdoos" value="verzenden" name="submit">
                        </form>';

                if (isset($_POST['submit'])) {
                    if (!empty($_POST['message']) && !empty($_POST['leerjaar']) && strlen($_POST['message']) <= 500) {
                        require "DBFuncs.php";
                        $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                        $DBName = "projectplenair";
                        $TableName = "users";
                        $Table2Name = "feedbacksuggestie";
                        if (TableExistCheck($DBConnect, $DBName, $TableName) === TRUE && TableExistCheck($DBConnect, $DBName, $Table2Name) === TRUE) {
                            if (empty($_POST['module'])) {
                                $module = NULL;
                            } else {
                                $module = htmlentities($_POST['module']);
                            }
                            if (empty($_POST['periode'])) {
                                $periode = NULL;
                            } else {
                                $periode = htmlentities($_POST['periode']);
                            }
                            $leerjaar = htmlentities($_POST['leerjaar']);
                            $tekst = htmlentities($_POST['message']);
                            $datum = date("Y-m-d");
                            $selectquery = "SELECT Cohort FROM " . $TableName . " WHERE LeerlingNR = ?;";
                            $leerlingNR = $_SESSION['userID'];
                            if ($stmt = mysqli_prepare($DBConnect, $selectquery)) {
                                mysqli_stmt_bind_param($stmt, 's', $leerlingNR);
                                $QueryResult = mysqli_stmt_execute($stmt);
                                if ($QueryResult === FALSE) {
                                    echo "<p>Er ging iets mis!.</p>"
                                    . "<p>Error code "
                                    . mysqli_errno($DBConnect)
                                    . ": "
                                    . mysqli_error($DBConnect)
                                    . "</p>";
                                } else {
                                    mysqli_stmt_bind_result($stmt, $cohort);
                                    mysqli_stmt_store_result($stmt);
                                    if (mysqli_stmt_num_rows($stmt) == 0) {
                                        echo "<p>There are no entries</p>";
                                        mysqli_stmt_close($stmt);
                                    } else {
                                        echo $cohort;
                                        mysqli_stmt_fetch($stmt);
                                        $insertquery = 'INSERT INTO ' . $Table2Name
                                                . ' (Tekst, Datum, Cohort, Schooljaar, Periode, Module)'
                                                . ' VALUES ( ?, ?, ?, ?, ?, ? )';
                                        if ($stmt = mysqli_prepare($DBConnect, $insertquery)) {
                                            mysqli_stmt_bind_param($stmt, 'ssssss', $tekst, $datum, $cohort, $leerjaar, $periode, $module);
                                            $QueryResult2 = mysqli_stmt_execute($stmt);
                                            if ($QueryResult2 === FALSE) {
                                                echo "<p>Unable to execute the query.</p>"
                                                . "<p>Error code "
                                                . mysqli_errno($DBConnect)
                                                . ": "
                                                . mysqli_error($DBConnect)
                                                . "</p>";
                                            } else {
                                                echo '<p>Bedankt voor het invullen!</p>';
                                            }
                                            mysqli_stmt_close($stmt);
                                        }
                                    }
                                }
                            } else {
                                DBQueryError($DBConnect);
                            }
                        }
                        mysqli_close($DBConnect);
                    } else {
                        echo '<p>Vul alle vereiste velden in.</p>';
                    }
                }
                echo '</div>';
            }
            ?>
        </div>
            <?php include 'footer.html'; ?>
    </body>
</html>