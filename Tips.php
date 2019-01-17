<?php
session_start();
 if(!isset($_SESSION['loggedin'])){
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
        <title>Suggesties</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/tips.css" rel="stylesheet" type="text/css" />
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

<!--            <div id="middlebox" >-->
                <div class="tipdoostop"></div>
                <div class="tipdoos">
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
                        <p class="tipdoos">Type hier je tekst*</p>
                        <textarea class="tipdoos" name="message" required=""></textarea>
                        <input type="submit" class="tipdoos" value="verzenden" name="submit">
                    </form>
                </div>
                <div class="tipdoosbottom"></div>
                <?php
                    if (isset($_POST['submit'])) {
                        if (!empty($_POST['message']) || !empty($_POST['schooljaar'])) {
                            require "DBFuncs.php";
                            $DBConnect = DBHandshake('127.0.0.1', 'root', '');
                            $DBName = "projectplenair";
                            $TableName = "users";
                            $Table2Name = "feedbacksuggestie";
                            if(TableExistCheck($DBConnect, $DBName, $TableName) === TRUE && TableExistCheck($DBConnect, $DBName, $Table2Name) === TRUE){
                                $insertquery = 'INSERT INTO '. $Table2Name 
                                .' (Tekst, Datum, Cohort, Schooljaar, Periode, Module)'
                                .' VALUES ( ?, ?, ?, ?, ?, ? )';
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
                                echo $datum;
                                
                                $selectquery = "SELECT Cohort FROM ". $TableName ." WHERE LeerlingNR = ?;";
                                $leerlingNR = $_SESSION['userID'];
                                if ($stmt = mysqli_prepare($DBConnect, $selectquery)) {
                                    mysqli_stmt_bind_param($stmt, 's', $leerlingNR);
                                    echo 'test';
                                    $QueryResult = mysqli_stmt_execute($stmt);
                                    if ($QueryResult === FALSE) {
                                        echo "<p>Er ging iets mis!.</p>"
                                        . "<p>Error code "
                                        . mysqli_errno($DBConnect)
                                        . ": "
                                        . mysqli_error($DBConnect)
                                        . "</p>";
                                    } else {
                                        mysqli_stmt_store_result($stmt);
                                        echo $cohort;
                                        echo 'test';
                                    }
                                    mysqli_stmt_close($stmt);
                                } else {
                                    DBQueryError($DBConnect);
                                }

                            }
                        } else {
                            echo 'Vul alle vereiste velden in.';
                        }
                    }
                ?>
<!--            </div>-->
        </div>

    </body>
</html>